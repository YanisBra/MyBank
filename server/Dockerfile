FROM php:8.2-cli
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git && docker-php-ext-install zip pdo pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY . .
RUN composer install
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]