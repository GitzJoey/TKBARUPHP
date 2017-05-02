@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.transfer_stock.show.title')
@endsection

@section('page_title')
    <span class="fa fa-refresh fa-fw"></span>&nbsp;@lang('warehouse.transfer_stock.show.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.transfer_stock.show.page_title_desc')
@endsection

@section('breadcrumbs')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('warehouse.transfer_stock.show.header.title.stock_transfer')</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                @lang('warehouse.transfer_stock.field.transfer_date')
                            </label>
                            <div class="col-sm-10">
                                <label class="control-label control-label-normal">
                                    <span class="control-label-normal">{{ $stock_transfer->transfer_date }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                @lang('warehouse.transfer_stock.field.remarks')
                            </label>
                            <div class="col-sm-10">
                                <label class="control-label control-label-normal">
                                    <span class="control-label-normal">{{ $stock_transfer->reason }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                @lang('warehouse.transfer_stock.field.source_warehouse')
                            </label>
                            <div class="col-sm-10">
                                <label class="control-label control-label-normal">
                                    <span class="control-label-normal">{{ $stock_transfer->source_warehouse->name }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                @lang('warehouse.transfer_stock.field.destination_warehouse')
                            </label>
                            <div class="col-sm-10">
                                <label class="control-label control-label-normal">
                                    <span class="control-label-normal">{{ $stock_transfer->destination_warehouse->name }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                @lang('warehouse.transfer_stock.field.product')
                            </label>
                            <div class="col-sm-10">
                                <label class="control-label control-label-normal">
                                    <span class="control-label-normal">{{ $stock_transfer->product->name }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                @lang('warehouse.transfer_stock.field.quantity')
                            </label>
                            <div class="col-sm-10">
                                <label class="control-label control-label-normal">
                                    <span class="control-label-normal">{{ $stock_transfer->quantity }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputButton" class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <a href="{{ route('db.warehouse.transfer_stock.index') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>
@endsection
