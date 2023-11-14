FROM php:8.1-fpm

# update container and install packages
RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl libmemcached-dev libssl-dev zlib1g-dev libpq-dev
RUN docker-php-ext-install pdo_pgsql

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /api

# start api
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000