<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController
{
    public function index(): View|Factory|Application
    {
        return view('admin.products.index', [
            'products' => Product::simplePaginate(20),
        ]);
    }

    public function create(): View|Factory|Application
    {
        return view('admin.products.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required',
            'category_id' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (request()->hasFile('image')) {
            $path = (request()->file('image'))->store('products', 'public');
            $attributes['image'] = $path;
        }

        $attributes['user_id'] = Auth::id();

        Product::create($attributes);
        return redirect(url('admin/products'));
    }

    public function edit(Product $product): View|Factory|Application
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
        ]);
    }

    public function update(Product $product): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required',
            'category_id' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (request()->hasFile('image')) {
            $path = (request()->file('image'))->store('products', 'public');
            $attributes['image'] = $path;

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
        }

        $product->update($attributes);
        return redirect('admin/products');
    }

    public function createImage(Product $product): View|Factory|Application
    {
        return view('admin.products.createImage', [
            'product' => $product,
            'images' => $product->productImage,
        ]);
    }

    public function storeImage(Product $product): Application|Redirector|RedirectResponse
    {
        request()->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        if (request()->hasFile('images')) {
            foreach (request()->file('images') as $photo) {
                $path = $photo->store('products', 'public');
                ProductImage::create([
                    'image' => $path,
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect('admin/products');
    }

    public function destroyImage(ProductImage $productImage): RedirectResponse
    {
        if ($productImage->image) {
            Storage::disk('public')->delete($productImage->image);
        }
        $productImage->delete();
        return redirect(url("admin/product/image/" . $productImage->product->id));
    }

    public function destroy(Product $product): Application|Redirector|RedirectResponse
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect('admin/products');
    }

}
