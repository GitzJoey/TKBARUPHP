<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title') | TKBARU</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/css/adminlte.css') }}">
        @yield('custom_css')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            @include('layouts.adminlte.header')

            @include('layouts.adminlte.sidebar')

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>@yield('page_title')
                        <small>@yield('page_title_desc')</small>
                    </h1>
                    @yield('breadcrumbs')
                </section>

                <section class="content">
                    @yield('content')
                </section>
            </div>

            @include('layouts.adminlte.footer')

            @include('layouts.adminlte.control-sidebar')
        </div>

        <script type="application/javascript" src="{{ asset('adminlte/js/app.js') }}"></script>

        <script type="application/javascript">
            window.Parsley.setLocale('{!! LaravelLocalization::getCurrentLocale() !!}');

            $('#goTop').goTop();

            var sessionTimeout = parseInt('{{ Config::get('session.lifetime') }}') * 60 * 1000;
            function timeout() {
                setTimeout(function () {
                    sessionTimeout = (sessionTimeout - 1000);
                    if (sessionTimeout >= 0) {
                        $('#timeoutCount').text(sessionTimeout / 1000);
                    } else {
                        window.location.href = ctxpath + "/logout";
                    }
                    timeout();
                }, 1000);
            }
            timeout();
        </script>

        @yield('custom_js')
    </body>
</html>