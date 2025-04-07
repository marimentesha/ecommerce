<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\CreditCard;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\UserDetail;
use App\Rules\Luhn;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CheckoutController
{
    public function index(): View|Factory|Application
    {
        $items = CartItem::get()->where('user_id', Auth::id());

        $discount = session('discount');

        if ($discount && Carbon::now()->gt(Carbon::parse($discount['expiration_date']))) {
            session()->forget('discount');
        }

        $totalPrice = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $discountAmount = $discount['discount_amount'] ?? 0;
        if ($discount && $discount["discount_type"] == "percentage") {
            $discountAmount = $discountAmount / 100 * $totalPrice;
        }

        return view('products.checkout', [
            'cartItems' => $items,
            'total' => $totalPrice,
            'discount' => $discountAmount,
        ]);
    }

    public function store(): RedirectResponse
    {
        request()->validate([
            'first' => 'required',
            'last' => 'required',
            'phone' => 'required',
            'payment' => 'required',
            'card_number' => ['required_if:payment,card', 'digits_between:13,19', new Luhn],
            'expiry_month' => 'required_if:payment,card|integer|between:1,12',
            'expiry_year' => 'required_if:payment,card|integer|min:' . now()->year,
            'cvv' => 'required_if:payment,card|digits_between:3,4',
            'card_type' => 'required_if:payment,card',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'address2' => 'required',
            'zip_code' => 'required',
        ]);

        $cartData = request()->input('cart');

        if(request()->input('payment') == 'card') {
            $card = CreditCard::create([
                'user_id' => Auth::id(),
                'last_four_digits' => substr(request('card_number'), -4),
                'card_type' => request('card_type'),
            ]);
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => request('first') . ' ' . request('last'),
            'total' => request('total'),
            'payment_method' => request('payment'),
            'credit_card_id' => $card->id ?? null,
        ]);

        foreach ($cartData as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            CartItem::get()->where('id',$item['cartId'])->first()->delete();
        }

        if (UserDetail::get()->where('user_id', Auth::id())->isEmpty())
        {
            UserDetail::create([
                'user_id' => Auth::id(),
                'address1' => request('address'),
                'address2' => request('address2'),
                'city' => request('city'),
                'country' => request('country'),
                'zip_code' => request('zip_code'),
                'phone' => request('phone'),
            ]);
        } elseif (!(UserDetail::get()->where('user_id', Auth::id())->isEmpty()))
        {
            (new UserDetail())->update([
                'address1' => request('address'),
                'address2' => request('address2'),
                'city' => request('city'),
                'country' => request('country'),
                'zip_code' => request('zip_code'),
                'phone' => request('phone'),
            ]);
        }

        session()->forget('discount');
        return redirect('/complete');
    }

    public function complete(): View|Factory|Application
    {
        return view('products.complete');
    }
}
