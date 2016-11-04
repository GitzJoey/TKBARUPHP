@extends('layouts.adminlte.master')

@section('title')
    @lang('phone_provider.create.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-phone"></span>&nbsp;@lang('phone_provider.create.page_title')
@endsection
@section('page_title_desc')
    @lang('phone_provider.create.page_title_desc')
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
            <h3 class="box-title">@lang('phone_provider.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.admin.phone_provider.create') }}" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('phone_provider.field.name')</label>
                    <div class="col-sm-10">
                        <input id="name" name="name" type="text" class="form-control" placeholder="@lang('phone_provider.field.name')" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">@lang('phone_provider.field.short_name')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="short_name" name="short_name" placeholder="@lang('phone_provider.field.short_name')">
                        <span class="help-block">{{ $errors->has('short_name') ? $errors->first('short_name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRoles" class="col-sm-2 control-label">@lang('phone_provider.field.prefix')</label>
                    <div class="col-sm-10">
                        <input id="prefix" name="prefix" type="text" class="form-control" placeholder="@lang('phone_provider.field.prefix')">
                        <span class="help-block">{{ $errors->has('prefix') ? $errors->first('prefix') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('phone_provider.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('phone_provider.field.remarks')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputRemarks" name="remarks" placeholder="@lang('phone_provider.field.remarks')">
                        <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.phone_provider') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection