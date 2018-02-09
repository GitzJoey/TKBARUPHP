@extends('layouts.adminlte.auth')

@section('title', 'Login')

@section('content')
    <body class="hold-transition login-page">

    <div class="login-box animated slideInUp">
        <div class="login-logo">
            <a href="/front"><img src="{{ asset('/images/loginlogo_notext.png') }}" width="88" height="80"/></a>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="login-box-body">
            <p class="login-box-msg">@lang('login.title')</p>

            <form role="form" method="post" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" name="email"
                           value="{{ !empty(Cookie::get('tkbaruCookie_login')) ? Cookie::get('tkbaruCookie_login'):old('email') }}"
                           type="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" class="is_icheck" name="remember"> @lang('login.remember_me')
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        &nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('buttons.login_button')</button>
                    </div>
                </div>
            </form>
            <hr class="strong-line">
            <div class="btn-group btn-group-justified">
                <a href="/register" class="btn btn-xs btn-primary btn-block btn-flat">@lang('login.register.new')</a>
            </div>
            <br>
            <div class="btn-group btn-group-justified">
                <a href="/forgot" class="btn btn-xs btn-default btn-block btn-flat">@lang('login.forgot_pass')</a></div>
            </div>
        </div>
    </div>

    <script type="application/javascript" src="{{ mix('adminlte/js/adminlte.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/parsley.config.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/parsley.min.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/id.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/id.extra.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/en.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/en.extra.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            window.Parsley.setLocale('{!! LaravelLocalization::getCurrentLocale() !!}');

            $('input.is_icheck').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
    </body>
@endsection