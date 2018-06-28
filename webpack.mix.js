let mix = require('laravel-mix');

/*
 | By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 */

mix.js('resources/assets/js/app.js', 'public/js')
	.babel('resources/assets/js/main.js', 'public/js/main.js')
	.sass('resources/assets/sass/app.scss', 'public/css')
	//.sass('resources/assets/sass/bootstrap.scss', 'public/css')
	.disableNotifications()
	.sourceMaps()
	.browserSync({
		proxy: 'localhost:8000',
		browser: 'firefox',
		files: [ 'public/css/*.css' ]
	})
