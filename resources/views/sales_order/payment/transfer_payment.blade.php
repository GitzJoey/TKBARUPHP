@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.payment.transfer.title')
@endsection

@section('page_title')
    <span class="fa fa-send fa-fw"></span>&nbsp;@lang('sales_order.payment.transfer.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.payment.transfer.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('sales_order_payment_transfer', $currentSo->hId()) !!}
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">@lang('sales_order.payment.transfer.box.payment')</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputPaymentType"
                                                       class="col-sm-2 control-label">@lang('sales_order.payment.transfer.field.payment_type')</label>
                                                <div class="col-sm-4">
                                                    <input id="inputPaymentType" type="text" class="form-control" readonly value="@lang('lookup.'.$paymentType)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">@lang('sales_order.payment.transfer.field.bank_from')</label>
                                                <div class="col-sm-4">
                                                    <select id="inputBankAccountFrom"
                                                            name="bank_account_from"
                                                            class="form-control"
                                                            v-model="bankAccountFrom.id">
                                                        <option v-bind:value="defaultBank.id">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="bankAccountFrom in customerBankAccounts" v-bind:value="bankAccountFrom.id">@{{ bankAccountFrom.account_number + ' ' + bankAccountFrom.bank.short_name }}</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 control-label">@lang('sales_order.payment.transfer.field.bank_to')</label>
                                                <div class="col-sm-4">
                                                    <select id="inputBankAccountTo"
                                                            name="bank_account_to"
                                                            class="form-control"
                                                            v-model="bankAccountTo.id">
                                                        <option v-bind:value="defaultBank.id">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="bankAccountTo in storeBankAccounts" v-bind:value="bankAccountTo.id">@{{ bankAccountTo.account_number + ' ' + bankAccountFrom.bank.short_name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputPaymentDate"
                                                       class="col-sm-2 control-label">@lang('sales_order.payment.transfer.field.payment_date')</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <vue-datetimepicker id="inputPaymentDate" name="payment_date" value="" v-model="payment_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                                    </div>
                                                </div>
                                                <label for="inputEffectiveDate"
                                                       class="col-sm-2 control-label">@lang('sales_order.payment.transfer.field.effective_date')</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <vue-datetimepicker id="inputEffectiveDate" name="effective_date" value="" v-model="effective_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('total_amount') }">
                                                <label for="inputPaymentAmount"
                                                       class="col-sm-2 control-label">@lang('sales_order.payment.transfer.field.payment_amount')</label>
                                                <div class="col-sm-4">
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            Rp
                                                        </div>
                                                        <input type="text" class="form-control" id="inputPaymentAmount" name="total_amount" v-validate="'required|decimal:2'" data-vv-as="{{ trans('sales_order.payment.transfer.field.payment_amount') }}">
                                                    </div>
                                                    <span v-show="errors.has('total_amount')" class="help-block" v-cloak>@{{ errors.first('total_amount') }}</span>
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
                                <a id="cancelButton" href="{{ route('db.so.payment.index') }}"
                                   class="btn btn-primary pull-right"
                                   role="button">@lang('buttons.cancel_button')</a>
                            </div>
                        </div>
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
                bankAccountFrom: { id: '' },
                bankAccountTo: { id: '' },
                storeBankAccounts: JSON.parse('{!! htmlspecialchars_decode($storeBankAccounts) !!}'),
                customerBankAccounts: JSON.parse('{!! htmlspecialchars_decode($customerBankAccounts) !!}'),
                expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}'),
                so: {
                    customer: { },
                    items: [],
                    expenses: [],
                    disc_percent : 0,
                    disc_value : 0
                },
                payment_date: '',
                effective_date: '',
                soIndex: 0
            },
            mounted: function() {
                var vm = this;

                vm.so.customer = _.cloneDeep(vm.currentSo.customer);
                vm.so.disc_percent = vm.currentSo.disc_percent % 1 !== 0 ? vm.currentSo.disc_percent : parseFloat(vm.currentSo.disc_percent).toFixed(0);
                vm.so.disc_value = vm.currentSo.disc_value % 1 !== 0 ? vm.currentSo.disc_value : parseFloat(vm.currentSo.disc_value).toFixed(0);

                for (var i = 0; i < vm.currentSo.items.length; i++) {
                    var itemDiscounts = [];
                    if( vm.currentSo.items[i].discounts.length ){
                        for (var ix = 0; ix < vm.currentSo.items[i].discounts.length; ix++) {
                            itemDiscounts.push({
                                id : vm.currentSo.items[i].discounts[ix].id,
                                disc_percent : vm.currentSo.items[i].discounts[ix].item_disc_percent % 1 !== 0 ? vm.currentSo.items[i].discounts[ix].item_disc_percent : parseFloat(vm.currentSo.items[i].discounts[ix].item_disc_percent).toFixed(0),
                                disc_value : vm.currentSo.items[i].discounts[ix].item_disc_value % 1 !== 0 ? vm.currentSo.items[i].discounts[ix].item_disc_value : parseFloat(vm.currentSo.items[i].discounts[ix].item_disc_value).toFixed(0),
                            });
                        }
                    }
                    vm.so.items.push({
                        id: vm.currentSo.items[i].id,
                        product: _.cloneDeep(vm.currentSo.items[i].product),
                        base_unit: _.cloneDeep(_.find(vm.currentSo.items[i].product.product_units, function(unit) { return unit.is_base == 1; })),
                        selected_unit: _.cloneDeep(_.find(vm.currentSo.items[i].product.product_units, function(punit) { return punit.id == vm.currentSo.items[i].selected_unit_id; })),
                        quantity: parseFloat(vm.currentSo.items[i].quantity).toFixed(0),
                        price: parseFloat(vm.currentSo.items[i].price).toFixed(0),
                        discounts : itemDiscounts
                    });
                }

                for (var i = 0; i < vm.currentSo.expenses.length; i++) {
                    var type = _.find(vm.expenseTypes, function (type) {
                        return type.code === vm.currentSo.expenses[i].type;
                    });

                    vm.so.expenses.push({
                        id: vm.currentSo.expenses[i].id,
                        name: vm.currentSo.expenses[i].name,
                        type: {
                            code: vm.currentSo.expenses[i].type,
                            description: type ? type.description : ''
                        },
                        amount: vm.currentSo.expenses[i].amount,
                        remarks: vm.currentSo.expenses[i].remarks
                    });
                }
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.so.payment.transfer', $currentSo->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#soPaymentForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.so.payment.index') }}';
                        }).catch(function(e) {
                            $('#loader-container').fadeOut('fast');
                            if (e.response.data.errors != undefined && Object.keys(e.response.data.errors).length > 0) {
                                for (var key in e.response.data.errors) {
                                    for (var i = 0; i < e.response.data.errors[key].length; i++) {
                                        vm.$validator.errors.add('', e.response.data.errors[key][i], 'server', '__global__');
                                    }
                                }
                            } else {
                                vm.$validator.errors.add('', e.response.status + ' ' + e.response.statusText, 'server', '__global__');
                                if (e.response.data.message != undefined) { console.log(e.response.data.message); }
                            }
                        });
                    });
                },
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
                }
            },
            computed: {
                defaultBank: function() {
                    return {
                        id: ''
                    };
                }
            }
        });
    </script>
@endsection