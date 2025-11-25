<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class HomepageController extends Controller
{
    /**
     * Display the modern homepage.
     */
    public function index(): View
    {
        // Get featured products (first 6 active products)
        $featuredProducts = Product::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('home.homepage', [
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
