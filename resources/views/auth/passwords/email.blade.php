@extends('layouts.adminlte.auth')

@section('title', 'Reset Password')

@section('content')
    <body class="hold-transition login-page">

        <div class="login-box animated slideInUp">
            <div class="login-logo">
                <a href="/front"><img src="{{ asset('/images/loginlogo_notext.png') }}" width="88" height="80"/></a>
            </div>

            <div class="login-box-body">
                @if(!empty(session('status')))
                    {{ session('status') }}
                    <hr/>
                    <a href="/login" class="btn btn-primary btn-block btn-flat">@lang('buttons.back_button')</a>
                @else
                    <p class="login-box-msg">@lang('login.forgot.title')</p>

                    <form role="form" method="post" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" name="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="Email">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            @if ($errors->has('email'))
                                <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('buttons.send_button')</button>
                            </div>
                        </div>
                    </form>
                    <hr/>

                    <a href="/login" class="text-center">@lang('buttons.back_button')</a>
                @endif
            </div>
        </div>

        <script type="application/javascript" src="{{ mix('adminlte/js/adminlte.js') }}"></script>

    </body>
@endsection