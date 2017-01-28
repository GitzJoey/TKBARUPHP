@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.cash.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.cash.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.cash.edit.page_title_desc')
@endsection

@section('breadcrumbs')

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
            <h3 class="box-title">@lang('accounting.cash.edit.header.title')</h3>
        </div>
        {!! Form::model($acccash, ['method' => 'PATCH', 'route' => ['db.acc.cash.edit', $acccash->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputCode" class="col-sm-2 control-label">@lang('accounting.cash.field.code')</label>
                    <div class="col-sm-10">
                        <input id="inputCode" class="form-control" name="symbol" type="text" value="{{ $acccash->symbol }}" placeholder="Code">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('accounting.cash.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" type="text" class="form-control" value="{{ $acccash->name }}" placeholder="Name" data-parsley-required="true">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputIsDefault" class="col-sm-2 control-label">@lang('accounting.cash.field.is_default')</label>
                    <div class="col-sm-10">

                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('accounting.cash.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, $unit->status, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.acc.cash') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        {!! Form::close() !!}
    </div>
@endsection