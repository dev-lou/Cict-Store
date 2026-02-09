<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
try {
    (require_once __DIR__.'/../bootstrap/app.php')
        ->handleRequest(Request::capture());
} catch (\Throwable $e) {
    // Log the actual error for debugging
    $errorMessage = $e->getMessage();
    $errorFile = $e->getFile();
    $errorLine = $e->getLine();
    
    // Write to error log
    error_log("FATAL: {$errorMessage} in {$errorFile}:{$errorLine}");
    
    // Try to write to Laravel log
    $logFile = __DIR__ . '/../storage/logs/fatal.log';
    @file_put_contents($logFile, date('Y-m-d H:i:s') . " FATAL: {$errorMessage}\nFile: {$errorFile}:{$errorLine}\nTrace: {$e->getTraceAsString()}\n\n", FILE_APPEND);
    
    // Serve custom 500 error page
    $errorPage = __DIR__ . '/../resources/views/errors/500.blade.php';
    if (file_exists($errorPage)) {
        http_response_code(500);
        echo file_get_contents($errorPage);
    } else {
        http_response_code(500);
        echo '<h1>500 - Server Error</h1><p>Something went wrong.</p>';
    }
}
