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

        <script type="application/javascript" src="{{ asset('adminlte/js/app.js') }}"></script>

        <script type="application/javascript">
            $(document).ready(function () {
                var container = $("#loader-container");
                container.on('click', function () {
                    $(this).fadeOut("slow");
                });
                container.fadeOut("slow");
            });

            window.onload = function () {
                $("#loader-container").fadeIn("slow");
            };

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

            $('a[id^="btn_skin"]').click(function(e) {
                e.preventDefault();

                $.each(my_skins, function(i) {
                    $('body').removeClass(my_skins[i]);
                });

                $('body').addClass($(this).attr('data-skin'));

                store('skin', $(this).attr('data-skin'));
            });

            $('input[id^="cbx_settings_"]').click(function(e) {
                var button = $(this).attr('id');

                if (button == 'cbx_settings_toggleRightSidebarSkin') {
                    var sidebar = $("aside.control-sidebar");
                    var skinList = $("#skinList");

                    if (sidebar.hasClass("control-sidebar-dark")) {
                        sidebar.removeClass("control-sidebar-dark");
                        sidebar.addClass("control-sidebar-light");
                        skinList.removeClass("control-sidebar-skin-bg-dark");
                        skinList.addClass("control-sidebar-skin-bg-light");
                    } else {
                        sidebar.removeClass("control-sidebar-light");
                        sidebar.addClass("control-sidebar-dark");
                        skinList.removeClass("control-sidebar-skin-bg-light");
                        skinList.addClass("control-sidebar-skin-bg-dark");
                    }
                }
            })

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

            $("#cbx_settings_toggleRightSidebarSlide").on('click', function () {
                change_layout($(this).data('controlsidebar'));

                var slide = $.AdminLTE.options.controlSidebarOptions.slide;

                $.AdminLTE.options.controlSidebarOptions.slide = slide;

                if (!slide) $('.control-sidebar').removeClass('control-sidebar-open');
            });

            $("#cbx_settings_expandOnHover").on('click', function () {
                if ($('#cbx_settings_expandOnHover').is(':checked')) {
                    store('expandOnHover', true);
                    $("body").removeClass('sidebar-expanded-on-hover').addClass('sidebar-collapse');
                } else {
                    store('expandOnHover', false);
                }
            });

            $('#cbx_settings_boxedLayout').click(function() {
                if ($(this).is(':checked')) {
                    change_layout('layout-boxed');
                    store('layout-boxed', true)
                } else {
                    change_layout('fixed');
                    store('layout-boxed', false)
                }
            });

            $(".main-sidebar").hover(function(){
                var screenWidth = $.AdminLTE.options.screenSizes.sm - 1;

                if ($("body").hasClass('sidebar-mini')
                    && $("body").hasClass('sidebar-collapse')
                    && $(window).width() > screenWidth
                    && get('expandOnHover') == "true") {
                    $("body").removeClass('sidebar-collapse').addClass('sidebar-expanded-on-hover');
                } else if ($("body").hasClass('sidebar-mini')
                    && $("body").hasClass('sidebar-expanded-on-hover')
                    && $(window).width() > screenWidth
                    && get('expandOnHover') == "true") {
                    $("body").removeClass('sidebar-expanded-on-hover').addClass('sidebar-collapse');
                } else {

                }
            });
        </script>

        @yield('custom_js')
    </body>
</html>