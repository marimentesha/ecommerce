<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class HomeController extends Controller
{
    public function index(): View|Factory|Application
    {
        return view('index',
        [
            'products' => Product::all(),
            'categories' => Category::all(),
        ]);
    }

    public function about(): View|Factory|Application
    {
        return view('about');
    }

    public function contacts(): View|Factory|Application
    {
        return view('contacts');
    }

    public function feedback(): View|Factory|Application
    {
        return view('feedback');
    }

    public function store(): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Feedback::create($attributes);
        return redirect('/');
    }

    public function search(): View|Factory|Application
    {
        $search = request()->input('search', '');
        $products = Product::whereRaw("LOWER(name) LIKE ?", ['%' . strtolower($search) . '%'])->get();

        return view('search', [
            'products' => $products,
        ]);
    }
}
