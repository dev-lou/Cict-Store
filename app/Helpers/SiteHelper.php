<?php

namespace App\Helpers;

class SiteHelper
{
    /**
     * Get the site name from app configuration
     */
    public static function getSiteName()
    {
        return config('app.name', 'IGP Hub');
    }
}
