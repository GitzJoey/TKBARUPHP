@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.transfer_stock.index.title')
@endsection

@section('page_title')
    <span class="fa fa-refresh fa-fw"></span>&nbsp;@lang('warehouse.transfer_stock.index.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.transfer_stock.index.page_title_desc')
@endsection

@section('breadcrumbs')

@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('warehouse.transfer_stock.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="20%">@lang('warehouse.transfer_stock.index.table.header.transfer_date')</th>
                        <th class="text-center" width="20%">@lang('warehouse.transfer_stock.index.table.header.product')</th>
                        <th class="text-center" width="20%">@lang('warehouse.transfer_stock.index.table.header.from')</th>
                        <th class="text-center" width="20%">@lang('warehouse.transfer_stock.index.table.header.to')</th>
                        <th class="text-center" width="10%">@lang('warehouse.transfer_stock.index.table.header.quantity')</th>
                        <th class="text-center" width="10%">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection