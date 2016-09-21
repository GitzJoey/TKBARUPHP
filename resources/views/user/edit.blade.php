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
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
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
        <form class="form-horizontal" action="{{ route('db.admin.user.edit', $user->hId()) }}" method="post" accept-charset="UTF-8">
            <input name="_method" type="hidden" value="PATCH"/>
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" value="{{ $user->name }}" type="text" class="form-control" placeholder="Name">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email">
                        <span class="help-block">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('store') ? 'has-error' : '' }}">
                    <label for="inputStore" class="col-sm-2 control-label">Store</label>
                    <div class="col-sm-10">
                        {{ Form::select('store', $storeDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('store') ? $errors->first('store') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                    <label for="inputRoles" class="col-sm-2 control-label">Roles</label>
                    <div class="col-sm-10">
                        {{ Form::select('roles', $rolesDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
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
                <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="inputFirstName" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputFirstName" name="first_name" placeholder="First Name">
                        <span class="help-block">{{ $errors->has('first_name') ? $errors->first('first_name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="inputLastName" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputFirstName" name="last_name" placeholder="Last Name">
                        <span class="help-block">{{ $errors->has('last_name') ? $errors->first('last_name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('image_path') ? 'has-error' : '' }}">
                    <label for="inputUserImage" class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-10">
                        @if(!empty($user->image_filename))
                            <img src="{{ asset('images/'.$user->image_filename) }}" class="img-responsive img-circle" style="max-width: 150px; max-height: 150px;"/>
                        @endif
                        <input id="inputUserImage" name="image_path" type="file" class="form-control">
                        <span class="help-block">{{ $errors->has('image_path') ? $errors->first('image_path') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="inputAddress" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <textarea id="inputAddress" class="form-control" rows="5" name="address"></textarea>
                        <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.user') }}" class="btn btn-default">Cancel</a>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection