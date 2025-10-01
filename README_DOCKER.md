# Run the app locally with Docker

## Prereqs
- Docker Desktop 4.27+
- Optional: GNU Make (for shorthand commands)

## Quick start
1) Copy env files
   cp .env.example .env
   cp .env.docker.example .env.docker

2) Start the stack
   docker compose up -d --build

3) Initialize the app (first run only)
   # The container will generate APP_KEY and run caches automatically.
   # If you want migrations on first boot, MIGRATE_ON_BOOT is enabled in .env.docker.example

4) Open the app
   http://localhost:8080

## Useful commands
- View logs
  docker compose logs -f app

- Rebuild after changes
  docker compose up -d --build

- Run artisan in the container
  docker compose exec app php artisan <command>

- Run composer in the container
  docker compose exec app php -d detect_unicode=0 -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
  docker compose exec app php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
  docker compose exec app composer <command>

- Run one-off migrations (if MIGRATE_ON_BOOT=false)
  docker compose exec app php artisan migrate --force

- Stop and remove
  docker compose down

## Notes
- MySQL data, Redis data, and Laravel storage/cache are persisted via volumes.
- The image already serves Nginx + PHP-FPM under Supervisor and exposes port 80 (mapped to 8080 on your host).
- Health checks use /health.php (already present in public/).
