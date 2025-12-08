<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Blade Anonymous Component Paths:\n";
$paths = app('blade.compiler')->getAnonymousComponentPaths();
var_dump($paths);

echo "\n\nChecking if app-layout component file exists:\n";
$componentPath = resource_path('views/components/app-layout.blade.php');
echo "Path: $componentPath\n";
echo "Exists: " . (file_exists($componentPath) ? 'YES' : 'NO') . "\n";

echo "\n\nTrying to compile a simple component tag:\n";
$compiler = app('blade.compiler');
$result = $compiler->compileString('<x-app-layout>Test</x-app-layout>');
echo substr($result, 0, 200) . "...\n";
