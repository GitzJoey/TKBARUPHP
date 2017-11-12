@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.payment.index.title')
@endsection

@section('page_title')
    <span class="fa fa-calculator fa-fw"></span>&nbsp;@lang('sales_order.payment.index.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.payment.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('sales_order_payment') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('sales_order.payment.index.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-5">
                    <input id="searchCustomer" type="text" class="form-control" value="{{ is_null(Request::input('s')) ? '':Request::input('s') }}">
                </div>
            </div>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="10%">@lang('sales_order.payment.index.table.header.code')</th>
                        <th class="text-center" width="15%">@lang('sales_order.payment.index.table.header.customer')</th>
                        <th class="text-center" width="10%">@lang('sales_order.payment.index.table.header.so_date')</th>
                        <th class="text-center" width="15%">@lang('sales_order.payment.index.table.header.total')</th>
                        <th class="text-center" width="15%">@lang('sales_order.payment.index.table.header.paid')</th>
                        <th class="text-center" width="15%">@lang('sales_order.payment.index.table.header.rest')</th>
                        <th width="5%"></th>
                        <th class="text-center" width="10%">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($salesOrders) > 0)
                        @foreach ($salesOrders as $key => $so)
                            <tr>
                                <td class="text-center">{{ $so->code }}</td>
                                <td class="text-center">
                                    @if($so->customer_type == 'CUSTOMERTYPE.R')
                                        {{ $so->customer->name }}
                                    @else
                                        {{ $so->walk_in_cust }}
                                    @endif
                                </td>
                                <td class="text-center">{{ date(Auth::user()->store->dateTimeFormat, strtotime($so->so_created)) }}</td>
                                <td class="text-right">{{ number_format($so->totalAmount(), 0) }}</td>
                                <td class="text-right">{{ number_format($so->totalAmountPaid(), 0) }}</td>
                                <td class="text-right">{{ number_format($so->totalAmount() - $so->totalAmountPaid(), 0) }}</td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary {{ $so->customer_type == 'CUSTOMERTYPE.R' ? '':'disabled' }}" href="{{ route('db.so.payment.bf', $so->hId()) }}"><span class="fa fa-arrow-circle-right fa-fw"></span></a>
                                </td>
                                <td class="text-center" width="10%">
                                    <a class="btn btn-xs btn-primary" href="{{ route('db.so.payment.cash', $so->hId()) }}" title="Cash"><span class="fa fa-money fa-fw"></span></a>
                                    <a class="btn btn-xs btn-primary {{ $so->customer_type == 'CUSTOMERTYPE.R' ? '':'disabled' }}" href="{{ route('db.so.payment.transfer', $so->hId()) }}" title="Transfer"><span class="fa fa-send fa-fw"></span></a>
                                    <a class="btn btn-xs btn-primary {{ $so->customer_type == 'CUSTOMERTYPE.R' ? '':'disabled' }}" href="{{ route('db.so.payment.giro', $so->hId()) }}" title="Giro"><span class="fa fa-book fa-fw"></span></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center animated shake">@lang('labels.DATA_NOT_FOUND')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            $('#searchCustomer').change(function() {
                window.location.href = new URI().setQuery('s', $('#searchCustomer').val());
            });
        });
    </script>
@endsection