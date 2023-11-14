# Discount Counter

## Installation Guide (+ automatic start)

### Install project on Linux (I used WSL)

```sh
./start.sh
```

### Install project on Windows

```sh
bash start.sh
```

### Install project without script

#### Create .env file in API folder

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