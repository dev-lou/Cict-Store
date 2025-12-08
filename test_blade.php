<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test basic Blade compilation
$blade = app('view');

echo "Testing Blade Engine:\n";
echo "====================\n\n";

// Test 1: Simple variable
$test1 = $blade->make('cart.index', [
    'items' => [],
    'subtotal' => 100,
    'total' => 100
])->render();

echo "First 500 chars of rendered output:\n";
echo substr($test1, 0, 500);
echo "\n\n";

// Check if {{ }} is being compiled
if (strpos($test1, '{{') !== false) {
    echo "ERROR: Blade syntax {{ }} found in output - NOT COMPILED!\n";
    echo "Showing problematic sections:\n";
    preg_match_all('/\{\{[^}]+\}\}/', substr($test1, 0, 2000), $matches);
    foreach ($matches[0] as $match) {
        echo "  - $match\n";
    }
} else {
    echo "SUCCESS: No uncompiled Blade syntax found\n";
}
