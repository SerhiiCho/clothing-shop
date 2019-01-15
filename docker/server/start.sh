#! /bin/bash
# This script will run untill composer done with creating autoload.php file
# in laravel vendor folder

printf 'Setting everything up... \n'

while [ true ]; do
    if [ -f /var/www/vendor/autoload.php ] && [ ! -f /var/www/.env ]; then
        cd /var/www
        chown -R www-data:www-data $(ls | awk '{if($1 != "docker"){ print $1 }}')
        cp .env.example .env
        php artisan key:generate
        php artisan storage:link
        php artisan wipe

        if [ ! -f /var/www/public/js/app.js ] && [ ! -f /var/www/public/css/app.css ]; then
            npm rebuild node-sass --force && npm install && npm run prod
        fi

        printf 'DONE!! Go to a localhost \n'
        break;
    fi
done

# if [ -f /etc/supervisor/conf.d/laravel-worker.conf ]; then
#     supervisord && supervisorctl update && supervisorctl start laravel-worker:*
# fi