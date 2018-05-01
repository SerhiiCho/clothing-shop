let mix = require('laravel-mix');

/*
 | By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 */

mix.js('resources/assets/js/app.js', 'public/js')
	.sass('resources/assets/sass/app.scss', 'public/css')
	.disableNotifications()
