@extends('layouts.adminlte.master')

@section('title')
    @lang('search.result.title')
@endsection

@section('page_title')
    @lang('search.result.page_title')
@endsection

@section('page_title_desc')
    @lang('search.result.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('search') !!}
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('search.result.box.purchase_order')</h3>
        </div>
        <div class="box-body">
            @if (count($po) == 0) <div class="text-center">@lang('labels.DATA_NOT_FOUND')</div> @endif
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('search.result.box.sales_order')</h3>
        </div>
        <div class="box-body">
            @if (count($po) == 0) <div class="text-center">@lang('labels.DATA_NOT_FOUND')</div> @endif
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('search.result.box.purchase_order_payment')</h3>
        </div>
        <div class="box-body">
            @if (count($so) == 0) <div class="text-center">@lang('labels.DATA_NOT_FOUND')</div> @endif
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('search.result.box.sales_order_payment')</h3>
        </div>
        <div class="box-body">
            @if (count($payment) == 0) <div class="text-center">@lang('labels.DATA_NOT_FOUND')</div> @endif
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('search.result.box.stock')</h3>
        </div>
        <div class="box-body">
            @if (count($stocks) == 0) <div class="text-center">@lang('labels.DATA_NOT_FOUND')</div> @endif
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('search.result.box.supplier')</h3>
        </div>
        <div class="box-body">
            @if (count($supplier) == 0) <div class="text-center">@lang('labels.DATA_NOT_FOUND')</div> @endif
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('search.result.box.customer')</h3>
        </div>
        <div class="box-body">
            @if (count($customer) == 0) <div class="text-center">@lang('labels.DATA_NOT_FOUND')</div> @endif
        </div>
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('search.result.box.product')</h3>
        </div>
        <div class="box-body">
            @if (count($product) == 0) <div class="text-center">@lang('labels.DATA_NOT_FOUND')</div> @endif
        </div>
    </div>
@endsection