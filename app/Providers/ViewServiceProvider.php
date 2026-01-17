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
        // Share site logo with all views
        View::composer('*', function ($view) {
            try {
                $logoSetting = Setting::where('key', 'site_logo')->first();
                if ($logoSetting && $logoSetting->value) {
                    // Always use Supabase for logo regardless of FILESYSTEM_DISK setting
                    $logoUrl = \Storage::disk('supabase')->url($logoSetting->value);
                } else {
                    $logoUrl = asset('images/ctrlp-logo.png');
                }
            } catch (\Exception $e) {
                $logoUrl = asset('images/ctrlp-logo.png');
            }
            
            $view->with('siteLogo', $logoUrl);
        });
    }
}
