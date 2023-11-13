# Discount Counter

## Install project on Linux

```sh
./start.sh
```

## Install project on Windows

```sh
bash start.sh
```

## Install project without script

#### First run inside ./api
```sh
php artisan key:generate
composer install --ignore-platform-reqs
```

#### Run on the project root
```sh
docker-compose up --build -d
docker exec discount-api php artisan migrate
```

## After installing the project, it can be started again with

#### Run on the project root
```sh
docker-compose up -d
```