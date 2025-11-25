<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Announcement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with announcements and hero section.
     *
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        // Fetch announcements
        $announcements = Announcement::published()->pinned()->limit(3)->get();

        // Fetch featured products (newest, with active variants that have stock)
        $featuredProducts = Product::active()
            ->with('variants')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get()
            ->filter(function ($product) {
                // Only include products that have at least one active variant with stock
                return $product->variants()
                    ->where('status', 'active')
                    ->where('stock_quantity', '>', 0)
                    ->exists();
            });

        return view('home.index', [
            'announcements' => $announcements,
            'featuredProducts' => $featuredProducts,
        ]);
    }
}

