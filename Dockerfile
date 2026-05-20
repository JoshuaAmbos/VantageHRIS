FROM php:8.3-fpm-alpine

# Install system dependencies, PHP extensions, and BASH needed for Laravel
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    postgresql-dev \
    oniguruma-dev \
    bash

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

COPY nginx.conf /etc/nginx/http.d/default.conf

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

RUN chmod +x /var/www/build.sh && bash /var/www/build.sh

EXPOSE 80

# Start Nginx & PHP-FPM
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]