@extends('layouts.adminlte.auth')

@section('title', 'Login')

@section('content')
    <body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <a href="#"></a>
        </div>

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
                                <input type="checkbox" name="remember"> @lang('login.remember_me')
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('buttons.login_button')</button>
                    </div>
                </div>
            </form>
            <hr/>

            <a href="/register" class="text-center">@lang('login.register.new')</a>

        </div>
        <div class="pull-right"><a href="/forgot">@lang('login.forgot_pass')</a></div>
    </div>

    <script type="application/javascript" src="{{ asset('adminlte/js/app.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
    </body>
@endsection