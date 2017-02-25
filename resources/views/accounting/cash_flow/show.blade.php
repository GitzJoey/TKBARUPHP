@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.cash_flow.show.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.cash_flow.show.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.cash_flow.show.page_title_desc')
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
        <div class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputDate" class="col-sm-2 control-label">@lang('accounting.cash_flow.field.date')</label>
                    <div class="col-sm-10">
                        <span class="form-control"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSource" class="col-sm-2 control-label">@lang('accounting.cash_flow.field.source_account')</label>
                    <div class="col-sm-10">
                        <span class="form-control"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDestination" class="col-sm-2 control-label">@lang('accounting.cash_flow.field.destination_account')</label>
                    <div class="col-sm-10">
                        <span class="form-control"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAmount" class="col-sm-2 control-label">@lang('accounting.cash_flow.field.amount')</label>
                    <div class="col-sm-10">
                        <span class="form-control"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('accounting.cash_flow.field.remarks')</label>
                    <div class="col-sm-10">
                        <span class="form-control"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.acc.cash_flow') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </div>
    </div>
@endsection