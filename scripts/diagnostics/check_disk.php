<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$diskName = (config('filesystems.disks.supabase.key') && config('filesystems.disks.supabase.secret') && config('filesystems.disks.supabase.bucket')) ? 'supabase' : 'public';
echo "Selected disk: $diskName\n";
$disk = Illuminate\Support\Facades\Storage::disk($diskName);
echo 'Disk class: ' . get_class($disk) . "\n";
try {
    echo 'Driver: ' . get_class($disk->getDriver()) . "\n";
} catch (Exception $e) {
    echo 'Driver not available: ' . $e->getMessage() . "\n";
}
