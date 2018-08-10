let mix = require('laravel-mix');

/*
 | By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 */

mix.js('resources/js/app.js', 'public/js/vendor')
	.babel('resources/js/main.js', 'public/js/vendor/main.js')
	.combine([
		'public/js/vendor/app.js',
		'public/js/vendor/main.js',
	], 'public/js/app.js')
	.sass('resources/sass/app.scss', 'public/css')
	.disableNotifications()
	.sourceMaps()
	.browserSync({
		proxy: 'localhost:8000',
		browser: 'firefox',
		files: [
			'public/css/*.css',
			'public/js/*.js',
		]
	})
