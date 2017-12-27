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
    <div id="poVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="poForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit('submit')">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.create.box.supplier')</h3>
                        </div>
                        <div class="box-body">
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('supplier_type') }">
                                <label for="inputSupplierType"
                                       class="col-sm-2 control-label">@lang('purchase_order.create.field.supplier_type')</label>
                                <div class="col-sm-8">
                                    <select id="inputSupplierType" name="supplier_type" class="form-control"
                                            v-validate="'required'" data-vv-as="{{ trans('purchase_order.create.field.supplier_type') }}"
                                            v-model="po.supplier_type.code">
                                        <option v-bind:value="defaultSupplierType.code">@lang('labels.PLEASE_SELECT')</option>
                                        <option v-for="st of supplierTypeDDL" v-bind:value="st.code">@{{ st.i18nDescription }}</option>
                                    </select>
                                    <span v-show="errors.has('supplier_type')" class="help-block" v-cloak>@{{ errors.first('supplier_type') }}</span>
                                </div>
                            </div>
                            <template v-if="po.supplier_type.code == 'SUPPLIERTYPE.R'">
                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('supplier_id') }">
                                    <label for="inputSupplierId"
                                           class="col-sm-2 control-label">@lang('purchase_order.create.field.supplier_name')</label>
                                    <div class="col-sm-8">
                                        <select id="inputSupplierId" name="supplier_id" class="form-control"
                                                v-validate="po.supplier_type.code == 'SUPPLIERTYPE.R' ? 'required':''"
                                                data-vv-as="{{ trans('purchase_order.create.field.supplier_name') }}"
                                                v-model="po.supplier.id"
                                                v-on:change="onChangeSupplier()">
                                            <option v-bind:value="defaultSupplier.id">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="supplier of supplierDDL" v-bind:value="supplier.id">@{{ supplier.name }}</option>
                                        </select>
                                        <span v-show="errors.has('supplier_id')" class="help-block" v-cloak>@{{ errors.first('supplier_id') }}</span>
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
                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('walk_in_supplier') }">
                                    <label for="inputSupplierName"
                                           class="col-sm-2 control-label">@lang('purchase_order.create.field.supplier_name')</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="inputSupplierName" name="walk_in_supplier"
                                               v-validate="po.supplier_type.code == 'SUPPLIERTYPE.WI' ? 'required':''"
                                               data-vv-as="{{ trans('purchase_order.create.field.supplier_name') }}"
                                               class="form-control" v-model="po.supplier_name">
                                        <span v-show="errors.has('walk_in_supplier')" class="help-block" v-cloak>@{{ errors.first('walk_in_supplier') }}</span>
                                    </div>
                                </div>
                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('walk_in_supplier_detail') }">
                                    <label for="inputSupplierDetails"
                                           class="col-sm-2 control-label">@lang('purchase_order.create.field.supplier_details')</label>
                                    <div class="col-sm-10">
                                        <textarea id="inputSupplierDetails" name="walk_in_supplier_detail" class="form-control" rows="5"
                                                  v-validate="po.supplier_type.code == 'SUPPLIERTYPE.WI' ? 'required':''"
                                                  data-vv-as="{{ trans('purchase_order.create.field.supplier_details') }}"
                                                  v-model="po.supplier_details"></textarea>
                                        <span v-show="errors.has('walk_in_supplier_detail')" class="help-block" v-cloak>@{{ errors.first('walk_in_supplier_detail') }}</span>
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
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('po_type') }">
                                <label for="inputPoType"
                                       class="col-sm-3 control-label">@lang('purchase_order.create.field.po_type')</label>
                                <div class="col-sm-9">
                                    <select id="inputPoType" name="po_type" class="form-control"
                                            v-validate="'required'"
                                            data-vv-as="{{ trans('purchase_order.create.field.po_type') }}"
                                            v-model="po.poType.code">
                                        <option v-bind:value="defaultPOType.code">@lang('labels.PLEASE_SELECT')</option>
                                        <option v-for="poType of poTypeDDL" v-bind:value="poType.code">@{{ poType.i18nDescription }}</option>
                                    </select>
                                    <span v-show="errors.has('po_type')" class="help-block" v-cloak>@{{ errors.first('po_type') }}</span>
                                </div>
                            </div>
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('po_created') }">
                                <label for="inputPoDate"
                                       class="col-sm-3 control-label">@lang('purchase_order.create.field.po_date')</label>
                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputPoDate" name="po_created" value="" v-model="po.po_created" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
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
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('shipping_date') }">
                                <label for="inputShippingDate"
                                       class="col-sm-2 control-label">@lang('purchase_order.create.field.shipping_date')</label>
                                <div class="col-sm-5">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputShippingDate" name="shipping_date" value="" v-model="po.shipping_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                    </div>
                                </div>
                            </div>
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('warehouse_id') }">
                                <label for="inputWarehouse"
                                       class="col-sm-2 control-label">@lang('purchase_order.create.field.warehouse')</label>
                                <div class="col-sm-5">
                                    <select id="inputWarehouse" name="warehouse_id" class="form-control"
                                            v-model="po.warehouse.id"
                                            v-validate="'required'"
                                            data-vv-as="{{ trans('purchase_order.create.field.warehouse') }}"
                                            v-on:change="onChangeWarehouse()">
                                        <option v-bind:value="defaultWarehouse.id">@lang('labels.PLEASE_SELECT')</option>
                                        <option v-for="warehouse of warehouseDDL" v-bind:value="warehouse.id">@{{ warehouse.name }}</option>
                                    </select>
                                    <span v-show="errors.has('warehouse_id')" class="help-block" v-cloak>@{{ errors.first('warehouse_id') }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="inputVendorTrucking"
                                       class="col-sm-2 control-label">@lang('purchase_order.create.field.vendor_trucking')</label>
                                <div class="col-sm-8">
                                    <select id="inputVendorTrucking" name="vendor_trucking_id" class="form-control"
                                            v-model="po.vendorTrucking.id">
                                        <option v-bind:value="defaultVendorTrucking.id">@lang('labels.PLEASE_SELECT')</option>
                                        <option v-for="vendorTrucking of vendorTruckingDDL" v-bind:value="vendorTrucking.id">@{{ vendorTrucking.name }}</option>
                                    </select>
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
                            <h3 class="box-title">@lang('purchase_order.create.box.transactions')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-11 col-xs-12">
                                    <select id="inputProduct" class="form-control" v-model="po.product" v-on:change="insertItem(po.product)">
                                        <option v-bind:value="defaultProduct">@lang('labels.PLEASE_SELECT')</option>
                                        <template v-if="po.supplier_type.code == 'SUPPLIERTYPE.R'">
                                            <option v-for="product of po.supplier.products" v-bind:value="product">@{{ product.name }}</option>
                                        </template>
                                        <template v-if="po.supplier_type.code == 'SUPPLIERTYPE.WI'">
                                            <option v-for="product of productDDL" v-bind:value="product">@{{ product.name }}</option>
                                        </template>
                                    </select>
                                </div>
                                <div class="col-md-1 hidden-xs">
                                    <button type="button" class="btn btn-primary btn-md" v-on:click="insertItem(po.product)">
                                        <span class="fa fa-plus"/>
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-responsive table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="25%">@lang('purchase_order.create.table.item.header.product_name')</th>
                                                <th width="10%"
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
                                                <input type="hidden" name="item_product_id[]" v-bind:value="item.product.id">
                                                <input type="hidden" name="base_unit_id[]" v-bind:value="item.base_unit.unit.id">
                                                <td class="valign-middle">@{{ item.product.name }}</td>
                                                <td>
                                                    <input type="text" v-bind:class="{ 'form-control':true, 'text-right':true, 'has-error':errors.has('quantity_' + itemIndex) }"
                                                           name="item_quantity[]"
                                                           v-bind:data-vv-name="'quantity_' + itemIndex"
                                                           v-bind:data-vv-as="'{{ trans('purchase_order.create.table.item.header.quantity') }} ' + (itemIndex + 1)"
                                                           v-model="item.quantity" v-validate="'required'">
                                                </td>
                                                <td>
                                                    <select v-bind:class="{ 'form-control':true, 'has-error':errors.has('unit_' + itemIndex) }"
                                                            name="item_selected_unit_id[]"
                                                            v-model="item.selected_unit.id"
                                                            v-bind:data-vv-name="'unit_' + itemIndex"
                                                            v-bind:data-vv-as="'{{ trans('purchase_order.create.table.item.header.unit') }} ' + (itemIndex + 1)"
                                                            v-validate="'required'"
                                                            v-on:change="onChangeUnit(itemIndex)">
                                                        <option v-bind:value="defaultProductUnit.id">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="pu in item.product.product_units" v-bind:value="pu.id">@{{ pu.unit.name }} (@{{ pu.unit.symbol }})</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="item_price[]"
                                                           v-bind:class="{ 'form-control':true, 'text-right':true, 'has-error':errors.has('price_' + itemIndex) }"
                                                           v-model="item.price" v-validate="'required'"
                                                           v-bind:data-vv-name="'price_' + itemIndex"
                                                           v-bind:data-vv-as="'{{ trans('purchase_order.create.table.item.header.price_unit') }} ' + (itemIndex + 1)">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-md"
                                                            v-on:click="removeItem(itemIndex)"><span
                                                                class="fa fa-minus"></span>
                                                    </button>
                                                </td>
                                                <td class="text-right valign-middle">
                                                    @{{ numbro(item.selected_unit.conversion_value * item.quantity * item.price).format() }}
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
                                                    <span class="control-label-normal">@{{ numbro(grandTotal()).format() }}</span>
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
                            <h3 class="box-title">@lang('purchase_order.create.box.discount_per_item')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="discountsListTable" class="table table-bordered table-hover">
                                        <thead>
											<tr>
												<th width="30%">@lang('purchase_order.create.table.item.header.product_name')</th>
												<th width="30%">@lang('purchase_order.create.table.item.header.total_price')</th>
												<th width="40%" class="text-left" colspan="3">@lang('purchase_order.create.table.item.header.total_price')</th>
											</tr>
                                        </thead>
                                        <tbody>
                                            <template v-for="(item, itemIndex) in po.items">
                                                <tr>
        											<td width="30%">@{{ item.product.name }}</td>
        											<td width="30%">@{{ numbro(item.selected_unit.conversion_value * item.quantity * item.price).format() }}</td>
                                                    <td colspan="3" width="40%">
                                                        <button type="button" class="btn btn-primary btn-xs pull-right" v-on:click="insertDiscount(item)">
                                                            <span class="fa fa-plus"/>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" width="65%" ></td>
                                                    <th width="10%" class="small-header">@lang('purchase_order.create.table.item.header.discount_percent')</th>
                                                    <th width="25%" class="small-header">@lang('purchase_order.create.table.item.header.discount_nominal')</th>
                                                </tr>
                                                <tr v-for="(discount, discountIndex) in item.discounts">
                                                    <td colspan="2" width="60%"></td>
                                                    <td class="text-center valign-middle" width="5%">
                                                        <button type="button" class="btn btn-danger btn-md" v-on:click="removeDiscount(itemIndex, discountIndex)">
                                                                <span class="fa fa-minus"></span>
                                                        </button>
                                                    </td>
                                                    <td width="10%">
                                                        <input type="text" class="form-control text-right" v-bind:name="'item_disc_percent['+itemIndex+'][]'" v-model="discount.disc_percent" placeholder="%" v-on:keyup="discountPercentToNominal(item, discount)" />
                                                    </td>
                                                    <td width="25%">
                                                        <input type="text" class="form-control text-right" v-bind:name="'item_disc_value['+itemIndex+'][]'" v-model="discount.disc_value" placeholder="Nominal" v-on:keyup="discountNominalToPercent(item, discount)" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="3">@lang('purchase_order.create.table.total.body.sub_total_discount')</td>
                                                    <td class="text-right" colspan="2"> @{{ numbro(discountItemSubTotal(item.discounts)).format() }}</td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td width="65%"
                                                class="text-right">@lang('purchase_order.create.table.total.body.total_discount')</td>
                                            <td width="35%" class="text-right">
                                                <span class="control-label-normal">@{{ numbro(discountTotal()).format() }}</span>
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
												<td v-bind:class="{ 'has-error':errors.has('expense_name_' + expenseIndex) }">
													<input name="expense_name[]" type="text" class="form-control"
														   v-model="expense.name" v-validate="'required'" v-bind:data-vv-as="'{{ trans('purchase_order.create.table.expense.header.name') }} ' + (expenseIndex + 1)"
                                                           v-bind:data-vv-name="'expense_name_' + expenseIndex">
												</td>
												<td v-bind:class="{ 'has-error':errors.has('expense_type_' + expenseIndex) }">
													<select class="form-control" v-model="expense.type.code" name="expense_type[]"
                                                            v-validate="'required'" v-bind:data-vv-as="'{{ trans('purchase_order.create.table.expense.header.type') }} ' + (expenseIndex + 1)"
                                                            v-bind:data-vv-name="'expense_type_' + expenseIndex">
														<option v-bind:value="defaultExpenseType.code">@lang('labels.PLEASE_SELECT')</option>
														<option v-for="expenseType of expenseTypes" v-bind:value="expenseType.code">@{{ expenseType.i18nDescription }}</option>
													</select>
												</td>
												<td class="text-center">
                                                    <vue-iCheck name="is_internal_expense[]" v-model="expense.is_internal_expense"></vue-iCheck>
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
														   v-bind:data-vv-as="'{{ trans('purchase_order.create.table.expense.header.amount') }} ' + (expenseIndex + 1)"
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
                                                class="text-right">@lang('purchase_order.create.table.total.body.total')</td>
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
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><h3 class="box-title">@lang('purchase_order.create.box.discount_transaction')</h3></h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="discountsListTable" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="30%" class="text-right">@lang('purchase_order.create.table.total.body.total')</th>
                                            <th width="30%" class="text-left">@lang('purchase_order.create.table.total.body.invoice_discount')</th>
                                            <th width="40%" class="text-right">@lang('purchase_order.create.table.total.body.total_transaction')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
    											<td class="text-right valign-middle">@{{ numbro( ( grandTotal() - discountTotal() ) + expenseTotal() ).format() }}</td>
    											<td>
													<div class="row">
														<div class="col-md-3">
															<input type="text" class="form-control text-right" name="disc_total_percent" v-model="po.disc_total_percent" placeholder="%" v-on:keyup="discountTotalPercentToNominal()" />
														</div>
														<div class="col-md-9">
															<input type="text" class="form-control text-right" name="disc_total_value" v-model="po.disc_total_value" placeholder="Nominal" v-on:keyup="discountTotalNominalToPercent()" />
														</div>
													</div>
												</td>
												<td class="text-right valign-middle">@{{ numbro( ( grandTotal() - discountTotal() ) + expenseTotal() - po.disc_total_value ).format() }}</td>
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
                            <h3 class="box-title">@lang('purchase_order.create.box.transaction_summary')</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-3 col-md-6">
                                <div class="box">
                                    <div class="box-header text-center">
                                        <template v-if="po.supplier_type.code == 'SUPPLIERTYPE.R'">
                                        <h4>@{{ po.supplier.name }}</h4>
                                        <h5>@{{ po.supplier.address }}</h5>
                                        </template>

                                        <template v-if="po.supplier_type.code == 'SUPPLIERTYPE.WI'">
                                        <h4>@{{ po.supplier_name }}</h4>
                                        </template>
                                    </div>
                                    <div class="box-body table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>@lang('purchase_order.create.field.po_date')</td>
                                                <td class="text-right">@{{ po.po_created }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('purchase_order.create.field.shipping_date')</td>
                                                <td class="text-right">@{{ po.shipping_date }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('purchase_order.create.field.po_code')</td>
                                                <td class="text-right">{{ $poCode }}</td>
                                            </tr>
                                        </table>

                                        <hr>

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>@lang('purchase_order.create.table.item.header.product_name')</th>
                                                    <th>@lang('purchase_order.create.table.item.header.quantity')</th>
                                                    <th>@lang('purchase_order.create.table.item.header.price_unit')</th>
                                                    <th>@lang('purchase_order.create.table.item.header.total_price')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <template v-for="(item, itemIndex) in po.items">
                                                    <tr>
                                                        <td>*@{{ item.product.name }}</td>
                                                        <td>@{{ item.quantity }}</td>
                                                        <td>@{{ numbro(item.price).format() }}</td>
                                                        <td class="text-right">@{{ numbro(item.selected_unit.conversion_value * item.quantity * item.price).format() }}</td>
                                                    </tr>
                                                    <template v-for="discount in item.discounts">
                                                    <tr v-if="discount.disc_value != 0">
                                                        <td>Disc. @{{ discount.disc_percent }}%</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-right">-@{{ numbro(discount.disc_value).format() }}</td>
                                                    </tr>
                                                    </template>
                                                </template>
                                            </tbody>
                                        </table>

                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="text-right"><b>@lang('purchase_order.create.table.item.header.total_price')</b></td>
                                                    <td class="text-right">@{{ numbro(grandTotal()).format() }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><b>@lang('purchase_order.create.table.total.body.total_discount')</b></td>
                                                    <td class="text-right">@{{ numbro(discountTotal()).format() }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><b>@lang('purchase_order.create.box.expenses')</b></td>
                                                    <td class="text-right">@{{ numbro(expenseTotal()).format() }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><b>@lang('purchase_order.create.box.discount_transaction')</b></td>
                                                    <td class="text-right">@{{ numbro(po.disc_total_value).format() }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right"><b>@lang('purchase_order.create.table.total.body.total_transaction')</b></td>
                                                    <td class="text-right">@{{ numbro( ( grandTotal() - discountTotal() ) + expenseTotal() - po.disc_total_value ).format() }}</td>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.create.box.remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#tab_remarks" aria-controls="tab_remarks" role="tab" data-toggle="tab">@lang('purchase_order.create.tab.remarks')</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#tab_internal" aria-controls="tab_internal" role="tab" data-toggle="tab">@lang('purchase_order.create.tab.internal')</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#tab_private" aria-controls="tab_private" role="tab" data-toggle="tab">@lang('purchase_order.create.tab.private')</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="tab_remarks">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <textarea id="inputRemarks" name="remarks" class="form-control" rows="5" v-model="po.remarks"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="tab_internal">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <textarea id="inputInternalRemarks" name="internal_remarks" class="form-control" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="tab_private">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <textarea id="inputPrivateRemarks" name="private_remarks" class="form-control" rows="5"></textarea>
                                                    </div>
                                                </div>
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
                <div class="col-md-8 col-offset-md-4">
                    <div class="btn-toolbar">
                        <button id="submitAndCreateButton" type="button" class="btn btn-primary pull-right"
                                v-on:click="validateBeforeSubmit('submitcreate')">@lang('buttons.submit_button')&nbsp;&amp;&nbsp;@lang('buttons.create_new_button')</button>
                        <button id="submitButton" type="button" class="btn btn-primary pull-right"
                                v-on:click="validateBeforeSubmit('submit')">@lang('buttons.submit_button')</button>
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
                    disc_total_percent : parseInt('{{ old('disc_total_percent')? old('disc_total_percent') : 0 }}'),
                    disc_total_value : parseInt('{{ old('disc_total_value')? old('disc_total_value') : 0 }}'),
                    po_created: '',
                    shipping_date: '',
                    supplier_type: {
                        code: ''
                    },
                    supplier: {
                        id: '',
                        show: false
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
                    expenses: [],
                }
            },
            methods: {
                validateBeforeSubmit: function(type) {
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.po.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#poForm')[0]))
                            .then(function(response) {
                                if (type == 'submitcreate') { window.location.href = '{{ route('db.po.create') }}'; }
                                else { window.location.href = '{{ route('db') }}'; }
                            });
                    }).catch(function() {

                    });
                },
                onChangeSupplier: function() {
                    if (!this.po.supplier.id) {
                        this.removeAllExpense();
                        this.po.supplier = { id: '', show: false };
                    } else {
                        var supp = _.find(this.supplierDDL, {id: this.po.supplier.id});
                        this.insertDefaultExpense(supp);
                        this.po.supplier.show = true;
                        _.merge(this.po.supplier, supp);
                    }
                },
                onChangeWarehouse: function() {
                    if(!this.po.warehouse.id) {
                        this.po.warehouse = { id: '', show: false };
                    } else {
                        var wh = _.find(this.warehouseDDL, { id: this.po.warehouse.id });
                        this.po.warehouse.show = true;
                        _.merge(this.po.warehouse, wh);
                    }
                },
                onChangeUnit: function(itemIndex) {
                    if (!this.po.items[itemIndex].selected_unit.id) {
                        this.po.items[itemIndex].selected_unit = this.defaultProductUnit;
                    } else {
                        var pUnit = _.find(this.po.items[itemIndex].product.product_units, { id: this.po.items[itemIndex].selected_unit.id });
                        _.merge(this.po.items[itemIndex].selected_unit, pUnit);
                    }
                },
                discountPercentToNominal: function(item, discount){
                    var disc_value = ( item.selected_unit.conversion_value * item.quantity * item.price ) * ( discount.disc_percent / 100 );
                    if( disc_value % 1 !== 0 )
                        disc_value = disc_value.toFixed(2);
                    discount.disc_value = disc_value;
                },
                discountNominalToPercent: function(item, discount){
                    var disc_percent = discount.disc_value / ( item.selected_unit.conversion_value * item.quantity * item.price ) * 100 ;
                    if( disc_percent % 1 !== 0 )
                        disc_percent = disc_percent.toFixed(2);
                    discount.disc_percent = disc_percent;
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
                            result += parseInt(numbro().unformat(expense.amount));
                        else
                            result -= parseInt(numbro().unformat(expense.amount));
                    });
                    return result;
                },
                discountTotalPercentToNominal: function(){
                    var vm = this;

                    var grandTotal = 0;
                    _.forEach(vm.po.items, function (item, key) {
                        grandTotal += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });

                    var discountTotal = 0;
                    _.forEach(vm.po.items, function (item) {
                        _.forEach(item.discounts, function (discount) {
                            discountTotal += parseFloat(discount.disc_value);
                        });
                    });

                    var expenseTotal = 0;
                    _.forEach(vm.po.expenses, function (expense, key) {
                        if (expense.type.code === 'EXPENSETYPE.ADD')
                            expenseTotal += parseInt(numbro().unformat(expense.amount));
                        else
                            expenseTotal -= parseInt(numbro().unformat(expense.amount));
                    });

                    var disc_total_value = ( ( grandTotal - discountTotal ) + expenseTotal ) * ( vm.po.disc_total_percent / 100 );
                    if( disc_total_value % 1 !== 0 )
                        disc_total_value = disc_total_value.toFixed(2);
                    vm.po.disc_total_value = disc_total_value;
                },
                discountTotalNominalToPercent: function(){
                    var vm = this;

                    var grandTotal = 0;
                    _.forEach(vm.po.items, function (item, key) {
                        grandTotal += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });

                    var discountTotal = 0;
                    _.forEach(vm.po.items, function (item) {
                        _.forEach(item.discounts, function (discount) {
                            discountTotal += parseFloat(discount.disc_value);
                        });
                    });

                    var expenseTotal = 0;
                    _.forEach(vm.po.expenses, function (expense, key) {
                        if (expense.type.code === 'EXPENSETYPE.ADD')
                            expenseTotal += parseInt(numbro().unformat(expense.amount));
                        else
                            expenseTotal -= parseInt(numbro().unformat(expense.amount));
                    });

                    var disc_total_percent = vm.po.disc_total_value / ( ( grandTotal - discountTotal ) + expenseTotal ) * 100 ;
                    if( disc_total_percent % 1 !== 0 )
                        disc_total_percent = disc_total_percent.toFixed(2);
                    vm.po.disc_total_percent = disc_total_percent;
                },
                insertItem: function (product) {
                    if(product.id != ''){
                        var vm = this;
                        var item_init_discount = [];
                        item_init_discount.push({
                            disc_percent : 0,
                            disc_value : 0,
                        });
                        vm.po.items.push({
                            product: _.cloneDeep(product),
                            selected_unit: {
                                id: '',
                                unit: {
                                    id: ''
                                },
                                conversion_value: 1
                            },
                            base_unit: _.cloneDeep(_.find(product.product_units, {is_base: 1})),
                            quantity: 0,
                            price: 0,
                            discounts: item_init_discount
                        });
                    }
                },
                removeItem: function (index) {
                    var vm = this;
                    vm.po.items.splice(index, 1);
                },
                insertDiscount: function (item) {
                    item.discounts.push({
                        disc_percent : 0,
                        disc_value : 0,
                    });
                },
                removeDiscount: function (index, discountIndex) {
                    var vm = this;
                    vm.po.items[index].discounts.splice(discountIndex, 1);
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
                                amount: numbro(supplier.expense_templates[i].amount).format('0,0'),
                                remarks: supplier.expense_templates[i].remarks
                            });
                        }
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
                },
                removeExpense: function (index) {
                    var vm = this;
                    vm.po.expenses.splice(index, 1);
                },
                removeAllExpense: function() {
                    var vm = this;
                    vm.po.expenses = [];
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
                        id: '',
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
                },
                item_total: function(){
                    return this.po.items.reduce(function(prev, item){
                        return item.selected_unit.conversion_value * item.quantity * item.price;
                    },0);
                }
            }
        });
    </script>
@endsection
