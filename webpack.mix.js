const mix = require('laravel-mix');

const env = process.env.NODE_ENV

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/index.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version()
    .sourceMaps(true, 'inline-source-map')

if (env === 'production') {
    // Don't do system notifications, as production can be run on production
    // server and CI/CD
    mix.disableNotifications();
}
