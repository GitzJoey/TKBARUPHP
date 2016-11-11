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
                    <th>@lang('labels.ACTION')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($solist as $key => $so)
                    <tr class="accordion-toggle" data-toggle="collapse" data-target="#row{{ $so->index }}">
                        <td><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                        <td>{{ $so->code }}</td>
                        <td>{{ $so->shipping_date->format('d-m-Y') }}</td>
                        <td>{{ $so->items()->first()->deliver()->first()->deliver_date->format('d-m-Y') }}</td>
                        <td></td>
                        <td>@lang('lookup.'.$so->status)</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.customer.approval.approve', $so->hId()) }}"><span class="fa fa-check fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.customer.approval.reject', $so->hId()) }}"><span class="fa fa-close fa-fw"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12" class="hiddenRow" style="padding-left: 15px; padding-top: 15px;">
                            <div class="accordian-body collapse" id="row{{ $so->index }}">
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
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="25%" class="text-center">@lang('customer.confirmation.approval.table.header.so')</th>
                    <th width="65%" class="text-center" colspan="5">@lang('customer.confirmation.approval.table.header.items_detail')</th>
                    <th width="10%" class="text-center">@lang('labels.ACTION')</th>
                </tr>
                <tr>
                    <th class="text-center"></th>
                    <th class="text-center">@lang('customer.confirmation.approval.table.header.items.product_name')</th>
                    <th class="text-center">@lang('customer.confirmation.approval.table.header.items.brutto')</th>
                    <th class="text-center">@lang('customer.confirmation.approval.table.header.items.netto')</th>
                    <th class="text-center">@lang('customer.confirmation.approval.table.header.items.tare')</th>
                    <th class="text-center">@lang('customer.confirmation.approval.table.header.items.remarks')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($solist as $key => $so)
                    <tr>
                        <td>
                            {{ $so->code }}<br/>
                            @foreach ($so->items as $i)
                                {{ $i->delivers()->first()->deliver_date->format('d-m-Y') }}
                            @endforeach
                            <br/>
                        </td>
                        <td>
                            @foreach ($so->items as $i)
                                {{ $i->product()->first()->name }}<br/>
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach ($so->items as $i)
                                {{ $i->brutto }}<br/>
                            @endforeach
                        </td>
                        <td class="text-center">
                        </td>
                        <td></td>
                        <td></td>
                        <td class="text-center valign-middle" width="20%">
                            <a class="btn btn-xs btn-primary" href="{{ route('db.customer.approval.approve', $so->hId()) }}"><span class="fa fa-check fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.customer.approval.reject', $so->hId()) }}"><span class="fa fa-close fa-fw"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            {{ $solist->render() }}
        </div>
    </div>
@endsection
