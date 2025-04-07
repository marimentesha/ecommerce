<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;

class CategoryController
{
    public function index(): View|Factory|Application
    {
        return view('admin.categories.index', [
            'categories' => Category::simplePaginate(20)
        ]);
    }

    public function create(): View|Factory|Application
    {
        return view('admin.categories.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'name' => 'required',
            'parent_id' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(request()->hasFile('image')) {
            $path = request()->file('image')->store('categories', 'public');
            $attributes['image'] = $path;
        }

        Category::create($attributes);
        return redirect(url('admin/categories'));
    }

    public function edit(Category $category): View|Factory|Application
    {
        return view('admin.categories.edit', [
            'categories' => Category::all(),
            'category' => $category
        ]);
    }

    public function update(Category $category): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'name' => 'required',
            'parent_id' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if(request()->hasFile('image')) {
            $path = request()->file('image')->store('categories', 'public');
            $attributes['image'] = $path;

            if($category->image){
                Storage::disk('public')->delete($category->image);
            }
        }

        $category->update($attributes);
        return redirect(url('admin/categories'));
    }

    public function destroy(Category $category): Application|Redirector|RedirectResponse
    {
        Storage::disk('public')->delete($category->image);
        $category->delete();
        return redirect(url('admin/categories'));
    }

}
