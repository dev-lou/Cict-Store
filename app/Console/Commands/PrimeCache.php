<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\HomeController;
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
            app(HomepageController::class)->index();
            app(HomeController::class)->index();
            $this->info('Cache primed successfully.');
            return 0;
        } catch (\Throwable $e) {
            $this->error('Cache priming failed: ' . $e->getMessage());
            return 1;
        }
    }
}
