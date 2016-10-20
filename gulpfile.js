const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.styles([
        './node_modules/bootstrap/dist/css/bootstrap.min.css',
        './node_modules/font-awesome/css/font-awesome.min.css',
        './node_modules/ionicons/dist/css/ionicons.min.css',
        './node_modules/admin-lte/dist/css/AdminLTE.min.css',
        './node_modules/admin-lte/dist/css/skins/_all-skins.min.css',
        './node_modules/icheck/skins/square/blue.css',
        './node_modules/bootstrap-daterangepicker/daterangepicker.css',
        './node_modules/ui-select/dist/select.min.css',
    ], 'public/adminlte/css/adminlte.css')
    .scripts([
        './node_modules/jquery/dist/jquery.min.js',
        './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/angular/angular.min.js',
        './node_modules/angular-sanitize/angular-sanitize.min.js',
        './node_modules/bootstrap-daterangepicker/moment.min.js',
        './node_modules/icheck/icheck.min.js',
        './node_modules/bootstrap-daterangepicker/daterangepicker.js',
        './node_modules/ui-select/dist/select.min.js',
        './resources/assets/js/parsley.config.js',
        './node_modules/parsleyjs/dist/parsley.min.js',
        './node_modules/parsleyjs/dist/i18n/en.js',
        './node_modules/parsleyjs/dist/i18n/id.js',
        './node_modules/parsleyjs/dist/i18n/en.extra.js',
        './node_modules/parsleyjs/dist/i18n/id.extra.js',
        './node_modules/ui-select/dist/select.min.js',eyjs for front-end validation with sample in truck module
        './node_modules/admin-lte/dist/js/app.min.js'
    ], 'public/adminlte/js/app.js');
});