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

# Get modern Composer inside the container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Setup working directory framework
WORKDIR /var/www

# Copy application source code
COPY . .

# Set permissions for Laravel storage engines
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Run the build script securely using bash
RUN chmod +x /var/www/build.sh && bash /var/www/build.sh

# Expose Render default port allocation parameter
EXPOSE 10000

# Start modern Nginx & PHP-FPM routing explicitly for Alpine
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]