const mix = require('laravel-mix');

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
mix.setPublicPath('public/');
// mix.setResourceRoot('../');
// mix.copyDirectory('resources/fonts/', 'public/fonts')
//     .copyDirectory('resources/img/', 'public/img');

mix.sass('resources/sass/app.scss', 'public/css/sewagi.css').version();
mix.sass('resources/sass/dashboard.scss', 'public/css/dashboard.css').version();

mix.js('resources/js/app.js', 'public/js')
    .babel([
        'public/js/app.js',
        'resources/js/config.js',
        'resources/js/plugins/*',
        'resources/js/initial.js',
        'resources/js/pages/*'
    ], 'public/js/sewagi.js').version()
    .babel([
        'public/adminlte/bower_components/jquery/dist/jquery.min.js',
        'public/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js',
        'public/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js',
        'public/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
        'public/adminlte/bower_components/iziToast/dist/js/iziToast.min.js',
        'public/adminlte/bower_components/jquery-validation/dist/jquery.validate.min.js',
        'public/adminlte/bower_components/bootbox/bootbox.min.js',
        'public/adminlte/dist/js/adminlte.min.js',
        'resources/js/config.js',
        'public/adminlte/dist/js/helper.js',
        'resources/js/plugins/*',
        'resources/js/admin/*',
    ], 'public/js/sewagi-admin.js').version();

