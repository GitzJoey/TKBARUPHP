<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Page Not Found | TKBARU</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />

        <link rel="stylesheet" type="text/css" href="{{ mix('adminlte/css/adminlte.css') }}">
    </head>

    <body style="background-color: #ecf0f5;">
        <div>

            <br>
            <br>
            <br>
            <br>
            <br>

            <div class="error-page">
                <h2 class="headline text-yellow"> 404</h2>

                <div class="error-content">
                    <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

                    <p>
                        Sorry...<br/>
                        We could not find the page you were looking for.<br/>
                        <a href="#" onclick="window.history.go(-1); return false;">Return to your previous page</a>
                        <br/>
                        <br/>
                        <a href="#">Contact Support</a>
                    </p>
                </div>
            </div>

            <br>
            <br>
            <br>

        </div>

        <script type="application/javascript" src="{{ mix('adminlte/js/adminlte.js') }}"></script>

    </body>
</html>
