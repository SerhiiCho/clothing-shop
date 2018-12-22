let mix = require('laravel-mix');

const css = 0;
const js = 1;
const server = 1;

if (css === 1) {
    mix.sass('resources/sass/app.scss', 'public/css/app.css').options({
        processCssUrls: false,
    })
}

if (js === 1) {
    mix.js('resources/js/app.js', 'public/js/app.js')
        .options({
            uglify: {
                uglifyOptions: {
                    compress: {
                        drop_console: true
                    }
                }
            }
        })
}

if (server === 1) {
    mix.browserSync({
        proxy: 'clothing-shop.test',
        files: [
            'public/css/*.css',
            'public/js/*.js',
        ],
        notify: false,
    })
}
