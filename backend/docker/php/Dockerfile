FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    zlib1g-dev \
    && docker-php-ext-install pdo_pgsql zip \
    && pecl install redis \
    && docker-php-ext-enable redis

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u 1000 -d /home/www www \
    && mkdir -p /home/www && chown -R www:www /home/www

WORKDIR /home/www

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader --prefer-dist

COPY . .
RUN composer dump-autoload --optimize

RUN chown -R www:www storage bootstrap/cache

EXPOSE 9000

USER www

CMD ["php-fpm"]
