#!/usr/bin/env bash
# Render.com Build Script for Laravel

set -o errexit

echo "🔧 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

echo "📦 Installing NPM dependencies..."
npm ci

echo "🎨 Building Vite assets..."
npm run build

echo "🔑 Generating app key if not set..."
php artisan key:generate --force --no-interaction || true

echo "🗄️ Running database migrations..."
php artisan migrate --force --no-interaction

echo "🧹 Clearing all caches..."
php artisan optimize:clear

echo "⚡ Caching for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🔗 Creating storage symlink..."
php artisan storage:link || true

echo "✅ Build completed successfully!"
