<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure custom route rate limiters for security-sensitive endpoints.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->input('email', '');
            $ip = (string) $request->ip();
            $key = strtolower($email) . '|' . $ip;

            return [
                Limit::perMinute(6)->by($key),
                Limit::perMinute(20)->by($ip),
            ];
        });

        RateLimiter::for('oauth', function (Request $request) {
            $provider = (string) $request->route('provider', 'oauth');
            $ip = (string) $request->ip();

            return [
                Limit::perMinute(30)->by($provider . '|' . $ip),
            ];
        });
    }
}
