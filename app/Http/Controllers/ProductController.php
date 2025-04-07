<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ProductController
{
    public function index(Category $category = null): View|Factory|Application
    {
        $selectedCategories = request()->input('categories', []);

        $sortOrder = request()->input('sort', 'asc');
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'asc';
        }

        if ($category) {
            $products = Product::where('category_id', $category->id)->orderBy('price', $sortOrder)->simplePaginate(20);
        } elseif ($selectedCategories) {
            $products = Product::when(!empty($selectedCategories), function ($query) use ($selectedCategories) {
                return $query->whereIn('category_id', $selectedCategories);
            })->orderBy('price', $sortOrder)->simplePaginate(20);
        }else {
            $products = (new Product)->orderBy('price', $sortOrder)->simplePaginate(20);
        }

        return view('products.index',
            [
                'products' => $products,
                'categories' => Category::all(),
            ]);
    }

    public function filter(): Application|Redirector|RedirectResponse
    {
        return redirect('/catalog')->withInput();
    }

    public function show(Product $product): View|Factory|Application
    {
        return view('products.show', [
            'product' => $product,
            'products' => Product::all(),
        ]);
    }
}
