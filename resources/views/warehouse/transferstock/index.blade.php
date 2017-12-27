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
    {!! Breadcrumbs::render('transferstock_index') !!}
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
                    @foreach ($stock_transfer as $key => $stock_transfer_item)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($stock_transfer_item->transfer_date)->format(Auth::user()->store->dateTimeFormat) }}</td>
                            <td>{{ $stock_transfer_item->product->name }}</td>
                            <td>{{ $stock_transfer_item->source_warehouse->name }}</td>
                            <td>{{ $stock_transfer_item->destination_warehouse->name }}</td>
                            <td class="text-center">{{ number_format($stock_transfer_item->quantity, Auth::user()->decimal_digit, Auth::user()->store->decimal_separator, Auth::user()->store->thousand_separator) }}</td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.warehouse.transfer_stock.show', $stock_transfer_item->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
        <div class="box-footer clearfix">
            {!! $stock_transfer->render() !!}
            <a class="btn btn-success" href="{{ route('db.warehouse.transfer_stock.transfer') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
        </div>
    </div>
@endsection
