@extends('layouts.adminlte.master')

@section('title')
    @lang('user.show.title')
@endsection

@section('custom_css')
    <style type="text/css">
        .control-label-normal {
            font-weight: 400;
            display:inline-block;
        }
    </style>
@endsection

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;@lang('user.show.page_title')
@endsection
@section('page_title_desc')
    @lang('user.show.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('user.show.header.title') : {{ $user->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('user.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputId" class="control-label">
                                <span class="control-label-normal">{{ $user->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">@lang('user.field.email')</label>
                        <div class="col-sm-10">
                            <label id="inputEmail" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $user->email }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRoles" class="col-sm-2 control-label">@lang('user.field.roles')</label>
                        <div class="col-sm-10">
                            <label id="inputEmail" class="control-label control-label-normal">
                                <span class="control-label-normal"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.user') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection