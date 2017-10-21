@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.confirmation.approval.title')
@endsection

@section('page_title')
    <span class="fa fa-bell-o fa-fw"></span>&nbsp;@lang('customer.confirmation.approval.page_title')
@endsection

@section('page_title_desc')
    @lang('customer.confirmation.approval.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('customer_approval') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('info'))
        <div class="alert alert-info">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('customer.confirmation.approval.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-condensed" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>@lang('customer.confirmation.approval.table.header.so_code')</th>
                        <th>@lang('customer.confirmation.approval.table.header.shipping_date')</th>
                        <th>@lang('customer.confirmation.approval.table.header.deliver_date')</th>
                        <th>@lang('customer.confirmation.approval.table.header.confirm_receive_date')</th>
                        <th>@lang('customer.confirmation.approval.table.header.status')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($solist) == 0)
                        <tr>
                            <td class="text-center" colspan="7"><span class="animated shake">@lang('labels.DATA_NOT_FOUND')</span></td>
                        </tr>
                    @else
                        @foreach ($solist as $key => $so)
                            <tr class="accordion-toggle" data-toggle="collapse" data-target="#row{{ $so->index }}">
                                <td class="text-center"><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                                <td>{{ $so->code }}</td>
                                <td>{{ $so->shipping_date->format('d-m-Y') }}</td>
                                <td>{{ $so->items()->first()->delivers()->first()->deliver_date->format('d-m-Y') }}</td>
                                <td></td>
                                <td>@lang('lookup.'.$so->status)</td>
                                <td class="text-center" width="10%">
                                    <a class="btn btn-xs btn-primary" href="{{ route('db.customer.approval.approve', $so->hId()) }}"><span class="fa fa-check fa-fw"></span></a>
                                    <a class="btn btn-xs btn-primary" href="{{ route('db.customer.approval.reject', $so->hId()) }}"><span class="fa fa-close fa-fw"></span></a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12" class="hiddenRow" style="padding-left: 15px; padding-top: 15px;">
                                    <div class="accordian-body collapse" id="row{{ $so->index }}">
                                        {{ $so->code }}<br/>
                                        @if ($so->customer_type == 'CUSTOMERTYPE.WI')
                                            {{ $so->walk_in_cust }}<br/>
                                            {{ $so->walk_in_cust_detail }}
                                        @else
                                            {{ $so->customer->name }}
                                        @endif
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>@lang('customer.confirmation.approval.table.header.items.product_name')</th>
                                                <th>@lang('customer.confirmation.approval.table.header.items.brutto')</th>
                                                <th>@lang('customer.confirmation.approval.table.header.items.netto')</th>
                                                <th>@lang('customer.confirmation.approval.table.header.items.tare')</th>
                                                <th>@lang('customer.confirmation.approval.table.header.items.remarks')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($so->items as $i)
                                                <tr>
                                                    <td>{{ $i->product->name }}</td>
                                                    <td>{{ $i->delivers()->first()->brutto }}</td>
                                                    <td>{{ $i->delivers()->first()->netto }}</td>
                                                    <td>{{ $i->delivers()->first()->tare }}</td>
                                                    <td>{{ $i->delivers()->first()->remarks }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            {{ $solist->render() }}
        </div>
    </div>
@endsection
