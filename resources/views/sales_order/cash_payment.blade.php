@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.payment.cash.title')
@endsection

@section('page_title')
    <span class="fa fa-money fa-fw"></span>&nbsp;@lang('sales_order.payment.cash.page_title')
@endsection
@section('page_title_desc')
    @lang('sales_order.payment.cash.page_title_desc')
@endsection
@section('breadcrumbs')
    {!! Breadcrumbs::render('sales_order_payment_cash', $currentSo->hId()) !!}
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

    <div ng-app="soModule" ng-controller="soController">
        {!! Form::model($currentSo, ['method' => 'POST','route' => ['db.so.payment.cash', $currentSo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('sales_order.payment.cash.box.customer')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputCustomerType"
                                   class="col-sm-2 control-label">@lang('sales_order.payment.cash.field.customer_type')</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" readonly
                                       value="@lang('lookup.'.$currentSo->customer_type)">
                            </div>
                        </div>
                        @if($currentSo->customer_type == 'CUSTOMERTYPE.R')
                            <div class="form-group">
                                <label for="inputCustomerId"
                                       class="col-sm-2 control-label">@lang('sales_order.payment.cash.field.customer_name')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly
                                           value="{{ $currentSo->customer->name }}">
                                </div>
                                <div class="col-sm-2">
                                    <button id="customerDetailButton" type="button" class="btn btn-primary btn-sm"
                                            data-toggle="modal" data-target="#customerDetailModal"><span
                                                class="fa fa-info-circle fa-lg"></span></button>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="inputCustomerName"
                                       class="col-sm-2 control-label">@lang('sales_order.payment.cash.field.customer_name')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly
                                           value="{{ $currentSo->walk_in_cust }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCustomerDetails"
                                       class="col-sm-2 control-label">@lang('sales_order.payment.cash.field.customer_details')</label>
                                <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" readonly>{{ $currentSo->walk_in_cust_detail }}
                                        </textarea>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('sales_order.payment.cash.box.sales_order_detail')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputSoCode"
                                   class="col-sm-2 control-label">@lang('sales_order.payment.cash.so_code')</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly value="{{ $currentSo->code }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSoType"
                                   class="col-sm-2 control-label">@lang('sales_order.payment.cash.so_type')</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly
                                       value="@lang('lookup.'.$currentSo->so_type)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSoDate"
                                   class="col-sm-2 control-label">@lang('sales_order.payment.cash.so_date')</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" readonly
                                           value="{{ $currentSo->so_created->format('d-m-Y') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSoStatus"
                                   class="col-sm-2 control-label">@lang('sales_order.payment.cash.so_status')</label>
                            <div class="col-sm-10">
                                <label class="control-label control-label-normal">@lang('lookup.'.$currentSo->status)</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-offset-1">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('sales_order.payment.cash.box.shipping')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputShippingDate"
                                   class="col-sm-2 control-label">@lang('sales_order.payment.cash.field.shipping_date')</label>
                            <div class="col-sm-5">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                        <input type="text" class="form-control" name="shipping_date" readonly
                                               value="{{ $currentSo->shipping_date->format('d-m-Y') }}"
                                               data-parsley-required="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputWarehouse"
                                   class="col-sm-2 control-label">@lang('sales_order.payment.cash.field.warehouse')</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" readonly
                                       value="{{ $currentSo->warehouse->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputVendorTrucking"
                                   class="col-sm-2 control-label">@lang('sales_order.payment.cash.field.vendor_trucking')</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" readonly
                                       value="{{ empty($currentSo->vendorTrucking->name) ? '':$currentSo->vendorTrucking->name }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="box box-info">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('sales_order.payment.cash.box.transactions')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="itemsListTable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th width="30%">@lang('sales_order.payment.cash.table.item.header.product_name')</th>
                                        <th width="15%"
                                            class="text-center">@lang('sales_order.payment.cash.table.item.header.header.quantity')</th>
                                        <th width="15%"
                                            class="text-center">@lang('sales_order.payment.cash.table.item.header.unit')</th>
                                        <th width="15%"
                                            class="text-center">@lang('sales_order.payment.cash.table.item.header.price_unit')</th>
                                        <th width="5%">&nbsp;</th>
                                        <th width="20%"
                                            class="text-center">@lang('sales_order.payment.cash.table.item.header.total_price')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="item in so.items">
                                        <td class="valign-middle">@{{ item.product.name }}</td>
                                        <td>
                                            <input type="text" class="form-control text-right" name="quantity[]"
                                                   ng-model="item.quantity" data-parsley-required="true"
                                                   data-parsley-type="number" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" readonly
                                                   value="@{{ item.selected_unit.unit.name + ' (' + item.selected_unit.unit.symbol + ')' }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control text-right" name="price[]"
                                                   ng-model="item.price" data-parsley-required="true" readonly
                                                   data-parsley-pattern="^(?!0\.00)\d{1,3}(,\d{3})*(\.\d\d)?$" fcsa-number>
                                        </td>
                                        <td class="text-center">
                                        </td>
                                        <td class="text-right valign-middle">
                                            @{{ item.selected_unit.conversion_value * item.quantity * item.price | number }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="itemsTotalListTable" class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td width="80%"
                                            class="text-right">@lang('sales_order.payment.cash.table.total.body.total')</td>
                                        <td width="20%" class="text-right">
                                            <span class="control-label-normal">@{{ grandTotal() | number }}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-offset-1">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('sales_order.payment.cash.box.remarks')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea id="inputRemarks" name="remarks" class="form-control"
                                                  rows="5" readonly>{{ $currentSo->remarks }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('sales_order.payment.cash.box.payment_history')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="paymentHistoryTable" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th width="25%" class="text-center">@lang('sales_order.payment.cash.table.payments.header.payment_type')</th>
                                        <th width="25%" class="text-center">@lang('sales_order.payment.cash.table.payments.header.payment_date')</th>
                                        <th width="25%" class="text-center">@lang('sales_order.payment.cash.table.payments.header.payment_status')</th>
                                        <th width="25%" class="text-center">@lang('sales_order.payment.cash.table.payments.header.payment_amount')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($currentSo->payments as $key => $payment)
                                            <tr>
                                                <td class="text-center">{{ $paymentTypeDLL[$payment->type] }}</td>
                                                <td class="text-center">{{ date('d-m-Y', strtotime($payment->payment_date)) }}</td>
                                                <td class="text-center">{{ $cashPaymentStatusDLL[$payment->status] }}</td>
                                                <td class="text-center">{{ number_format($payment->total_amount, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="paymentSummaryTable" class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td class="text-right">@lang('sales_order.payment.cash.table.total.body.paid_amount')</td>
                                        <td width="25%" class="text-right">
                                            <span class="control-label-normal">{{ number_format($currentSo->totalAmountPaid(), 2) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">@lang('sales_order.payment.cash.table.total.body.to_be_paid_amount')</td>
                                        <td width="25%" class="text-right">
                                            <span class="control-label-normal">
                                                {{ number_format($currentSo->totalAmount() - $currentSo->totalAmountPaid(), 2)}}
                                            </span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('sales_order.payment.cash.box.payment')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="inputPaymentType"
                                       class="col-sm-2 control-label">@lang('sales_order.payment.cash.field.payment_type')</label>
                                <div class="col-sm-4">
                                    <input id="inputPaymentType" type="text" class="form-control" readonly value="@lang('lookup.'.'PAYMENTTYPE.C')">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="inputPaymentDate"
                                       class="col-sm-2 control-label">@lang('sales_order.payment.cash.field.payment_date')</label>
                                <div class="col-sm-4">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" id="inputPaymentDate"
                                               name="payment_date" data-parsley-required="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="inputPaymentAmount"
                                       class="col-sm-2 control-label">@lang('sales_order.payment.cash.field.payment_amount')</label>
                                <div class="col-sm-4">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            Rp
                                        </div>
                                        <input type="text" class="form-control" id="inputPaymentAmount"
                                               name="total_amount" data-parsley-required="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 col-offset-md-5">
                <div class="btn-toolbar">
                    <button id="submitButton" type="submit"
                            class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>
                    &nbsp;&nbsp;&nbsp;
                    <a id="cancelButton" href="{{ route('db.so.payment.index') }}" class="btn btn-primary pull-right"
                       role="button">@lang('buttons.cancel_button')</a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module("soModule", ['fcsa-number']);
        app.controller("soController", ['$scope', function ($scope) {
            var currentSo = JSON.parse('{!! htmlspecialchars_decode($currentSo->toJson()) !!}');

            $scope.so = {
                customer: currentSo.customer,
                items: [],
                warehouse: {
                    id: currentSo.warehouse.id,
                    name: currentSo.warehouse.name
                },
                vendorTrucking: {
                    id: (currentSo.vendor_trucking == null) ? '' : currentSo.vendor_trucking.id,
                    name: (currentSo.vendor_trucking == null) ? '' : currentSo.vendor_trucking.name
                }
            };

            for (var i = 0; i < currentSo.items.length; i++) {
                $scope.so.items.push({
                    id: currentSo.items[i].id,
                    product: currentSo.items[i].product,
                    base_unit: _.find(currentSo.items[i].product.product_units, isBase),
                    selected_unit: _.find(currentSo.items[i].product.product_units, getSelectedUnit(currentSo.items[i].selected_unit_id)),
                    quantity: parseFloat(currentSo.items[i].quantity).toFixed(0),
                    price: parseFloat(currentSo.items[i].price).toFixed(0)
                });
            }

            $scope.grandTotal = function () {
                var result = 0;
                angular.forEach($scope.so.items, function (item, key) {
                    result += (item.selected_unit.conversion_value * item.quantity * item.price);
                });
                return result;
            };

            function getSelectedUnit(selectedUnitId) {
                return function (element) {
                    return element.unit_id == selectedUnitId;
                }
            }

            function isBase(unit) {
                return unit.is_base == 1;
            }
        }]);

        $("#inputPaymentDate").daterangepicker({
            locale: {
                format: 'DD-MM-YYYY'
            },
            singleDatePicker: true,
            showDropdowns: true
        });
    </script>
@endsection