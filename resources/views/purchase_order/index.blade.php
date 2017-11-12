@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.revise.index.title')
@endsection

@section('page_title')
    <span class="fa fa-code-fork fa-rotate-180 fa-fw"></span>&nbsp;@lang('purchase_order.revise.index.page_title')
@endsection

@section('page_title_desc')
    @lang('purchase_order.revise.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('purchase_order') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div id="poVue">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('purchase_order.revise.index.header.title')</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" width="15%">@lang('purchase_order.revise.index.table.header.code')</th>
                            <th class="text-center" width="15%">@lang('purchase_order.revise.index.table.header.po_date')</th>
                            <th class="text-center" width="25%">@lang('purchase_order.revise.index.table.header.supplier')</th>
                            <th class="text-center" width="15%">@lang('purchase_order.revise.index.table.header.shipping_date')</th>
                            <th class="text-center" width="20%">@lang('purchase_order.revise.index.table.header.status')</th>
                            <th class="text-center" width="10%">@lang('labels.ACTION')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchaseOrders as $key => $po)
                            <tr>
                                <td class="text-center">{{ $po->code }}</td>
                                <td class="text-center">{{ date(Auth::user()->store->dateTimeFormat, strtotime($po->po_created)) }}</td>
                                <td class="text-center">
                                    @if($po->supplier_type == 'SUPPLIERTYPE.R')
                                        {{ $po->supplier->name }}
                                    @else
                                        {{ $po->walk_in_supplier }}
                                    @endif
                                </td>
                                <td class="text-center">{{ date(Auth::user()->store->dateTimeFormat, strtotime($po->shipping_date)) }}</td>
                                <td class="text-center">@lang('lookup.'.$po->status)</td>
                                <td class="text-center" width="10%">
                                    <a class="btn btn-xs btn-primary" href="{{ route('db.po.revise', $po->hId()) }}"
                                    title="Revise"><span class="fa fa-pencil fa-fw"></span></a>
                                    @if($po->status == 'POSTATUS.WA')
                                        {!! Form::open(['id' => 'deleteForm', 'method' => 'DELETE', 'route' => ['db.po.reject', $po->hId()], 'style'=>'display:inline'])  !!}
                                        <button type="submit" class="btn btn-xs btn-danger" title="Reject" id="delete_button" v-on:click.prevent="showAlert">
                                            <span class="fa fa-close fa-fw"></span></button>
                                        {!! Form::close() !!}
                                    @else
                                        <button type="submit" class="btn btn-xs btn-danger" title="Reject" id="delete_button" disabled><span class="fa fa-close fa-fw"></span></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                {!! $purchaseOrders->render() !!}
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var poApp = new Vue({
            el: '#poVue',
            methods: {
                showAlert: function (event) {
                    var buttonId = event.currentTarget.id;

                    swal({
                        title: "@lang('messages.alert.delete.purchase_order.title')",
                        text: "@lang('messages.alert.delete.purchase_order.text')",
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
