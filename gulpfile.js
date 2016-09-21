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

elixir(mix => {
    mix.sass('app.scss')
       .webpack('app.js');
});

/* AdminLTE */
elixir(function(mix) {
    mix.styles([
        'bootstrap/dist/css/bootstrap.min.css',
        'font-awesome/css/font-awesome.min.css',
        'ionicons/dist/css/ionicons.min.css',
        'admin-lte/dist/css/AdminLTE.min.css',
        'admin-lte/dist/css/skins/_all-skins.min.css',
        'icheck/skins/square/blue.css',
    ], 'public/adminlte/css/adminlte.css', 'node_modules')
        .scripts([
            'jquery/dist/jquery.min.js',
            'bootstrap/dist/js/bootstrap.min.js',
            'admin-lte/dist/js/app.min.js',
            'icheck/icheck.min.js'
        ], 'public/adminlte/js/app.js', 'node_modules')
        .copy('node_modules/bootstrap/fonts', 'public/adminlte/fonts')
        .copy('node_modules/font-awesome/fonts', 'public/adminlte/fonts')
        .copy('node_modules/ionicons/dist/fonts', 'public/adminlte/fonts')
        .copy('node_modules/icheck/skins/square/blue.png', 'public/adminlte/css')
        .copy('node_modules/icheck/skins/square/blue@2x.png', 'public/adminlte/css');
})