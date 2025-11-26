<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ensure pgsql 'options' is always an array to prevent TypeErrors
        // when a `DATABASE_URL` query param named `options` is present
        // (Laravel's parser sets `options` to a string which conflicts
        // with the PDO options array). If a string arrives, clear it.
        $pgsql = config('database.connections.pgsql', []);
        if (isset($pgsql['options']) && is_string($pgsql['options'])) {
            config(['database.connections.pgsql.options' => []]);
        }

        // Force https when APP_URL uses https or in production behind proxies
        if ($this->app->environment('production') || str_starts_with(config('app.url', ''), 'https://')) {
            URL::forceScheme('https');
        }
        // Normalize any malformed DB options (e.g., from DATABASE_URL query params)
        // If 'options' is present and is a string, ensure we reset it to an empty array
        // so that PDO options do not cause runtime TypeErrors (see Connector::getOptions).
        try {
            $defaultDriver = config('database.default');
            $connOptions = config("database.connections.{$defaultDriver}.options");
            if (is_string($connOptions)) {
                // Avoid overriding when we actually do want PDO options; emptying is safer
                // than letting a string be passed to Connector->getOptions() which will blow up.
                config(["database.connections.{$defaultDriver}.options" => []]);
            }
        } catch (\Throwable $e) {
            // Do not let a mis-parsed config break the application bootstrap; just log and continue
            logger()->warning('Database options normalization failed: '.$e->getMessage());
        }

        // Define authorization gates
        $this->defineAuthorizationGates();

        // Share order counts with all views via View Composer (guarded by try/catch)
        View::composer('*', function ($view) {
            try {
                $pendingOrderCount = Order::where('status', 'pending')->count();
                $processingOrderCount = Order::where('status', 'processing')->count();
                $completedOrderCount = Order::where('status', 'completed')->count();
                $totalOrderCount = Order::count();

                $view->with([
                    'pendingOrderCount' => $pendingOrderCount,
                    'processingOrderCount' => $processingOrderCount,
                    'completedOrderCount' => $completedOrderCount,
                    'totalOrderCount' => $totalOrderCount,
                ]);
            } catch (\Throwable $e) {
                // When DB is unavailable or misconfigured (e.g., during migrations, CI, or dev),
                // don't crash the app; provide defaults and log the issue.
                logger()->warning('Order counts view composer failed to query database: '.$e->getMessage());

                $view->with([
                    'pendingOrderCount' => 0,
                    'processingOrderCount' => 0,
                    'completedOrderCount' => 0,
                    'totalOrderCount' => 0,
                ]);
            }
        });
    }

    /**
     * Define authorization gates.
     */
    private function defineAuthorizationGates(): void
    {
        Gate::define('manage-users', function ($user) {
            return true; // All authenticated users can manage users
        });
    }
}

