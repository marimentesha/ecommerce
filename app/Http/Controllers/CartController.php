<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Discount;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CartController
{
    public function index(): View|Factory|Application
    {
        $items = CartItem::get()->where('user_id', Auth::id());
        $products = collect();
        $discount = session('discount');

        if ($discount && Carbon::now()->gt(Carbon::parse($discount['expiration_date']))) {
            session()->forget('discount');
        }

        foreach ($items as $item) {
            $similarProducts = Product::where('category_id', $item->product->category_id)->get();
            $products = $products->merge($similarProducts);
        }

        $totalPrice = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $discountAmount = $discount['discount_amount'] ?? 0;
        if ($discount && $discount["discount_type"] == "percentage") {
            $discountAmount = $discountAmount / 100 * $totalPrice;
        }else{
            $discountAmount = min($discountAmount, $totalPrice);
        }

        return view('products.cart', [
            'cartItems' => $items,
            'products' => $products,
            'total' => $totalPrice,
            'discount' => $discountAmount
        ]);
    }

    public function store(Product $product): RedirectResponse
    {
        $item = CartItem::get()->where('product_id', $product->id)->where('user_id', Auth::id())->first();
        if (!$item) {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => request('quantity') ?? 1,
            ]);
        } elseif ($item) {
            $item->update([
                'quantity' => request('quantity'),
            ]);
        }

        return redirect()->back();
    }

    public function update(CartItem $cartItem): RedirectResponse
    {
        $cartItem->update(['quantity' => request()->input('quantity')]);
        return redirect()->back();
    }

    public function coupon(): RedirectResponse
    {
        $couponCode = request()->input('coupon');

        $coupon = Discount::where('code', $couponCode)->where('expiration_date', '>=', Carbon::now())->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Invalid or expired coupon.');
        }

        if(session('discount')){
            session()->forget('discount');
        }

        $discountAmount = $coupon->discount_value;
        session(['discount' => ['discount_amount' => $discountAmount, 'expiration_date' => $coupon->expiration_date, "discount_type" => $coupon->discount_type]]);

        return redirect('/cart')->with('success', 'Coupon applied successfully!');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $cartProduct = CartItem::get()->where('user_id', Auth::id())->where('product_id', $product->id);
        $cartProduct->each->delete();

        return redirect()->back();
    }

}
