# Dockerfile

FROM php:8.2-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev libjpeg-dev libfreetype6-dev \
    libicu-dev gnupg2 ca-certificates lsb-release \
    nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# MongoDB PHP Extension
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copy source
COPY . .

# Create storage and cache directories early with correct permissions
RUN mkdir -p /var/www/storage /var/www/storage/logs /var/www/storage/framework/cache /var/www/storage/framework/sessions /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Tailwind / Vite build
RUN npm install && npm run build

# Permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
