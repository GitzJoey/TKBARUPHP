@extends('layouts.adminlte.master')

@section('title')
    @lang('vendor_trucking.show.title')
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
    <span class="fa fa-ge fa-fw"></span>&nbsp;@lang('vendor_trucking.show.page_title')
@endsection
@section('page_title_desc')
    @lang('vendor_trucking.show.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('vendor_trucking.show.header.title') : {{ $vt->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('vendor_trucking.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputId" class="control-label">
                                <span class="control-label-normal">{{ $vt->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress" class="col-sm-2 control-label">@lang('vendor_trucking.field.address')</label>
                        <div class="col-sm-10">
                            <label id="inputAddress" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $vt->address }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPhone" class="col-sm-2 control-label">@lang('vendor_trucking.field.phone')</label>
                        <div class="col-sm-10">
                            <label id="inputPhone" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $vt->phone_num }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTaxId" class="col-sm-2 control-label">@lang('vendor_trucking.field.tax_id')</label>
                        <div class="col-sm-10">
                            <label id="inputTaxId" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $vt->tax_id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('vendor_trucking.field.status')</label>
                        <div class="col-sm-10">
                            <label id="inputStatus" class="control-label control-label-normal">
                                <span class="control-label-normal">@lang('lookup.'.$vt->status)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('vendor_trucking.field.remarks')</label>
                        <div class="col-sm-10">
                            <label id="inputRemarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $vt->remarks }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.vendor.trucking') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection