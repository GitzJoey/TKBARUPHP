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
    {!! Breadcrumbs::render('stockmerger_show') !!}
@endsection

@section('content')
@endsection