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
* Admin can check see **logs** and some basic **statistics**.

Here is what admin can choose on the dashboard.
1. **Allow registration** Admin can turn this option off, and register form will disappear.
2. **Turn on men's category** Admin can turn this off, and men's category will disappear.
3. **Turn on women's category** Admin can turn this off, and women's category will disappear.
4. **Clear all cahce** By clicking this button admin deletes all file cache data that is widely used in this app.

## Language

The app supports only russian language, but can be easily translated. Just by copying /resources/lang/ru folder and translating all files to whatever language you want. Also translate couple seeders. There are no hard coded word, everything is using laravel translations via functions *lang()* and *trans()*.

## Technologies

* [Laravel - PHP framework](https://github.com/laravel/laravel)
* [Vue.js - JavaScript framework](https://github.com/vuejs/vue)
* [Bootstrap 4 - CSS framework](https://getbootstrap.com/)

## Packages

* [Intervention/image](http://image.intervention.io/)
* [rap2hpoutre/laravel-log-viewer](https://github.com/rap2hpoutre/laravel-log-viewer)
* [Crinsane/LaravelShoppingcart](https://github.com/Crinsane/LaravelShoppingcart)
* [TinyMCE Editor](https://www.tinymce.com/)

## You need to know and have on your machine

* [Composer](https://getcomposer.org/)
* [Node](https://nodejs.org/en/)
* [PHP >= 7.2](http://php.net/)

## Get started (without Docker)

1. `> git clone https://github.com/SerhiiCho/clothing_shop.git`
2. `> cd clothing_shop/src` Enter cloned folder
3. `> mv .env.example .env` Rename the env.example file to .env
4. `> vim .env` Open .env file and fill credentials
5. Create database with the name that you filled in .env file in DB_DATABASE field
6. `> npm install` to create node_modules folder
7. `> composer install` to install all PHP packages
8. `> npm run dev` to create app.js and app.css files in public folder
9. `> php artisan key:generate` to generate laravel app key
10. `> php artisan wipe`, it should migrate all migrations and seed the database
11. `> php artisan storage:link`, it should create a link in public folder to storage
12. `> php artisan serve` and go to localhost:8000
13. `> vendor/bin/phpunit` Make sure tests are green