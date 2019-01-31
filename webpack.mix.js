const mix = require('laravel-mix')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

let vendors = [
    'vue',
    'vuex',
    'vee-validate',
    'axios',
    'sweetalert2',
    'lodash',
    'collect.js',
    'http-build-query',
    'vue-currency-filter',
    'vee-validate/dist/locale/pt_BR',
]

mix.js('resources/js/contact.js', 'public/js')
    .js('resources/js/auth/login.js', 'public/js/auth')
    .js('resources/js/auth/register.js', 'public/js/auth')
    .js('resources/js/auth/account-recovery.js', 'public/js/auth')
    .js('resources/js/sidebar/main.js', 'public/js/sidebar')
    .js('resources/js/cart/main.js', 'public/js/cart')
    .js('resources/js/user/main.js', 'public/js/user')
    .js('resources/js/login.js', 'public/js')
    .extract(vendors)

if (mix.inProduction()) {
    mix.version()
    mix.copyDirectory('resources/seo', 'public')
    mix.disableNotifications()
}

//mix.browserSync('127.0.0.1:8000')
