@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.inflow.receipt.title')
@endsection

@section('page_title')
    <span class="fa fa-mail-forward fa-rotate-90 fa-fw"></span>&nbsp;@lang('warehouse.inflow.receipt.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.inflow.receipt.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('receipt', $po->hId(), $po->warehouse_id) !!}
@endsection

@section('content')
    <div id="receiptVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="receiptForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.inflow.receipt.box.receipt')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputWarehouse" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.warehouse')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $po->warehouse->name }}">
                                    <input type="hidden" name="warehouse_id" value="{{ $po->warehouse->id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPOCode" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.po_code')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $po->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputShippingDate" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.shipping_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputShippingDate" name="shipping_date" v-model="PO.po_created" format="YYYY-MM-DD hh:mm A" readonly="true"></vue-datetimepicker>
                                    </div>
                                </div>
                            </div>
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('receipt_date') }">
                                <label for="inputReceiptDate" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.receipt_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputReceiptDate" name="receipt_date" v-model="receipt_date" v-validate="'required'" format="YYYY-MM-DD hh:mm A" v-bind:readonly="readOnly"></vue-datetimepicker>
                                    </div>
                                    <span v-show="errors.has('receipt_date')" class="help-block" v-cloak>@{{ errors.first('receipt_date') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.vendor_trucking')</label>
                                <div class="col-sm-8">
                                    @if (empty($po->vendorTrucking))
                                        <input type="text" class="form-control" readonly value="" >
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $po->vendorTrucking->name }}" >
                                    @endif
                                </div>
                            </div>
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('license_plate') }">
                                <label for="inputLicensePlate" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.license_plate')</label>
                                <div class="col-sm-8">
                                    <div v-show="!readOnly">
                                        <select id="selectLicensePlate" class="form-control"
                                                v-model="select_license_plate"
                                                v-on:change="onChangeSelectLicensePlate" v-bind:disabled="readOnly">
                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            @foreach($truck as $key => $t)
                                                <option value="{{ $key }}">{{ $t }}</option>
                                            @endforeach
                                            <option value="">@lang('labels.SELECT_OTHER')</option>
                                        </select>
                                        <br>
                                    </div>
                                    <input id="inputLicensePlate" type="text" name="license_plate" class="form-control"
                                           v-model="license_plate"
                                           v-validate="'required'"
                                           v-bind:readonly="readOnly ? true:select_license_plate == '' ? false:true"
                                           v-show="select_license_plate != '' ? false:true"
                                           data-vv-as="{{ trans('warehouse.inflow.receipt.field.license_plate') }}">
                                    <span v-show="errors.has('license_plate')" class="help-block" v-cloak>@{{ errors.first('license_plate') }}</span>
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
                            <h3 class="box-title">@lang('warehouse.inflow.receipt.box.items')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50%" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.product_name')</th>
                                                <th width="15%" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.unit')</th>
                                                <th width="10%" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.brutto')</th>
                                                <th width="10%" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.netto')</th>
                                                <th width="10%" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.tare')</th>
                                                <th width="5%">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(receipt, receiptIdx) in inflow.receipts" v-cloak>
                                                <input type="hidden" name="item_id[]" v-bind:value="receipt.item.id">
                                                <input type="hidden" name="product_id[]" v-bind:value="receipt.item.product_id">
                                                <input type="hidden" name="base_unit_id[]" v-bind:value="receipt.item.base_unit_id">
                                                <td class="valign-middle">
                                                    <span v-bind:title="receipt.item.quantity">@{{ receipt.item.product.name }}</span>
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('unit_' + receiptIdx) }">
                                                    <select name="selected_unit_id[]"
                                                            class="form-control"
                                                            v-model="receipt.selected_unit"
                                                            v-validate="'required'"
                                                            v-bind:disabled="readOnly"
                                                            v-bind:data-vv-as="'{{ trans('warehouse.inflow.receipt.table.item.header.unit') }} ' + (receiptIdx + 1)"
                                                            v-bind:data-vv-name="'unit_' + receiptIdx">
                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="product_unit in receipt.item.product.product_units" v-bind:value="product_unit.unit.id">@{{ product_unit.unit.name }} (@{{ product_unit.unit.symbol }})</option>
                                                    </select>
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('brutto_' + receiptIdx) }">
                                                    <input v-bind:id="'brutto_' + receipt.item.id" type="text" class="form-control text-right" name="brutto[]"
                                                           v-model="receipt.brutto" v-validate="readOnly ? '':'required|numeric:2'"
                                                           v-bind:readonly="readOnly"
                                                           v-bind:data-vv-as="'{{ trans('warehouse.inflow.receipt.table.item.header.brutto') }} ' + (receiptIdx + 1)"
                                                           v-bind:data-vv-name="'brutto_' + receiptIdx"
                                                           v-on:change="reValidate('brutto', receiptIdx)">
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('netto_' + receiptIdx) }">
                                                    <input v-bind:id="'netto_' + receipt.item.id" type="text" class="form-control text-right" name="netto[]"
                                                           v-model="receipt.netto" v-validate="readOnly ? '':'required|numeric:2|checkequal:' + receiptIdx"
                                                           v-bind:readonly="readOnly"
                                                           v-bind:data-vv-as="'{{ trans('warehouse.inflow.receipt.table.item.header.netto') }} ' + (receiptIdx + 1)"
                                                           v-bind:data-vv-name="'netto_' + receiptIdx"
                                                           v-on:change="reValidate('netto', receiptIdx)">
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('tare_' + receiptIdx) }">
                                                    <input v-bind:id="'tare_' + receipt.item.id" type="text" class="form-control text-right" name="tare[]"
                                                           v-model="receipt.tare" v-validate="readOnly ? '':'required|numeric:2|checkequal:' + receiptIdx"
                                                           v-bind:readonly="readOnly"
                                                           v-bind:data-vv-as="'{{ trans('warehouse.inflow.receipt.table.item.header.tare') }} ' + (receiptIdx + 1)"
                                                           v-bind:data-vv-name="'tare_' + receiptIdx"
                                                           v-on:change="reValidate('tare', receiptIdx)">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-md" v-on:click="removeReceipt(receiptIdx)" disabled><span class="fa fa-minus"/></button>
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
                            <h3 class="box-title">@lang('warehouse.inflow.receipt.box.expense')</h3>
                            <button type="button" class="btn btn-primary btn-xs pull-right" v-on:click="insertExpense"><span class="fa fa-plus fa-fw"/></button>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="expensesListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="20%">@lang('warehouse.inflow.receipt.table.expense.header.name')</th>
                                                <th width="20%"
                                                    class="text-center">@lang('warehouse.inflow.receipt.table.expense.header.type')</th>
                                                <th width="10%"
                                                    class="text-center">@lang('warehouse.inflow.receipt.table.expense.header.internal_expense')</th>
                                                <th width="25%"
                                                    class="text-center">@lang('warehouse.inflow.receipt.table.expense.header.remarks')</th>
                                                <th width="5%">&nbsp;</th>
                                                <th width="20%"
                                                    class="text-center">@lang('warehouse.inflow.receipt.table.expense.header.amount')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(expense, expenseIndex) in po.expenses">
                                                <td v-bind:class="{ 'has-error':errors.has('expense_name_' + expenseIndex) }">
                                                    <input type="hidden" v-bind:id="'expense_id' + expenseIndex" name="expense_id[]" value="0">
                                                    <input name="expense_name[]" type="text" class="form-control"
                                                           v-model="expense.name" v-validate="'required'" v-bind:data-vv-as="'{{ trans('warehouse.inflow.receipt.table.expense.header.name') }} ' + (expenseIndex + 1)"
                                                           v-bind:data-vv-name="'expense_name_' + expenseIndex">
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('expense_type_' + expenseIndex) }">
                                                    <select class="form-control" v-model="expense.type.code" name="expense_type[]"
                                                            v-validate="'required'" v-bind:data-vv-as="'{{ trans('warehouse.inflow.receipt.table.expense.header.type') }} ' + (expenseIndex + 1)"
                                                            v-bind:data-vv-name="'expense_type_' + expenseIndex">
                                                        <option v-bind:value="defaultExpenseType.code">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="expenseType of expenseTypes" v-bind:value="expenseType.code">@{{ expenseType.i18nDescription }}</option>
                                                    </select>
                                                </td>
                                                <td class="text-center">
                                                    <vue-iCheck name="is_internal_expense[]" v-model="expense.is_internal_expense" disabled="disabled"></vue-iCheck>
                                                </td>
                                                <td>
                                                    <input name="expense_remarks[]" type="text" class="form-control" v-model="expense.remarks"/>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-md" v-on:click="removeExpense(expenseIndex)">
                                                        <span class="fa fa-minus"></span>
                                                    </button>
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('expense_amount_' + expenseIndex) }">
                                                    <input name="expense_amount[]" type="text"
                                                           class="form-control text-right"
                                                           v-model="expense.amount" v-validate="'required|numeric:2|min_value:0'"
                                                           v-bind:data-vv-as="'{{ trans('warehouse.inflow.receipt.table.expense.header.amount') }} ' + (expenseIndex + 1)"
                                                           v-bind:data-vv-name="'expense_amount_' + expenseIndex"/>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="expensesTotalListTable" class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td width="80%"
                                                    class="text-right">@lang('warehouse.inflow.receipt.table.total.body.total')</td>
                                                <td width="20%" class="text-right">
                                                    <span class="control-label-normal">@{{ numbro(expenseTotal()).format() }}</span>
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
                <div class="col-md-7 col-offset-md-5">
                    <div class="btn-toolbar">
                        <button id="submitButton" type="submit" class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>&nbsp;&nbsp;&nbsp;
                        <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                        <a id="cancelButton" class="btn btn-primary pull-right" href="{{ route('db.warehouse.inflow.index', array('w' => Hashids::encode($po->warehouse->id))) }}" >@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = new Vue({
            el: '#receiptVue',
            data: {
                PO: JSON.parse('{!! htmlspecialchars_decode($po) !!}'),
                inflow: {
                    receipts: []
                },
                po: {
                    expenses: []
                },
                receipt_date: '',
                license_plate: '',
                select_license_plate: '',
                expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.warehouse.inflow.receipt', $po->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#receiptForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.warehouse.inflow.index', array('w' => $po->warehouse->hId)) }}';
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
                onChangeSelectLicensePlate: function() {
                    if (this.select_license_plate != '') {
                        this.license_plate = this.select_license_plate;
                    } else {
                        this.license_plate = '';
                    }
                },
                createReceipt: function() {
                    for(var i = 0; i < this.PO.items.length; i++){
                        this.inflow.receipts.push({
                            item: this.PO.items[i],
                            selected_unit: '',
                            brutto: '',
                            netto: '',
                            tare: ''
                        });
                    }
                },
                fillReceipt: function() {
                    var vm = this;

                    if (vm.PO.receipts == undefined) return;

                    vm.receipt_date = moment(vm.PO.receipts[0].receipt_date).format('{{ config('const.DATETIME_FORMAT.JS_DATETIME') }}');
                    vm.license_plate = vm.PO.receipts[0].license_plate;

                    for (var i = 0; i < vm.inflow.receipts.length; i++) {
                        for (var j = 0; j < vm.PO.receipts.length; j++) {
                            if (vm.inflow.receipts[i].item.id == vm.PO.receipts[j].item_id) {
                                vm.inflow.receipts[i].selected_unit = vm.PO.receipts[j].selected_unit_id;
                                vm.inflow.receipts[i].brutto = vm.PO.receipts[j].brutto;
                                vm.inflow.receipts[i].netto = vm.PO.receipts[j].netto;
                                vm.inflow.receipts[i].tare = vm.PO.receipts[j].tare;
                            }
                        }
                    }
                },
                removeReceipt: function (index) {
                    this.inflow.receipts.splice(index, 1);
                },
                expenseTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.po.expenses, function (expense, key) {
                        if (expense.type.code === 'EXPENSETYPE.ADD')
                            result += parseInt(numbro().unformat(expense.amount));
                        else
                            result -= parseInt(numbro().unformat(expense.amount));
                    });
                    return result;
                },
                insertExpense: function () {
                    var vm = this;
                    vm.po.expenses.push({
                        name: '',
                        type: {
                            code: ''
                        },
                        is_internal_expense: true,
                        amount: 0,
                        remarks: ''
                    });
                },
                expenseTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.po.expenses, function (expense, key) {
                        if (expense.type.code === 'EXPENSETYPE.ADD')
                            result += parseInt(numbro().unformat(expense.amount));
                        else
                            result -= parseInt(numbro().unformat(expense.amount));
                    });
                    return result;
                },
                removeExpense: function (index) {
                    var vm = this;
                    vm.po.expenses.splice(index, 1);
                },
                reValidate: function(field, idx) {
                    if (field == 'brutto') {
                        this.$validator.validate('netto_' + idx);
                        this.$validator.validate('tare_' + idx);
                    } else if (field == 'netto') {
                        this.$validator.validate('brutto_' + idx);
                        this.$validator.validate('tare_' + idx);
                    } else {
                        this.$validator.validate('brutto_' + idx);
                        this.$validator.validate('netto_' + idx);
                    }
                }
            },
            mounted: function() {
                var vm = this;
                this.$validator.extend('checkequal', {
                    getMessage: function(field, args) {
                        return vm.$validator.locale == 'id' ?
                            'Nilai bersih dan Tara tidak sama dengan Nilai Kotor':'Netto and Tare value not equal with Bruto';
                    },
                    validate: function(value, args) {
                        var result = false;
                        var itemIdx = args[0];

                        if (Number(app.inflow.receipts[itemIdx].brutto) ==
                            Number(app.inflow.receipts[itemIdx].netto) + Number(app.inflow.receipts[itemIdx].tare)) {
                            result = true;
                        }

                        return result;
                    }
                });
                this.createReceipt();
                if (this.PO.status == '{{ config('lookups.PO_STATUS.WAITING_PAYMENT') }}' ||
                    this.PO.status == '{{ config('lookups.PO_STATUS.CLOSED') }}') {
                    this.fillReceipt();
                }
            },
            computed: {
                defaultExpenseType: function () {
                    return {
                        code: ''
                    }
                },
                readOnly: function () {
                    var vm = this;

                    if (vm.PO.status == '{{ config('lookups.PO_STATUS.WAITING_ARRIVAL') }}') {
                        return false;
                    } else {
                        return true;
                    }
                }
            }
        });
    </script>
@endsection