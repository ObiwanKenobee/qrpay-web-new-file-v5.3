# Multi-stage build for Laravel (Nginx + PHP-FPM in one container via Supervisor)
# Build and runtime images are slim Alpine variants for reduced attack surface.

# 1) Composer vendor stage (no scripts) for caching
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-progress --no-interaction --no-plugins --no-scripts

# 2) Node build stage (Vite)
FROM node:22-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --silent
# Copy only what Vite needs to build
COPY resources ./resources
COPY vite.config.* ./
# Ensure public exists (vite writes to public/build)
RUN mkdir -p public
RUN npm run build

# 3) Runtime image
FROM php:8.3-fpm-alpine AS runtime

# Install system packages
RUN apk add --no-cache \
    nginx \
    supervisor \
    bash \
    curl \
    git \
    icu-libs \
    libpng \
    libjpeg-turbo \
    libwebp \
    freetype \
    libzip \
    tzdata \
    ca-certificates

# Build deps for PHP extensions
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    icu-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    zlib-dev \
    libzip-dev \
    oniguruma-dev

# PHP extensions: pdo_mysql, bcmath, exif, zip, gd, opcache, redis
RUN docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ \
    --with-webp=/usr/include/ \
 && docker-php-ext-install -j$(nproc) \
    pdo_mysql bcmath exif zip gd opcache \
 && pecl install redis \
 && docker-php-ext-enable redis

# Cleanup build deps
RUN apk del .build-deps && rm -rf /var/cache/apk/* /tmp/pear

# Copy app code
WORKDIR /var/www/html
# Copy vendor from composer stage first (cache friendly)
COPY --from=vendor /app/vendor ./vendor
# Copy application source
COPY . .
# Copy built assets
COPY --from=assets /app/public/build ./public/build

# Nginx + PHP-FPM + Supervisor configs
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/zzz-production.ini
COPY docker/entrypoint.sh /entrypoint.sh

# Ensure permissions for Laravel storage/bootstrap
RUN mkdir -p storage bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache \
 && chmod -R ug+rw storage bootstrap/cache \
 && ln -snf /usr/share/zoneinfo/Etc/UTC /etc/localtime && echo "Etc/UTC" > /etc/timezone

ENV APP_ENV=production \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS=0 \
    PHP_OPCACHE_MAX_ACCELERATED_FILES=20000 \
    PHP_OPCACHE_MEMORY_CONSUMPTION=192 \
    PHP_OPCACHE_INTERNED_STRINGS_BUFFER=16 \
    MIGRATE_ON_BOOT=false

EXPOSE 80
HEALTHCHECK --interval=30s --timeout=5s --retries=5 CMD curl -fsS http://localhost/health.php || exit 1

ENTRYPOINT ["/bin/bash","/entrypoint.sh"]
