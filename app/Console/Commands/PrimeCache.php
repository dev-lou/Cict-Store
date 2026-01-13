<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\HomepageController;

class PrimeCache extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:prime-cache';

    /**
     * The console command description.
     */
    protected $description = 'Prime the homepage and home page caches by invoking controllers';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Priming home caches...');

        try {
            // Easiest way is to instantiate controllers and call methods
            // Prime controllers (caches) and write local fallback data files
            $homepageData = app(HomepageController::class)->index();

            // Capture featuredProducts from controller if present
            try {
                $featured = cache('homepage.featured_products') ?: collect([]);
                // Write local JSON fallback files (public storage)
                $fallbackDir = storage_path('app/public/fallback');
                if (!file_exists($fallbackDir)) {
                    mkdir($fallbackDir, 0755, true);
                }
                file_put_contents($fallbackDir . '/products.json', json_encode($featured, JSON_PRETTY_PRINT));
                $this->info('Wrote fallback JSON files to storage/app/public/fallback');
            } catch (\Throwable $e) {
                $this->error('Failed to write fallback files: ' . $e->getMessage());
            }
            $this->info('Cache primed successfully.');
            return 0;
        } catch (\Throwable $e) {
            $this->error('Cache priming failed: ' . $e->getMessage());
            return 1;
        }
    }
}
