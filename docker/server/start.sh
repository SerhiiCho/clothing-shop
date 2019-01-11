#! /bin/bash

echo 'Waiting for 3 seconds'
sleep 3

if [ -f /var/www/vendor/autoload.php ]; then
    cd /var/www

    if [ ! -f /var/www/.env ]; then
        cp .env.example .env
        php artisan key:generate
        php artisan storage:link
        php artisan wipe
    else
        echo 'Seems like .env file is already created'
    fi

    if [ -f /etc/supervisor/conf.d/laravel-worker.conf ]; then
        supervisord && supervisorctl update && supervisorctl start laravel-worker:*
    fi
else
    echo 'Wait couple seconds and try again. vendor/autoload.php file is not created yet, composer is currently installing it.'
fi