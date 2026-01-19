<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Services\SupabaseFallback;
use App\DTO\FallbackProduct;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Throwable;

class HomepageController extends Controller
{
    /**
     * Display the modern homepage.
     */
    public function index(): View
    {
        // Cache featured products for 10 minutes
        $featuredProducts = Cache::remember('homepage.featured_products', now()->addMinutes(10), function () {
            try {
                return Product::where('status', 'active')
                    ->select(['id', 'name', 'slug', 'base_price', 'image_path', 'created_at'])
                    ->orderBy('created_at', 'desc')
                    ->take(4)
                    ->get();
            } catch (Throwable $e) {
                logger()->warning('Unable to fetch featured products: ' . $e->getMessage());
                return collect([]);
            }
        });

        // Cache featured services for 10 minutes
        $featuredServices = Cache::remember('homepage.featured_services', now()->addMinutes(10), function () {
            try {
                return Service::where('is_active', true)
                    ->select(['id', 'title', 'slug', 'description', 'icon', 'price_primary', 'price_secondary', 'created_at'])
                    ->orderByDesc('created_at')
                    ->take(3)
                    ->get();
            } catch (Throwable $e) {
                logger()->warning('Unable to fetch featured services: ' . $e->getMessage());
                return collect([]);
            }
        });

        // Cache site logo URL for 30 minutes
        $logoUrl = Cache::remember('site.logo_url', now()->addMinutes(30), function () {
            try {
                $logoSetting = Setting::where('key', 'site_logo')->first();
                if ($logoSetting && $logoSetting->value) {
                    return Storage::disk('supabase')->url($logoSetting->value);
                }
            } catch (Throwable $e) {
                logger()->warning('Unable to fetch site logo: ' . $e->getMessage());
            }
            return asset('images/ctrlp-logo.png');
        });

        // Service categories (keep existing logic, add caching)
        $serviceCategories = Cache::remember('homepage.service_categories', now()->addMinutes(10), function () {
            try {
                return Service::where('is_active', true)
                    ->orderBy('sort_order')
                    ->get()
                    ->groupBy(fn($service) => $service->category ?: 'General')
                    ->map(fn($group) => [
                        'name' => $group->first()->category ?: 'General',
                        'count' => $group->count(),
                    ])
                    ->values();
            } catch (Throwable $e) {
                logger()->warning('Unable to fetch service categories: ' . $e->getMessage());
                return collect([]);
            }
        });

        return view('home.homepage', [
            'featuredProducts' => $featuredProducts,
            'featuredServices' => $featuredServices,
            'serviceCategories' => $serviceCategories,
            'logoUrl' => $logoUrl,
        ]);
    }
}
