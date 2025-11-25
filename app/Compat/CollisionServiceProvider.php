<?php

namespace NunoMaduro\Collision\Adapters\Laravel;

use Illuminate\Support\ServiceProvider;

/**
 * Minimal stub of NunoMaduro\Collision\Adapters\Laravel\CollisionServiceProvider
 * to avoid runtime errors when dev-only collision package is not installed.
 */
class CollisionServiceProvider extends ServiceProvider
{
    public function register()
    {
        // no-op stub for production
    }

    public function boot()
    {
        // no-op
    }
}
