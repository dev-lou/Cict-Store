<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a new review.
     */
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Check if user has already reviewed this product
        $existingReview = Review::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        // Check if user has completed order with this product (verified purchase)
        $hasCompletedOrder = Order::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->whereHas('items', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->exists();

        // Get the most recent completed order with this product
        $order = Order::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->whereHas('items', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->latest()
            ->first();

        // Create review
        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'order_id' => $order?->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'verified_purchase' => $hasCompletedOrder,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }

    /**
     * Update an existing review.
     */
    public function update(Request $request, Review $review)
    {
        // Ensure user owns this review
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($validated);

        return back()->with('success', 'Review updated successfully!');
    }

    /**
     * Delete a review.
     */
    public function destroy(Review $review)
    {
        // Ensure user owns this review
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $review->delete();

        return back()->with('success', 'Review deleted successfully.');
    }
}
