<p align="center"><img src="https://raw.githubusercontent.com/SerhiiCho/clothing_shop/master/storage/app/public/img/big/slider/slider.jpg"></p>

## About

Simple Callback E-commerce clothing shop. It has men's and women's categories and convenient filtering with [vue.js](https://github.com/vuejs/vue) by types of clothes like pents, short, skirts etc. In this web app is implemented infinite pagination without npm packages, just [vue.js](https://github.com/vuejs/vue) and little bit of effort. The app is pretty fast and optimize. It has PHPUnit tests and code itself is well written. I'm a typification person (if you can say that), I'm using return types and typehinting.

## Checkout

Client can add items to a cart, and checkout. When client makes an order, he or she fills in the form with 2 fields. One for the phone number, and the second is for a name. After submitting the form, admin will see small red notification in his admin panel navigation menu. It shows that there is an order. If nexmo credentials are provided, then after client submits the checkout form you will receive SMS. This way you will be always notified when new order is waiting for you.

## Admin panel.

* Admin can add, delete or edit **clothes items**.
* Admin can add, delete or edit **home page cards**.
* Admin can add, delete or edit **home page slider**.
* Admin can add, delete or edit **contact information** that is visible on all pages.
* Admin can see **logs** and some basic **statistics**.
* Admin can add new users to admin list, or delete them.

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
* [Redis](https://redis.io/)
* [MySQL](https://www.mysql.com/)
* [JavaScript](https://www.javascript.com/)
* [Docker](https://www.docker.com/)

##### Frameworks

* [laravel/laravel](https://github.com/laravel/laravel) | PHP framework
* [vuejs/vue](https://github.com/vuejs/vue) | JavaScript framework
* [twbs/bootstrap](https://github.com/twbs/bootstrap)

> Register page is going to be at **localhost/hello/register** <br />
> Login page is going to be at **localhost/hello/login** <br />
> There is a registered admin user with email *ser@ser.com* and password **111111** <br />
> In order to add new user with admin role, you need to register a new user and main admin has to add user to admin list in admin menu

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