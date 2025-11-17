#!/usr/bin/env bash
set -euo pipefail

# Ensure composer install runs with production flags on the staging directory
STAGING_DIR="/var/app/staging"
if [ -f "$STAGING_DIR/composer.json" ]; then
  cd "$STAGING_DIR"
  # Prefer the platform composer if available; fallback to composer.phar
  if command -v composer >/dev/null 2>&1; then
    composer install --no-dev --prefer-dist --optimize-autoloader --no-ansi --no-interaction --no-progress
  elif [ -f "/usr/bin/composer.phar" ]; then
    php /usr/bin/composer.phar install --no-dev --prefer-dist --optimize-autoloader --no-ansi --no-interaction --no-progress
  else
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
      && php composer-setup.php --install-dir=/usr/bin --filename=composer.phar \
      && php -r "unlink('composer-setup.php');" \
      && php /usr/bin/composer.phar install --no-dev --prefer-dist --optimize-autoloader --no-ansi --no-interaction --no-progress
  fi
fi
