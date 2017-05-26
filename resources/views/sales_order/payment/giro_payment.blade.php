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
    {!! Breadcrumbs::render('sales_order_payment_giro', $currentSo->hId()) !!}
@endsection

@section('content')
    <div id="soPaymentVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="soPaymentForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
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
                                            <input id="inputPaymentType" type="text" class="form-control" readonly value="@lang('lookup.'.$paymentType)">
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
                                            <select id="inputGiro" name="bank_id"
                                                    class="form-control"
                                                    v-model="giro.bank.id"
                                                    v-validate="'required'">
                                                <option v-bind:value="defaultBank.id">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="bank in bankDDL" v-bind:value="bank.id">@{{ bank.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputGiroSerialNumber"
                                               class="col-sm-2 control-label">@lang('sales_order.payment.giro.field.serial_number')</label>
                                        <div class="col-sm-4">
                                            <input id="inputGiroSerialNumber" name="serial_number" type="text"
                                                   class="form-control" v-validate="'required'">
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
                                                <vue-datetimepicker id="inputPaymentDate" name="payment_date" value="" v-model="payment_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                            </div>
                                        </div>
                                        <label for="inputEffectiveDate"
                                               class="col-sm-2 control-label">@lang('sales_order.payment.giro.field.effective_date')</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <vue-datetimepicker id="inputEffectiveDate" name="effective_date" value="" v-model="giro.effective_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
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
                                            <input type="text" class="form-control" id="inputAmount" name="amount" v-model="giro.amount" v-validate="'required|decimal:2'">
                                        </div>
                                        <label for="inputPrintedName"
                                               class="col-sm-2 control-label">@lang('sales_order.payment.giro.field.printed_name')</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="inputPrintedName" name="printed_name"
                                                   v-bind:value="giro.printed_name" v-validate="'required'">
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
                                            <input type="text" class="form-control" id="inputGiroRemarks" v-bind:value="giro.remarks" name="remarks">
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
        </form>

        @include('sales_order.customer_details_partial')

    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var soPaymentApp = new Vue({
            el: '#soPaymentVue',
            data: {
                currentSo: JSON.parse('{!! htmlspecialchars_decode($currentSo->toJson()) !!}'),
                giro: { id: '', bank: {id: ''}},
                bankDDL: JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}'),
                expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}'),
                so: {
                    customer: _.cloneDeep(currentSo.customer),
                    items: [],
                    expenses: [],
                    disc_percent : currentSo.disc_percent % 1 !== 0 ? currentSo.disc_percent : parseFloat(currentSo.disc_percent).toFixed(0),
                    disc_value : currentSo.disc_value % 1 !== 0 ? currentSo.disc_value : parseFloat(currentSo.disc_value).toFixed(0),
                }
            },
            methods: {
                grandTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.so.items, function (item, key) {
                        result += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });
                    return result;
                },
                expenseTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.so.expenses, function (expense, key) {
                        result += parseInt(expense.amount);
                    });
                    return result;
                },
                discountItemSubTotal: function (discounts) {
                    var result = 0;
                    _.forEach(discounts, function (discount) {
                        result += parseFloat(discount.disc_value);
                    });
                    if( result % 1 !== 0 )
                        result = result.toFixed(2);
                    return result;
                },
                discountTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.so.items, function (item) {
                        _.forEach(item.discounts, function (discount) {
                            result += parseFloat(discount.disc_value);
                        });
                    });
                    return result;
                },
            }
        });
        
        for (var i = 0; i < currentSo.items.length; i++) {
            var itemDiscounts = [];
            if( currentSo.items[i].discounts.length ){
                for (var ix = 0; ix < currentSo.items[i].discounts.length; ix++) {
                    itemDiscounts.push({
                        id : currentSo.items[i].discounts[ix].id,
                        disc_percent : currentSo.items[i].discounts[ix].item_disc_percent % 1 !== 0 ? currentSo.items[i].discounts[ix].item_disc_percent : parseFloat(currentSo.items[i].discounts[ix].item_disc_percent).toFixed(0),
                        disc_value : currentSo.items[i].discounts[ix].item_disc_value % 1 !== 0 ? currentSo.items[i].discounts[ix].item_disc_value : parseFloat(currentSo.items[i].discounts[ix].item_disc_value).toFixed(0),
                    });
                }
            }
            soPaymentApp.so.items.push({
                id: currentSo.items[i].id,
                product: _.cloneDeep(currentSo.items[i].product),
                base_unit: _.cloneDeep(_.find(currentSo.items[i].product.product_units, isBase)),
                selected_unit: _.cloneDeep(_.find(currentSo.items[i].product.product_units, getSelectedUnit(currentSo.items[i].selected_unit_id))),
                quantity: parseFloat(currentSo.items[i].quantity).toFixed(0),
                price: parseFloat(currentSo.items[i].price).toFixed(0),
                discounts : itemDiscounts
            });
        }

        for (var i = 0; i < currentSo.expenses.length; i++) {
            var type = _.find(soPaymentApp.expenseTypes, function (type) {
                return type.code === currentSo.expenses[i].type;
            });

            soPaymentApp.so.expenses.push({
                id: currentSo.expenses[i].id,
                name: currentSo.expenses[i].name,
                type: {
                    code: currentSo.expenses[i].type,
                    description: type ? type.description : ''
                },
                amount: currentSo.expenses[i].amount,
                remarks: currentSo.expenses[i].remarks
            });
        }

        function getSelectedUnit(selectedUnitId) {
            return function (element) {
                return element.unit_id == selectedUnitId;
            }
        }

        function isBase(unit) {
            return unit.is_base == 1;
        }

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