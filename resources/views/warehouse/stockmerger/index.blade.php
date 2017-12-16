@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.stockmerger.index.title')
@endsection

@section('page_title')
    <span class="fa fa-sort-amount-asc fa-fw"></span>&nbsp;@lang('warehouse.stockmerger.index.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.stockmerger.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('stockmerger_index') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('warehouse.stockmerger.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('warehouse.stockmerger.index.table.header.merge_date')</th>
                        <th class="text-center">@lang('warehouse.stockmerger.index.table.header.merge_type')</th>
                        <th class="text-center">@lang('warehouse.stockmerger.index.table.header.product')</th>
                        <th class="text-center">@lang('warehouse.stockmerger.index.table.header.remarks')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($stockmerge) == 0)
                        <tr>
                            <td colspan="5" class="text-center animated shake">@lang('labels.DATA_NOT_FOUND')</td>
                        </tr>
                    @else
                        @foreach ($stockmerge as $key => $s)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($s->merge_date)->format(Auth::user()->store->date_format) }}</td>
                                <td>@lang('lookup.'.$s->merge_type)</td>
                                <td>{{ $s->product->name }}</td>
                                <td>{{ $s->remarks }}</td>
                                <td width="10%" class="text-center">
                                    <a class="btn btn-xs btn-info" href="{{ route('db.warehouse.stock_merger.show', $s->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.warehouse.stock_merger.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $stockmerge->render() !!}
        </div>
    </div>
@endsection