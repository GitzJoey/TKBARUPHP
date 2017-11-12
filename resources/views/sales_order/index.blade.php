@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.revise.index.title')
@endsection

@section('page_title')
    <span class="fa fa-code-fork fa-fw"></span>&nbsp;@lang('sales_order.revise.index.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.revise.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('sales_order') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div id="soVue">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('sales_order.revise.index.header.title')</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" width="15%">@lang('sales_order.revise.index.table.header.code')</th>
                            <th class="text-center" width="15%">@lang('sales_order.revise.index.table.header.so_date')</th>
                            <th class="text-center" width="25%">@lang('sales_order.revise.index.table.header.customer')</th>
                            <th class="text-center" width="15">@lang('sales_order.revise.index.table.header.shipping_date')</th>
                            <th class="text-center" width="20">@lang('sales_order.revise.index.table.header.status')</th>
                            <th class="text-center" width="10">@lang('labels.ACTION')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesOrders as $key => $so)
                            <tr>
                                <td class="text-center">{{ $so->code }}</td>
                                <td class="text-center">{{ date(Auth::user()->store->dateTimeFormat, strtotime($so->so_created)) }}</td>
                                <td class="text-center">
                                    @if($so->customer_type == 'CUSTOMERTYPE.R')
                                        {{ $so->customer->name }}
                                    @else
                                        {{ $so->walk_in_cust }}
                                    @endif
                                </td>
                                <td class="text-center">{{ date(Auth::user()->store->dateTimeFormat, strtotime($so->shipping_date)) }}</td>
                                <td class="text-center">@lang('lookup.'.$so->status)</td>
                                <td class="text-center" width="10%">
                                    <a class="btn btn-xs btn-primary" href="{{ route('db.so.revise', $so->hId()) }}" title="revise"><span class="fa fa-pencil fa-fw"></span></a>
                                    @if($so->status == 'SOSTATUS.WD')
                                    {!! Form::open(['id' => 'deleteForm', 'method' => 'DELETE', 'route' => ['db.so.reject', $so->hId()], 'style'=>'display:inline'])  !!}
                                        <button type="submit" class="btn btn-xs btn-danger" title="reject" id="delete_button" v-on:click.prevent="showAlert"><span class="fa fa-close fa-fw"></span></button>
                                    {!! Form::close() !!}
                                    @else
                                        <button type="submit" class="btn btn-xs btn-danger" title="reject" id="delete_button" disabled><span class="fa fa-close fa-fw"></span></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                {!! $salesOrders->render() !!}
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    <script type="application/javascript">
        var soApp = new Vue({
            el: '#soVue',
            methods: {
                showAlert: function (event) {
                    var buttonId = event.currentTarget.id;

                    swal({
                        title: "@lang('messages.alert.delete.sales_order.title')",
                        text: "@lang('messages.alert.delete.sales_order.text')",
                        type: "error",
                        showCancelButton: true,
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "@lang('buttons.reject_button')",
                        cancelButtonText: "@lang('buttons.cancel_button')",
                        closeOnConfirm: false
                    }, function (isConfirm) {
                        if (isConfirm) $('#deleteForm').submit();
                    });
                }
            }
        });
    </script>
@endsection
