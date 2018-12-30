#! /bin/bash

if [ ! -f /var/www/.env ] && [ ! -f /var/www/vendor/autoload.php ]; then
    cd /var/www
    cp .env.example .env
    php artisan key:generate
    php artisan wipe
    ./vendor/bin/phpunit
else
    echo 'Try again, because composer is not done yet'
fi