#!/usr/bin/env bash
set -euo pipefail

# Ensure correct ownership (container runs as root, PHP-FPM runs as www-data)
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true
chmod -R ug+rw /var/www/html/storage /var/www/html/bootstrap/cache || true

# Pre-warm Laravel links and caches. Do not echo any secret values.
cd /var/www/html

# Storage symlink (idempotent)
php artisan storage:link || true

# Ensure APP_KEY exists; generate only if missing
if ! php -r 'exit((int) (getenv("APP_KEY") && getenv("APP_KEY") !== ""));'; then
  php artisan key:generate --force
fi

# Package discovery (in case composer scripts were skipped during image build)
php artisan package:discover --no-ansi || true

# Optimize caches
php artisan optimize:clear --no-ansi || true
php artisan config:cache --no-ansi
php artisan route:cache --no-ansi || true
php artisan view:cache --no-ansi || true
php artisan event:cache --no-ansi || true
php artisan optimize --no-ansi || true

# Optional migrations on boot (controlled by env)
if [ "${MIGRATE_ON_BOOT:-false}" = "true" ]; then
  php artisan migrate --force --no-ansi || true
fi

# Start Supervisor to run php-fpm and nginx
exec /usr/bin/supervisord -c /etc/supervisord.conf
