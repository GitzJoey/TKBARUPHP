@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.payment.giro.title')
@endsection

@section('page_title')
    <span class="fa fa-money fa-fw"></span>&nbsp;@lang('purchase_order.payment.giro.page_title')
@endsection
@section('page_title_desc')
    @lang('purchase_order.payment.giro.page_title_desc')
@endsection
@section('breadcrumbs')
    {!! Breadcrumbs::render('purchase_order_payment_giro', $currentPo->hId()) !!}
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
        {!! Form::model($currentPo, ['method' => 'POST', 'route' => ['db.po.payment.giro', $currentPo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
        {{ csrf_field() }}

        @include('purchase_order.payment_summary_partial')

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('purchase_order.payment.giro.box.payment')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputPaymentType"
                                           class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.payment_type')</label>
                                    <div class="col-sm-4">
                                        <input id="inputPaymentType" type="text" class="form-control" readonly
                                               value="@lang('lookup.'.$paymentType)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputGiro"
                                           class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.giro')</label>
                                    <div class="col-sm-4">
                                        <select id="inputGiro"
                                                name="giro_id"
                                                class="form-control"
                                                ng-model="giro"
                                                ng-options="giro as (giro.bank.short_name + ' ' + giro.serial_number + ' ' + giro.printed_name) for giro in availableGiros track by giro.id">
                                            <option value="">@lang('purchase_order.payment.giro.field.label.new_giro')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputGiroBank"
                                           class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.bank')</label>
                                    <div class="col-sm-4">
                                        <div ng-if="giro == null">
                                            <select id="inputGiro"
                                                    name="bank_id"
                                                    class="form-control"
                                                    ng-model="giro.bank"
                                                    ng-options="bank as bank.name for bank in bankDDL track by bank.id">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            </select>
                                        </div>
                                        <div ng-if="giro != null">
                                            <input id="inputGiroBank" type="text" class="form-control" readonly
                                                   ng-value="$parent.giro.bank.name">
                                        </div>
                                    </div>
                                    <label for="inputGiroSerialNumber"
                                           class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.serial_number')</label>
                                    <div class="col-sm-4">
                                        <input id="inputGiroSerialNumber" name="serial_number" type="text"
                                               class="form-control" ng-value="giro.serial_number"
                                               ng-readonly="giro != null">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputPaymentDate"
                                           class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.payment_date')</label>
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
                                           class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.effective_date')</label>
                                    <div class="col-sm-4">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" id="inputEffectiveDate"
                                                   ng-value="giro.effective_date"
                                                   name="effective_date" data-parsley-required="true"
                                                   ng-disabled="giro != null">
                                            <input ng-if="giro != null " type="hidden" name="effective_date" ng-value="$parent.giro.effective_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputAmount"
                                           class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.payment_amount')</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="inputAmount" ng-value="giro.amount" fcsa-number
                                               name="amount" ng-model="amount" data-parsley-required="true" ng-readonly="giro != null">
                                    </div>
                                    <label for="inputPrintedName"
                                           class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.printed_name')</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="inputPrintedName"
                                               ng-value="giro.printed_name"
                                               name="printed_name" data-parsley-required="true"
                                               ng-readonly="giro != null">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputGiroRemarks"
                                           class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.remarks')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputGiroRemarks"
                                               ng-value="giro.remarks"
                                               name="remarks" data-parsley-required="true" ng-readonly="giro != null">
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
            $scope.availableGiros = JSON.parse('{!! htmlspecialchars_decode($availableGiros) !!}');
            $scope.bankDDL = JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}');
            console.log($scope.availableGiros);

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
                }
            };

            for (var i = 0; i < currentPo.items.length; i++) {
                $scope.po.items.push({
                    id: currentPo.items[i].id,
                    product: currentPo.items[i].product,
                    base_unit: _.find(currentPo.items[i].product.product_units, isBase),
                    selected_unit: _.find(currentPo.items[i].product.product_units, getSelectedUnit(currentPo.items[i].selected_unit_id)),
                    quantity: currentPo.items[i].quantity,
                    price: currentPo.items[i].price
                });
            }

            $scope.grandTotal = function () {
                var result = 0;
                angular.forEach($scope.po.items, function (item, key) {
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