FROM php:8.3-fpm-alpine

# Install system dependencies, PHP extensions, and BASH
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

# Inject the Laravel routing map
COPY nginx.conf /etc/nginx/http.d/default.conf

# Align permissions and configure Nginx to run as www-data
RUN chown -R www-data:www-data /var/www
RUN sed -i 's/user nginx;/user www-data;/g' /etc/nginx/nginx.conf

# FORCE PHP-FPM to listen on 127.0.0.1:9000 (overriding default Alpine Unix sockets)
RUN sed -i 's|listen = /.*|listen = 127.0.0.1:9000|g' /usr/local/etc/php-fpm.d/www.conf

# Run the build script securely using bash
RUN chmod +x /var/www/build.sh && bash /var/www/build.sh

# Expose the standard web port
EXPOSE 80

# Start modern Nginx & PHP-FPM together explicitly
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]