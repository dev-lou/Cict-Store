<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SyncSettings extends Command
{
    protected $signature = 'settings:sync';
    protected $description = 'Sync settings from Supabase to local database';

    public function handle()
    {
        $this->info('Fetching settings from Supabase...');

        try {
            // Fetch settings directly from Supabase using credentials
            $supabaseConfig = [
                'driver' => 'pgsql',
                'host' => env('DB_HOST'),
                'port' => env('DB_PORT', 5432),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'charset' => 'utf8',
                'prefix' => '',
                'schema' => 'public',
                'sslmode' => env('DB_SSLMODE', 'prefer'),
            ];

            config(['database.connections.supabase_temp' => $supabaseConfig]);

            $settings = DB::connection('supabase_temp')->table('settings')->get();

            if ($settings->isEmpty()) {
                $this->warn('No settings found in Supabase database.');
                return 0;
            }

            $this->info("Found {$settings->count()} settings in Supabase.");

            // Insert each setting into local database
            foreach ($settings as $setting) {
                Setting::updateOrCreate(
                    ['key' => $setting->key],
                    ['value' => $setting->value]
                );
                $this->line("✓ Synced: {$setting->key} => {$setting->value}");
            }

            $this->info('Settings synced successfully!');
            return 0;

        } catch (\Exception $e) {
            $this->error('Failed to sync settings: ' . $e->getMessage());
            return 1;
        }
    }
}
