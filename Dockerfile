FROM php:8.3-fpm-alpine

# Install system dependencies and PHP extensions needed for Laravel
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
    oniguruma-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Get modern Composer inside the container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Setup working directory framework
WORKDIR /var/www

# Copy application source code
COPY . .

# Set permissions for Laravel storage engines
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copy Nginx server configuration from Render runtime template
RUN cp /var/www/vendor/bin/heroku-php-nginx /usr/local/bin/ || true

# Run the build script
RUN chmod +x /var/www/build.sh && /var/www/build.sh

# Expose Render default port allocation parameter
EXPOSE 10000

# Start Nginx & PHP-FPM service matrix routing through public/ directory
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;' -c /var/www/vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php"]