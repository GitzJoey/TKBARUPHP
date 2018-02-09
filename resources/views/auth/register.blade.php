@extends('layouts.adminlte.auth')

@section('title', 'Register')

@section('content')
    <body class="hold-transition register-page">

    <div class="register-box animated slideInDown">
        <div class="register-logo">
            <a href="/front"><img src="{{ asset('/images/loginlogo_notext.png') }}" width="88" height="80"/></a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">@lang('login.register.title')</p>

            <form id="registerForm" role="form" method="post" action="{{ url('/register') }}" data-parsley-validate="parsley">
                {{ csrf_field() }}
                @if ($store_mode == 'create')
                    <div class="form-group has-feedback {{ $errors->has('store_name') ? ' has-error' : '' }}">
                        <input id="store_name" name="store_name" type="text" class="form-control" placeholder="{{ trans('login.register.store_name') }}">
                        <span class="fa fa-umbrella form-control-feedback"></span>
                        @if ($errors->has('store_name'))
                            <span class="help-block"><strong>{{ $errors->first('store_name') }}</strong></span>
                        @endif
                    </div>
                    <hr>
                @elseif ($store_mode == 'use_default')
                    <input type="hidden" name="store_id" value="{{ $store_id }}">
                @elseif ($store_mode == 'store_pick')
                    <select name="picked_store_id" class="form-control">
                        @foreach ($storeDDL as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                    <hr>
                @else
                @endif
                <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                    <input id="name" name="name" type="text" class="form-control" placeholder="{{ trans('login.register.full_name') }}" value="{{ old('name') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" name="email" type="email" class="form-control" placeholder="{{ trans('login.register.email') }}" value="{{ old('email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" name="password" type="password" class="form-control" placeholder="{{ trans('login.register.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback">
                    </span>
                    @if ($errors->has('password'))
                        <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="{{ trans('login.register.retype_password') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="checkbox icheck">
                            <label></label>
                            <input id="terms" class="is_icheck" type="checkbox" data-parsley-required="true" data-parsley-errors-container="#checkbox_req"> @lang('login.register.agree_1')<a href="#" data-toggle="modal" data-target="#termsModal">@lang('login.register.agree_2')</a>
                            <span id="checkbox_req" class="help-block has-error"></span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('buttons.register_button')</button>
                        </div>
                    </div>
                </div>
            </form>
            <hr class="strong-line">
            <div class="row">
                <div class="col-md-6">
                    <a href="/login" class="btn btn-xs btn-primary btn-flat">@lang('login.register.already_member')</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="termsModalLabel">@lang('login.register.terms_and_cond')</h4>
                </div>
                <div class="modal-body">
                    @for ($i = 0; $i < 15; $i++)
                        <br/>
                    @endfor
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('buttons.close_button')</button>
                </div>
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

    <script>
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