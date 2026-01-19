<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use App\Models\Order;

class ClearPerformanceCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-performance {--all : Clear all performance caches}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear performance-related caches (settings, order counts, homepage)';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Clearing performance caches...');

        if ($this->option('all')) {
            // Clear everything
            Cache::flush();
            $this->info('✓ All caches cleared');
        } else {
            // Clear specific performance caches
            $caches = [
                'setting.*',
                'admin.order_counts',
                'homepage.featured_products',
                'homepage.featured_services',
                'homepage.service_categories',
                'site.logo_url',
            ];

            foreach ($caches as $key) {
                if (str_contains($key, '*')) {
                    // Clear all keys matching pattern
                    $pattern = str_replace('*', '', $key);
                    $this->clearPattern($pattern);
                } else {
                    Cache::forget($key);
                }
            }

            $this->info('✓ Performance caches cleared');
        }

        $this->newLine();
        $this->info('Cache cleared successfully!');
        $this->info('New data will be cached on next request.');

        return Command::SUCCESS;
    }

    /**
     * Clear cache keys matching a pattern
     */
    private function clearPattern(string $pattern): void
    {
        // For file cache, we can't easily iterate, so we'll just note it
        // Redis/Memcached would allow pattern matching
        $this->warn("Note: Pattern '{$pattern}' requires manual clear or cache:clear for file driver");
    }
}
