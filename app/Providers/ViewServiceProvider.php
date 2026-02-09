<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share site logo with all views (cached for 10 minutes)
        View::composer('*', function ($view) {
            try {
                $logoUrl = \Cache::remember('site_logo_url', 600, function() {
                    $logoSetting = Setting::where('key', 'site_logo')->first();
                    if ($logoSetting && $logoSetting->value) {
                        // Always use Supabase for logo regardless of FILESYSTEM_DISK setting
                        return \Storage::disk('supabase')->url($logoSetting->value);
                    }
                    return asset('images/ctrlp-logo.webp');
                });
            } catch (\Exception $e) {
                $logoUrl = asset('images/ctrlp-logo.webp');
            }
            
            $view->with('siteLogo', $logoUrl);
        });
    }
}
