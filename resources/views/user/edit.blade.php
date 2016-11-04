@extends('layouts.adminlte.master')

@section('title')
    @lang('user.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;@lang('user.edit.page_title')
@endsection
@section('page_title_desc')
    @lang('user.edit.page_title_desc')
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
            <h3 class="box-title">@lang('user.edit.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.admin.user.edit', $user->hId()) }}" method="post" accept-charset="UTF-8" data-parsley-validate="parsley">
            <input name="_method" type="hidden" value="PATCH"/>
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" value="{{ $user->name }}" type="text" class="form-control" placeholder="Name" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $user->email }}" placeholder="Email" data-parsley-required="true" readonly>
                        <span class="help-block">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('store') ? 'has-error' : '' }}">
                    <label for="inputStore" class="col-sm-2 control-label">Store</label>
                    <div class="col-sm-10">
                        {{ Form::select('store', $storeDDL, $user->store->id, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('store') ? $errors->first('store') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                    <label for="inputRoles" class="col-sm-2 control-label">Roles</label>
                    <div class="col-sm-10">
                        {{ Form::select('roles', $rolesDDL, $user->roles->first()->name, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('roles') ? $errors->first('roles') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                        <span class="help-block">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label for="inputPasswordConfirmation" class="col-sm-2 control-label">Retype Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="password_confirmation" placeholder="Password">
                        <span class="help-block">{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</span>
                    </div>
                </div>
                <hr>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="inputUserType" class="col-sm-2 control-label">@lang('user.field.user_type')</label>
                    <div class="col-sm-10">
                        {{ Form::select('type', $usertypeDDL, $user->userDetail()->pluck('type')->first(), array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('allow_login') ? 'has-error' : '' }}">
                    <label for="inputAllowLogin" class="col-sm-2 control-label">@lang('user.field.allow_login')</label>
                    <div class="col-sm-10">
                        <div class="checkbox icheck">
                            <label>
                                @if (boolval($user->userDetail()->pluck('allow_login')->first()))
                                    <input type="checkbox" name="allow_login" checked>&nbsp;
                                @else
                                    <input type="checkbox" name="allow_login">&nbsp;
                                @endif
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputLinkProfiles" class="col-sm-2 control-label">@lang('user.field.link_profile')</label>
                    <div class="col-sm-10">
                        @if (!empty($user->profile()->pluck('id')->first()))
                            <select name="link_profile" class="form-control">
                                @foreach($profiles as $p)
                                    @if (!empty($p->suppliers()->first()->id))
                                        @if ($user->profile()->pluck('id')->first() == $p->id)
                                            <option value="{{ $p->id }}" selected>[Supplier] Name: {{ $p->suppliers()->first()->name }}, PIC: {{ $p->first_name }} {{ $p->last_name }} 1</option>
                                        @else
                                            <option value="{{ $p->id }}">[Supplier] Name: {{ $p->suppliers()->first()->name }}, PIC: {{ $p->first_name }} {{ $p->last_name }} 2</option>
                                        @endif
                                    @else
                                        @if ($user->profile()->pluck('id')->first() == $p->id)
                                            <option value="{{ $p->id }}" selected>[Customer] Name: {{ $p->customers()->first()->name }}, PIC: {{ $p->first_name }} {{ $p->last_name }} 3</option>
                                        @else
                                            <option value="{{ $p->id }}">[Customer] Name: {{ $p->customers()->first()->name }}, PIC: {{ $p->first_name }} {{ $p->last_name }} 4</option>
                                        @endif
                                    @endif
                                @endforeach
                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                            </select>
                        @else
                            <select name="link_profile" class="form-control">
                                @foreach($profiles as $p)
                                    @if (!empty($p->suppliers()->first()->id))
                                        <option value="{{ $p->id }}">[Supplier] Name: {{ $p->suppliers()->first()->name }}, PIC: {{ $p->first_name }} {{ $p->last_name }} 5</option>
                                    @else
                                        <option value="{{ $p->id }}">[Customer] Name: {{ $p->customers()->first()->name }}, PIC: {{ $p->first_name }} {{ $p->last_name }} 6</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif
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