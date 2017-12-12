const { mix } = require('laravel-mix');

mix.webpackConfig({
    resolve: {
        alias: {
            AutoNumeric: 'autonumeric/dist/autoNumeric.min',
        }
    }
});

mix.disableNotifications();

mix.copy('node_modules/highcharts/highcharts.js', 'public/adminlte/js')
    .copy('node_modules/fullcalendar/dist/fullcalendar.min.js', 'public/adminlte/js')
    .copy('node_modules/fullcalendar/dist/locale/id.js', 'public/adminlte/js')
    .copy('node_modules/tooltipster/dist/js/tooltipster.bundle.min.js', 'public/adminlte/js')
    .copy('node_modules/highcharts/css/highcharts.css', 'public/adminlte/css')
    .copy('node_modules/noty/lib/noty.js.map', 'public/adminlte/js')
    .copy('node_modules/fullcalendar/dist/fullcalendar.min.css', 'public/adminlte/css')
    .copy('node_modules/fullcalendar/dist/fullcalendar.print.min.css', 'public/adminlte/css')
    .copy('node_modules/tooltipster/dist/css/tooltipster.bundle.min.css', 'public/adminlte/css')
    .copy('node_modules/tooltipster/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min.css', 'public/adminlte/css')
    .copy('node_modules/bootstrap-fileinput/js/fileinput.js', 'public/adminlte/fileinput')
    .copy('node_modules/bootstrap-fileinput/js/locales/id.js', 'public/adminlte/fileinput')
    .copy('node_modules/bootstrap-fileinput/css/fileinput.css', 'public/adminlte/fileinput')
    .copy('resources/assets/js/parsley.config.js', 'public/adminlte/parsley')
    .copy('node_modules/parsleyjs/dist/parsley.min.js', 'public/adminlte/parsley')
    .copy('node_modules/parsleyjs/dist/i18n/en.js', 'public/adminlte/parsley')
    .copy('node_modules/parsleyjs/dist/i18n/id.js', 'public/adminlte/parsley')
    .copy('node_modules/parsleyjs/dist/i18n/en.extra.js', 'public/adminlte/parsley')
    .copy('node_modules/parsleyjs/dist/i18n/id.extra.js', 'public/adminlte/parsley')
    .copy('resources/assets/css/frontweb.css', 'public/frontweb/css');

mix.sass('resources/assets/sass/adminlte.scss', 'public/adminlte/css');
mix.js('resources/assets/js/adminlte.js', 'public/adminlte/js');
mix.js('resources/assets/js/app.js', 'public/adminlte/js');

mix.version();
