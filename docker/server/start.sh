#! /bin/bash

if [ ! -f /var/www/.env ]; then
    cd /var/www
    cp .env.example .env
    php artisan key:generate
    php artisan wipe
    ./vendor/bin/phpunit
fi