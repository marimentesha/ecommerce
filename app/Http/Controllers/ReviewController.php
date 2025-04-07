<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class ReviewController
{
    public function create(Product $product): View|Factory|Application
    {
        return view('products.show', [
            'product' => $product,
            'products' => Product::all(),
        ]);
    }

    public function store(Product $product): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'comment' => 'required',
            'rating' => 'required',
        ]);

        Review::create([
            'comment' => $attributes['comment'],
            'rating' => $attributes['rating'],
            'product_id' => $product->id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('product/' . $product->id);
    }

    public function update(Product $product, Review $review): RedirectResponse
    {
        $attributes = request()->validate([
           'comment' => 'required',
           'rating' => 'required',
        ]);

        $review->update($attributes);
        return redirect("product/$product->id");
    }

    public function destroy(Product $product, Review $review): Application|Redirector|RedirectResponse
    {
        $review->delete();
        return redirect("product/$product->id");
    }

}
