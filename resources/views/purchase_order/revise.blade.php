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
        {!! Form::model($currentPo, ['method' => 'PATCH', 'route' => ['db.po.revise', $currentPo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
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
                                            <input type="text" class="form-control" id="inputShippingDate"
                                                   name="shipping_date"
                                                   value="{{ $currentPo->shipping_date->format('d-m-Y') }}"
                                                   data-parsley-required="true">
                                        @else
                                            <input type="text" class="form-control" name="shipping_date" readonly
                                                   value="{{ $currentPo->shipping_date->format('d-m-Y') }}"
                                                   data-parsley-required="true">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarehouse"
                                       class="col-sm-2 control-label">@lang('purchase_order.revise.field.warehouse')</label>
                                <div class="col-sm-5">
                                    @if($currentPo->status == 'POSTATUS.WA')
                                        <input type="hidden" name="warehouse_id" v-bind:value="po.warehouse.id" >
                                        <select id="inputWarehouse" data-parsley-required="true"
                                                class="form-control"
                                                v-model="po.warehouse">
                                            <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="warehouse of warehouseDDL" v-bind:value="warehouse">@{{ warehouse.name }}</option>
                                        </select>
                                    @else
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentPo->warehouse->name }}">
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
                                                v-model="po.product">
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
                                                           data-parsley-required="true" data-parsley-type="number"
                                                           name="item_quantity[]"
                                                           v-model="item.quantity" {{ $currentPo->status == 'POSTATUS.WA' ? '' : 'readonly' }}>
                                                </td>
                                                <td>
                                                    @if($currentPo->status == 'POSTATUS.WA')
                                                        <input type="hidden" name="item_selected_unit_id[]" v-bind:value="item.selected_unit.unit.id" >
                                                        <select data-parsley-required="true"
                                                                class="form-control"
                                                                v-model="item.selected_unit"
                                                                data-parsley-required="true">
                                                            <option v-bind:value="{unit: {id: ''}, conversion_value: 1}">@lang('labels.PLEASE_SELECT')</option>
                                                            <option v-for="pu in item.product.product_units" v-bind:value="pu">@{{ pu.unit.name }} (@{{ pu.unit.symbol }})</option>
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
                                                           v-model="item.price" data-parsley-required="true">
                                                </td>
                                                <td class="text-center">
                                                    @if($currentPo->status == 'POSTATUS.WA')
                                                        <button type="button" class="btn btn-danger btn-md"
                                                                v-on:click="removeItem(itemIndex)"><span class="fa fa-minus"/>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td class="text-right valign-middle">
                                                    @{{ item.selected_unit.conversion_value * item.quantity * item.price }}
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
                                                           data-parsley-required="true" {{ $currentPo->status == 'POSTATUS.WA' ? '' : 'readonly' }} />
                                                </td>
                                                <td>
                                                    @if($currentPo->status == 'POSTATUS.WA')
                                                        <input type="hidden" name="expense_type[]" v-bind:value="expense.type.code" >
                                                        <select data-parsley-required="true"
                                                                class="form-control" v-model="expense.type">
                                                            <option v-bind:value="{code: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                            <option v-for="expenseType of expenseTypes" v-bind:value="expenseType">@{{ expenseType.description }}</option>
                                                        </select>
                                                    @else
                                                        <input type="text" class="form-control" readonly
                                                               v-bind:value="expense.type.description">
                                                        <input type="hidden" name="expense_type[]"
                                                               v-bind:value="expense.type.code"/>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <input name="is_internal_expense[]" v-model="expense.is_internal_expense" type="checkbox">
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
                                                           v-model="expense.amount" data-parsley-required="true"/>
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
                                                    <td width="30%">@{{ item.selected_unit.conversion_value * item.quantity * item.price }}</td>
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
                                                    <td class="text-right" colspan="2"> @{{ discountItemSubTotal(item.discounts) }}</td>
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
                                                <span class="control-label-normal">@{{ discountTotal() }}</span>
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
                                                <td class="text-right valign-middle">@{{ ( grandTotal() - discountTotal() ) + expenseTotal() }}</td>
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
                                                <td class="text-right valign-middle">@{{ ( grandTotal() - discountTotal() ) + expenseTotal() - po.disc_total_value }}</td>
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
                        <button id="submitButton" type="submit"
                                class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>
                        &nbsp;&nbsp;&nbsp;
                        <a id="printButton" href="#" target="_blank"
                           class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>
                        <a id="cancelButton" href="{{ route('db.po.revise.index') }}" class="btn btn-primary pull-right"
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
            var currentPo = JSON.parse('{!! htmlspecialchars_decode($currentPo->toJson()) !!}');
            var poApp = new Vue({
                el: '#poVue',
                data: {
                    warehouseDDL: JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}'),
                    vendorTruckingDDL: JSON.parse('{!! htmlspecialchars_decode($vendorTruckingDDL) !!}'),
                    expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}'),
                    productDDL: JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}'),
                    po: {
                        disc_total_percent : currentPo.disc_percent % 1 !== 0 ? currentPo.disc_percent : parseFloat(currentPo.disc_percent).toFixed(0),
                        disc_total_value : currentPo.disc_value % 1 !== 0 ? currentPo.disc_value : parseFloat(currentPo.disc_value).toFixed(0),
                        supplier: currentPo.supplier ? _.cloneDeep(currentPo.supplier) : {id: ''},
                        warehouse: _.cloneDeep(currentPo.warehouse),
                        vendorTrucking: currentPo.vendor_trucking ? _.cloneDeep(currentPo.vendor_trucking) : {id: ''},
                        items: [],
                        expenses: [],
                        supplier_type: {
                            code: currentPo.supplier_type
                        },
                        product: {
                            id: ''
                        }
                    }
                },
                methods: {
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
                            if(expense.type.code === 'EXPENSETYPE.ADD')
                                result += parseInt(numeral().unformat(expense.amount));
                            else
                                result -= parseInt(numeral().unformat(expense.amount));
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
                                expenseTotal += parseInt(numeral().unformat(expense.amount));
                            else
                                expenseTotal -= parseInt(numeral().unformat(expense.amount));
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
                                expenseTotal += parseInt(numeral().unformat(expense.amount));
                            else
                                expenseTotal -= parseInt(numeral().unformat(expense.amount));
                        });
                        
                        var disc_total_percent = vm.po.disc_total_value / ( ( grandTotal - discountTotal ) + expenseTotal ) * 100 ;
                        if( disc_total_percent % 1 !== 0 )
                            disc_total_percent = disc_total_percent.toFixed(2);
                        vm.po.disc_total_percent = disc_total_percent;
                    },
                    insertItem: function (product) {
                        if(product.id != ''){
                            var item_init_discount = [];
                            item_init_discount.push({
                                disc_percent : 0,
                                disc_value : 0,
                            });
                            this.po.items.push({
                                id: null,
                                product: _.cloneDeep(product),
                                base_unit: _.cloneDeep(_.find(product.product_units, isBase)),
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

                        $(function () {
                            $('input[type="checkbox"], input[type="radio"]').iCheck({
                                checkboxClass: 'icheckbox_square-blue',
                                radioClass: 'iradio_square-blue'
                            });
                        });    
                    },
                    removeExpense: function (index) {
                        this.po.expenses.splice(index, 1);
                    }
                }
            });

            for (var i = 0; i < currentPo.items.length; i++) {
                var itemDiscounts = [];
                if( currentPo.items[i].discounts.length ){
                    for (var ix = 0; ix < currentPo.items[i].discounts.length; ix++) {
                        itemDiscounts.push({
                            id : currentPo.items[i].discounts[ix].id,
                            disc_percent : currentPo.items[i].discounts[ix].item_disc_percent % 1 !== 0 ? currentPo.items[i].discounts[ix].item_disc_percent : parseFloat(currentPo.items[i].discounts[ix].item_disc_percent).toFixed(0),
                            disc_value : currentPo.items[i].discounts[ix].item_disc_value % 1 !== 0 ? currentPo.items[i].discounts[ix].item_disc_value : parseFloat(currentPo.items[i].discounts[ix].item_disc_value).toFixed(0),
                        });
                    }
                }
                else{
                    itemDiscounts.push({
                        disc_percent : 0,
                        disc_value : 0,
                    });
                }
                poApp.po.items.push({
                    id: currentPo.items[i].id,
                    product: _.cloneDeep(currentPo.items[i].product),
                    base_unit: _.cloneDeep(_.find(currentPo.items[i].product.product_units, isBase)),
                    selected_unit: _.cloneDeep(_.find(currentPo.items[i].product.product_units, getSelectedUnit(currentPo.items[i].selected_unit_id))),
                    quantity: parseFloat(currentPo.items[i].quantity).toFixed(0),
                    price: parseFloat(currentPo.items[i].price).toFixed(0),
                    discounts : itemDiscounts
                });
            }

            for (var i = 0; i < currentPo.expenses.length; i++) {
                var type = _.find(poApp.expenseTypes, function (type) {
                    return type.code === currentPo.expenses[i].type;
                });

                poApp.po.expenses.push({
                    id: currentPo.expenses[i].id,
                    name: currentPo.expenses[i].name,
                    type: _.cloneDeep(type),
                    is_internal_expense: currentPo.expenses[i].is_internal_expense == 1,
                    amount: currentPo.expenses[i].amount,
                    remarks: currentPo.expenses[i].remarks
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

            $("#inputShippingDate").datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment()
            });
        });
    </script>
@endsection
