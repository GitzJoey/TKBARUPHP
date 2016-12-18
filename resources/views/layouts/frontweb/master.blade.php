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

    <body>
        @yield('content')
    </body>

    <script type="application/javascript" src="{{ asset('adminlte/js/app.js') }}"></script>

    @yield('custom_js')
</html>