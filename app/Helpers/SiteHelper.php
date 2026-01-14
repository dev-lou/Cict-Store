<?php

namespace App\Helpers;

use App\Models\Setting;

class SiteHelper
{
    /**
     * Get the site name from database or app configuration
     */
    public static function getSiteName()
    {
        $setting = Setting::where('key', 'site_name')->first();
        return $setting ? $setting->value : config('app.name', 'CICT Dingle');
    }
}
