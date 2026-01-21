<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Seed the settings table with logo and favicon from Supabase.
     */
    public function run(): void
    {
        // Clear existing settings
        Setting::truncate();

        // Add site logo (update the path if you have a different one in Supabase)
        Setting::create([
            'key' => 'site_logo',
            'value' => 'logos/your-logo-filename.png', // UPDATE THIS PATH
        ]);

        // Add site favicon (update the path if you have a different one in Supabase)
        Setting::create([
            'key' => 'site_favicon',
            'value' => 'favicons/your-favicon-filename.png', // UPDATE THIS PATH
        ]);

        $this->command->info('Settings seeded successfully!');
    }
}
