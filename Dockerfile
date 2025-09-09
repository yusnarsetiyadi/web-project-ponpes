FROM php:8.2-apache

# Install dependencies + mysql client
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libzip-dev zip unzip git curl \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Set working dir
WORKDIR /var/www/html/deploy/daarulmukhtarin

# Copy Laravel files ke dalam container
COPY . /var/www/html/deploy/daarulmukhtarin

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set Apache DocumentRoot ke public/
RUN sed -i 's!/var/www/html!/var/www/html/deploy/daarulmukhtarin/public!' /etc/apache2/sites-available/daarulmukhtarin.my.id.conf

# Permission Laravel
RUN chown -R www-data:www-data /var/www/html/deploy/daarulmukhtarin \
    && chmod -R 777 /var/www/html/deploy/daarulmukhtarin

EXPOSE 80
CMD ["apache2-foreground"]
