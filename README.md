# Discount Counter

## Installation Guide (+ automatic start)

### 1. Create .env file in API folder from .env.example

### 2. Install on Linux (WSL was used when creating this project)
```sh
./start.sh
```

### OR 2. Install on Windows
```sh
bash start.sh
```

## Install project without script

#### First run inside ./api
```sh
php artisan key:generate
composer install --prefer-dist
```

#### Run on the project root
```sh
docker-compose up --build -d
docker exec discount-api php artisan config:clear
docker exec discount-api php artisan route:cache
docker exec discount-api php artisan migrate
docker exec discount-api php artisan optimize
```

## Stop project (at root)
```sh
docker compose down
```

## Run the project again (at root)
```sh
docker compose up -d
```

## UI URL
```sh
http://localhost:3000
```