<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the product shop page with all items and variants.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $query = Product::query()->active();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = htmlspecialchars($request->search, ENT_QUOTES, 'UTF-8');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price-low':
                $query->orderBy('base_price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('base_price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Pagination
        $products = $query->paginate(12);

        return view('shop.index', [
            'products' => $products,
            'sort' => $sort,
            'search' => $request->search,
        ]);
    }

    /**
     * Display a single product detail page.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product): \Illuminate\View\View
    {
        // Load relationships
        $product->load(['variants']);

        // Get reviews with pagination
        $reviews = $product->reviews()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Calculate average rating
        $averageRating = $product->averageRating();

        // Get related products (active only)
        $relatedProducts = Product::query()
            ->active()
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        // Check if current user can review (authenticated and has completed order)
        $canReview = false;
        $userReview = null;
        
        if (auth()->check()) {
            $userReview = $product->reviews()->where('user_id', auth()->id())->first();
            
            if (!$userReview) {
                $canReview = \App\Models\Order::where('user_id', auth()->id())
                    ->where('status', 'completed')
                    ->whereHas('items', function ($query) use ($product) {
                        $query->where('product_id', $product->id);
                    })
                    ->exists();
            }
        }

        // Calculate rating breakdown
        $ratingBreakdown = [];
        for ($i = 5; $i >= 1; $i--) {
            $ratingBreakdown[$i] = $product->reviews()->where('rating', $i)->count();
        }

        return view('shop.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'reviews' => $reviews,
            'averageRating' => $averageRating,
            'canReview' => $canReview,
            'userReview' => $userReview,
            'ratingBreakdown' => $ratingBreakdown,
        ]);
    }
}

