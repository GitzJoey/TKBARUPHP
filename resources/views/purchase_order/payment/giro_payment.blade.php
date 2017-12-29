@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.payment.giro.title')
@endsection

@section('page_title')
    <span class="fa fa-book fa-fw"></span>&nbsp;@lang('purchase_order.payment.giro.page_title')
@endsection

@section('page_title_desc')
    @lang('purchase_order.payment.giro.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('purchase_order_payment_giro', $currentPo->hId()) !!}
@endsection

@section('content')
    <div id="poPaymentVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="poPaymentForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}

            @include('purchase_order.payment.payment_summary_partial')

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
                                            <input type="hidden" name="giro_id" v-bind:value="giro.id">
                                            <select id="inputGiro"
                                                    class="form-control"
                                                    v-model="giro" v-validate="'required'">
                                                <option v-bind:value="{id: '', bank: {name: ''}}">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="giro in availableGiros" v-bind:value="giro">@{{ giro.bank.short_name + ' ' + giro.serial_number + ' ' + giro.printed_name }}</option>
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
                                            <input id="inputGiroBank" type="text" class="form-control" readonly
                                                   v-bind:value="giro.bank.name">
                                        </div>
                                        <label for="inputGiroSerialNumber"
                                               class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.serial_number')</label>
                                        <div class="col-sm-4">
                                            <input id="inputGiroSerialNumber" name="serial_number" type="text"
                                                   class="form-control" v-bind:value="giro.serial_number" readonly>
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
                                                <vue-datetimepicker id="inputPaymentDate" name="payment_date" value="" v-model="payment_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                            </div>
                                        </div>
                                        <label for="inputEffectiveDate"
                                               class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.effective_date')</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <vue-datetimepicker id="inputEffectiveDate" name="effective_date" value="" v-model="giro.effective_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A" readonly="true"></vue-datetimepicker>
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
                                            <input type="text" class="form-control" id="inputAmount" v-bind:value="giro.amount"
                                                   name="amount" readonly>
                                        </div>
                                        <label for="inputPrintedName"
                                               class="col-sm-2 control-label">@lang('purchase_order.payment.giro.field.printed_name')</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="inputPrintedName"
                                                   v-bind:value="giro.printed_name"
                                                   name="printed_name" readonly>
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
                                                   v-bind:value="giro.remarks"
                                                   name="remarks" readonly>
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
        </form>

        @include('purchase_order.supplier_details_partial')
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var poPaymentApp = new Vue({
            el: '#poPaymentVue',
            data: {
                currentPo: JSON.parse('{!! htmlspecialchars_decode($currentPo->toJson()) !!}'),
                giro: {id: '', bank: {name: ''}},
                availableGiros: JSON.parse('{!! htmlspecialchars_decode($availableGiros) !!}'),
                expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}'),
                po: {
                    supplier: '',
                    items: [],
                    expenses: [],
                    disc_total_percent : 0,
                    disc_total_value : 0
                },
                payment_date: ''
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.po.payment.giro', $currentPo->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#poPaymentForm')[0]))
                            .then(function(response) {
                                window.location.href = '{{ route('db.po.payment.index') }}';
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
                    _.forEach(vm.po.items, function (item, key) {
                        result += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });
                    return result;
                },
                expenseTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.po.expenses, function (expense, key) {
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
                    _.forEach(vm.po.items, function (item) {
                        _.forEach(item.discounts, function (discount) {
                            result += parseFloat(discount.disc_value);
                        });
                    });
                    return result;
                },
                init: function() {
                    var vm = this;

                    this.po.supplier = _.cloneDeep(vm.currentPo.supplier);
                    this.po.disc_total_percent = this.currentPo.disc_percent % 1 !== 0 ? this.currentPo.disc_percent : parseFloat(this.currentPo.disc_percent).toFixed(0);
                    this.po.disc_total_value = this.currentPo.disc_value % 1 !== 0 ? this.currentPo.disc_value : parseFloat(this.currentPo.disc_value).toFixed(0);

                    for (var i = 0; i < this.currentPo.items.length; i++) {
                        var itemDiscounts = [];
                        if (this.currentPo.items[i].discounts.length) {
                            for (var ix = 0; ix < this.currentPo.items[i].discounts.length; ix++) {
                                itemDiscounts.push({
                                    id : this.currentPo.items[i].discounts[ix].id,
                                    disc_percent : this.currentPo.items[i].discounts[ix].item_disc_percent % 1 !== 0 ? this.currentPo.items[i].discounts[ix].item_disc_percent : parseFloat(this.currentPo.items[i].discounts[ix].item_disc_percent).toFixed(0),
                                    disc_value : this.currentPo.items[i].discounts[ix].item_disc_value % 1 !== 0 ? this.currentPo.items[i].discounts[ix].item_disc_value : parseFloat(this.currentPo.items[i].discounts[ix].item_disc_value).toFixed(0),
                                });
                            }
                        }
                        vm.po.items.push({
                            id: this.currentPo.items[i].id,
                            product: this.currentPo.items[i].product,
                            base_unit: _.find(this.currentPo.items[i].product.product_units, function(unit) { return unit.is_base == 1; }),
                            selected_unit: _.find(this.currentPo.items[i].product.product_units, function(punit) { return punit.id == vm.currentPo.items[i].selected_unit_id; }),
                            quantity: this.currentPo.items[i].quantity % 1 != 0 ? parseFloat(this.currentPo.items[i].quantity).toFixed(2):parseFloat(this.currentPo.items[i].quantity).toFixed(0),
                            price: this.currentPo.items[i].price % 1 != 0 ? parseFloat(this.currentPo.items[i].price).toFixed(2):parseFloat(this.currentPo.items[i].price).toFixed(0),
                            discounts : itemDiscounts
                        });
                    }

                    for (var i = 0; i < this.currentPo.expenses.length; i++) {
                        var type = _.find(vm.expenseTypes, function (type) {
                            return type.code === vm.currentPo.expenses[i].type;
                        });

                        vm.po.expenses.push({
                            id: this.currentPo.expenses[i].id,
                            name: this.currentPo.expenses[i].name,
                            type: {
                                code: this.currentPo.expenses[i].type,
                                description: type ? type.description : ''
                            },
                            is_internal_expense: this.currentPo.expenses[i].is_internal_expense == 1,
                            amount: parseFloat(this.currentPo.expenses[i].amount).toFixed(0),
                            remarks: this.currentPo.expenses[i].remarks
                        });
                    }

                    _.forEach(vm.availableGiros, function (giro) {
                        giro.effective_date = moment(giro.effective_date).format('DD-MM-YYYY');
                    });
                }
            },
            mounted: function() {
                this.init();
            }
        });
    </script>
@endsection