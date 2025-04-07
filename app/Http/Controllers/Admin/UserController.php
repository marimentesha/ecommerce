<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class UserController
{
    public function index(): View|Factory|Application
    {
        return view('admin.users.index', [
            'users' => User::simplePaginate(20),
        ]);
    }

    public function edit(User $user): View|Factory|Application
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(User $user): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'first' => 'required',
            'last' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(request()->hasFile('profile_photo')) {
            $path = request()->file('profile_photo')->store('profilePhotos', 'public');
            $attributes['profile_photo'] = $path;

            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
        }

        $user->update($attributes);
        return redirect('admin');
    }

    public function roles(): View|Factory|Application
    {
        return view('admin.users.roles', [
            'users' => User::simplePaginate(20),
            'roles' => Role::all(),
        ]);
    }

    public function editRole(User $user, Role $role): View|Factory|Application
    {
        return view('admin.users.editRole', [
            'user' => $user,
            'roles' => Role::all(),
            'userRole' => $role,
        ]);
    }

    public function updateRole(User $user): Application|Redirector|RedirectResponse
    {

        request()->validate([
            'role' => 'required|exists:roles,id',
        ]);

        $user->role_id = request()->role;
        $user->save();
        return redirect('admin/user/roles');
    }

    public function destroy(User $user): Application|Redirector|RedirectResponse
    {
        Storage::disk('public')->delete($user->profile_picture);
        $user->delete();
        return redirect('admin');
    }
}
