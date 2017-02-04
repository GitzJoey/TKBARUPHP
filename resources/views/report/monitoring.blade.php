@extends('layouts.adminlte.master')

@section('title')
    @lang('report.monitoring.title')
@endsection

@section('page_title')
    <span class="fa fa-eye fa-fw"></span>&nbsp;@lang('report.monitoring.page_title')
@endsection

@section('page_title_desc')
    @lang('report.monitoring.page_title_desc')
@endsection

@section('content')
    <div id="warehouseOutflowVue">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('report.monitoring.header.title')</h3>
            </div>
            <div class="box-body">
            </div>
        </div>
        <div class="box-footer clearfix">
        </div>
    </div>
@endsection