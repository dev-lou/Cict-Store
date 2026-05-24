<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "APP_KEY (env): ".(getenv('APP_KEY') ?: 'not set')."\n";
echo "config('app.key'): ".(config('app.key') ?: 'not set')."\n";