#! /bin/bash

echo 'Setting everything up...'
sleep 17

if [ -f /var/www/vendor/autoload.php ]; then
    cd /var/www
    chown -R www-data:www-data $(ls | awk '{if($1 != "docker"){ print $1 }}')

    if [ ! -f /var/www/.env ]; then
        cp .env.example .env
        php artisan key:generate
        php artisan storage:link
        php artisan wipe
        echo 'DONE!! Go to localhost'
    fi

    if [ ! -f /var/www/public/js/app.js && ! -f /var/www/public/css/app.css ]; then
        npm rebuild node-sass --force && npm install && npm run prod
    fi
    # if [ -f /etc/supervisor/conf.d/laravel-worker.conf ]; then
    #     supervisord && supervisorctl update && supervisorctl start laravel-worker:*
    # fi
else
    echo 'WAIT COUPLE SECONDS AND TRY AGAIN. vendor/autoload.php file is not created yet, composer is currently installing it.'
fi