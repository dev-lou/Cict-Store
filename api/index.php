<?php

/**
 * Vercel Serverless Entry Point
 * 
 * This file bridges Vercel's serverless functions to Laravel's public/index.php.
 * It sets up the correct working directory and includes the main Laravel entry point.
 */

// Change to the project root directory
chdir(__DIR__ . '/..');

// Set the public path for Laravel
$_ENV['LARAVEL_PUBLIC_PATH'] = __DIR__ . '/../public';

// Ensure the views cache directory exists in /tmp
$viewsPath = '/tmp/views';
if (!is_dir($viewsPath)) {
    mkdir($viewsPath, 0755, true);
}

// Include and execute the main Laravel entry point
require __DIR__ . '/../public/index.php';
