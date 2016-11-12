@extends('layouts.adminlte.master')

@section('title')
    @lang('report.admin.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-cog"></span>&nbsp;@lang('report.admin.page_title')
@endsection

@section('page_title_desc')
    @lang('report.admin.page_title_desc')
@endsection

@section('content')
    <div class="well">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.admin.header.user')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="inputUser_User" class="col-sm-2 control-label">@lang('report.admin.field.user')</label>
                                <div class="col-sm-10">
                                    <input id="inputUser_User" type="text" class="form-control" placeholder="@lang('report.admin.field.user')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUser_Email" class="col-sm-2 control-label">@lang('report.admin.field.email')</label>
                                <div class="col-sm-10">
                                    <input id="inputUser_Email" type="text" class="form-control" placeholder="@lang('report.admin.field.email')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUser_Role" class="col-sm-2 control-label">@lang('report.admin.field.role')</label>
                                <div class="col-sm-10">
                                    {{ Form::select('role', $rolesDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'))) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUser_Profile" class="col-sm-2 control-label">@lang('report.admin.field.profile')</label>
                                <div class="col-sm-10">
                                    <input id="inputUser_Profile" type="text" class="form-control" placeholder="@lang('report.admin.field.profile')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.admin.header.role')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="inputRole_Name" class="col-sm-2 control-label">@lang('report.admin.field.name')</label>
                                <div class="col-sm-10">
                                    <input id="inputRole_Name" type="text" class="form-control" placeholder="@lang('report.admin.field.name')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRole_Permission" class="col-sm-2 control-label">@lang('report.admin.field.permission')</label>
                                <div class="col-sm-10">
                                    <input id="inputRole_Permission" type="text" class="form-control" placeholder="@lang('report.admin.field.permission')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.admin.header.store')</h3>
                    </div>
                    <div class="box-body">
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection