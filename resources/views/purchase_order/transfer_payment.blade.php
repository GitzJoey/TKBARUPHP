@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.payment.transfer.title')
@endsection

@section('page_title')
    <span class="fa fa-send fa-fw"></span>&nbsp;@lang('purchase_order.payment.transfer.page_title')
@endsection
@section('page_title_desc')
    @lang('purchase_order.payment.transfer.page_title_desc')
@endsection
@section('breadcrumbs')
    {!! Breadcrumbs::render('purchase_order_payment_transfer', $currentPo->hId()) !!}
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

    <div ng-app="poModule" ng-controller="poController">
        {!! Form::model($currentPo, ['method' => 'POST', 'route' => ['db.po.payment.transfer', $currentPo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            {{ csrf_field() }}

            @include('purchase_order.payment_summary_partial')

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.payment.transfer.box.payment')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPaymentType"
                                               class="col-sm-2 control-label">@lang('purchase_order.payment.transfer.field.payment_type')</label>
                                        <div class="col-sm-8">
                                            <input id="inputPaymentType" type="text" class="form-control" readonly
                                                   value="@lang('lookup.'.$paymentType)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">@lang('purchase_order.payment.transfer.field.bank_from')</label>
                                        <div class="col-sm-4">
                                            <select id="inputBankAccountFrom"
                                                    name="bank_account_from"
                                                    class="form-control"
                                                    ng-model="bankAccountFrom"
                                                    ng-options="bankAccountFrom as (bankAccountFrom.account_number + ' ' + bankAccountFrom.bank.short_name) for bankAccountFrom in storeBankAccounts track by bankAccountFrom.id">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">@lang('purchase_order.payment.transfer.field.bank_to')</label>
                                        <div class="col-sm-4">
                                            <select id="inputBankAccountTo"
                                                    name="bank_account_to"
                                                    class="form-control"
                                                    ng-model="bankAccountTo"
                                                    ng-options="bankAccountTo as (bankAccountTo.account_number + ' ' + bankAccountTo.bank.short_name) for bankAccountTo in supplierBankAccounts track by bankAccountTo.id">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPaymentDate"
                                               class="col-sm-2 control-label">@lang('purchase_order.payment.transfer.field.payment_date')</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="inputPaymentDate"
                                                       name="payment_date" data-parsley-required="true">
                                            </div>
                                        </div>
                                        <label for="inputEffectiveDate"
                                               class="col-sm-2 control-label">@lang('purchase_order.payment.transfer.field.effective_date')</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="inputEffectiveDate"
                                                       name="effective_date" data-parsley-required="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPaymentAmount"
                                               class="col-sm-2 control-label">@lang('purchase_order.payment.transfer.field.payment_amount')</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    Rp
                                                </div>
                                                <input type="text" class="form-control" id="inputPaymentAmount"
                                                       name="total_amount" ng-model="total_amount"
                                                       data-parsley-required="true" fcsa-number>
                                            </div>
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
                        <a id="cancelButton" href="{{ route('db.po.payment.index') }}" class="btn btn-primary pull-right"
                           role="button">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}

        @include('purchase_order.supplier_details_partial')
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module('poModule', ['fcsa-number']);
        app.controller('poController', ['$scope', function ($scope) {
            var currentPo = JSON.parse('{!! htmlspecialchars_decode($currentPo->toJson()) !!}');
            $scope.storeBankAccounts = JSON.parse('{!! htmlspecialchars_decode($storeBankAccounts) !!}');
            $scope.supplierBankAccounts = JSON.parse('{!! htmlspecialchars_decode($supplierBankAccounts) !!}');
            $scope.expenseTypes = JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}');

            $scope.po = {
                supplier: currentPo.supplier,
                items: [],
                warehouse: {
                    id: currentPo.warehouse.id,
                    name: currentPo.warehouse.name
                },
                vendorTrucking: {
                    id: (currentPo.vendor_trucking == null) ? '' : currentPo.vendor_trucking.id,
                    name: (currentPo.vendor_trucking == null) ? '' : currentPo.vendor_trucking.name
                },
                expenses: []
            };

            for (var i = 0; i < currentPo.items.length; i++) {
                $scope.po.items.push({
                    id: currentPo.items[i].id,
                    product: currentPo.items[i].product,
                    base_unit: _.find(currentPo.items[i].product.product_units, isBase),
                    selected_unit: _.find(currentPo.items[i].product.product_units, getSelectedUnit(currentPo.items[i].selected_unit_id)),
                    quantity: currentPo.items[i].quantity % 1 != 0 ? parseFloat(currentPo.items[i].quantity).toFixed(2):parseFloat(currentPo.items[i].quantity).toFixed(0),
                    price: currentPo.items[i].price % 1  != 0 ? parseFloat(currentPo.items[i].price).toFixed(2):parseFloat(currentPo.items[i].price).toFixed(0)
                });
            }

            for (var i = 0; i < currentPo.expenses.length; i++) {
                var type = _.find($scope.expenseTypes, function (type) {
                    return type.code === currentPo.expenses[i].type;
                });

                $scope.po.expenses.push({
                    id: currentPo.expenses[i].id,
                    name: currentPo.expenses[i].name,
                    type: {
                        code: currentPo.expenses[i].type,
                        description: type ? type.description : ''
                    },
                    amount: currentPo.expenses[i].amount,
                    remarks: currentPo.expenses[i].remarks
                });
            }

            $scope.grandTotal = function () {
                var result = 0;
                angular.forEach($scope.po.items, function (item, key) {
                    result += (item.selected_unit.conversion_value * item.quantity * item.price);
                });
                return result;
            };

            $scope.expenseTotal = function () {
                var result = 0;
                angular.forEach($scope.po.expenses, function (expense, key) {
                    result += parseInt(expense.amount);
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

        $(function () {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });

            $("#inputPaymentDate").daterangepicker({
                locale: {
                    format: 'DD-MM-YYYY'
                },
                singleDatePicker: true,
                showDropdowns: true
            });

            $("#inputEffectiveDate").daterangepicker({
                locale: {
                    format: 'DD-MM-YYYY'
                },
                singleDatePicker: true,
                showDropdowns: true
            });
        });
    </script>
@endsection