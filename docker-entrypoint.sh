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

# CRITICAL: Clear ALL caches before Apache starts (fixes 500 errors on deploy)
echo "Clearing all caches..."
php artisan optimize:clear || true

# Cache for production
echo "Rebuilding caches for production..."
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Run migrations in background (non-blocking)
(
    echo "[Background] Waiting for DB connection..."
    sleep 3
    echo "[Background] Running migrations..."
    php artisan migrate --force || echo "[Background] Migration skipped or failed"
    echo "[Background] Migrations complete"
) &

# Start Apache
echo "=== Starting Apache ==="
exec "$@"
