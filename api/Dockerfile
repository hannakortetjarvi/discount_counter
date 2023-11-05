FROM php:8.2
RUN apt-get update -y && apt-get install -y libmcrypt-dev openssl libmemcached-dev libssl-dev zlib1g-dev

RUN pecl install mcrypt \
	&& docker-php-ext-enable mcrypt

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /api

CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000