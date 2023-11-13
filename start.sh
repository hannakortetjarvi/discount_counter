#!/bin/bash

cd api
php artisan key:generate
composer install --prefer-dist

cd ..
docker compose up --build -d # OR docker-compose up --build -d
docker exec discount-api php artisan config:clear
docker exec discount-api php artisan route:cache
docker exec discount-api php artisan migrate
docker exec discount-api php artisan optimize