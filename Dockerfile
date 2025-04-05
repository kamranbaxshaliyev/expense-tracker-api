# Use official PHP with Apache image
FROM php:8.1-apache

# Install required extensions and tools
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Copy Composer from a separate layer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Fix permissions
RUN mkdir -p storage && chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
