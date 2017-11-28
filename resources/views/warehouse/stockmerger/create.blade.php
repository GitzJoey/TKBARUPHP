@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.stockmerger.create.title')
@endsection

@section('page_title')
    <span class="fa fa-sort-amount-asc fa-fw"></span>&nbsp;@lang('warehouse.stockmerger.create.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.stockmerger.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('stockmerger_create') !!}
@endsection

@section('content')
@endsection