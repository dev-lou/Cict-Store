<?php

namespace App\Console\Commands;

use App\Models\FailedLoginAttempt;
use Illuminate\Console\Command;

class CleanupFailedLogins extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'auth:cleanup-failed-logins';

    /**
     * The console command description.
     */
    protected $description = 'Clean up old failed login attempt records';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Cleaning up failed login attempts older than 7 days...');
        
        $count = FailedLoginAttempt::where('attempted_at', '<', now()->subDays(7))->count();
        FailedLoginAttempt::cleanup();
        
        $this->info("Deleted {$count} old records.");
        
        return Command::SUCCESS;
    }
}
