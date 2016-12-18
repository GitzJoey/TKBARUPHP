@extends('layouts.adminlte.master')

@section('title')
    @lang('product_type.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-cube fa-fw"></span>&nbsp;@lang('product_type.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('product_type.edit.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_product_type_edit', $prodtype->hId()) !!}
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
            <h3 class="box-title">@lang('product_type.edit.header.title')</h3>
        </div>
        {!! Form::model($prodtype, ['method' => 'PATCH', 'route' => ['db.master.producttype.edit', $prodtype->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'true']) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">@lang('product_type.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" type="text" class="form-control" value="{{ $prodtype->name }}" placeholder="Name" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('short_code') ? 'has-error' : '' }}">
                    <label for="inputShortCode" class="col-sm-2 control-label">@lang('product_type.field.short_code')</label>
                    <div class="col-sm-10">
                        <input id="inputShortCode" name="short_code" type="text" class="form-control" value="{{ $prodtype->short_code }}" placeholder="Short Code">
                        <span class="help-block">{{ $errors->has('short_code') ? $errors->first('short_code') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescription" class="col-sm-2 control-label">@lang('product_type.field.description')</label>
                    <div class="col-sm-10">
                        <input id="inputDescription" name="description" type="text" class="form-control" value="{{ $prodtype->description }}" placeholder="Description">
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('product_type.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.producttype') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        {!! Form::close() !!}
    </div>
@endsection