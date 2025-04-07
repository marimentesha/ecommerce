<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Discount;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class CouponController
{

    public function index(): View|Factory|Application
    {
        return view('admin.coupons.index', [
            'coupons' => Discount::all()
        ]);
    }

    public function create(): View|Factory|Application
    {
        return view('admin.coupons.create');
    }

    public function store(): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'code' => 'required',
            'discount_type' => 'required',
            'discount_value' => 'required',
            'expiration_date' => 'required',
        ]);

        Discount::create($attributes);
        return redirect(url('admin/coupons'));
    }

    public function edit(Discount $coupon): View|Factory|Application
    {
        return view('admin.coupons.edit', [
            'coupon' => $coupon
        ]);
    }

    public function update(Discount $coupon): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
           'code' => 'required',
           'discount_type' => 'required',
           'discount_value' => 'required',
           'expiration_date' => 'required',
        ]);

        $coupon->update($attributes);
        return redirect(url('admin/coupons'));
    }

    public function destroy(Discount $coupon): Application|Redirector|RedirectResponse
    {
        $coupon->delete();
        return redirect('/admin/coupons');
    }

}
