#!/usr/bin/env bash
set -e

echo "Starting VantageHRIS Production Build Pipeline..."

# 1. Clear any legacy cached or optimized system parameters
rm -f bootstrap/cache/config.php
rm -f bootstrap/cache/routes.php
rm -f bootstrap/cache/services.php
rm -f bootstrap/cache/packages.php

# 2. Run Composer installation
composer install --no-dev --no-interaction --optimize-autoloader

# 3. Safe migration execution that preserves existing data rows
echo "Running live database migrations..."
php artisan migrate --force

# 4. Generate core framework optimization maps
echo "Generating production configuration and route caches..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Fix folder permissions so PHP/Nginx can read everything root just created
echo "Setting folder ownership groups to www-data..."
chown -R www-data:www-data /var/www
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

echo "VantageHRIS Build Completed Successfully!"