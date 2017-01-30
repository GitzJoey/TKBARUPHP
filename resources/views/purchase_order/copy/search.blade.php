@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.copy.search.title')
@endsection

@section('page_title')
    <span class="fa fa-copy fa-rotate-180 fa-fw"></span>&nbsp;@lang('purchase_order.copy.search.page_title')
@endsection

@section('page_title_desc')
    @lang('purchase_order.copy.search.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('purchase_order_copy') !!}
@endsection

@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                <li>@lang("purchase_order.copy.search.po_not_found") {{ Session::get('code') }}</li>
            </ul>
        </div>
    @endif

        <div id="po-copy-vue">
            <form class="form-horizontal">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('purchase_order.copy.search.header.search')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputSearchPOCode" v-model="poCode" placeholder="Purchase Order Code">
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-block btn-md btn-primary" v-bind:href="'{{ route('db.po.copy.index') }}/' + poCode">Search</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var poCopyApp = new Vue({
            el: '#po-copy-vue',
            data: {
                poCode: '{{ Session::get('code') }}'
            }
        });
    </script>
@endsection
