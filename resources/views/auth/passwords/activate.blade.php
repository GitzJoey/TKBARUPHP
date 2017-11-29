@extends('layouts.adminlte.auth')

@section('title', 'Activation')

@section('content')
    <body class="hold-transition login-page">
        <div class="login-box animated slideInUp">
            <div class="login-logo">
                <a href="/front"><img src="{{ asset('/images/loginlogo_notext.png') }}" width="88" height="80"/></a>
            </div>

            @if(session('error'))
                <div class="alert alert-warning text-center">
                    {{ session('error') }}
                </div>
            @endif

            <div class="login-box-body">
                @if(session('error'))
                    <p class="login-box-msg">
                        @if (LaravelLocalization::getCurrentLocale() == 'id')
                            Klik Disini Untuk Mengirim Ulang
                        @else
                            Click Here To Resend
                        @endif
                    </p>
                @endif
                <form role="form" method="post" action="{{ url('/activate/resend') }}">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" name="email" value="" type="email" class="form-control" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('buttons.resend_button')</button>
                        </div>
                    </div>
                </form>
                <hr/>

                <a href="/login" class="text-center">@lang('buttons.back_button')</a>
            </div>
        </div>
    </body>
@endsection