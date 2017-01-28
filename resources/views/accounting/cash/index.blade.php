@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.cash.index.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.cash.index.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.cash.index.page_title_desc')
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
            <h3 class="box-title">@lang('accounting.cash.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('accounting.cash.index.table.header.code')</th>
                        <th class="text-center">@lang('accounting.cash.index.table.header.name')</th>
                        <th class="text-center">@lang('accounting.cash.index.table.header.is_default')</th>
                        <th class="text-center">@lang('accounting.cash.index.table.header.status')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection