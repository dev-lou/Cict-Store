#!/usr/bin/env bash
set -e

echo "=== Starting Laravel Application ==="

# Handle Vite manifest location difference
if [ -f /var/www/html/public/build/.vite/manifest.json ] && [ ! -f /var/www/html/public/build/manifest.json ]; then
    cp /var/www/html/public/build/.vite/manifest.json /var/www/html/public/build/manifest.json
    echo "Copied Vite manifest from .vite/manifest.json to public/build/manifest.json"
fi

# Create directories
echo "Creating storage directories..."
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Permissions - CRITICAL: Must run BEFORE Apache starts
echo "Fixing permissions..."
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Create empty log file with proper permissions
touch /var/www/html/storage/logs/laravel.log
chown www-data:www-data /var/www/html/storage/logs/laravel.log
chmod 664 /var/www/html/storage/logs/laravel.log

# Background tasks
(
    echo "[Background] Waiting for 5s to allow DB connection..."
    sleep 5
    echo "[Background] Clearing caches..."
    php artisan view:clear || true
    php artisan config:clear || true
    echo "[Background] Caching config..."
    php artisan config:cache || true
    echo "[Background] Running migrations..."
    php artisan migrate --force || echo "[Background] Migration skipped or failed"
    echo "[Background] Tasks complete"
) &

# Start Apache
echo "=== Starting Apache ==="
exec "$@"
