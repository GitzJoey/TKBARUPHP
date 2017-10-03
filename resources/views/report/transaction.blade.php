@extends('layouts.adminlte.master')

@section('title')
    @lang('report.transaction.title')
@endsection

@section('page_title')
    <span class="fa fa-connectdevelop fa-fw"></span>&nbsp;@lang('report.transaction.page_title')
@endsection

@section('page_title_desc')
    @lang('report.transaction.page_title_desc')
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="well">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info animated tada">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.transaction.header.purchase_order')</h3>
                    </div>
                    <form action="{{ route('db.report.trx.po') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPOCode" class="col-sm-3 control-label">@lang('report.transaction.field.po_code')</label>
                                <div class="col-sm-9">
                                    <input type="text" name="code" class="form-control" id="inputPOCode" placeholder="PO Code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPODate" class="col-sm-3 control-label">@lang('report.transaction.field.po_date')</label>
                                <div class="col-sm-9">
                                    <input type="text" name="po_date" class="form-control" id="inputPODate" placeholder="PO Date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPOShippingDate" class="col-sm-3 control-label">@lang('report.transaction.field.shipping_date')</label>
                                <div class="col-sm-9">
                                    <input type="text" name="shipping_date" class="form-control" id="inputPOShippingDate" placeholder="Shipping Date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputReceiptDate" class="col-sm-3 control-label">@lang('report.transaction.field.receipt_date')</label>
                                <div class="col-sm-9">
                                    <input type="text" name="shipping_date" class="form-control" id="inputReceiptDate" placeholder="Receipt Date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSupplier" class="col-sm-3 control-label">@lang('report.transaction.field.supplier')</label>
                                <div class="col-sm-9">
                                    <input type="text" name="supplier" class="form-control" id="inputSupplier" placeholder="Supplier">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info animated rollIn">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.transaction.header.sales_order')</h3>
                    </div>
                    <form action="{{ route('db.report.trx.so') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSOCode" class="col-sm-3 control-label">@lang('report.transaction.field.so_code')</label>
                                <div class="col-sm-9">
                                    <input type="text" name="code" class="form-control" id="inputSOCode" placeholder="SO Code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSODate" class="col-sm-3 control-label">@lang('report.transaction.field.so_date')</label>
                                <div class="col-sm-9">
                                    <input type="text" name="so_date" class="form-control" id="inputSODate" placeholder="SO Date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSOShippingDate" class="col-sm-3 control-label">@lang('report.transaction.field.shipping_date')</label>
                                <div class="col-sm-9">
                                    <input type="text" name="shipping_date" class="form-control" id="inputSOShippingDate" placeholder="Shipping Date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDeliverDate" class="col-sm-3 control-label">@lang('report.transaction.field.deliver_date')</label>
                                <div class="col-sm-9">
                                    <input type="text" name="deliver_date" class="form-control" id="inputDeliverDate" placeholder="Deliver Date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCustomer" class="col-sm-3 control-label">@lang('report.transaction.field.customer')</label>
                                <div class="col-sm-9">
                                    <input type="text" name="customer" class="form-control" id="inputCustomer" placeholder="Customer">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {

        });
    </script>
@endsection