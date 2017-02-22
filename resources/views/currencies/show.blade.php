@extends('layouts.adminlte.master')

@section('title')
    @lang('currencies.show.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-flash"></span>&nbsp;@lang('currencies.show.page_title')
@endsection

@section('page_title_desc')
    @lang('currencies.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin_currencies_show', $currencies->hId()) !!}
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('currencies.show.header.title') : {{ $currencies->name }}</h3>
        </div>
        <form class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('currencies.field.name')</label>
                    <div class="col-sm-10">
                        <label id="inputName" class="control-label">
                            <span class="control-label-normal">{{ $currencies->name }}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSymbol" class="col-sm-2 control-label">@lang('currencies.field.symbol')</label>
                    <div class="col-sm-10">
                        <label id="inputSymbol" class="control-label control-label-normal">
                            <span class="control-label-normal">{{ $currencies->symbol }}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('currencies.field.status')</label>
                    <div class="col-sm-10">
                        <label class="control-label control-label-normal">
                            <span class="control-label-normal">@lang('lookup.'.$currencies->status)</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('currencies.field.remarks')</label>
                    <div class="col-sm-10">
                        <label id="inputRemarks" class="control-label control-label-normal">
                            <span class="control-label-normal">{{ $currencies->remarks }}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.currencies') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </form>
    </div>
@endsection