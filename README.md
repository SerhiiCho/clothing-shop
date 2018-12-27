<p align="center"><img src="https://raw.githubusercontent.com/SerhiiCho/clothing_shop/master/storage/app/public/img/big/slider/slider.png"></p>

## About

Simple E-commerce clothing shop. It has men's and women's categories and convenient filtering with [vue.js](https://github.com/vuejs/vue) by types of clothes like pents, short, skirts etc. In this web app is implemented infinite pagination without npm packages, just [vue.js](https://github.com/vuejs/vue) and little bit of effort. The app is pretty fast and optimized and the code is well written. Afcourse like any E-commerce web app it has admin panel.

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

The app supports only russian language, but can be easily translated. Just by copying /resources/lang/ru folder and translating all files to whatever language you want. There are no hard coded word, everything is using laravel translations via functions *lang()* and *trans()*.

## Technologies

* [Laravel - PHP framework](https://github.com/laravel/laravel)
* [Vue.js - JavaScript framework](https://github.com/vuejs/vue)
* [Bootstrap 4 - CSS framework](https://getbootstrap.com/)

## Packages

* [Intervention/image](http://image.intervention.io/)
* [rap2hpoutre/laravel-log-viewer](https://github.com/rap2hpoutre/laravel-log-viewer)
* [Crinsane/LaravelShoppingcart](https://github.com/Crinsane/LaravelShoppingcart)
* [TinyMCE Editor](https://www.tinymce.com/)

## Get started

1. `git clone https://github.com/SerhiiCho/clothing_shop.git`
2. `cd clothing_shop` Enter cloned folder
3. `mv .env.example .env` Rename the env.example file to .env
4. `vim .env` Open .env file and fill credentials
5. Create database **clothing_shop** or other name if you changed it in .env file
6. `npm install` to create node_modules folder
7. `composer install` to install or PHP packages
8. `npm run dev` to create js and css files in public folder
9. `php artisan key:generate` to generate app key
10. `php artisan wipe`, it should migrate all migrations and seed the database
11. `php artisan storage:link`, it should create a link in public folder to storage
12. `php artisan serve` and go to localhost:8000