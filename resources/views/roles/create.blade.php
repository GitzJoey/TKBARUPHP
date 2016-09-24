@extends('layouts.adminlte.master')

@section('title')
    @lang('role.index.title')
@endsection

@section('page_title')
    <span class="fa fa-key fa-fw"></span>&nbsp;@lang('role.index.page_title')
@endsection
@section('page_title_desc')
    @lang('role.index.page_title_desc')
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
            <h3 class="box-title">@lang('role.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.admin.roles.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('role.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('role.field.name')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDisplayName" class="col-sm-2 control-label">@lang('role.field.display_name')</label>
                    <div class="col-sm-10">
                        <input id="inputDisplayName" name="display_name" type="text" class="form-control" placeholder="@lang('role.field.display_name')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescription" class="col-sm-2 control-label">@lang('role.field.description')</label>
                    <div class="col-sm-10">
                        <input id="inputDescription" name="description" type="text" class="form-control" placeholder="@lang('role.field.description')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPermission" class="col-sm-2 control-label">@lang('role.field.permission')</label>
                    <div class="col-sm-10">
                        <select multiple name="permission[]" class="form-control" size="25">
                            @foreach($permission as $key => $p)
                                <option value="{{ $p->id }}">{{ $p->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.roles') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection