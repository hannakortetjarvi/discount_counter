#!/bin/bash

cd api
php artisan key:generate
composer install --ignore-platform-reqs

cd ..
docker-compose up --build -d