#! /bin/bash
# This script will run untill composer done with creating autoload.php file
# in laravel vendor folder

printf 'Waiting until composer will create autoload.php file... \n'
cd /var/www

while [ true ]; do
    if [ -f /var/www/vendor/autoload.php ]; then
        if [ ! -f /var/www/.env ]; then
            cp .env.example .env
            php artisan key:generate
            php artisan storage:link
        else
            printf '.env file is already exists \n'
        fi

        if [ ! -f /var/www/public/js/app.js ] && [ ! -f /var/www/public/css/app.css ]; then
            npm rebuild node-sass --force && npm install && npm run prod
        fi

        rm storage/logs/laravel-*
        php artisan wipe
        chown -R www-data:www-data $(ls | awk '{if($1 != "docker"){ print $1 }}')
        chmod -R 775 storage

        printf 'DONE! You can go to a localhost:8100 \n'
        break;
    fi
done

if [ -f /etc/supervisor/conf.d/laravel-worker.conf ]; then
    supervisord && supervisorctl update && supervisorctl start laravel-worker:*
fi