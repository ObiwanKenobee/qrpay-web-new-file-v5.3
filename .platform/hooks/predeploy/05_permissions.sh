#!/usr/bin/env bash
set -euo pipefail

cd /var/app/current

# Ensure required directories exist with correct permissions
mkdir -p storage/framework/{cache,sessions,views} bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Set ownership based on available web server user
if id -u webapp >/dev/null 2>&1; then
  chown -R webapp:webapp storage bootstrap/cache
elif id -u apache >/dev/null 2>&1; then
  chown -R apache:apache storage bootstrap/cache
elif id -u nginx >/dev/null 2>&1; then
  chown -R nginx:nginx storage bootstrap/cache
fi
