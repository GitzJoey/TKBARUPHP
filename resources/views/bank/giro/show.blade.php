@extends('layouts.adminlte.master')

@section('title')
    @lang('giro.show.title')
@endsection

@section('page_title')
    <span class="fa fa-book fa-fw"></span>&nbsp;@lang('giro.show.page_title')
@endsection

@section('page_title_desc')
    @lang('giro.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('bank_giro_show', $giro->hId()) !!}
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('giro.show.header.title') : {{ $giro->serial_number }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputBank" class="col-sm-2 control-label">@lang('giro.field.bank')</label>
                        <div class="col-sm-10">
                            <label id="inputBank" class="control-label">
                                <span class="control-label-normal">{{ $giro->bank->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSerialNumber" class="col-sm-2 control-label">@lang('giro.field.serial_number')</label>
                        <div class="col-sm-10">
                            <label id="inputSerialNumber" class="control-label">
                                <span class="control-label-normal">{{ $giro->serial_number }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEffectiveDate" class="col-sm-2 control-label">@lang('giro.field.effective_date')</label>
                        <div class="col-sm-10">
                            <label id="inputEffectiveDate" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ date('d-m-Y', strtotime($giro->effective_date)) }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAmount" class="col-sm-2 control-label">@lang('giro.field.amount')</label>
                        <div class="col-sm-10">
                            <label id="inputAmount" class="control-label">
                                <span class="control-label-normal">{{ number_format($giro->amount, 0) }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPrintedName" class="col-sm-2 control-label">@lang('giro.field.printed_name')</label>
                        <div class="col-sm-10">
                            <label id="inputPrintedName" class="control-label">
                                <span class="control-label-normal">{{ $giro->printed_name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('giro.field.status')</label>
                        <div class="col-sm-10">
                            <label id="status" class="control-label control-label-normal">
                                <span class="control-label-normal">@lang('lookup.' . $giro->status)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('giro.field.remarks')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $giro->remarks }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.bank.giro') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </form>
        </div>
    </div>
@endsection