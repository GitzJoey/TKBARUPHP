@extends('layouts.adminlte.master')

@section('title')
    @lang('report.admin.title')
@endsection

@section('page_title')
    <span class="fa fa-viacoin fa-flip-vertical fa-fw"></span>&nbsp;@lang('report.admin.page_title')
@endsection

@section('page_title_desc')
    @lang('report.admin.page_title_desc')
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

    <div class="well">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('db.report.admin.user') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box box-info collapsed-box animated fadeInUp">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('report.admin.header.user')</h3>
                            <div class="box-tools">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputUser_User" class="col-sm-2 control-label">@lang('report.admin.field.user')</label>
                                <div class="col-sm-10">
                                    <input id="inputUser_User" type="text" name="name" class="form-control" placeholder="@lang('report.admin.field.user')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUser_Email" class="col-sm-2 control-label">@lang('report.admin.field.email')</label>
                                <div class="col-sm-10">
                                    <input id="inputUser_Email" type="text" name="email" class="form-control" placeholder="@lang('report.admin.field.email')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUser_Role" class="col-sm-2 control-label">@lang('report.admin.field.role')</label>
                                <div class="col-sm-10">
                                    {{ Form::select('role_id', $rolesDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'))) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUser_Profile" class="col-sm-2 control-label">@lang('report.admin.field.profile')</label>
                                <div class="col-sm-10">
                                    <input id="inputUser_Profile" type="text" name="profile_name" class="form-control" placeholder="@lang('report.admin.field.profile')">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </div>
                </form>
                <form action="{{ route('db.report.admin.role') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box box-info collapsed-box animated fadeInDownBig">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('report.admin.header.role')</h3>
                            <div class="box-tools">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <form action="" method="post" class="form-horizontal">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputRole_Name" class="col-sm-2 control-label">@lang('report.admin.field.name')</label>
                                    <div class="col-sm-10">
                                        <input id="inputRole_Name" type="text" name="name" class="form-control" placeholder="@lang('report.admin.field.name')">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputRole_Permission" class="col-sm-2 control-label">@lang('report.admin.field.permission')</label>
                                    <div class="col-sm-10">
                                        <input id="inputRole_Permission" type="text" name="permission" class="form-control" placeholder="@lang('report.admin.field.permission')">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                            </div>
                        </form>
                    </div>
                </form>
                <form action="{{ route('db.report.admin.store') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box box-info collapsed-box animated fadeInLeft">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('report.admin.header.store')</h3>
                            <div class="box-tools">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputStore_Name" class="col-sm-2 control-label">@lang('report.admin.field.name')</label>
                                <div class="col-sm-10">
                                    <input id="inputStore_Name" type="text" name="name"  class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputStore_Tax" class="col-sm-2 control-label">@lang('report.admin.field.tax_id')</label>
                                <div class="col-sm-10">
                                    <input id="inputStore_Tax" type="text" name="tax_id" class="form-control" placeholder="Tax ID">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form action="{{ route('db.report.admin.unit') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box box-info collapsed-box animated fadeInUpBig">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('report.admin.header.unit')</h3>
                            <div class="box-tools">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputUnit_Name" class="col-sm-2 control-label">@lang('report.admin.field.name')</label>
                                <div class="col-sm-10">
                                    <input id="inputUnit_Name" type="text" name="name" class="form-control" placeholder="@lang('report.admin.field.name')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputUnit_Symbol" class="col-sm-2 control-label">@lang('report.admin.field.symbol')</label>
                                <div class="col-sm-10">
                                    <input id="inputUnit_Symbol" type="text" name="symbol" class="form-control" placeholder="@lang('report.admin.field.symbol')">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </div>
                </form>
                <form action="{{ route('db.report.admin.phone_provider') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box box-info collapsed-box animated fadeInRightBig">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('report.admin.header.phone_provider')</h3>
                            <div class="box-tools">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPhoneProvider_Name" class="col-sm-2 control-label">@lang('report.admin.field.name')</label>
                                <div class="col-sm-10">
                                    <input id="inputPhoneProvider_Name" type="text" name="name" class="form-control" placeholder="@lang('report.admin.field.name')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhoneProvider_ShortName" class="col-sm-2 control-label">@lang('report.admin.field.short_name')</label>
                                <div class="col-sm-10">
                                    <input type="text" name="short_name" class="form-control" id="inputPhoneProvider_ShortName" placeholder="@lang('report.admin.field.short_name')">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </div>
                </form>
                <form action="{{ route('db.report.admin.settings') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box box-info collapsed-box animated fadeInRight">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('report.admin.header.settings')</h3>
                            <div class="box-tools">
                                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSettings_User" class="col-sm-2 control-label">@lang('report.admin.field.user')</label>
                                <div class="col-sm-10">
                                    <input id="inputSettings_User" type="text" name="user" class="form-control" placeholder="@lang('report.admin.field.user')">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection