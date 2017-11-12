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
            <div class="row">
                <div class="col-md-3">
                    <input id="inputCode" type="text" class="form-control" value="{{ $searchCode }}">
                </div>
                <div class="col-md-1">
                    <button id="btnCode" type="btn" class="btn btn-primary"><i class="fa fa-search fa-fw"></i></button>
                </div>
            </div>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="10%">@lang('purchase_order.payment.index.table.header.code')</th>
                        <th class="text-center" width="15%">@lang('purchase_order.payment.index.table.header.supplier')</th>
                        <th class="text-center" width="10%">@lang('purchase_order.payment.index.table.header.po_date')</th>
                        <th class="text-center" width="15%">@lang('purchase_order.payment.index.table.header.total')</th>
                        <th class="text-center" width="15%">@lang('purchase_order.payment.index.table.header.paid')</th>
                        <th class="text-center" width="15%">@lang('purchase_order.payment.index.table.header.rest')</th>
                        <th class="text-center" width="10%">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($purchaseOrders) > 0)
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
                                <td class="text-center">{{ date(Auth::user()->store->dateTimeFormat, strtotime($po->po_created)) }}</td>
                                <td class="text-right">{{ number_format($po->totalAmount(), 0) }}</td>
                                <td class="text-right">{{ number_format($po->totalAmountPaid(), 0) }}</td>
                                <td class="text-right">{{ number_format($po->totalAmount() - $po->totalAmountPaid(), 0) }}</td>
                                <td class="text-center" width="10%">
                                    <a class="btn btn-xs btn-primary" href="{{ route('db.po.payment.cash', $po->hId()) }}" title="Cash"><span class="fa fa-money fa-fw"></span></a>
                                    <a class="btn btn-xs btn-primary" href="{{ route('db.po.payment.transfer', $po->hId()) }}" title="Transfer"><span class="fa fa-send fa-fw"></span></a>
                                    <a class="btn btn-xs btn-primary" href="{{ route('db.po.payment.giro', $po->hId()) }}" title="Giro"><span class="fa fa-book fa-fw"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center">@lang('labels.DATA_NOT_FOUND')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            {!! $purchaseOrders->render() !!}
        </div>
    </div>
@endsection
@section('custom_js')
    <script type="application/javascript">
        $('#btnCode').click(function() {
           if ($('#inputCode').length > 0) {
               window.location.href = '{{ route('db.po.payment.index') }}' + '?c=' + $('#inputCode').val();
           }
        });
    </script>
@endsection
