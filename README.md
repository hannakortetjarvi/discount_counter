# Discount Counter

## Run project on Linux

```sh
./start.sh
```

## Run project on Windows

```sh
bash start.sh
```

## Run project without script

#### First run inside ./api
```sh
php artisan key:generate
composer install --ignore-platform-reqs
```

#### Run on the project root
```sh
docker-compose up --build -d
```