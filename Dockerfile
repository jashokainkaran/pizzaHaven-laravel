FROM php:8.2-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev libjpeg-dev libfreetype6-dev \
    libicu-dev gnupg2 ca-certificates lsb-release \
    nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ✅ Install MongoDB extension via PECL
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# ✅ Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy app files
COPY . .

# ✅ Install PHP dependencies
#RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# ✅ Install Node + Tailwind
RUN npm install && npm run build

# ✅ Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]

