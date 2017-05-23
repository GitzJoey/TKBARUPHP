@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.create.title')
@endsection

@section('page_title')
    <span class="fa fa-cart-arrow-down fa-fw"></span>&nbsp;@lang('sales_order.create.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('create_sales_order') !!}
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
    <div id="soVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form class="form-horizontal" id="soForm" v-on:submit.prevent="validateBeforeSubmit()">
        {{ csrf_field() }}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li v-for="(so, soIndex) in SOs" v-bind:class="{active: soIndex === SOs.length - 1}">
                                    <a v-bind:href="'#tab_so_' + (soIndex + 1)" data-toggle="tab"><div v-cloak>
                                        @{{ so.customer_type.code == 'CUSTOMERTYPE.R' ? so.customer.name || (defaultTabLabel + " " + (soIndex + 1))
                                        : so.customer_type.code == 'CUSTOMERTYPE.WI' ? so.walk_in_cust || (defaultTabLabel + " " + (soIndex + 1))
                                        : (defaultTabLabel + " " + (soIndex + 1)) }}</div></a>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-xs btn-default pull-right" v-on:click="insertTab(SOs)">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div v-for="(so, soIndex) in SOs" v-bind:class="{active: soIndex === SOs.length - 1}"
                                     class="tab-pane" v-bind:id="'tab_so_' + (soIndex + 1)">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="box box-info">
                                                <div class="box-body">
                                                    <button id="draftButton" type="button" name="draft" value="@{{ soIndex }}" class="btn btn-xs btn-primary pull-right"
                                                        v-on:click="saveDraft(soIndex)">
                                                        <span class="fa fa-save fa-fw"></span>Save as Draft
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="box box-info">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">@lang('sales_order.create.box.customer')</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('customer_type_' + (soIndex + 1)) }">
                                                        <label v-bind:for="'inputCustomerType_' + ( soIndex + 1)" class="col-sm-2 control-label">@lang('sales_order.create.field.customer_type')</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control"
                                                                    v-bind:id="'inputCustomerType_' + (soIndex + 1)"
                                                                    v-validate="'required'"
                                                                    v-model="so.customer_type.code"
                                                                    v-on:change="onChangeCustomerType(soIndex)"
                                                                    v-bind:data-vv-as="'{{ trans('sales_order.create.field.customer_type') }} ' + (soIndex + 1)"
                                                                    v-bind:data-vv-name="'customer_type_' + (soIndex + 1)">
                                                                <option v-bind:value="defaultCustomerType.code">@lang('labels.PLEASE_SELECT')</option>
                                                                <option v-for="customerType in customerTypeDDL" v-bind:value="customerType.code">@{{ customerType.i18nDescription }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <template v-if="so.customer_type.code == 'CUSTOMERTYPE.R'">
                                                        <div class="form-group">
                                                            <label v-bind:for="'inputCustomerId_' + (soIndex + 1)" class="col-sm-2 control-label">@lang('sales_order.create.field.customer_name')</label>
                                                            <div class="col-sm-8">
                                                                <select2_customer class="form-control" name="customer_id[]" v-bind:id="'customerSelect' + soIndex" v-model="so.customer.id" v-on:select="onSelectCustomer(soIndex)"></select2_customer>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <button v-bind:id="'customerDetailButton_' + (soIndex + 1)" type="button" class="btn btn-primary btn-sm"
                                                                        data-toggle="modal" data-target="#customerDetailModal" v-on:click="showCustomerPopup(soIndex)">
                                                                    <span class="fa fa-info-circle fa-lg"></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </template>
                                                    <template v-if="so.customer_type.code == 'CUSTOMERTYPE.WI'">
                                                        <div class="form-group">
                                                            <label v-bind:for="'inputCustomerName_' + (soIndex + 1)" class="col-sm-2 control-label">@lang('sales_order.create.field.customer_name')</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control" v-bind:id="'inputCustomerName_' + (soIndex + 1)"
                                                                       name="walk_in_customer[]" placeholder="Customer Name"
                                                                       v-model="so.walk_in_cust">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label v-bind:for="'inputCustomerDetails_' + (soIndex + 1)" class="col-sm-2 control-label">@lang('sales_order.create.field.customer_details')</label>
                                                            <div class="col-sm-10">
                                                                <textarea v-bind:id="'inputCustomerDetails_' + (soIndex + 1)" class="form-control" rows="5" name="walk_in_customer_details[]" v-model="so.walk_in_cust_details"></textarea>
                                                            </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="box box-info">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">@lang('sales_order.create.box.sales_order_detail')</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label v-bind:for="'inputSoCode_' + (soIndex + 1)" class="col-sm-3 control-label">@lang('sales_order.create.so_code')</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" v-bind:id="'inputSoCode_' + (soIndex + 1)"
                                                                   name="so_code[]" placeholder="SO Code" readonly
                                                                   v-model="so.so_code">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label v-bind:for="'inputSoType_' + (soIndex + 1)" class="col-sm-3 control-label">@lang('sales_order.create.so_type')</label>
                                                        <div class="col-sm-9">
                                                            <select v-bind:id="'inputSoType_' + (soIndex + 1)" v-validate="'required'"
                                                                    class="form-control"
                                                                    v-model="so.sales_type.code">
                                                                <option v-bind:value="defaultSalesType.code">@lang('labels.PLEASE_SELECT')</option>
                                                                <option v-for="salesType in soTypeDDL" v-bind:value="salesType.code">@{{ salesType.i18nDescription }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label v-bind:for="'inputSoDate_' + (soIndex + 1)" class="col-sm-3 control-label">@lang('sales_order.create.so_date')</label>
                                                        <div class="col-sm-9">
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <vue-datetimepicker v-bind:id="'inputSoDate_' + (soIndex + 1)" name="so_created[]" value="" v-model="so.so_created" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label v-bind:for="'inputSoStatus_' + (soIndex + 1)" class="col-sm-3 control-label">@lang('sales_order.create.so_status')</label>
                                                        <div class="col-sm-9">
                                                            <label class="control-label control-label-normal">@lang('lookup.'.$soStatusDraft->first()->code)</label>
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
                                                    <h3 class="box-title">@lang('sales_order.create.box.shipping')</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label v-bind:for="'inputShippingDate_' + (soIndex + 1)" class="col-sm-3 control-label">@lang('sales_order.create.field.shipping_date')</label>
                                                        <div class="col-sm-4">
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <vue-datetimepicker v-bind:id="'inputShippingDate_' + (soIndex + 1)" name="shipping_date[]" value="" v-model="so.shipping_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label v-bind:for="'inputWarehouse_' + (soIndex + 1)" class="col-sm-3 control-label">@lang('sales_order.create.field.warehouse')</label>
                                                        <div class="col-sm-9">
                                                            <select v-bind:id="'inputWarehouse_' + (soIndex + 1)" v-validate="'required'"
                                                                    class="form-control"
                                                                    v-model="so.warehouse.id"
                                                                    data-vv-as="{{ trans('sales_order.create.field.warehouse') }}">
                                                                <option v-bind:value="defaultWarehouse.id">@lang('labels.PLEASE_SELECT')</option>
                                                                <option v-for="warehouse in warehouseDDL" v-bind:value="warehouse.id">@{{warehouse.name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label v-bind:for="'inputVendorTrucking_' + (soIndex + 1)" class="col-sm-3 control-label">@lang('sales_order.create.field.vendor_trucking')</label>
                                                        <div class="col-sm-9">
                                                            <select v-bind:id="'inputVendorTrucking_' + (soIndex + 1)"
                                                                    class="form-control"
                                                                    v-model="so.vendorTrucking.id">
                                                                <option v-bind:value="defaultVendorTrucking.id">@lang('labels.PLEASE_SELECT')</option>
                                                                <option v-for="vendorTrucking in vendorTruckingDDL" v-bind:value="vendorTrucking.id">@{{ vendorTrucking.name }}</option>
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
                                                    <h3 class="box-title">@lang('sales_order.create.box.transactions')</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div v-show="so.sales_type.code === 'SOTYPE.SVC'">
                                                            <div class="col-md-11">
                                                                <select v-bind:id="'inputProduct_' + (soIndex + 1)"
                                                                        class="form-control"
                                                                        v-model="so.product">
                                                                    <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                                    <option v-for="product in productDDL" v-bind:value="product">@{{ product.name }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-primary btn-md"
                                                                        v-on:click="insertProduct(soIndex, so.product)"><span class="fa fa-plus"/></button>
                                                            </div>
                                                        </div>
                                                        <div v-show="so.sales_type.code === 'SOTYPE.S' || so.sales_type.code === 'SOTYPE.AC'">
                                                            <div class="col-md-11">
                                                                <select v-bind:id="'inputStock_' + (soIndex + 1)"
                                                                        class="form-control"
                                                                        v-model="so.stock">
                                                                    <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                                    <option v-for="stock in stocksDDL" v-bind:value="stock">@{{ stock.product.name }}</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-primary btn-md"
                                                                        v-on:click="insertStock(soIndex, so.stock)"><span class="fa fa-plus"/></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table v-bind:id="'itemsListTable_' + (soIndex + 1)" class="table table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="30%">@lang('sales_order.create.table.item.header.product_name')</th>
                                                                        <th width="15%">@lang('sales_order.create.table.item.header.quantity')</th>
                                                                        <th width="15%" class="text-right">@lang('sales_order.create.table.item.header.unit')</th>
                                                                        <th width="15%" class="text-right">@lang('sales_order.create.table.item.header.price_unit')</th>
                                                                        <th width="5%">&nbsp;</th>
                                                                        <th width="20%" class="text-right">@lang('sales_order.create.table.item.header.total_price')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(item, itemIndex) in so.items">
                                                                        <input type="hidden" v-bind:name="'so_' + (soIndex + 1) + '_product_id[]'" v-bind:value="item.product.id">
                                                                        <input type="hidden" v-bind:name="'so_' + (soIndex + 1) + '_stock_id[]'" v-bind:value="item.stock_id">
                                                                        <input type="hidden" v-bind:name="'so_' + (soIndex + 1) + '_base_unit_id[]'" v-bind:value="item.base_unit.unit.id">
                                                                        <td class="valign-middle">@{{ item.product.name }}</td>
                                                                        <td>
                                                                            <input type="text" class="form-control text-right" v-bind:name="'so_' + (soIndex + 1) + '_quantity[]'"
                                                                                   v-model="item.quantity" v-validate="'required|decimal:2'">
                                                                        </td>
                                                                        <td>
                                                                            <select name="selected_unit_id[]"
                                                                                    class="form-control"
                                                                                    v-model="item.selected_unit.id"
                                                                                    v-validate="'required'">
                                                                                <option v-bind:value="defaultProductUnit.id">@lang('labels.PLEASE_SELECT')</option>
                                                                                <option v-for="product_unit in item.product.product_units" v-bind:value="product_unit.id">@{{ product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' }}</option>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control text-right" v-bind:name="'so_' + soIndex + '_price[]'"
                                                                                   v-model="item.price" v-validate="'required|decimal:2'">
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <button type="button" class="btn btn-danger btn-md"
                                                                                    v-on:click="removeItem(soIndex, itemIndex)"><span class="fa fa-minus"/>
                                                                            </button>
                                                                        </td>
                                                                        <td class="text-right valign-middle">
                                                                            @{{ numeral(item.selected_unit.conversion_value * item.quantity * item.price).format() }}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table v-bind:id="'itemsTotalListTable_' + (soIndex + 1)" class="table table-bordered">
                                                                <tbody>
                                                                <tr>
                                                                    <td width="80%"
                                                                        class="text-right">@lang('sales_order.create.table.total.body.total')</td>
                                                                    <td width="20%" class="text-right">
                                                                        <span class="control-label-normal">@{{ numeral(grandTotal(soIndex)).format() }}</span>
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
                                                            <table v-bind:id="'discountsListTable_' + (soIndex + 1)" class="table table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="30%">@lang('purchase_order.create.table.item.header.product_name')</th>
                                                                        <th width="30%">@lang('purchase_order.create.table.item.header.total_price')</th>
                                                                        <th width="40%" class="text-left" colspan="3">@lang('purchase_order.create.table.item.header.total_price')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <template v-for="(item, itemIndex) in so.items">
                                                                        <tr>
                                                                            <td width="30%">@{{ item.product.name }}</td>
                                                                            <td width="30%">@{{ numeral(item.selected_unit.conversion_value * item.quantity * item.price).format() }}</td>
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
                                                                                <button type="button" class="btn btn-danger btn-md" v-on:click="removeDiscount(soIndex, itemIndex, discountIndex)">
                                                                                        <span class="fa fa-minus"></span>
                                                                                </button>
                                                                            </td>
                                                                            <td width="10%">
                                                                                <input type="text" class="form-control text-right" v-bind:name="'so_' + soIndex + '_item_disc_percent['+itemIndex+'][]'" v-model="discount.disc_percent" placeholder="%" v-on:keyup="discountPercentToNominal(item, discount)" />
                                                                            </td>
                                                                            <td width="25%">
                                                                                <input type="text" class="form-control text-right" v-bind:name="'so_' + soIndex + '_item_disc_value['+itemIndex+'][]'" v-model="discount.disc_value" placeholder="Nominal" v-on:keyup="discountNominalToPercent(item, discount)" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text-right" colspan="3">@lang('purchase_order.create.table.total.body.sub_total_discount')</td>
                                                                            <td class="text-right" colspan="2"> @{{ numeral(discountItemSubTotal(item.discounts)).format() }}</td>
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
                                                                            <span class="control-label-normal">@{{ numeral(discountTotal(soIndex)).format() }}</span>
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
                                                    <h3 class="box-title">@lang('sales_order.create.box.expenses')</h3>
                                                    <button type="button" class="btn btn-primary btn-xs pull-right"
                                                            v-on:click="insertExpense(soIndex)"><span class="fa fa-plus fa-fw"></span></button>
                                                </div>
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table v-bind:id="'expensesListTable_' + (soIndex + 1)" class="table table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="20%">@lang('sales_order.create.table.expense.header.name')</th>
                                                                        <th width="20%"
                                                                            class="text-center">@lang('sales_order.create.table.expense.header.type')</th>
                                                                        <th width="10%"
                                                                            class="text-center">@lang('sales_order.create.table.expense.header.internal_expense')</th>
                                                                        <th width="25%"
                                                                            class="text-center">@lang('sales_order.create.table.expense.header.remarks')</th>
                                                                        <th width="5%">&nbsp;</th>
                                                                        <th width="20%"
                                                                            class="text-center">@lang('sales_order.create.table.expense.header.amount')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(expense, expenseIndex) in so.expenses">
                                                                        <td>
                                                                            <input v-bind:name="'so_' + soIndex + '_expense_name[]'" type="text" class="form-control"
                                                                                   v-model="expense.name" v-validate="'required'">
                                                                        </td>
                                                                        <td>
                                                                            <input type="hidden" v-bind:name="'so_' + soIndex + '_expense_type[]'" v-bind:value="expense.type.code">
                                                                            <input type="hidden" v-bind:name="'so_' + soIndex + '_expense_type_description[]'" v-bind:value="expense.type.description">
                                                                            <input type="hidden" v-bind:name="'so_' + soIndex + '_expense_type_i18nDescription[]'" v-bind:value="expense.type.i18nDescription">
                                                                            <select class="form-control" v-model="expense.type">
                                                                                <option v-bind:value="{code: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                                                <option v-for="expenseType in expenseTypes" v-bind:value="expenseType">@{{ expenseType.description }}</option>
                                                                            </select>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <input v-bind:name="'so_' + soIndex + '_is_internal_expense[]'" v-model="expense.is_internal_expense" type="checkbox">
                                                                        </td>
                                                                        <td>
                                                                            <input v-bind:name="'so_' + soIndex + '_expense_remarks[]'" type="text" class="form-control"
                                                                                   v-model="expense.remarks"/>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <button type="button" class="btn btn-danger btn-md"
                                                                                    v-on:click="removeExpense(soIndex, expenseIndex)"><span class="fa fa-minus"/>
                                                                            </button>
                                                                        </td>
                                                                        <td>
                                                                            <input v-bind:name="'so_' + soIndex + '_expense_amount[]'" type="text" class="form-control text-right"
                                                                                   v-model="expense.amount" v-validate="'required|deciaml:2'"/>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table v-bind:id="'expensesTotalListTable_' + (soIndex + 1)" class="table table-bordered">
                                                                <tbody>
                                                                <tr>
                                                                    <td width="80%"
                                                                        class="text-right">@lang('sales_order.create.table.total.body.total')</td>
                                                                    <td width="20%" class="text-right">
                                                                        <span class="control-label-normal">@{{ numeral(expenseTotal(soIndex)).format() }}</span>
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
                                                    <h3 class="box-title">@lang('sales_order.create.box.transaction_summary')</h3>
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
                                                                        <td class="text-right valign-middle">@{{ numeral( ( grandTotal(soIndex) - discountTotal(soIndex) ) + expenseTotal(soIndex) ).format() }}</td>
                                                                        <td>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <input type="text" class="form-control text-right" v-bind:name="'so_' + soIndex + 'disc_percent'" v-model="so.disc_percent" placeholder="%" v-on:keyup="discountTotalPercentToNominal(soIndex)" />
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <input type="text" class="form-control text-right" v-bind:name="'so_' + soIndex + 'disc_value'" v-model="so.disc_value" placeholder="Nominal" v-on:keyup="discountTotalNominalToPercent(soIndex)" />
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-right valign-middle">@{{ numeral( ( grandTotal(soIndex) - discountTotal(soIndex) ) + expenseTotal(soIndex) - so.disc_value ).format() }}</td>
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
                                                    <h3 class="box-title">@lang('sales_order.create.box.remarks')</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <textarea v-bind:id="'inputRemarks_' + (soIndex + 1)" class="form-control" rows="5" name="remarks[]" v-model="so.remarks"></textarea>
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
                                                <button v-bind:id="'submitButton_' + soIndex" type="submit" name="submit" v-bind:value="soIndex" class="submitButton btn btn-primary pull-right">@lang('buttons.submit_button')</button>&nbsp;&nbsp;&nbsp;
                                                <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                                                <button v-bind:id="'cancelButton_' + soIndex" type="submit" name="cancel" v-bind:value="soIndex" class="cancelButton btn btn-primary pull-right">@lang('buttons.cancel_button')</button>
                                            </div>
                                        </div>
                                    </div>

                                    @include('sales_order.customer_details_partial')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        Vue.use(VeeValidate, { locale: '{!! LaravelLocalization::getCurrentLocale() !!}' });

        Vue.component('select2_customer', {
            template: '<select v-model="value"><option></option></select>',
            props: ['value'],
            model: {
                event: 'select'
            },
            mounted: function(){
                var vm = this;
                $(this.$el).select2({
                    ajax: {
                        url: "{{ route('api.customer.search') }}?q=",
                        dataType: 'json',
                        data: function(params){
                            return {
                                q: params.term,
                                page: params.page
                            }
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            var output = [];
                            _.map(data, function(d){
                                output.push({id: d.id, text: d.name});
                            });
                            return {
                                results: output
                            }
                        }
                    },
                    minimumInputLength: 1
                }).val(this.value).trigger('change').on('change', function() {
                    vm.$emit('input', this.value);
                    vm.$emit('select', this.value);
                });
            },
            destroyed: function(){
                $(this.$el).off().select2('destroy');
            }
        });

        Vue.component('vue-icheck', {
            template: "<input v-bind:id='id' v-bind:name='name' type='checkbox' v-bind:disabled='disabled' v-model='value'>",
            props: ['id', 'name', 'disabled', 'value'],
            mounted: function() {
                $(this.$el).iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue'
                }).on('ifChecked', function(event) {
                    this.value = true;
                }).on('ifUnchecked', function(event) {
                    this.value = false;
                });

                if (this.value) { $(this.$el).iCheck('check'); }
                if (this.disabled == 'true') { $(this.$el).iCheck('disable'); }
            },
            destroyed: function() {
                $(this.$el).iCheck('destroy');
            }
        });

        Vue.component('vue-datetimepicker', {
            template: "<input type='text' v-bind:id='id' v-bind:name='name' class='form-control' v-bind:value='value' v-model='value' v-bind:format='format' v-bind:readonly='readonly'>",
            props: ['id', 'name', 'value', 'format', 'readonly'],
            mounted: function() {
                var vm = this;

                if (this.value == undefined) this.value = '';
                if (this.format == undefined) this.format = 'DD-MM-YYYY hh:mm A';
                if (this.readonly == undefined) this.readonly = 'false';

                $(this.$el).datetimepicker({
                    format: this.format,
                    defaultDate: this.value == '' ? moment():moment(this.value),
                    showTodayButton: true,
                    showClose: true
                }).on("dp.change", function(e) {
                    vm.$emit('input', this.value);
                });

                if (this.value == '') { vm.$emit('input', moment().format(this.format)); }
            },
            destroyed: function() {
                $(this.$el).data("DateTimePicker").destroy();
            }
        });

        var soApp = new Vue({
            el: '#soVue',
            data: {
                vendorTruckingDDL: JSON.parse('{!! htmlspecialchars_decode($vendorTruckingDDL) !!}'),
                customerTypeDDL: JSON.parse('{!! htmlspecialchars_decode($customerTypeDDL) !!}'),
                expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}'),
                warehouseDDL: JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}'),
                productDDL: JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}'),
                stocksDDL: JSON.parse('{!! htmlspecialchars_decode($stocksDDL) !!}'),
                soTypeDDL: JSON.parse('{!! htmlspecialchars_decode($soTypeDDL) !!}'),
                SOs: JSON.parse('{!! htmlspecialchars_decode($userSOs) !!}'),
                defaultTabLabel: '',
                defaultCustomerType: { code: '' },
                customerPopupData: { customer: { } }
            },
            mounted: function() {
                var vm = this;

                this.defaultTabLabel = '{{ trans('sales_order.create.tab.sales') }}';

                if(this.SOs.length == 0) {
                    this.insertTab(this.SOs);
                } else {
                    for(var i = 0; i < this.SOs.length; i++) {
                        if(this.SOs[i].warehouse.id == 0) {
                            this.SOs[i].warehouse = { id: 0 };
                        } else {
                            this.SOs[i].warehouse = _.find(this.warehouseDDL, function(warehouse) {
                                return warehouse.id == vm.SOs[i].warehouse.id
                            });
                        }

                        if(this.SOs[i].vendorTrucking.id == 0) {
                            this.SOs[i].vendorTrucking = { id: 0, name: '' };
                        } else {
                            this.SOs[i].vendorTrucking = _.find(this.vendorTruckingDDL, function(vendorTrucking) {
                                return vendorTrucking.id == vm.SOs[i].vendorTrucking.id
                            });
                        }
                    }
                }
            },
            methods: {
                validateBeforeSubmit: function(type) {
                    this.$validator.validateAll().then(function(result) {
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.so.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#soForm')[0]))
                            .then(function(response) {

                            });
                    }).catch(function() {

                    });
                },
                saveDraft: function(soIndex) {

                },
                onChangeCustomerType: function(soIndex) {
                    var vm = this;

                    if(!this.SOs[soIndex].customer_type.code) {
                        vm.SOs[soIndex].customer_type = this.defaultCustomerType;
                    } else {
                        var ct = _.find(this.customerTypeDDL, { code: vm.SOs[soIndex].customer_type.code });
                        _.merge(vm.SOs[soIndex].customer_type, ct);
                    }
                },
                onSelectCustomer: function(soIndex) {
                    var vm = this;

                    if(!this.SOs[soIndex].customer.id) {
                        vm.SOs[soIndex].customer = { id: '' };
                    } else {
                        axios.get('{{ route('api.get.customer') }}' + '?api_token=' + $('#secapi').val(), { params: { id: vm.SOs[soIndex].customer.id } })
                            .then(function(response) {
                                _.merge(vm.SOs[soIndex].customer, response.data);
                            });
                    }
                },
                showCustomerPopup: function(soIndex) {
                    var vm = this;

                    this.customerPopupData.customer = { };
                    this.customerPopupData.customer = _.cloneDeep(vm.SOs[soIndex].customer);
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
                discountTotal: function (index) {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.SOs[index].items, function (item, key) {
                        _.forEach(item.discounts, function (discount) {
                            result += parseFloat(discount.disc_value);
                        });
                    });
                    return result;
                },
                setSOCode: function(so){
                    axios.get('{{ route('api.get.so.code') }}').then(function(data){
                        so.so_code = data.data;
                    });
                },
                insertTab: function(SOs){
                    var vm = this;

                    var so = {
                        disc_percent : 0,
                        disc_value : 0,
                        so_code: '',
                        customer_type: { code: '' },
                        customer: {
                            id: '',
                            price_level: { name: '' }
                        },
                        sales_type: {
                            code: ''
                        },
                        warehouse: {
                            id: ''
                        },
                        vendorTrucking: {
                            id: '', name: ''
                        },
                        product: { id: '' },
                        stock: { id: '' },
                        items : [],
                        expenses: []
                    };

                    vm.setSOCode(so);
                    this.SOs.push(so);
                },
                grandTotal: function (index) {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.SOs[index].items, function (item, key) {
                        result += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });
                    return result;
                },
                expenseTotal: function (index) {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.SOs[index].expenses, function (expense, key) {
                        if(expense.type.code === 'EXPENSETYPE.ADD')
                            result += parseInt(numeral().unformat(expense.amount));
                        else
                            result -= parseInt(numeral().unformat(expense.amount));
                    });
                    return result;
                },
                discountTotalPercentToNominal: function(index){
                    var vm = this;

                    var grandTotal = 0;
                    _.forEach(vm.SOs[index].items, function (item, key) {
                        grandTotal += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });

                    var discountTotal = 0;
                    _.forEach(vm.SOs[index].items, function (item, key) {
                        _.forEach(item.discounts, function (discount) {
                            discountTotal += parseFloat(discount.disc_value);
                        });
                    });

                    var expenseTotal = 0;
                    _.forEach(vm.SOs[index].expenses, function (expense, key) {
                        if (expense.type.code === 'EXPENSETYPE.ADD')
                            expenseTotal += parseInt(numeral().unformat(expense.amount));
                        else
                            expenseTotal -= parseInt(numeral().unformat(expense.amount));
                    });

                    var disc_value = ( ( grandTotal - discountTotal ) + expenseTotal ) * ( vm.SOs[index].disc_percent / 100 );
                    if( disc_value % 1 !== 0 )
                        disc_value = disc_value.toFixed(2);
                    vm.SOs[index].disc_value = disc_value;
                },
                discountTotalNominalToPercent: function(index){
                    var vm = this;

                    var grandTotal = 0;
                    _.forEach(vm.SOs[index].items, function (item, key) {
                        grandTotal += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });

                    var discountTotal = 0;
                    _.forEach(vm.SOs[index].items, function (item, key) {
                        _.forEach(item.discounts, function (discount) {
                            discountTotal += parseFloat(discount.disc_value);
                        });
                    });

                    var expenseTotal = 0;
                    _.forEach(vm.SOs[index].expenses, function (expense, key) {
                        if (expense.type.code === 'EXPENSETYPE.ADD')
                            expenseTotal += parseInt(numeral().unformat(expense.amount));
                        else
                            expenseTotal -= parseInt(numeral().unformat(expense.amount));
                    });

                    var disc_percent = vm.SOs[index].disc_value / ( ( grandTotal - discountTotal ) + expenseTotal ) * 100 ;
                    if( disc_percent % 1 !== 0 )
                        disc_percent = disc_percent.toFixed(2);
                    vm.SOs[index].disc_percent = disc_percent;
                },
                insertProduct: function (index, product) {
                    var vm = this;
                    if(product.id != ''){
                        var item_init_discount = [];
                        item_init_discount.push({
                            disc_percent : 0,
                            disc_value : 0,
                        });
                        vm.SOs[index].items.push({
                            stock_id: 0,
                            product: _.cloneDeep(product),
                            selected_unit: {
                                id: '',
                                unit: {
                                    id: ''
                                },
                                conversion_value: 1
                            },
                            base_unit: _.cloneDeep(_.find(product.product_units, function(unit) {
                                return unit.is_base == 1
                            })),
                            quantity: 0,
                            price: 0,
                            discounts: item_init_discount,
                        });
                    }
                },
                insertStock: function (index, stock) {
                    var vm = this;
                    if(stock.id != ''){
                        var stock_price = _.find(stock.today_prices, function (price) {
                            return price.price_level_id === vm.SOs[index].customer.price_level_id;
                        });
                        var item_init_discount = [];
                        item_init_discount.push({
                            disc_percent : 0,
                            disc_value : 0,
                        });

                        vm.SOs[index].items.push({
                            stock_id: stock.id,
                            product: _.cloneDeep(stock.product),
                            selected_unit: {
                                unit: {
                                    id: ''
                                },
                                conversion_value: 1
                            },
                            base_unit: _.cloneDeep(_.find(stock.product.product_units, function(unit) { return unit.is_base == 1 })),
                            quantity: 0,
                            price: stock_price ? stock_price.price : 0,
                            discounts: item_init_discount,
                        });
                    }
                },
                removeItem: function (SOIndex, index) {
                    this.SOs[SOIndex].items.splice(index, 1);
                },
                insertDiscount: function (item) {
                    item.discounts.push({
                        disc_percent : 0,
                        disc_value : 0,
                    });
                },
                removeDiscount: function (SOIndex, index, discountIndex) {
                    var vm = this;
                    this.SOs[SOIndex].items[index].discounts.splice(discountIndex, 1);
                },
                insertDefaultExpense: function (SOIndex, customer) {
                    var vm = this;
                    if(customer.id != ''){
                        vm.SOs[SOIndex].expenses = [];
                        for(var i = 0; i < customer.expense_templates.length; i++){
                            vm.SOs[SOIndex].expenses.push({
                                name: customer.expense_templates[i].name,
                                type: {
                                    code: customer.expense_templates[i].type,
                                    description: _.find(expenseTypes, function(expenseType){ return expenseType.code === customer.expense_templates[i].type})
                                },
                                is_internal_expense: customer.expense_templates[i].is_internal_expense == 1,
                                amount: numeral(customer.expense_templates[i].amount).format('0,0'),
                                remarks: customer.expense_templates[i].remarks
                            });
                        }
                    }
                    else{
                        vm.SOs[SOIndex].expenses = [];
                    }
                },
                insertExpense: function (index) {
                    var vm = this;
                    this.SOs[index].expenses.push({
                        name: '',
                        type: {
                            code: ''
                        },
                        is_internal_expense: false,
                        amount: 0,
                        remarks: ''
                    });
                },
                removeExpense: function (SOIndex, index) {
                    this.SOs[SOIndex].expenses.splice(index, 1);
                },
            },
            computed: {
                defaultCustomerType: function() {
                    return {
                        code: ''
                    };
                },
                defaultSalesType: function() {
                    return {
                        code: ''
                    };
                },
                defaultVendorTrucking: function() {
                    return {
                        id: '', name: ''
                    };
                },
                defaultWarehouse: function() {
                    return {
                        id: ''
                    };
                }
            }
        });
    </script>
@endsection
