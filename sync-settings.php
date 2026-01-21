<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

// Insert settings
DB::table('settings')->updateOrInsert(
    ['key' => 'site_logo'],
    ['value' => 'logos/logo.png']  // Update this path if needed
);

DB::table('settings')->updateOrInsert(
    ['key' => 'site_favicon'],
    ['value' => 'favicons/favicon.png']  // Update this path if needed  
);

echo "✓ Settings synced successfully!" . PHP_EOL;
echo "Logo: logos/logo.png" . PHP_EOL;
echo "Favicon: favicons/favicon.png" . PHP_EOL;
echo PHP_EOL;
echo "Note: Update the paths above to match your actual Supabase files." . PHP_EOL;
