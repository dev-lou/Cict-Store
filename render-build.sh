#!/usr/bin/env bash
set -e

echo "Clearing old caches..."
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan cache:clear || true

echo "Installing dependencies..."
composer install --no-dev --optimize-autoloader

echo "Skipping migrations (will run at startup)..."

echo "Caching config only (NOT routes - debugging)..."
php artisan config:cache
# php artisan route:cache  # DISABLED FOR DEBUGGING
php artisan view:cache

echo "Build complete!"