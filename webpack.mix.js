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
/* las librerias están en la carpeta css y js*/

mix.styles([
    'resources/assets/plantilla/css/all.min.css',
    'resources/assets/plantilla/css/ionicons.min.css',
    'resources/assets/plantilla/css/adminlte.min.css',
    'resources/assets/plantilla/css/OverlayScrollbars.min.css'
], 'public/css/plantilla.css')
.scripts([
    'resources/assets/plantilla/js/jquery.min.js',
    //'resources/assets/plantilla/js/sweetalert2.all.js',
    'resources/assets/plantilla/js/Chart.min.js',
    'resources/assets/plantilla/js/bootstrap.bundle.min.js',
    'resources/assets/plantilla/js/adminlte.min.js',
    'resources/assets/plantilla/js/demo.js'
], 'public/js/plantilla.js')
.js(['resources/assets/js/app.js'],'public/js/app.js');