<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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
                logger()->warning('Unable to fetch featured products: '.$e->getMessage());

                return collect([]);
            }
        });

        // Cache featured services for 10 minutes
        $featuredServices = Cache::remember('homepage.featured_services', now()->addMinutes(10), function () {
            try {
                return Service::whereRaw('"is_active" IS TRUE')
                    ->select(['id', 'title', 'slug', 'description', 'icon', 'price_primary', 'price_secondary', 'created_at'])
                    ->orderByDesc('created_at')
                    ->take(3)
                    ->get();
            } catch (Throwable $e) {
                logger()->warning('Unable to fetch featured services: '.$e->getMessage());

                return collect([]);
            }
        });

        $featuredProductDisplayPrices = collect();
        $featuredProductIds = $featuredProducts->pluck('id')->filter()->values()->all();

        if (! empty($featuredProductIds)) {
            $idsCacheKey = 'homepage.featured_variant_min_modifiers.'.md5(implode(',', $featuredProductIds));

            $variantMinModifiers = Cache::remember($idsCacheKey, now()->addMinutes(10), function () use ($featuredProductIds) {
                return DB::table('product_variants')
                    ->select('product_id', DB::raw('MIN(price_modifier) as min_price_modifier'))
                    ->whereIn('product_id', $featuredProductIds)
                    ->where('status', 'active')
                    ->groupBy('product_id')
                    ->get()
                    ->mapWithKeys(function ($row) {
                        return [(int) $row->product_id => (float) $row->min_price_modifier];
                    });
            });

            $featuredProductDisplayPrices = $featuredProducts->mapWithKeys(function ($product) use ($variantMinModifiers) {
                $basePrice = (float) ($product->base_price ?? 0);
                $modifier = (float) ($variantMinModifiers[(int) $product->id] ?? 0);

                return [(int) $product->id => $basePrice + $modifier];
            });
        }

        // Cache site logo URL for 30 minutes
        $logoUrl = Cache::remember('site.logo_url', now()->addMinutes(30), function () {
            try {
                $logoSetting = Setting::where('key', 'site_logo')->first();
                if ($logoSetting && $logoSetting->value) {
                    /** @var \Illuminate\Filesystem\FilesystemAdapter $supabaseDisk */
                    $supabaseDisk = Storage::disk('supabase');

                    return $supabaseDisk->url($logoSetting->value);
                }
            } catch (Throwable $e) {
                logger()->warning('Unable to fetch site logo: '.$e->getMessage());
            }

            return asset('images/ctrlp-logo.webp');
        });

        // Service categories (keep existing logic, add caching)
        $serviceCategories = Cache::remember('homepage.service_categories', now()->addMinutes(10), function () {
            try {
                return Service::whereRaw('"is_active" IS TRUE')
                    ->orderBy('sort_order')
                    ->get()
                    ->groupBy(fn ($service) => $service->category ?: 'General')
                    ->map(fn ($group) => [
                        'name' => $group->first()->category ?: 'General',
                        'count' => $group->count(),
                    ])
                    ->values();
            } catch (Throwable $e) {
                logger()->warning('Unable to fetch service categories: '.$e->getMessage());

                return collect([]);
            }
        });

        return view('home.homepage', [
            'featuredProducts' => $featuredProducts,
            'featuredProductDisplayPrices' => $featuredProductDisplayPrices,
            'featuredServices' => $featuredServices,
            'serviceCategories' => $serviceCategories,
            'logoUrl' => $logoUrl,
        ]);
    }
}
