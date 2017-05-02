@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.payment.giro.title')
@endsection

@section('page_title')
    <span class="fa fa-book fa-fw"></span>&nbsp;@lang('sales_order.payment.giro.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.payment.giro.page_title_desc')
@endsection

@section('breadcrumbs')

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

    <div id="custPayemntVue">
        {!! Form::model($currentSo, ['method' => 'POST', 'route' => ['db.customer.payment.giro', $currentSo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            {{ csrf_field() }}

            @include('sales_order.payment.payment_summary_partial')

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.payment.giro.box.payment')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPaymentType"
                                               class="col-sm-2 control-label">@lang('sales_order.payment.giro.field.payment_type')</label>
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
                                        <label for="inputGiroBank"
                                               class="col-sm-2 control-label">@lang('sales_order.payment.giro.field.bank')</label>
                                        <div class="col-sm-4">
                                            <select id="inputGiro"
                                                    name="bank_id"
                                                    class="form-control"
                                                    ng-options="bank as bank.name for bank in bankDDL track by bank.id">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            </select>
                                        </div>
                                        <label for="inputGiroSerialNumber"
                                               class="col-sm-2 control-label">@lang('sales_order.payment.giro.field.serial_number')</label>
                                        <div class="col-sm-4">
                                            <input id="inputGiroSerialNumber" name="serial_number" type="text"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPaymentDate"
                                               class="col-sm-2 control-label">@lang('sales_order.payment.giro.field.payment_date')</label>
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
                                               class="col-sm-2 control-label">@lang('sales_order.payment.giro.field.effective_date')</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="inputEffectiveDate"
                                                       ng-value="giro.effective_date"
                                                       name="effective_date" data-parsley-required="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputAmount"
                                               class="col-sm-2 control-label">@lang('sales_order.payment.giro.field.payment_amount')</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="inputAmount" ng-value="giro.amount"
                                                   name="amount" data-parsley-required="true"
                                                   autonumeric>
                                        </div>
                                        <label for="inputPrintedName"
                                               class="col-sm-2 control-label">@lang('sales_order.payment.giro.field.printed_name')</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="inputPrintedName"
                                                   ng-value="giro.printed_name"
                                                   name="printed_name" data-parsley-required="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputGiroRemarks"
                                               class="col-sm-2 control-label">@lang('sales_order.payment.giro.field.remarks')</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputGiroRemarks"
                                                   ng-value="giro.remarks"
                                                   name="remarks" data-parsley-required="true">
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
                        <a id="cancelButton" href="{{ route('db.customer.payment.index') }}" class="btn btn-primary pull-right"
                           role="button">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            var app = new Vue({
                el: '#custPaymentVue',
                data: {
                    currentSo: JSON.parse('{!! htmlspecialchars_decode($currentSo->toJson()) !!}'),
                    bankDDL: JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}'),
                    so:{
                        customer: '',
                        warehouse: {
                            id: '',
                            name: '',
                        },
                        vendorTrucking: {
                            id: '',
                            name: ''
                        },
                        items: []
                    }
                },
                mounted: function() {
                    this.init();
                },
                methods: {
                    init: function() {
                        this.so.customer = this.currentSo.customer;
                        this.so.warehouse.id = this.currentSo.warehouse.id;
                        this.so.warehouse.name = this.currentSo.warehouse.name;
                        this.vendorTrucking.id = this.currentSo.vendor_trucking == null ? '' : this.currentSo.vendor_trucking.id,
                        this.vendorTrucking.name = this.currentSo.vendor_trucking == null ? '' : this.currentSo.vendor_trucking.name

                        for (var i = 0; i < this.currentSo.items.length; i++) {
                            this.so.items.push({
                                id: currentSo.items[i].id,
                                product: currentSo.items[i].product,
                                base_unit: _.find(currentSo.items[i].product.product_units, isBase),
                                selected_unit: _.find(currentSo.items[i].product.product_units, getSelectedUnit(currentSo.items[i].selected_unit_id)),
                                quantity: parseFloat(currentSo.items[i].quantity).toFixed(0),
                                price: parseFloat(currentSo.items[i].price).toFixed(0)
                            });
                        }
                    },
                    grandTotal: function () {
                        var result = 0;
                        angular.forEach($scope.so.items, function (item, key) {
                            result += (item.selected_unit.conversion_value * item.quantity * item.price);
                        });
                        return result;
                    }
                }
            });

            function getSelectedUnit(selectedUnitId) {
                return function (element) {
                    return element.unit_id == selectedUnitId;
                }
            }

            function isBase(unit) {
                return unit.is_base == 1;
            }

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