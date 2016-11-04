@extends('layouts.adminlte.master')

@section('title')
    @lang('user.create.title')
@endsection

@section('page_title')
    <span class="fa fa-user fa-fw" xmlns="http://www.w3.org/1999/html"></span>&nbsp;@lang('user.create.page_title')
@endsection
@section('page_title_desc')
    @lang('user.create.page_title_desc')
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('user.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.admin.user.create') }}" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">@lang('user.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" type="text" class="form-control" placeholder="Name" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="inputEmail" class="col-sm-2 control-label">@lang('user.field.email')</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" value="{{ old('email') }}" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('store') ? 'has-error' : '' }}">
                    <label for="inputStore" class="col-sm-2 control-label">@lang('user.field.store')</label>
                    <div class="col-sm-10">
                        {{ Form::select('store', $storeDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('store') ? $errors->first('store') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                    <label for="inputRoles" class="col-sm-2 control-label">@lang('user.field.roles')</label>
                    <div class="col-sm-10">
                        {{ Form::select('roles', $rolesDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('roles') ? $errors->first('roles') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="inputPassword" class="col-sm-2 control-label">@lang('user.field.password')</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                        <span class="help-block">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label for="inputPasswordConfirmation" class="col-sm-2 control-label">@lang('user.field.retype_password')</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password_confirmation" placeholder="Password">
                        <span class="help-block">{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</span>
                    </div>
                </div>
                <hr>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="inputUserType" class="col-sm-2 control-label">@lang('user.field.user_type')</label>
                    <div class="col-sm-10">
                        {{ Form::select('type', $usertypeDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('allow_login') ? 'has-error' : '' }}">
                    <label for="inputAllowLogin" class="col-sm-2 control-label">@lang('user.field.allow_login')</label>
                    <div class="col-sm-10">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="allow_login">&nbsp;
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputLinkProfiles" class="col-sm-2 control-label">@lang('user.field.link_profile')</label>
                    <div class="col-sm-10">
                        <select name="link_profile" class="form-control">
                            @foreach($profiles as $p)
                                @if (!empty($p->suppliers()->first()->id))
                                    <option value="{{ $p->id }}">[Supplier] Name: {{ $p->suppliers()->first()->name }}, PIC: {{ $p->first_name }} {{ $p->last_name }}</option>
                                @else
                                    <option value="{{ $p->id }}">[Customer] Name: {{ $p->customers()->first()->name }}, PIC: {{ $p->first_name }} {{ $p->last_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.user') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="text/javascript">
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
@endsection