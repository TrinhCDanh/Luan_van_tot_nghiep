let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   //.sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/giangvien/assets/js/app.js', 'public/giangvien/js')
   //.sass('resources/giangvien/assets/sass/app.scss', 'public/giangvien/css');

mix.js('resources/kythuatvien/assets/js/app.js', 'public/kythuatvien/js')
   //.sass('resources/kythuatvien/assets/sass/app.scss', 'public/kythuatvien/css');