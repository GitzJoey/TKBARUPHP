@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.payment.index.title')
@endsection

@section('page_title')
    <span class="fa fa-calculator fa-fw"></span>&nbsp;@lang('customer.payment.index.page_title')
@endsection

@section('page_title_desc')
    @lang('customer.payment.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('customer_payment') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif($message = Session::get('info'))
        <div class="alert alert-info">
            <p>{{ $message }}</p>
        </div>
        {{ Session::forget('info') }}
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('customer.payment.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('customer.payment.index.table.header.code')</th>
                        <th class="text-center">@lang('customer.payment.index.table.header.so_date')</th>
                        <th class="text-center">@lang('customer.payment.index.table.header.total')</th>
                        <th class="text-center">@lang('customer.payment.index.table.header.paid')</th>
                        <th class="text-center">@lang('customer.payment.index.table.header.rest')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesOrders as $key => $so)
                        <tr>
                            <td class="text-center">{{ $so->code }}</td>
                            <td class="text-center">{{ date('d-m-Y', strtotime($so->so_created)) }}</td>
                            <td class="text-center">{{ number_format($so->totalAmount(), 0) }}</td>
                            <td class="text-center">{{ number_format($so->totalAmountPaid(), 0) }}</td>
                            <td class="text-center">{{ number_format($so->totalAmount() - $so->totalAmountPaid(), 0) }}</td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-primary" href="{{ route('db.customer.payment.cash', $so->hId()) }}" title="Cash"><span class="fa fa-money fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.customer.payment.transfer', $so->hId()) }}" title="Transfer"><span class="fa fa-send fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.customer.payment.giro', $so->hId()) }}" title="Giro"><span class="fa fa-book fa-fw"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection