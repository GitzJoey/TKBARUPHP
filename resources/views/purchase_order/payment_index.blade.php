@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.payment.index.title')
@endsection

@section('page_title')
    <span class="fa fa-calculator fa-fw"></span>&nbsp;@lang('purchase_order.payment.index.page_title')
@endsection
@section('page_title_desc')
    @lang('purchase_order.payment.index.page_title_desc')
@endsection
@section('breadcrumbs')
    {!! Breadcrumbs::render('purchase_order_payment') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('purchase_order.payment.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('purchase_order.payment.index.table.header.code')</th>
                    <th class="text-center">@lang('purchase_order.payment.index.table.header.supplier')</th>
                    <th class="text-center">@lang('purchase_order.payment.index.table.header.po_date')</th>
                    <th class="text-center">@lang('purchase_order.payment.index.table.header.total')</th>
                    <th class="text-center">@lang('purchase_order.payment.index.table.header.paid')</th>
                    <th class="text-center">@lang('purchase_order.payment.index.table.header.rest')</th>
                    <th class="text-center">@lang('labels.ACTION')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($purchaseOrders as $key => $po)
                    <tr>
                        <td class="text-center">{{ $po->code }}</td>
                        <td class="text-center">
                            @if($po->supplier_type == 'SUPPLIERTYPE.R')
                                {{ $po->supplier->name }}
                            @else
                                {{ $po->walk_in_supplier }}
                            @endif
                        </td>
                        <td class="text-center">{{ date('d-m-Y', strtotime($po->po_created)) }}</td>
                        <td class="text-center">{{ $po->totalAmount() }}</td>
                        <td class="text-center">{{ $po->totalAmountPaid() }}</td>
                        <td class="text-center">{{ $po->totalAmount() - $po->totalAmountPaid() }}</td>
                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-primary" href="{{ route('db.po.payment.cash', $po->hId()) }}" title="Cash"><span class="fa fa-money fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.po.payment.transfer', $po->hId()) }}" title="Transfer"><span class="fa fa-send fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.po.payment.giro', $po->hId()) }}" title="Giro"><span class="fa fa-book fa-fw"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('custom_js')
    <script type="application/javascript">
    </script>
@endsection
