@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.payment.transfer.title')
@endsection

@section('page_title')
    <span class="fa fa-send fa-fw"></span>&nbsp;@lang('customer.payment.transfer.page_title')
@endsection

@section('page_title_desc')
    @lang('customer.payment.transfer.page_title_desc')
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

    <div id="customerTransferVue">
        {!! Form::model($currentSo, ['method' => 'POST', 'route' => ['db.customer.payment.transfer', $currentSo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            {{ csrf_field() }}

            @include('sales_order.payment.payment_summary_partial')

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">@lang('customer.payment.transfer.box.payment')</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputPaymentType"
                                                       class="col-sm-2 control-label">@lang('customer.payment.transfer.field.payment_type')</label>
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
                                                <label class="col-sm-2 control-label">@lang('customer.payment.transfer.field.bank_from')</label>
                                                <div class="col-sm-4">
                                                    <select id="inputBankAccountFrom"
                                                            name="bank_account_from"
                                                            class="form-control"
                                                            v-model="bankAccountFrom">
                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="bankAccountFrom in customerBankAccounts" v-bind:value="bankAccountFrom">@{{ bankAccountFrom.account_number }} - @{{ bankAccountFrom.bank.short_name }}</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 control-label">@lang('customer.payment.transfer.field.bank_to')</label>
                                                <div class="col-sm-4">
                                                    <select id="inputBankAccountTo"
                                                            name="bank_account_to"
                                                            class="form-control"
                                                            v-model="bankAccountTo">
                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="bankAccountTo in storeBankAccounts" v-bind:value="">@{{ bankAccountTo.account_number }} @{{ bankAccountTo.bank.short_name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputPaymentDate"
                                                       class="col-sm-2 control-label">@lang('customer.payment.transfer.field.payment_date')</label>
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
                                                       class="col-sm-2 control-label">@lang('customer.payment.transfer.field.effective_date')</label>
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
                                                       class="col-sm-2 control-label">@lang('customer.payment.transfer.field.payment_amount')</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            Rp
                                                        </div>
                                                        <input type="text" class="form-control" id="inputPaymentAmount"
                                                               name="total_amount" v-model="total_amount"
                                                               data-parsley-required="true" autonumeric>
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
                                <a id="cancelButton" href="{{ route('db.customer.payment.index') }}"
                                   class="btn btn-primary pull-right"
                                   role="button">@lang('buttons.cancel_button')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function () {
            var app = new Vue({
                el: '#customerTransferVue',
                data: {
                    so: [],
                    currentSo: JSON.parse('{!! htmlspecialchars_decode($currentSo->toJson()) !!}'),
                    storeBankAccounts: JSON.parse('{!! htmlspecialchars_decode($storeBankAccounts) !!}'),
                    customerBankAccounts: JSON.parse('{!! htmlspecialchars_decode($customerBankAccounts) !!}')
                },
                methods: {
                    initSO: function() {
                        this.so = {
                            customer: this.currentSo.customer,
                            items: [],
                            warehouse: {
                                id: this.currentSo.warehouse.id,
                                name: this.currentSo.warehouse.name
                            },
                            vendorTrucking: {
                                id: (this.currentSo.vendor_trucking == null) ? '' : this.currentSo.vendor_trucking.id,
                                name: (this.currentSo.vendor_trucking == null) ? '' : this.currentSo.vendor_trucking.name
                            }
                        };

                        for (var i = 0; i < this.currentSo.items.length; i++) {
                            this.so.items.push({
                                id: this.currentSo.items[i].id,
                                product: this.currentSo.items[i].product,
                                base_unit: _.find(this.currentSo.items[i].product.product_units, isBase),
                                selected_unit: _.find(this.currentSo.items[i].product.product_units, getSelectedUnit(currentSo.items[i].selected_unit_id)),
                                quantity: parseFloat(this.currentSo.items[i].quantity).toFixed(0),
                                price: parseFloat(this.currentSo.items[i].price).toFixed(0)
                            });
                        }
                    },
                    grandTotal: function () {
                        var result = 0;
                        _.forEach(this.so.items, function (item, key) {
                            result += (item.selected_unit.conversion_value * item.quantity * item.price);
                        });
                        return result;
                    }
                },
                mounted:function() {
                    this.initSO();
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

            $("#inputEffectiveDate").
            this.initSO();daterangepicker({
                locale: {
                    format: 'DD-MM-YYYY'
                },
                singleDatePicker: true,
                showDropdowns: true
            });
        });
    </script>
@endsection