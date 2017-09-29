<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title') | TKBARU</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />

        <link rel="stylesheet" type="text/css" href="{{ mix('adminlte/css/adminlte.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ mix('frontweb/css/frontweb.css') }}">

        @yield('custom_css')
    </head>

    <body class="with-fixed-top-nav">
        @include('layouts.frontweb.topnav')

        @yield('content')
    </body>

    <script type="application/javascript" src="{{ mix('adminlte/js/adminlte.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/js/app.js') }}"></script>
    @yield('custom_js')
</html>