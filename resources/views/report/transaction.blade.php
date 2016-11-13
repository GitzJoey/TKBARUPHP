@extends('layouts.adminlte.master')

@section('title')
    @lang('report.transaction.title')
@endsection

@section('page_title')
    <span class="fa fa-connectdevelop fa-fw"></span>&nbsp;@lang('report.transaction.page_title')
@endsection

@section('page_title_desc')
    @lang('report.transaction.page_title_desc')
@endsection

@section('content')
    <div class="well">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.admin.header.purchase_order')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.admin.header.sales_order')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection