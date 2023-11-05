FROM php:8.2

# update container and install packages
RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl libmemcached-dev libssl-dev zlib1g-dev

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /api

# start api in port 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000