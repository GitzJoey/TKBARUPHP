<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title') | TKBARU</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />

        <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/css/adminlte.css') }}">

        @yield('custom_css')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper {{ !empty(Auth::user()->store->ribbon) ? Auth::user()->store->ribbon:'' }}">
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

        <script type="application/javascript" src="{{ asset('adminlte/js/app.js') }}"></script>

        <script type="application/javascript">
            $(document).ready(function () {
                var container = $("#loader-container");
                container.on('click', function () {
                    $(this).fadeOut("slow");
                });
                container.delay(500).fadeOut("slow");

                window.Parsley.setLocale('{!! LaravelLocalization::getCurrentLocale() !!}');

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

                var my_skins = [
                    "skin-blue",
                    "skin-black",
                    "skin-red",
                    "skin-yellow",
                    "skin-purple",
                    "skin-green",
                    "skin-blue-light",
                    "skin-black-light",
                    "skin-red-light",
                    "skin-yellow-light",
                    "skin-purple-light",
                    "skin-green-light"
                ];

                function store(name, val) {
                    if (typeof (Storage) !== "undefined") {
                        localStorage.setItem(name, val);
                    } else {
                        window.alert('Please use a modern browser to properly view this template!');
                    }
                }

                function get(name) {
                    if (typeof (Storage) !== "undefined") {
                        return localStorage.getItem(name);
                    } else {
                        window.alert('Please use a modern browser to properly view this template!');
                    }
                }

                function change_layout(cls) {
                    $("body").toggleClass(cls);
                    $.AdminLTE.layout.fixSidebar();

                    if (cls == "layout-boxed")
                        $.AdminLTE.controlSidebar._fix($(".control-sidebar-bg"));
                    if ($('body').hasClass('fixed') && cls == 'fixed') {
                        $.AdminLTE.pushMenu.expandOnHover();
                        $.AdminLTE.layout.activate();
                    }
                    $.AdminLTE.controlSidebar._fix($(".control-sidebar-bg"));
                    $.AdminLTE.controlSidebar._fix($(".control-sidebar"));
                }

                $("[data-layout]").on('click', function () {
                    change_layout($(this).data('layout'));
                });

                $("[data-controlsidebar]").on('click', function () {
                    change_layout($(this).data('controlsidebar'));
                    var slide = !AdminLTE.options.controlSidebarOptions.slide;
                    AdminLTE.options.controlSidebarOptions.slide = slide;
                    if (!slide)
                        $('.control-sidebar').removeClass('control-sidebar-open');
                });

                $("[data-sidebarskin='toggle']").on('click', function () {
                    var sidebar = $(".control-sidebar");
                    if (sidebar.hasClass("control-sidebar-dark")) {
                        sidebar.removeClass("control-sidebar-dark")
                        sidebar.addClass("control-sidebar-light")
                    } else {
                        sidebar.removeClass("control-sidebar-light")
                        sidebar.addClass("control-sidebar-dark")
                    }
                });

                $("[data-enable='expandOnHover']").on('click', function () {
                    if ($(this).is(':checked')) {
                        $(this).attr('disabled', true);
                        $.AdminLTE.pushMenu.expandOnHover();
                        if (!$('body').hasClass('sidebar-collapse'))
                            $("[data-layout='sidebar-collapse']").click();
                    } else {

                    }
                });

                $('input[autonumeric]').autoNumeric('init');

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
                            noty({
                                text: 'Settings updated.',
                                type: 'success',
                                timeout: 3000,
                                progressBar: true
                            });
                        }
                    });
                });
            });
        </script>

        @yield('custom_js')
    </body>
</html>