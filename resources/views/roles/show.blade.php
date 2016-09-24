@extends('layouts.adminlte.master')

@section('title')
    @lang('role.show.title')
@endsection

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;@lang('role.show.page_title')
@endsection
@section('page_title_desc')
    @lang('role.show.page_title_desc')
@endsection

@section('custom_css')
    <style type="text/css">
        .control-label-normal {
            font-weight: 400;
            display:inline-block;
        }
    </style>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('role.show.header.title') : {{ $role->display_name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('role.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputName" class="control-label">
                                <span class="control-label-normal">{{ $role->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDisplayName" class="col-sm-2 control-label">@lang('role.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputDisplayName" class="control-label">
                                <span class="control-label-normal">{{ $role->display_name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription" class="col-sm-2 control-label">@lang('role.field.description')</label>
                        <div class="col-sm-10">
                            <label id="inputDescription" class="control-label">
                                <span class="control-label-normal">{{ $role->description }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPermission" class="col-sm-2 control-label">@lang('role.field.permission')</label>
                        <div class="col-sm-10">
                            <label id="inputPermission" class="control-label">
                                <span class="control-label-normal">
                                    @foreach($role->permissionList as $p)
                                        {{ $p->name }}&nbsp;-&nbsp;{{ $p->display_name }}<br>
                                        <small>{{ $p->description }}</small><br/>
                                    @endforeach
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.roles') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection