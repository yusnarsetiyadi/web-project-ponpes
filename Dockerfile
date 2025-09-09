FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Enable Apache rewrite
RUN a2enmod rewrite

# Set working dir
WORKDIR /var/www/html/deploy/daarulmukhtarin

# Copy Laravel files ke dalam container
COPY . /var/www/html/deploy/daarulmukhtarin

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Laravel storage symlink
RUN php artisan storage:link || true

# Set Apache DocumentRoot ke public/
RUN sed -i 's!/var/www/html!/var/www/html/deploy/daarulmukhtarin/public!' /etc/apache2/sites-available/000-default.conf

# Permission Laravel
RUN chown -R www-data:www-data /var/www/html/deploy/daarulmukhtarin \
    && chmod -R 755 /var/www/html/deploy/daarulmukhtarin/storage

EXPOSE 80
CMD ["apache2-foreground"]
