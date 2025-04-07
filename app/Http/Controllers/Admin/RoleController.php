<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class RoleController
{
    public function index(): View|Factory|Application
    {
        return view('admin.roles.index', [
            'roles' => Role::all(),
        ]);
    }

    public function create(): View|Factory|Application
    {
        return view('admin.roles.create');
    }

    public function store(): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'name' => 'required',
        ]);

        Role::create($attributes);
        return redirect(url('admin/roles'));
    }

    public function edit(Role $role): View|Factory|Application
    {
        return view('admin.roles.edit', [
            'role' => $role,
        ]);
    }

    public function update(Role $role): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'name' => 'required',
        ]);

        $role->update($attributes);
        return redirect(url('admin/roles'));
    }

    public function destroy(Role $role): Application|Redirector|RedirectResponse
    {
        $role->delete();
        return redirect(url('admin/roles'));
    }
}
