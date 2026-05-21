FROM php:8.3-fpm-alpine

# Install system dependencies, core development libraries, and BASH
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
    bash \
    nodejs \
    npm

# Install native PHP extensions
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql mbstring exif pcntl bcmath gd

# Get modern Composer inside the container
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Setup working directory framework
WORKDIR /var/www

# Copy application source code
COPY . .

# Install NPM packages and build production assets (Vite compilation)
RUN npm install && npm run build

# Inject the Laravel routing map
COPY nginx.conf /etc/nginx/http.d/default.conf

# Align permissions and configure Nginx to run as www-data
RUN chown -R www-data:www-data /var/www
RUN sed -i 's/user nginx;/user www-data;/g' /etc/nginx/nginx.conf

# Force PHP-FPM to listen globally on port 9000
RUN sed -i 's|listen = /.*|listen = 0.0.0.0:9000|g' /usr/local/etc/php-fpm.d/www.conf

# Expose the standard web port
EXPOSE 80

# FIXED: Mark the file as executable during build, but DO NOT run it here
RUN chmod +x /var/www/build.sh

# FIXED: Run the build script at runtime when variables are live, then launch services
CMD ["sh", "-c", "bash /var/www/build.sh && php-fpm -D && nginx -g 'daemon off;'"]