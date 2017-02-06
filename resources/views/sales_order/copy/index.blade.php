@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.copy.index.title')
@endsection

@section('page_title')
    <span class="fa fa-copy fa-rotate-180 fa-fw"></span>&nbsp;@lang('sales_order.copy.index.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.copy.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('sales_order_copy') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                @if (Session::get('error') == 'so_not_found')
                    <li>@lang("sales_order.copy.search.so_not_found") {{ Session::get('code') }}</li>
                @else
                    <li>{{ Session::get('error') }} {{ Session::get('code') }}</li>
                @endif
            </ul>
        </div>
    @endif

    <div id="soCopyVue">
        <form class="form-horizontal" id="searchForm">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('sales_order.copy.index.header.search')</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputSearchSOCode" v-model="soCode"
                                   placeholder="Sales Order Code">
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-block btn-md btn-primary"
                               v-bind:href="'{{ route('db.so.copy.index') }}/' +  soCode">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('sales_order.copy.index.header.title')</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">@lang('sales_order.copy.index.table.header.code')</th>
                        <th class="text-center">@lang('sales_order.copy.index.table.header.so_date')</th>
                        <th class="text-center">@lang('sales_order.copy.index.table.header.customer')</th>
                        <th class="text-center">@lang('sales_order.copy.index.table.header.shipping_date')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($soCopies as $key => $copy)
                        <tr>
                            <td class="text-center">{{ $copy->code }}</td>
                            <td class="text-center">{{ $copy->so_created }}</td>
                            <td class="text-center">
                                @if($copy->customer_type == 'CUSTOMERTYPE.R')
                                    {{ $copy->customer->name }}
                                @else
                                    {{ $copy->walk_in_cust }}
                                @endif
                            </td>
                            <td class="text-center">{{ $copy->shipping_date }}</td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-primary"
                                   href="{{ route('db.so.copy.edit', ['soCode' => $copy->main_so_code, 'id' => $copy->hId()]) }}"
                                   title="Edit"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.so.copy.delete', $copy->main_so_code, $copy->hId()], 'style'=>'display:inline'])  !!}
                                <button type="submit" class="btn btn-xs btn-danger" title="Delete" id="delete_button" v-on:click.prevent="showAlert">
                                    <span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <a class="btn btn-success" href="{{ route('db.so.copy.create', ['code' => $soCode]) }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = new Vue({
            el: '#soCopyVue',
            data: {
                soCode: '{{ $soCode }}'
            },
            methods: {
                showAlert: function (event) {
                    var buttonId = event.currentTarget.id;
                    var form = $('#'+buttonId).parents('form');
                    swal({
                        title: "@lang('messages.alert.delete.sales_order.copy.title')",
                        text: "@lang('messages.alert.delete.sales_order.copy.text')",
                        type: "error",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "@lang('buttons.reject_button')",
                        cancelButtonText: "@lang('buttons.cancel_button')",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) form.submit();
                    });
                }
            }
        });
    </script>
@endsection
