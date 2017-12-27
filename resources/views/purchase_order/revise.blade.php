@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.revise.title')
@endsection

@section('page_title')
    <span class="fa fa-code-fork fa-rotate-180 fa-fw"></span>&nbsp;@lang('purchase_order.revise.page_title')
@endsection

@section('page_title_desc')
    @lang('purchase_order.revise.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('revise_purchase_order_detail', $currentPo) !!}
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

        <form id="poForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.supplier')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSupplierType"
                                       class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_type')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly
                                           value="@lang('lookup.'.$currentPo->supplier_type)">
                                </div>
                            </div>
                            @if($currentPo->supplier_type == 'SUPPLIERTYPE.R')
                                <div class="form-group">
                                    <label for="inputSupplierId"
                                           class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_name')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentPo->supplier->name }}">
                                    </div>
                                    <div class="col-sm-2">
                                        <button id="supplierDetailButton" type="button" class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#supplierDetailModal"><span
                                                    class="fa fa-info-circle fa-lg"></span></button>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="inputSupplierName"
                                           class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_name')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentPo->walk_in_supplier }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSupplierDetails"
                                           class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_details')</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" readonly>{{ $currentPo->walk_in_supplier_detail }}</textarea>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.purchase_order_detail')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPoCode"
                                       class="col-sm-3 control-label">@lang('purchase_order.revise.field.po_code')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoType"
                                       class="col-sm-3 control-label">@lang('purchase_order.revise.field.po_type')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly
                                           value="@lang('lookup.'.$currentPo->po_type)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoDate"
                                       class="col-sm-3 control-label">@lang('purchase_order.revise.field.po_date')</label>
                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentPo->po_created->format('d-m-Y') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoStatus"
                                       class="col-sm-3 control-label">@lang('purchase_order.revise.field.po_status')</label>
                                <div class="col-sm-9">
                                    <label class="control-label control-label-normal">@lang('lookup.'.$currentPo->status)</label>
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
                            <h3 class="box-title">@lang('purchase_order.revise.box.shipping')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputShippingDate"
                                       class="col-sm-2 control-label">@lang('purchase_order.revise.field.shipping_date')</label>
                                <div class="col-sm-5">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        @if($currentPo->status == 'POSTATUS.WA')
                                            <vue-datetimepicker id="inputShippingDate" name="shipping_date" value="{{ $currentPo->shipping_date->format('d-m-Y') }}" v-model="po.shipping_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                        @else
                                            <vue-datetimepicker id="inputShippingDate" name="shipping_date" value="{{ $currentPo->shipping_date->format('d-m-Y') }}" v-model="po.shipping_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A" readonly="readonly"></vue-datetimepicker>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarehouse"
                                       class="col-sm-2 control-label">@lang('purchase_order.revise.field.warehouse')</label>
                                <div class="col-sm-5">
                                    @if($currentPo->status == 'POSTATUS.WA')
                                        <select id="inputWarehouse" name="warehouse_id" class="form-control"
                                                v-model="po.warehouse.id"
                                                v-validate="'required'"
                                                data-vv-as="{{ trans('purchase_order.revise.field.warehouse') }}"
                                                v-on:change="onChangeWarehouse()">
                                            <option v-bind:value="defaultWarehouse.id">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="warehouse of warehouseDDL" v-bind:value="warehouse.id">@{{ warehouse.name }}</option>
                                        </select>
                                        <span v-show="errors.has('warehouse_id')" class="help-block" v-cloak>@{{ errors.first('warehouse_id') }}</span>
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $currentPo->warehouse->name }}">
                                        <input type="hidden" name="warehouse_id" value="{{ $currentPo->warehouse->id }}">
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="inputVendorTrucking"
                                       class="col-sm-2 control-label">@lang('purchase_order.revise.field.vendor_trucking')</label>
                                <div class="col-sm-8">
                                    @if($currentPo->status == 'POSTATUS.WA')
                                        <input type="hidden" name="vendor_trucking_id" v-bind:value="po.vendorTrucking.id" >
                                        <select id="inputVendorTrucking"
                                                class="form-control"
                                                v-model="po.vendorTrucking">
                                            <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="vendorTrucking of vendorTruckingDDL" v-bind:value="vendorTrucking">@{{ vendorTrucking.name }}</option>
                                        </select>
                                    @else
                                        <input type="text" class="form-control" readonly
                                               value="{{ empty($currentPo->vendorTrucking->name) ? '':$currentPo->vendorTrucking->name }}">
                                        <input type="hidden" name="vendor_trucking_id"
                                               value="{{ empty($currentPo->vendorTrucking->id) ? '':$currentPo->vendorTrucking->id }}">
                                    @endif
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
                            <h3 class="box-title">@lang('purchase_order.revise.box.transactions')</h3>
                        </div>
                        <div class="box-body">
                            @if($currentPo->status == 'POSTATUS.WA')
                                <div class="row">
                                    <div class="col-md-11">
                                        <select id="inputProduct"
                                                class="form-control"
                                                v-model="po.product"
                                                v-on:change="insertItem(po.product)">
                                            <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
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
                                                v-on:click="insertItem(po.product)"><span class="fa fa-plus"/></button>
                                    </div>
                                </div>
                                <hr>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30%">@lang('purchase_order.revise.table.item.header.product_name')</th>
                                                <th width="15%"
                                                    class="text-center">@lang('purchase_order.revise.table.item.header.quantity')</th>
                                                <th width="15%"
                                                    class="text-center">@lang('purchase_order.revise.table.item.header.unit')</th>
                                                <th width="15%"
                                                    class="text-center">@lang('purchase_order.revise.table.item.header.price_unit')</th>
                                                <th width="5%">&nbsp;</th>
                                                <th width="20%"
                                                    class="text-center">@lang('purchase_order.revise.table.item.header.total_price')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, itemIndex) in po.items">
                                                <input type="hidden" name="item_id[]" v-bind:value="item.id">
                                                <input type="hidden" name="item_product_id[]" v-bind:value="item.product.id">
                                                <input type="hidden" name="base_unit_id[]" v-bind:value="item.base_unit.unit.id">
                                                <td class="valign-middle">@{{ item.product.name }}</td>
                                                <td>
                                                    <input type="text" class="form-control text-right"
                                                           name="item_quantity[]"
                                                           v-validate="'required|decimal:2'"
                                                           v-model="item.quantity" {{ $currentPo->status == 'POSTATUS.WA' ? '' : 'readonly' }}>
                                                </td>
                                                <td>
                                                    @if($currentPo->status == 'POSTATUS.WA')
                                                        <select name="item_selected_unit_id[]"
                                                                class="form-control"
                                                                v-model="item.selected_unit.id"
                                                                v-validate="'required'">
                                                            <option v-bind:value="defaultProductUnit.id">@lang('labels.PLEASE_SELECT')</option>
                                                            <option v-for="pu in item.product.product_units" v-bind:value="pu.id">@{{ pu.unit.name }} (@{{ pu.unit.symbol }})</option>
                                                        </select>
                                                    @else
                                                        <input type="text" class="form-control" readonly
                                                               v-bind:value="item.selected_unit.unit.name + ' (' + item.selected_unit.unit.symbol + ')'">
                                                        <input type="hidden" name="item_selected_unit_id[]"
                                                               v-bind:value="item.selected_unit.unit.id">
                                                    @endif
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control text-right" name="item_price[]"
                                                           v-model="item.price" v-validate="'required'">
                                                </td>
                                                <td class="text-center">
                                                    @if($currentPo->status == 'POSTATUS.WA')
                                                        <button type="button" class="btn btn-danger btn-md"
                                                                v-on:click="removeItem(itemIndex)"><span class="fa fa-minus"/>
                                                        </button>
                                                    @endif
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
                                                    class="text-right">@lang('purchase_order.revise.table.total.body.total')</td>
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
                            <h3 class="box-title">@lang('purchase_order.revise.box.expenses')</h3>
                            @if($currentPo->status == 'POSTATUS.WA')
                                <button type="button" class="btn btn-primary btn-xs pull-right"
                                        v-on:click="insertExpense()"><span class="fa fa-plus fa-fw"/></button>
                            @endif
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="expensesListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="20%">@lang('purchase_order.revise.table.expense.header.name')</th>
                                                <th width="20%"
                                                    class="text-center">@lang('purchase_order.revise.table.expense.header.type')</th>
                                                <th width="10%"
                                                    class="text-center">@lang('purchase_order.revise.table.expense.header.internal_expense')</th>
                                                <th width="25%"
                                                    class="text-center">@lang('purchase_order.revise.table.expense.header.remarks')</th>
                                                <th width="5%">&nbsp;</th>
                                                <th width="20%"
                                                    class="text-center">@lang('purchase_order.revise.table.expense.header.amount')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(expense, expenseIndex) in po.expenses">
                                                <td>
                                                    <input type="hidden" name="expense_id[]" v-bind:value="expense.id" />
                                                    <input name="expense_name[]" type="text" class="form-control" v-model="expense.name"
                                                           v-validate="'required'" {{ $currentPo->status == 'POSTATUS.WA' ? '' : 'readonly' }} />
                                                </td>
                                                <td>
                                                    @if($currentPo->status == 'POSTATUS.WA')
                                                        <input type="hidden" name="expense_type[]" v-bind:value="expense.type.code" >
                                                        <select v-validate="'required'"
                                                                class="form-control" v-model="expense.type">
                                                            <option v-bind:value="{code: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                            <option v-for="expenseType of expenseTypes" v-bind:value="expenseType">@{{ expenseType.i18nDescription }}</option>
                                                        </select>
                                                    @else
                                                        <input type="text" class="form-control" readonly v-bind:value="expense.type.description">
                                                        <input type="hidden" name="expense_type[]" v-bind:value="expense.type.code"/>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <vue-iCheck name="is_internal_expense[]" v-model="expense.is_internal_expense"></vue-iCheck>
                                                </td>
                                                <td>
                                                    <input name="expense_remarks[]" type="text" class="form-control" v-model="expense.remarks" {{ $currentPo->status == 'POSTATUS.WA' ? '' : 'readonly' }}/>
                                                </td>
                                                <td class="text-center">
                                                    @if($currentPo->status == 'POSTATUS.WA')
                                                        <button type="button" class="btn btn-danger btn-md"
                                                                v-on:click="removeExpense(expenseIndex)"><span class="fa fa-minus"/>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <input name="expense_amount[]" type="text" class="form-control text-right"
                                                           v-model="expense.amount" v-validate="'required|decimal:2'"/>
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
                                                    class="text-right">@lang('purchase_order.revise.table.total.body.total')</td>
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
                                                    <input type="hidden" v-bind:name="'item_discount_id['+itemIndex+'][]'" v-bind:value="discount.id">

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
                            <h3 class="box-title"><h3 class="box-title">@lang('purchase_order.create.box.discount_transaction')</h3></h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
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
                            <h3 class="box-title">@lang('purchase_order.revise.box.transaction_summary')</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-3 col-md-6">
                                <div class="box">
                                    <div class="box-header text-center">
                                        @if($currentPo->supplier_type == 'SUPPLIERTYPE.R')
                                        <h4>{{ $currentPo->supplier->name }}</h4>
                                        <h5>{{ $currentPo->supplier->address }}</h5>
                                        @else
                                        <h4>{{ $currentPo->walk_in_supplier }}</h4>
                                        @endif
                                    </div>
                                    <div class="box-body table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>@lang('purchase_order.create.field.po_date')</td>
                                                <td class="text-right">{{ $currentPo->po_created->format('d-m-Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('purchase_order.create.field.shipping_date')</td>
                                                <td class="text-right">@{{ po.shipping_date }}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('purchase_order.create.field.po_code')</td>
                                                <td class="text-right">{{ $currentPo->code }}</td>
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
                            <h3 class="box-title">@lang('purchase_order.revise.box.remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#tab_remarks" aria-controls="tab_remarks" role="tab" data-toggle="tab">@lang('purchase_order.revise.tab.remarks')</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#tab_internal" aria-controls="tab_internal" role="tab" data-toggle="tab">@lang('purchase_order.revise.tab.internal')</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#tab_private" aria-controls="tab_private" role="tab" data-toggle="tab">@lang('purchase_order.revise.tab.private')</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="tab_remarks">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <textarea id="inputRemarks" name="remarks" class="form-control" rows="5">{{ $currentPo->remarks }}</textarea>
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
                                                        <textarea id="inputInternalRemarks" name="internal_remarks" class="form-control" rows="5">{{ $currentPo->internal_remarks }}</textarea>
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
                                                        <textarea id="inputPrivateRemarks" name="private_remarks" class="form-control" rows="5">{{ $currentPo->private_remarks }}</textarea>
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
                <div class="col-md-7 col-offset-md-5">
                    <div class="btn-toolbar">
                        <button id="submitButton" type="submit" class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>&nbsp;&nbsp;&nbsp;
                        <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>
                        <a id="cancelButton" href="{{ route('db.po.revise.index') }}" class="btn btn-primary pull-right" role="button">@lang('buttons.cancel_button')</a>
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
                currentPo: JSON.parse('{!! htmlspecialchars_decode($currentPo->toJson()) !!}'),
                warehouseDDL: JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}'),
                vendorTruckingDDL: JSON.parse('{!! htmlspecialchars_decode($vendorTruckingDDL) !!}'),
                expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}'),
                productDDL: JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}'),
                po: {
                    disc_total_percent : 0,
                    disc_total_value : 0,
                    supplier: '',
                    warehouse: {
                        id: ''
                    },
                    vendorTrucking: '',
                    items: [],
                    expenses: [],
                    supplier_type: {
                        code: ''
                    },
                    product: {
                        id: ''
                    }
                }
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.po.revise', $currentPo->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#poForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db') }}';
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
                onChangeWarehouse: function() {
                    if(!this.po.warehouse.id) {
                        this.po.warehouse = { id: '' };
                    } else {
                        var wh = _.find(this.warehouseDDL, { id: this.po.warehouse.id });
                        _.merge(this.po.warehouse, wh);
                    }
                },
                discountPercentToNominal: function(item, discount) {
                    var disc_value = ( item.selected_unit.conversion_value * item.quantity * item.price ) * ( discount.disc_percent / 100 );
                    if( disc_value % 1 !== 0 ) disc_value = disc_value.toFixed(2);
                    discount.disc_value = disc_value;
                    },
                discountNominalToPercent: function(item, discount) {
                    var disc_percent = discount.disc_value / ( item.selected_unit.conversion_value * item.quantity * item.price ) * 100 ;
                    if( disc_percent % 1 !== 0 ) disc_percent = disc_percent.toFixed(2);
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
                        if(expense.type.code === 'EXPENSETYPE.ADD')
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
                    if( disc_total_value % 1 !== 0 ) disc_total_value = disc_total_value.toFixed(2);
                    vm.po.disc_total_value = disc_total_value;
                    },
                discountTotalNominalToPercent: function() {
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
                    if( disc_total_percent % 1 !== 0 ) disc_total_percent = disc_total_percent.toFixed(2);
                    vm.po.disc_total_percent = disc_total_percent;
                    },
                insertItem: function (product) {
                    if(product.id != '') {
                        var item_init_discount = [];
                        item_init_discount.push({
                            disc_percent : 0,
                            disc_value : 0,
                        });

                        this.po.items.push({
                            id: null,
                            product: _.cloneDeep(product),
                            base_unit: _.cloneDeep(_.find(product.product_units, function(unit) { return unit.is_base == 1; })),
                            selected_unit: {
                                unit: {
                                    id: ''
                                },
                                conversion_value: 1
                            },
                            quantity: 0,
                            price: 0,
                            discounts: item_init_discount
                        });
                    }
                    },
                removeItem: function (index) {
                    this.po.items.splice(index, 1);
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
                insertExpense: function () {
                    this.po.expenses.push({
                        name: '',
                        type: {
                            code: ''
                        },
                        amount: 0,
                        remarks: ''
                    });
                    },
                removeExpense: function (index) {
                    this.po.expenses.splice(index, 1);
                },
                init: function() {
                    this.po = {
                        disc_total_percent : this.currentPo.disc_percent % 1 !== 0 ? this.currentPo.disc_percent : parseFloat(this.currentPo.disc_percent).toFixed(0),
                        disc_total_value : this.currentPo.disc_value % 1 !== 0 ? this.currentPo.disc_value : parseFloat(this.currentPo.disc_value).toFixed(0),
                        supplier: this.currentPo.supplier ? _.cloneDeep(this.currentPo.supplier) : {id: ''},
                        warehouse: _.cloneDeep(this.currentPo.warehouse),
                        vendorTrucking: this.currentPo.vendor_trucking ? _.cloneDeep(this.currentPo.vendor_trucking) : {id: ''},
                        shipping_date: moment(this.currentPo.shipping_date).format('DD-MM-YYYY hh:mm A'),
                        items: [],
                        expenses: [],
                        supplier_type: {
                            code: this.currentPo.supplier_type
                        },
                        product: {
                            id: ''
                        }
                    };

                    var vm = this;

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
                        } else {
                            itemDiscounts.push({
                                disc_percent : 0,
                                disc_value : 0,
                            });
                        }

                        this.po.items.push({
                            id: this.currentPo.items[i].id,
                            product: _.cloneDeep(this.currentPo.items[i].product),
                            base_unit: _.cloneDeep(_.find(this.currentPo.items[i].product.product_units, function(unit) { return unit.is_base == 1; })),
                            selected_unit: _.cloneDeep(_.find(this.currentPo.items[i].product.product_units, function(punit) { return punit.id == vm.currentPo.items[i].selected_unit_id; })),
                            quantity: parseFloat(this.currentPo.items[i].quantity).toFixed(0),
                            price: parseFloat(this.currentPo.items[i].price).toFixed(0),
                            discounts : itemDiscounts
                        });
                    }

                    for (var i = 0; i < this.currentPo.expenses.length; i++) {
                        var vm = this;
                        var type = _.find(this.expenseTypes, function (type) {
                            return type.code === vm.currentPo.expenses[i].type;
                        });

                        this.po.expenses.push({
                            id: this.currentPo.expenses[i].id,
                            name: this.currentPo.expenses[i].name,
                            type: _.cloneDeep(type),
                            is_internal_expense: this.currentPo.expenses[i].is_internal_expense == 1,
                            amount: this.currentPo.expenses[i].amount,
                            remarks: this.currentPo.expenses[i].remarks
                        });
                    }
                }
            },
            mounted: function() {
                this.init();
            },
            computed: {
                defaultWarehouse: function(){
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
            }
        });
    </script>
@endsection
