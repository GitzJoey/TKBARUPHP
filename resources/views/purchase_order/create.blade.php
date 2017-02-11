@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.create.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-fw"></span>&nbsp;@lang('purchase_order.create.page_title')
@endsection

@section('page_title_desc')
    @lang('purchase_order.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('create_purchase_order') !!}
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

    <div id="poVue">
        <form class="form-horizontal" action="{{ route('db.po.create') }}" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">@lang('purchase_order.create.box.supplier')</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputSupplierType"
                                               class="col-sm-2 control-label">@lang('purchase_order.create.field.supplier_type')</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="supplier_type" v-bind:value="po.supplier_type.code" >
                                            <select id="inputSupplierType" data-parsley-required="true"
                                                    class="form-control"
                                                    v-model="po.supplier_type">
                                                <option v-bind:value="defaultSupplierType">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="st of supplierTypeDDL" v-bind:value="st">@{{ st.i18nDescription }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <template v-if="po.supplier_type.code == 'SUPPLIERTYPE.R'">
                                        <div class="form-group">
                                            <label for="inputSupplierId"
                                                   class="col-sm-2 control-label">@lang('purchase_order.create.field.supplier_name')</label>
                                            <div class="col-sm-8">
                                                <input type="hidden" name="supplier_id" v-bind:value="po.supplier.id" >
                                                <select id="inputSupplierId"
                                                        class="form-control"
                                                        v-model="po.supplier"
                                                        v-on:change="insertDefaultExpense(po.supplier)">
                                                    <option v-bind:value="defaultSupplier">@lang('labels.PLEASE_SELECT')</option>
                                                    <option v-for="supplier of supplierDDL" v-bind:value="supplier">@{{ supplier.name }}</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button id="supplierDetailButton" type="button"
                                                        class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#supplierDetailModal"><span
                                                            class="fa fa-info-circle fa-lg"></span></button>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-if="po.supplier_type.code == 'SUPPLIERTYPE.WI'">
                                        <div class="form-group">
                                            <label for="inputSupplierName"
                                                   class="col-sm-2 control-label">@lang('purchase_order.create.field.supplier_name')</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="inputSupplierName" name="walk_in_supplier"
                                                       class="form-control" v-model="po.supplier_name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSupplierDetails"
                                                   class="col-sm-2 control-label">@lang('purchase_order.create.field.supplier_details')</label>
                                            <div class="col-sm-10">
                                        <textarea id="inputSupplierDetails" class="form-control" rows="5"
                                                  name="walk_in_supplier_detail"
                                                  v-model="po.supplier_details"></textarea>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">@lang('purchase_order.create.box.purchase_order_detail')</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputPoCode"
                                               class="col-sm-3 control-label">@lang('purchase_order.create.field.po_code')</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputPoCode" name="code"
                                                   placeholder="PO Code" readonly value="{{ $poCode }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPoType"
                                               class="col-sm-3 control-label">@lang('purchase_order.create.field.po_type')</label>
                                        <div class="col-sm-9">
                                            <input type="hidden" name="po_type" v-bind:value="po.poType.code" >
                                            <select id="inputPoType" data-parsley-required="true"
                                                    class="form-control"
                                                    v-model="po.poType">
                                                <option v-bind:value="defaultPOType">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="poType of poTypeDDL" v-bind:value="poType">@{{ poType.i18nDescription }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPoDate"
                                               class="col-sm-3 control-label">@lang('purchase_order.create.field.po_date')</label>
                                        <div class="col-sm-9">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="inputPoDate"
                                                       name="po_created" data-parsley-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPoStatus"
                                               class="col-sm-3 control-label">@lang('purchase_order.create.field.po_status')</label>
                                        <div class="col-sm-9">
                                            <label class="control-label control-label-normal">@lang('lookup.'.$poStatusDraft->first()->code)</label>
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
                                    <h3 class="box-title">@lang('purchase_order.create.box.shipping')</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputShippingDate"
                                               class="col-sm-2 control-label">@lang('purchase_order.create.field.shipping_date')</label>
                                        <div class="col-sm-5">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="inputShippingDate"
                                                       name="shipping_date" data-parsley-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputWarehouse"
                                               class="col-sm-2 control-label">@lang('purchase_order.create.field.warehouse')</label>
                                        <div class="col-sm-5">
                                            <input type="hidden" name="warehouse_id" v-bind:value="po.warehouse.id" >
                                            <select id="inputWarehouse" data-parsley-required="true"
                                                    class="form-control"
                                                    v-model="po.warehouse">
                                                <option v-bind:value="defaultWarehouse">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="warehouse of warehouseDDL" v-bind:value="warehouse">@{{ warehouse.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="inputVendorTrucking"
                                               class="col-sm-2 control-label">@lang('purchase_order.create.field.vendor_trucking')</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" name="vendor_trucking_id" v-bind:value="po.vendorTrucking.id" >
                                            <select id="inputVendorTrucking"
                                                    class="form-control"
                                                    v-model="po.vendorTrucking">
                                                <option v-bind:value="defaultVendorTrucking">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="vendorTrucking of vendorTruckingDDL" v-bind:value="vendorTrucking">@{{ vendorTrucking.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="box box-info">
                        <div class="box-header with-border">
                        </div>
                        <div class="box-body">
                            @for ($i = 0; $i < 25; $i++)
                                <br/>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">@lang('purchase_order.create.box.transactions')</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <select id="inputProduct"
                                                    class="form-control"
                                                    v-model="po.product">
                                                <option v-bind:value="defaultProduct">@lang('labels.PLEASE_SELECT')</option>
                                                <template v-if="po.supplier_type.code == 'SUPPLIERTYPE.R'">
                                                    <option v-for="product of po.supplier.products" v-bind:value="product">@{{ product.name }}</option>
                                                </template>
                                                <template v-if="po.supplier_type.code == 'SUPPLIERTYPE.WI'">
                                                    <option v-for="product of productDDL" v-bind:value="product">@{{ product.name }}</option>
                                                </template> 
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary btn-md"
                                                    v-on:click="insertItem(po.product)"><span class="fa fa-plus"/>
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="itemsListTable" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="30%">@lang('purchase_order.create.table.item.header.product_name')</th>
                                                        <th width="15%"
                                                            class="text-center">@lang('purchase_order.create.table.item.header.quantity')</th>
                                                        <th width="15%"
                                                            class="text-center">@lang('purchase_order.create.table.item.header.unit')</th>
                                                        <th width="15%"
                                                            class="text-center">@lang('purchase_order.create.table.item.header.price_unit')</th>
                                                        <th width="5%">&nbsp;</th>
                                                        <th width="20%"
                                                            class="text-center">@lang('purchase_order.create.table.item.header.total_price')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(item, itemIndex) in po.items">
                                                        <input type="hidden" name="product_id[]" v-bind:value="item.product.id">
                                                        <input type="hidden" name="base_unit_id[]"
                                                               v-bind:value="item.base_unit.unit.id">
                                                        <td class="valign-middle">@{{ item.product.name }}</td>
                                                        <td>
                                                            <input type="text" class="form-control text-right"
                                                                   name="quantity[]"
                                                                   v-model="item.quantity" data-parsley-required="true"
                                                                   data-parsley-type="number">
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="selected_unit_id[]" v-bind:value="item.selected_unit.unit.id" >
                                                            <select data-parsley-required="true"
                                                                    class="form-control"
                                                                    v-model="item.selected_unit"
                                                                    data-parsley-required="true">
                                                                <option v-bind:value="defaultProductUnit">@lang('labels.PLEASE_SELECT')</option>
                                                                <option v-for="pu in item.product.product_units" v-bind:value="pu">@{{ pu.unit.name }} (@{{ pu.unit.symbol }})</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control text-right"
                                                                   name="price[]"
                                                                   v-model="item.price" data-parsley-required="true"
                                                                   data-parsley-pattern="^\d+(,\d+)?$"/>
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-danger btn-md"
                                                                    v-on:click="removeItem(itemIndex)"><span
                                                                        class="fa fa-minus"></span>
                                                            </button>
                                                        </td>
                                                        <td class="text-right valign-middle">
                                                            @{{ item.selected_unit.conversion_value * item.quantity * item.price}}
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
                                                        class="text-right">@lang('purchase_order.create.table.total.body.total')</td>
                                                    <td width="20%" class="text-right">
                                                        <span class="control-label-normal">@{{ grandTotal() }}</span>
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
                                    <h3 class="box-title">@lang('purchase_order.create.box.expenses')</h3>
                                    <button type="button" class="btn btn-primary btn-xs pull-right"
                                            v-on:click="insertExpense()"><span class="fa fa-plus fa-fw"/></button>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="expensesListTable" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="20%">@lang('purchase_order.create.table.expense.header.name')</th>
                                                        <th width="20%"
                                                            class="text-center">@lang('purchase_order.create.table.expense.header.type')</th>
                                                        <th width="10%"
                                                            class="text-center">@lang('purchase_order.create.table.expense.header.internal_expense')</th>
                                                        <th width="25%"
                                                            class="text-center">@lang('purchase_order.create.table.expense.header.remarks')</th>
                                                        <th width="5%">&nbsp;</th>
                                                        <th width="20%"
                                                            class="text-center">@lang('purchase_order.create.table.expense.header.amount')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(expense, expenseIndex) in po.expenses">
                                                        <td>
                                                            <input name="expense_name[]" type="text" class="form-control"
                                                                   v-model="expense.name" data-parsley-required="true">
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="expense_type[]" v-bind:value="expense.type.code" >
                                                            <select data-parsley-required="true"
                                                                    class="form-control" v-model="expense.type">
                                                                <option v-bind:value="defaultExpenseType">@lang('labels.PLEASE_SELECT')</option>
                                                                <option v-for="expenseType of expenseTypes" v-bind:value="expenseType">@{{ expenseType.description }}</option>
                                                            </select>
                                                        </td>
                                                        <td class="text-center">
                                                            <input name="is_internal_expense[]" v-model="expense.is_internal_expense" type="checkbox">
                                                        </td>
                                                        <td>
                                                            <input name="expense_remarks[]" type="text" class="form-control"
                                                                   v-model="expense.remarks"/>
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-danger btn-md"
                                                                    v-on:click="removeExpense(expenseIndex)"><span
                                                                        class="fa fa-minus"></span>
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <input name="expense_amount[]" type="text"
                                                                   class="form-control text-right"
                                                                   v-model="expense.amount" data-parsley-required="true"
                                                                   data-parsley-pattern="^(?!0\.00)\d{1,3}(,\d{3})*(\.\d\d)?$"/>
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
                                                        class="text-right">@lang('purchase_order.create.table.total.body.total')</td>
                                                    <td width="20%" class="text-right">
                                                        <span class="control-label-normal">@{{ expenseTotal() }}</span>
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
                </div>
                <div class="col-md-3">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.create.box.transaction_summary')</h3>
                        </div>
                        <div class="box-body">
                            @for ($i = 0; $i < 25; $i++)
                                <br/>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.create.box.remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputRemarks" name="remarks" class="form-control" rows="5"
                                                      v-model="po.remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-offset-md-4">
                    <div class="btn-toolbar">
                        <button id="submitAndCreateButton" type="submit"
                                class="btn btn-primary pull-right" name="submitcreate"
                                value="create_new">@lang('buttons.submit_button')
                            &nbsp;&amp;&nbsp;@lang('buttons.create_new_button')</button>
                        <button id="submitButton" type="submit" name="submit"
                                class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>
                        <a id="printButton" href="#" target="_blank"
                           class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                        <a id="cancelButton" class="btn btn-primary pull-right"
                           href="{{ route('db') }}">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        </form>
        @include('purchase_order.supplier_details_partial')
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            var poApp = new Vue({
                el: '#poVue',
                data: {
                    supplierDDL: JSON.parse('{!! htmlspecialchars_decode($supplierDDL) !!}'),
                    warehouseDDL: JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}'),
                    poTypeDDL: JSON.parse('{!! htmlspecialchars_decode($poTypeDDL) !!}'),
                    supplierTypeDDL: JSON.parse('{!! htmlspecialchars_decode($supplierTypeDDL) !!}'),
                    vendorTruckingDDL: JSON.parse('{!! htmlspecialchars_decode($vendorTruckingDDL) !!}'),
                    expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}'),
                    productDDL: JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}'),
                    po: {
                        supplier_type: {
                            code: ''
                        },
                        supplier: {
                            id: ''
                        },
                        warehouse: {
                            id: ''
                        },
                        vendorTrucking: {
                            id: ''
                        },
                        poType: {
                            code: ''
                        },
                        product: {
                            id: ''
                        },
                        items: [],
                        expenses: []
                    }
                },
                methods: {
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
                            if (expense.type.code === 'EXPENSETYPE.ADD')
                                result += parseInt(numeral().unformat(expense.amount));
                            else
                                result -= parseInt(numeral().unformat(expense.amount));
                        });
                        return result;
                    },
                    insertItem: function (product) {
                        if(product.id != ''){
                            var vm = this;
                            vm.po.items.push({
                                product: _.cloneDeep(product),
                                selected_unit: {
                                    unit: {
                                        id: ''
                                    },
                                    conversion_value: 1
                                },
                                base_unit: _.cloneDeep(_.find(product.product_units, isBase)),
                                quantity: 0,
                                price: 0
                            });
                        }
                    },
                    removeItem: function (index) {
                        var vm = this;
                        vm.po.items.splice(index, 1);
                    },
                    insertDefaultExpense: function (supplier) {
                        var vm = this;
                        if (supplier.id != '') {
                            vm.po.expenses = [];
                            for (var i = 0; i < supplier.expense_templates.length; i++) {
                                vm.po.expenses.push({
                                    name: supplier.expense_templates[i].name,
                                    type: {
                                        code: supplier.expense_templates[i].type
                                    },
                                    is_internal_expense: supplier.expense_templates[i].is_internal_expense === 1,
                                    amount: numeral(supplier.expense_templates[i].amount).format('0,0'),
                                    remarks: supplier.expense_templates[i].remarks
                                });
                            }

                            $(function () {
                                $('input[type="checkbox"], input[type="radio"]').iCheck({
                                    checkboxClass: 'icheckbox_square-blue',
                                    radioClass: 'iradio_square-blue'
                                });
                            });
                        }
                        else {
                            vm.po.expenses.push({
                                type: ''
                            });
                        }
                    },
                    insertExpense: function () {
                        var vm = this;
                        vm.po.expenses.push({
                            name: '',
                            type: {
                                code: ''
                            },
                            is_internal_expense: false,
                            amount: 0,
                            remarks: ''
                        });

                        $(function () {
                            $('input[type="checkbox"], input[type="radio"]').iCheck({
                                checkboxClass: 'icheckbox_square-blue',
                                radioClass: 'iradio_square-blue'
                            });
                        });
                    },
                    removeExpense: function (index) {
                        var vm = this;
                        vm.po.expenses.splice(index, 1);
                    }
                },
                computed: {
                    defaultSupplierType: function(){
                        return {
                            code: ''
                        };
                    },
                    defaultSupplier: function(){
                        return {
                            id: ''
                        };
                    },
                    defaultWarehouse: function(){
                        return {
                            id: ''
                        };
                    },
                    defaultVendorTrucking: function(){
                        return {
                            id: ''
                        };
                    },
                    defaultPOType: function(){
                        return {
                            code: ''
                        };
                    },
                    defaultProduct: function(){
                        return {
                            id: ''
                        };
                    },
                    defaultProductUnit: function(){
                        return {
                            unit: {
                                id: ''
                            },
                            conversion_value: 1
                        };
                    },
                    defaultExpenseType: function(){
                        return {
                            code: ''
                        }
                    }
                }
            });

            function isBase(unit) {
                return unit.is_base == 1;
            }

            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });

            $("#inputPoDate").datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment()
            });

            $("#inputShippingDate").datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment()
            });
        });
    </script>
@endsection
