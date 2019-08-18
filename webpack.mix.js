let mix = require('laravel-mix');

    mix.sass('resources/sass/app.scss', 'public/css/app.css')
        .js('resources/js/app.js', 'public/js/app.js')
        .disableNotifications()
        .options({
            processCssUrls: false,
            uglify: {
                uglifyOptions: {
                    compress: {
                        drop_console: true
                    }
                }
            }
        })

