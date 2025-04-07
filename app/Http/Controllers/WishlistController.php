<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishlistItem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class WishlistController
{
    public function index(): View|Factory|Application
    {
        $items = WishlistItem::get()->where('user_id', Auth::id());
        $products = collect();

        foreach ($items as $item) {
            $similarProducts = Product::where('category_id', $item->product->category_id)->get();
            $products = $products->merge($similarProducts);
        }

        return view('products.wishlist', [
            'wishlistItems' => $items,
            'products' => $products,
        ]);
    }

    public function store(Product $product): RedirectResponse
    {
        $item = WishlistItem::get()->where('product_id', $product->id)->where('user_id', Auth::id())->first();
        if(!$item)
        {
            WishlistItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);
        }

        return redirect()->back();
    }

    public function destroy(Product $product): RedirectResponse
    {
        $wishlistProduct = WishlistItem::get()->where('user_id', Auth::id())->where('product_id', $product->id);
        $wishlistProduct->each->delete();

        return redirect()->back();
    }

}
