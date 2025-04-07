<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ReviewController
{
    public function index(): View|Factory|Application
    {
        return view('admin.reviews.index', [
            'reviews' => Review::simplePaginate(20),
        ]);
    }
    public function edit(Review $review): View|Factory|Application
    {
        return view('admin.reviews.edit', [
            'review' => $review,
        ]);
    }
    public function update(Review $review): Application|Redirector|RedirectResponse
    {
        $attributes = request()->validate([
           'comment' => 'required',
           'rating' => 'required',
        ]);

        $review->update($attributes);
        return redirect("admin/reviews");
    }

    public function destroy(Review $review): Application|Redirector|RedirectResponse
    {
        $review->delete();
        return redirect("admin/reviews");
    }

}
