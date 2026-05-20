#!/usr/bin/env bash
# exit on error
set -o errexit

echo "🚀 Starting VantageHRIS Build Pipeline..."

# Install composer dependencies
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Optimize Laravel configuration and routes
echo "⚡ Optimizing application caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations automagically
echo "🗄️ Running migrations..."
php artisan migrate --force