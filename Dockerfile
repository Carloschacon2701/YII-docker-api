FROM php:8.3-apache

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    git zip unzip libzip-dev libicu-dev \
    && docker-php-ext-install zip intl pdo_mysql

# Composer installation
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy Yii2 app files
COPY yii2-rest-api /var/www/html

WORKDIR /var/www/html

# Install dependencies
RUN composer install --prefer-dist --no-dev --optimize-autoloader

# Enable Apache rewrite
RUN a2enmod rewrite

# Set Apache DocumentRoot to Yii2 web directory explicitly
RUN sed -i 's|/var/www/html|/var/www/html/web|g' /etc/apache2/sites-available/000-default.conf

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
