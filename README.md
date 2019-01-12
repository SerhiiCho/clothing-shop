![clothing shop](https://raw.githubusercontent.com/SerhiiCho/clothing_shop/master/storage/app/public/img/big/slider/slider.jpg)

## About

Simple Callback E-commerce clothing shop. It has men's and women's categories and convenient filtering with [vue.js](https://github.com/vuejs/vue) by types of clothes like pents, short, skirts etc. In this web app is implemented infinite pagination without npm packages, just [vue.js](https://github.com/vuejs/vue) and little bit of effort. The app is pretty fast and optimize. It has PHPUnit tests and code itself is well written. But of course there are places where code needs to be refactored and tested.

## Checkout

Client can add items to a cart, and checkout. When client makes an order, he or she fills in the form with 2 fields. One for the phone number, and the second is for a name. After submitting the form, admin will see small red notification in his admin panel navigation menu. It shows that there is an order.

## Admin panel
##### Admin can ...
* delete or edit **clothes items**.
* delete or edit **home page cards**.
* delete or edit **home page slider**.
* add, delete or edit **contact information** that is visible on all pages.
* see **logs** and some basic **statistics**.
* add new users to admin list, or delete them.
* close and delete client's orders

Here is what admin can choose on the dashboard.
1. **Allow registration** Admin can turn this option off, and register form will disappear.
2. **Turn on men's category** Admin can turn this off, and men's category will disappear.
3. **Turn on women's category** Admin can turn this off, and women's category will disappear.
4. **Clear all cache** By clicking this button admin deletes all file cache data that is widely used in this app.

## Language

The app supports only russian language, but can be easily translated. Just by copying /resources/lang/ru folder and translating all files to whatever language you want. Also translate couple seeders. There are no hard coded word, everything is using laravel translations via functions *lang()* and *trans()*.

## What we are using
##### Technologies

* [PHP](http://php.net/)
* [NGINX](https://nginx.org/)
* [MySQL](https://www.mysql.com/)
* [REDIS](https://redis.io/)
* [JavaScript](https://www.javascript.com/)
* [Docker](https://www.docker.com/)

##### Frameworks

* [laravel/laravel](https://github.com/laravel/laravel) | PHP framework
* [vuejs/vue](https://github.com/vuejs/vue) | JavaScript framework
* [twbs/bootstrap](https://github.com/twbs/bootstrap) | CSS framework

## Before downloading

* Register page is going to be at **localhost/hello/register**

* Login page is going to be at **localhost/hello/login**

* There is a registered admin user with email **ser@ser.com** and password **111111**

## Get started (without Docker)

1. `cp .env.example .env` copy the *env.example* and create *.env*
2. Open just created *.env* file and fill database credentials
3. Create database with the name that you filled in *.env* file in DB_DATABASE field
4. `composer install` to install all PHP packages
5. `php artisan key:generate` to generate laravel app key
6. `php artisan wipe`, migrate all migrations and seed the database
7. `php artisan storage:link`, create a link in public folder to storage
8. `php artisan serve` to start a server *(go to localhost:8000)*
9. `vendor/bin/phpunit` make sure tests are green

## Get started with Docker

1. `docker-compose up -d` and wait untill it's done
2. `docker-compose exec server /start.sh` *(go to localhost)*