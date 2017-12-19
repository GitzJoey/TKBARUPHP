@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.stockmerger.show.title')
@endsection

@section('page_title')
    <span class="fa fa-sort-amount-asc fa-fw"></span>&nbsp;@lang('warehouse.stockmerger.show.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.stockmerger.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('stockmerger_show', $stockMerge->hId()) !!}
@endsection

@section('content')
    <div class="form-horizontal">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('warehouse.stockmerger.show.header.title.merger')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputMergerDate" class="col-md-2">
                                @lang('warehouse.stockmerger.field.merger_date')
                            </label>
                            <div class="col-md-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMergerType" class="col-md-2">
                                @lang('warehouse.stockmerger.field.merge_type')
                            </label>
                            <div class="col-md-10">
                                <select class="form-control"
                                        name="merge_type">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('warehouse.stockmerger.show.header.title.stock_lists')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputStockLists" class="col-md-2">@lang('warehouse.stockmerger.field.stock_lists')</label>
                            <div class="col-md-10">
                                <select class="form-control"
                                        name="product_id">
                                    <option value="defaultStockLists"></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stockTable" class="col-md-2"></label>
                            <div class="col-md-10">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>@lang('warehouse.stockmerger.show.table.stock.header.po_code')</th>
                                            <th>@lang('warehouse.stockmerger.show.table.stock.header.po_date')</th>
                                            <th>@lang('warehouse.stockmerger.show.table.stock.header.shipping_date')</th>
                                            <th>@lang('warehouse.stockmerger.show.table.stock.header.current_quantity')</th>
                                            <th>@lang('warehouse.stockmerger.show.table.stock.header.warehouse')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center" width="10%">
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                   </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('warehouse.stockmerger.show.header.title.merger_remarks')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="inputRemarks">
                                    @lang('warehouse.stockmerger.field.remarks')
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea id="inputRemarks" name="remarks" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-5 col-sm-2 text-center">
                <div class="btn-toolbar">
                    <a id="backButton" class="btn btn-primary"
                       href="{{ route('db.warehouse.stock_merger.index') }}">@lang('buttons.back_button')</a>
                </div>
            </div>
        </div>
    </div>
@endsection