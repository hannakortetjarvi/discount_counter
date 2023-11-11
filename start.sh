#!/bin/bash

cd api
php artisan key:generate
composer install --ignore-platform-reqs

cd ..
docker-compose up --build -d
docker exec discount-api php artisan config:clear
docker exec discount-api php artisan migrate