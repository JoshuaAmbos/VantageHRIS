#!/usr/bin/env bash
set -e

echo "Starting VantageHRIS Production Build Pipeline..."

# Install Composer dependencies optimally for production
composer install --no-dev --no-interaction --optimize-autoloader

# Clear any cached view parameters
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Execute live database schema adjustments
echo "Running live database migrations..."
php artisan migrate --force

echo "VantageHRIS Build Completed Successfully!"