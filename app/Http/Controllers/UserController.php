<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use App\Models\UserDetail;
use App\Rules\Luhn;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function show(User $user): View|Factory|Application
    {
        return view('users.index', ['user' => $user]);
    }

    public function create(): View|Factory|Application
    {
        return view('users.create');
    }

    public function login(): View|Factory|Application
    {
        return view('users.login');
    }

    public function store(): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'first' => 'required',
            'last' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users',
            'password' => 'required|min:8',
            'password_repeat' => 'required|same:password',
        ]);

        $user = (new User())->create($attributes);
        Auth::login($user);

        return redirect('/');
    }

    public function authenticate(): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'password' => 'sorry, credentials do not match',
            ]);
        }

        request()->session()->regenerate();
        return redirect('/');
    }

    public function logout(): Application|Redirector|RedirectResponse
    {
        Auth::logout();
        return redirect('/');
    }

    public function password(User $user): View|Factory|Application
    {
        return view('users.profile.password', [
            'user' => $user
        ]);
    }

    public function updatePassword(User $user): Application|Redirector|RedirectResponse
    {
        request()->validate([
            'password_old' => ['required', 'current_password'],
            'password' => 'required|min:8',
            'password_again' => 'required|same:password',
        ]);

        $user->update([
            'password' => Hash::make(request('password')),
        ]);

        return redirect(url("users/$user->id"));
    }

    public function orders(User $user): View|Factory|Application
    {
        $orderStatus = OrderStatus::get();
        $orders = Order::get()->where('user_id', $user->id);

        $pending = $orderStatus->where('name', 'pending')->first()->id;
        $delivered = $orderStatus->where('name', 'delivered')->first()->id;
        $canceled = $orderStatus->where('name', 'canceled')->first()->id;

        if (request()->is('users/' . auth()->id() . '/orders/pending')) {
            $orders = $orders->where('status_id', $pending);
        } elseif (request()->is('users/' . auth()->id() . '/orders/delivered')) {
            $orders = $orders->where('status_id', $delivered);
        } elseif (request()->is('users/' . auth()->id() . '/orders/canceled')) {
            $orders = $orders->where('status_id', $canceled);
        }

        return view('users.profile.orders', [
            'user' => Auth::user(),
            'orders' => $orders,
        ]);
    }

    public function order(User $user, Order $order): View|Factory|Application
    {
        $totalPrice = $order->orderItem->sum(function ($order) {
            return $order->product->price * $order->quantity;
        });

        return view('users.profile.order', [
            'user' => $user,
            'order' => $order,
            'total' => $totalPrice,
        ]);
    }

    public function addresses(User $user): View|Factory|Application
    {
        return view('users.profile.addresses', [
            'user' => $user,
            'userDetail' => UserDetail::get()->where('user_id', $user->id)->first(),
        ]);
    }

    public function updateAddress(User $user): Application|Redirector|RedirectResponse
    {
        $userDetails = UserDetail::get()->where('user_id', $user->id)->first();
        $attributes = request()->validate([
            'address1' => 'required',
            'address2' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
            'city' => 'required',
            'phone' => 'required|unique:user_details,phone,' . $userDetails->id,
        ]);

        $userDetails->update($attributes);
        return redirect(url("/users/$user->id"));
    }

    public function cards(User $user): View|Factory|Application
    {
        $cards = CreditCard::all()->where('user_id', $user->id)->unique('last_four_digits');

        return view('users.profile.cards', [
            'user' => $user,
            'cards' => $cards,
        ]);
    }

    public function updateCard(User $user, CreditCard $card): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'card_number' => ['required', 'digits_between:13,19', new Luhn],
        ]);

        CreditCard::get()->where('user_id', $user->id)->where('id', $card->id)->first()->update([
            'last_four_digits' => substr($attributes['card_number'], -4),
        ]);
        return redirect(url('users/' . $user->id . '/cards'));
    }

    public function update(User $user): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'first' => 'required',
            'last' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
        ]);

        $user->update($attributes);
        return redirect(url("/users/$user->id"));
    }

    public function updatePhoto(User $user): Application|Redirector|RedirectResponse
    {
        request()->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        if (request()->hasFile('photo')) {
            $path = request()->file('photo')->store('profilePhotos', 'public');
            $user->update(['profile_photo' => $path]);
        }

        return redirect(url("/users/$user->id"));

    }

    public function destroy(User $user): Application|Redirector|RedirectResponse
    {
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->delete();
        return redirect("/");
    }
}
