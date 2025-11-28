#!/bin/sh
set -e

echo "=== Starting Laravel Application ==="

# Copy nested Vite manifest to expected location on startup if needed
if [ -f /var/www/html/public/build/.vite/manifest.json ] && [ ! -f /var/www/html/public/build/manifest.json ]; then
  cp /var/www/html/public/build/.vite/manifest.json /var/www/html/public/build/manifest.json
  echo "Copied Vite manifest from .vite/manifest.json to public/build/manifest.json"
fi

# Create necessary directories for file-based cache, sessions, and uploads
echo "Creating storage directories..."
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/app/public/products
mkdir -p /var/www/html/storage/app/public/profile-pictures
mkdir -p /var/www/html/bootstrap/cache

# Clear file caches quickly (no DB required)
echo "Clearing file caches..."
rm -f /var/www/html/bootstrap/cache/config.php || true
rm -f /var/www/html/bootstrap/cache/routes-v7.php || true
rm -f /var/www/html/bootstrap/cache/packages.php || true
rm -f /var/www/html/bootstrap/cache/services.php || true
rm -rf /var/www/html/storage/framework/cache/data/* || true

# Ensure storage & bootstrap cache permissions
echo "Setting permissions..."
chown -R www-data:www-data /var/www/html/storage || true
chown -R www-data:www-data /var/www/html/bootstrap/cache || true
chmod -R 775 /var/www/html/storage || true
chmod -R 775 /var/www/html/bootstrap/cache || true

# Run migrations in background with DB readiness check to not block startup
# This allows Apache to start immediately and pass health checks
echo "Starting background tasks..."
(
  sleep 3  # Wait for Apache to start first
  echo "[Background] Waiting for database to become available..."
  WAIT_SECS=60
  while [ $WAIT_SECS -gt 0 ]; do
    php -r "require 'vendor/autoload.php'; try { \Illuminate\Support\Facades\DB::select('SELECT 1'); echo 'db_ok'; } catch (Exception \$e) { exit(1);} " >/dev/null 2>&1 && break || true
    sleep 3
    WAIT_SECS=$((WAIT_SECS-3))
  done
  if [ $WAIT_SECS -le 0 ]; then
    echo "[Background] DB not available after timeout; skipping migrations"
  else
    echo "[Background] Running migrations..."
    timeout 30 php artisan migrate --force 2>&1 || echo "[Background] Migration skipped or failed"
  fi
  echo "[Background] Caching config..."
  php artisan config:cache 2>&1 || true
  echo "[Background] Tasks complete"
) &

# Launch Apache in the foreground immediately
echo "=== Starting Apache ==="
exec "$@"
