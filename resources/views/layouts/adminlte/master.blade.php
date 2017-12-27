<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title') | TKBARU</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />

        <link rel="stylesheet" type="text/css" href="{{ mix('adminlte/css/adminlte.css') }}">

        @yield('custom_css')
    </head>

    <body class="hold-transition {{ !empty(Auth::user()->store->ribbon) ? Auth::user()->store->ribbon:'skin-blue' }} sidebar-mini">
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

                <br>
                <br>
                <br>

            </div>

            @include('layouts.adminlte.footer')

            @include('layouts.adminlte.control-sidebar')
        </div>

        <div id="loader-container">
            <div class="sk-cube-grid">
                <div class="sk-cube sk-cube1"></div>
                <div class="sk-cube sk-cube2"></div>
                <div class="sk-cube sk-cube3"></div>
                <div class="sk-cube sk-cube4"></div>
                <div class="sk-cube sk-cube5"></div>
                <div class="sk-cube sk-cube6"></div>
                <div class="sk-cube sk-cube7"></div>
                <div class="sk-cube sk-cube8"></div>
                <div class="sk-cube sk-cube9"></div>
            </div>
        </div>

        <input type="hidden" id="secapi" value="{{ Auth::user()->api_token }}">
        <input type="hidden" id="momentFormat" value="{{ \App\Util\PHP2Moment::convertToMoment(Auth::user()->store->dateTimeFormat) }}">

        <script type="application/javascript" src="{{ mix('adminlte/js/adminlte.js') }}"></script>
        <script type="application/javascript" src="{{ mix('adminlte/js/app.js') }}"></script>
        <script>
            $(document).on('expanded.pushMenu', function() { if (typeof(Storage) != 'undefined') { localStorage.setItem('pushMenu', 'expanded'); }; });
            $(document).on('collapsed.pushMenu', function() { if (typeof(Storage) != 'undefined') { localStorage.setItem('pushMenu', 'collapsed'); }; });

            $(document).ready(function () {
                var container = $("#loader-container");
                container.on('click', function () {
                    $(this).fadeOut("slow");
                });
                container.delay(350).fadeOut("slow");

                if (typeof(Storage) != 'undefined') {
                    if (localStorage.getItem('pushMenu') == 'collapsed') {
                        $('body').addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                    }
                }

                $('#goTop').goTop();

                var sessionTimeout = parseInt('{{ Config::get('session.lifetime') }}') * 60;
                function timeout() {
                    setTimeout(function () {
                        sessionTimeout = (sessionTimeout - 1);
                        if (sessionTimeout >= 30) {
                            $('#timeoutCount').text(moment.duration(sessionTimeout, 'seconds').format('h:mm:ss'));
                        } else {
                            document.getElementById('logout-form').submit();
                        }
                        timeout();
                    }, 1000);
                }
                timeout();

                numbro.defaultFormat('{{ Auth::user()->store->numeralFormat }}');

                $('#applySettingsButton').click(function() {
                    var response = $.ajax({
                        type: "POST",
                        url: '{{ route('api.user.apply_settings') }}' + '?api_token=' + $('#secapi').val(),
                        data: {
                            df: $('#settingDateFormat').val(),
                            tf: $('#settingTimeFormat').val(),
                            ts: $('#settingThousandSeparator').val(),
                            ds: $('#settingDecimalSeparator').val(),
                            dd: $('#settingDecimalDigit').val()
                        },
                        dataType: 'application/json',
                        complete: function() {
                            new noty({
                                text: 'Settings updated.',
                                type: 'success',
                                theme: 'relax',
                                timeout: 3000,
                                progressBar: true
                            }).show();
                        }
                    });
                });

                $('#notepadButton').click(function() {
                    var response = $.ajax({
                        type: "POST",
                        url: '{{ route('api.post.user.notepad.save') }}' + '?api_token=' + $('#secapi').val(),
                        data: {
                            sessionId: '{{ encrypt(Session::getId()) }}',
                            data: $('#notepadArea').val()
                        },
                        dataType: 'application/json',
                        complete: function() {
                            new noty({
                                text: 'Notepad updated.',
                                type: 'success',
                                theme: 'relax',
                                timeout: 3000,
                                progressBar: true
                            }).show();
                        }
                    });
                });
            })
        </script>

        @yield('custom_js')
    </body>
</html>
