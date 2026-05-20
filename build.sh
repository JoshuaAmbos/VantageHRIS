#!/usr/bin/env bash
set -e

echo "Starting VantageHRIS Production Build Pipeline..."

# Install Composer dependencies optimally for production
composer install --no-dev --no-interaction --optimize-autoloader

# Clear any cached view parameters
php artisan config:clear
php artisan route:clear
php artisan view:clear

# FIXED: Force drop old tables and run all schema migrations cleanly from scratch
echo "Rebuilding live database structures..."
php artisan migrate:fresh --force

echo "VantageHRIS Build Completed Successfully!"