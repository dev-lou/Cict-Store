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
            $logoSetting = Setting::where('key', 'site_logo')->first();
            $logoUrl = $logoSetting && $logoSetting->value 
                ? asset('storage/' . $logoSetting->value) 
                : asset('images/ctrlp-logo.png');
            
            $view->with('siteLogo', $logoUrl);
        });
    }
}
