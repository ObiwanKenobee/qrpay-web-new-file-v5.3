#!/usr/bin/env bash
set -euo pipefail

cd /var/app/current

# Create storage symlink and warm caches
php artisan storage:link || true
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Publish vendor assets that may be required in production
php artisan vendor:publish --tag=laravel-assets --force || true

# Optional: run database migrations (uncomment to enable)
# php artisan migrate --force
