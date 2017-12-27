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
    <div id="soVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="soForm" class="form-horizontal">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li v-for="(so, soIndex) in SOs" v-bind:class="{ 'active': soIndex === SOs.length - 1 }">
                                <a v-bind:href="'#tab_so_' + soIndex" data-toggle="tab">
                                    <div v-cloak>
                                        @{{ so.customer_type.code == 'CUSTOMERTYPE.R' ? so.customer.name || (defaultTabLabel + " " + (soIndex + 1))
                                        : so.customer_type.code == 'CUSTOMERTYPE.WI' ? so.walk_in_cust || (defaultTabLabel + " " + (soIndex + 1))
                                        : (defaultTabLabel + " " + (soIndex + 1)) }}
                                        <span v-show="errors.any('tab_' + soIndex)" class="red-asterisk">*</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <button type="button" class="btn btn-xs btn-default pull-right" v-on:click="insertTab(SOs)">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div v-for="(so, soIndex) in SOs" v-bind:class="{active: soIndex === SOs.length - 1}"
                                 class="tab-pane" v-bind:id="'tab_so_' + soIndex">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-info">
                                            <div class="box-body">
                                                <button id="draftButton" type="button" name="draft" v-bind:value="soIndex" class="btn btn-xs btn-primary pull-right"
                                                        v-on:click="saveDraft(soIndex)">
                                                    <span class="fa fa-save fa-fw"></span>&nbsp;Save as Draft
                                                </button>
                                                <input type="hidden" name="sId" value="{{ Session::getId() }}">
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
                                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_' + soIndex + '.' + 'customer_type_' + soIndex) }">
                                                    <label v-bind:for="'inputCustomerType_' + ( soIndex + 1)" class="col-sm-2 control-label">@lang('sales_order.create.field.customer_type')</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control"
                                                                name="customer_type[]"
                                                                v-bind:id="'inputCustomerType_' + soIndex"
                                                                v-validate="'required'"
                                                                v-model="so.customer_type.code"
                                                                v-on:change="onChangeCustomerType(soIndex)"
                                                                v-bind:data-vv-as="'{{ trans('sales_order.create.field.customer_type') }} ' + (soIndex + 1)"
                                                                v-bind:data-vv-name="'customer_type_' + soIndex"
                                                                v-bind:data-vv-scope="'tab_' + soIndex">
                                                            <option v-bind:value="defaultCustomerType.code">@lang('labels.PLEASE_SELECT')</option>
                                                            <option v-for="customerType in customerTypeDDL" v-bind:value="customerType.code">@{{ customerType.i18nDescription }}</option>
                                                        </select>
                                                        <span v-show="errors.has('tab_' + soIndex + '.' + 'customer_type_' + soIndex)" class="help-block" v-cloak>@{{ errors.first('tab_' + soIndex + '.' + 'customer_type_' + soIndex) }}</span>
                                                    </div>
                                                </div>
                                                <template v-if="so.customer_type.code == 'CUSTOMERTYPE.R'">
                                                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('customer_id_' + soIndex) }">
                                                        <label v-bind:for="'inputCustomerId_' + soIndex" class="col-sm-2 control-label">@lang('sales_order.create.field.customer_name')</label>
                                                        <div class="col-sm-8">
                                                            <select2_customer class="form-control" name="customer_id[]" v-bind:id="'customerSelect' + soIndex"
                                                                              v-validate="so.customer_type.code == 'CUSTOMERTYPE.R' ? 'required':''"
                                                                              v-model="so.customer.id" v-on:select="onSelectCustomer(soIndex)"
                                                                              v-bind:data-vv-as="'{{ trans('sales_order.create.field.customer_name') }} ' + soIndex"
                                                                              v-bind:data-vv-name="'customer_id_' + soIndex"
                                                                              v-bind:data-vv-scope="'tab_' + soIndex"></select2_customer>
                                                            <span v-show="errors.has('customer_id_' + soIndex)" class="help-block" v-cloak>@{{ errors.first('customer_id_' + soIndex) }}</span>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button v-bind:id="'customerDetailButton_' + soIndex" type="button" class="btn btn-primary btn-sm"
                                                                    data-toggle="modal" v-bind:data-target="'#customerDetailModal_' + soIndex">
                                                                <span class="fa fa-info-circle fa-lg"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </template>
                                                <template v-if="so.customer_type.code == 'CUSTOMERTYPE.WI'">
                                                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_' + soIndex + '.' + 'walk_in_customer_' + soIndex) }">
                                                        <label v-bind:for="'inputCustomerName_' + soIndex" class="col-sm-2 control-label">@lang('sales_order.create.field.customer_name')</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" v-bind:id="'inputCustomerName_' + soIndex"
                                                                   name="walk_in_customer[]" placeholder="Customer Name" v-validate="so.customer_type.code == 'CUSTOMERTYPE.WI' ? 'required':''"
                                                                   v-model="so.walk_in_cust" v-bind:data-vv-as="'{{ trans('sales_order.create.field.customer_name') }} ' + (soIndex + 1)"
                                                                   v-bind:data-vv-name="'walk_in_customer_' + soIndex" v-bind:data-vv-scope="'tab_' + soIndex">
                                                            <span v-show="errors.has('tab_' + soIndex + '.' + 'walk_in_customer_' + soIndex)" class="help-block" v-cloak>@{{ errors.first('tab_' + soIndex + '.' + 'walk_in_customer_' + soIndex) }}</span>
                                                        </div>
                                                    </div>
                                                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_' + soIndex + '.' + 'walk_in_customer_details_' + soIndex) }">
                                                        <label v-bind:for="'inputCustomerDetails_' + soIndex" class="col-sm-2 control-label">@lang('sales_order.create.field.customer_details')</label>
                                                        <div class="col-sm-10">
                                                                <textarea v-bind:id="'inputCustomerDetails_' + soIndex" class="form-control" rows="5" name="walk_in_customer_details[]"
                                                                          v-validate="so.customer_type.code == 'CUSTOMERTYPE.WI' ? 'required':''"
                                                                          v-model="so.walk_in_cust_details" v-bind:data-vv-as="'{{ trans('sales_order.create.field.customer_details') }} ' + (soIndex + 1)"
                                                                          v-bind:data-vv-name="'walk_in_customer_details_' + soIndex" v-bind:data-vv-scope="'tab_' + soIndex"></textarea>
                                                            <span v-show="errors.has('tab_' + soIndex + '.' + 'walk_in_customer_details_' + soIndex)" class="help-block" v-cloak>@{{ errors.first('tab_' + soIndex + '.' + 'walk_in_customer_details_' + soIndex) }}</span>
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
                                                    <label v-bind:for="'inputSoCode_' + soIndex" class="col-sm-3 control-label">@lang('sales_order.create.so_code')</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" v-bind:id="'inputSoCode_' + soIndex"
                                                               name="so_code[]" placeholder="SO Code" readonly v-model="so.so_code">
                                                    </div>
                                                </div>
                                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('sales_type_' + soIndex) }">
                                                    <label v-bind:for="'inputSoType_' + soIndex" class="col-sm-3 control-label">@lang('sales_order.create.so_type')</label>
                                                    <div class="col-sm-9">
                                                        <select v-bind:id="'inputSoType_' + soIndex" class="form-control" name="sales_type[]"
                                                                v-validate="'required'" v-model="so.sales_type.code"
                                                                v-bind:data-vv-as="'{{ trans('sales_order.create.so_type') }} ' + (soIndex + 1)"
                                                                v-bind:data-vv-name="'sales_type_' + soIndex">
                                                            <option v-bind:value="defaultSalesType.code">@lang('labels.PLEASE_SELECT')</option>
                                                            <option v-for="salesType in soTypeDDL" v-bind:value="salesType.code">@{{ salesType.i18nDescription }}</option>
                                                        </select>
                                                        <span v-show="errors.has('sales_type_' + soIndex)" class="help-block" v-cloak>@{{ errors.first('sales_type_' + soIndex) }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label v-bind:for="'inputSoDate_' + soIndex" class="col-sm-3 control-label">@lang('sales_order.create.so_date')</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <vue-datetimepicker v-bind:id="'inputSoDate_' + soIndex" name="so_created[]" value="" v-model="so.so_created" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label v-bind:for="'inputSoStatus_' + soIndex" class="col-sm-3 control-label">@lang('sales_order.create.so_status')</label>
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
                                                    <label v-bind:for="'inputShippingDate_' + soIndex" class="col-sm-3 control-label">@lang('sales_order.create.field.shipping_date')</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group date">
                                                            <div class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                            <vue-datetimepicker v-bind:id="'inputShippingDate_' + soIndex" name="shipping_date[]" value="" v-model="so.shipping_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_' + soIndex + '.' + 'warehouse_id_' + soIndex) }">
                                                    <label v-bind:for="'inputWarehouse_' + soIndex" class="col-sm-3 control-label">@lang('sales_order.create.field.warehouse')</label>
                                                    <div class="col-sm-9">
                                                        <select v-bind:id="'inputWarehouse_' + soIndex" class="form-control" name="warehouse_id[]"
                                                                v-validate="'required'"
                                                                v-model="so.warehouse.id"
                                                                v-bind:data-vv-as="'{{ trans('sales_order.create.field.warehouse') }} ' + (soIndex + 1)"
                                                                v-bind:data-vv-name="'warehouse_id_' + soIndex"
                                                                v-bind:data-vv-scope="'tab_' + soIndex">
                                                            <option v-bind:value="defaultWarehouse.id">@lang('labels.PLEASE_SELECT')</option>
                                                            <option v-for="warehouse in warehouseDDL" v-bind:value="warehouse.id">@{{warehouse.name}}</option>
                                                        </select>
                                                        <span v-show="errors.has('tab_' + soIndex + '.' + 'warehouse_id_' + soIndex)" class="help-block" v-cloak>@{{ errors.first('tab_' + soIndex + '.' + 'warehouse_id_' + soIndex) }}</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label v-bind:for="'inputVendorTrucking_' + soIndex" class="col-sm-3 control-label">@lang('sales_order.create.field.vendor_trucking')</label>
                                                    <div class="col-sm-9">
                                                        <select v-bind:id="'inputVendorTrucking_' + soIndex"
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
                                                            <select v-bind:id="'inputProduct_' + soIndex"
                                                                    class="form-control"
                                                                    v-model="so.product"
                                                                    v-on:change="insertProduct(soIndex, so.product)">
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
                                                            <select v-bind:id="'inputStock_' + soIndex"
                                                                    class="form-control"
                                                                    v-model="so.stock"
                                                                    v-on:change="insertStock(soIndex, so.stock)">
                                                                <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                                <option v-for="stock in validStock(soIndex)" v-bind:value="stock">@{{ stock.product.name }} [@{{ stock.current_quantity }}]</option>
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
                                                        <table v-bind:id="'itemsListTable_' + soIndex" class="table table-bordered table-hover">
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
                                                                    <td class="valign-middle">
                                                                        <input type="hidden" v-bind:name="'so_' + soIndex + '_product_id[]'" v-bind:value="item.product.id">
                                                                        <input type="hidden" v-bind:name="'so_' + soIndex + '_stock_id[]'" v-bind:value="item.stock_id">
                                                                        <input type="hidden" v-bind:name="'so_' + soIndex + '_base_unit_id[]'" v-bind:value="item.base_unit.unit.id">
                                                                        @{{ item.product.name }}
                                                                    </td>
                                                                    <td v-bind:class="{ 'has-error':errors.has('tab_' + soIndex + '.' + 'so_' + soIndex + '_quantity_' + soIndex) }">
                                                                        <input type="text" class="form-control text-right" v-bind:name="'so_' + soIndex + '_quantity[]'"
                                                                               v-model="item.quantity" v-validate="'required|decimal:2|min_value:1|max_value:' + item.current_quantity"
                                                                               v-bind:data-vv-as="'{{ trans('sales_order.create.table.item.header.quantity') }} ' + (soIndex + 1)"
                                                                               v-bind:data-vv-name="'so_' + soIndex + '_quantity_' + soIndex"
                                                                               v-bind:data-vv-scope="'tab_' + soIndex">
                                                                    </td>
                                                                    <td v-bind:class="{ 'has-error':errors.has('tab_' + soIndex + '.' + 'so_' + soIndex + '_unit_' + soIndex) }">
                                                                        <select name="selected_unit_id[]"
                                                                                class="form-control"
                                                                                v-model="item.selected_unit.id"
                                                                                v-validate="'required'"
                                                                                v-bind:data-vv-as="'{{ trans('sales_order.create.table.item.header.unit') }} ' + (soIndex + 1)"
                                                                                v-bind:data-vv-name="'so_' + soIndex + '_unit_' + soIndex"
                                                                                v-bind:data-vv-scope="'tab_' + soIndex"
                                                                                v-on:change="onChangeUnit(soIndex, itemIndex)">
                                                                            <option v-bind:value="defaultProductUnit.id">@lang('labels.PLEASE_SELECT')</option>
                                                                            <option v-for="product_unit in item.product.product_units" v-bind:value="product_unit.id">@{{ product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' }}</option>
                                                                        </select>
                                                                    </td>
                                                                    <td v-bind:class="{ 'has-error':errors.has('tab_' + soIndex + '.' + 'so_' + soIndex + '_price_' + soIndex) }">
                                                                        <input type="text" class="form-control text-right" v-bind:name="'so_' + soIndex + '_price[]'"
                                                                               v-model="item.price" v-validate="'required|decimal:2|min_value:1'"
                                                                               v-bind:data-vv-as="'{{ trans('sales_order.create.table.item.header.price_unit') }} ' + (soIndex + 1)"
                                                                               v-bind:data-vv-name="'so_' + soIndex + '_price_' + soIndex"
                                                                               v-bind:data-vv-scope="'tab_' + soIndex">
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <button type="button" class="btn btn-danger btn-md"
                                                                                v-on:click="removeItem(soIndex, itemIndex)"><span class="fa fa-minus"/>
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
                                                        <table v-bind:id="'itemsTotalListTable_' + soIndex" class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="80%" class="text-right">@lang('sales_order.create.table.total.body.total')</td>
                                                                    <td width="20%" class="text-right">
                                                                        <span class="control-label-normal">@{{ numbro(grandTotal(soIndex)).format() }}</span>
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
                                                        <table v-bind:id="'discountsListTable_' + soIndex" class="table table-bordered table-hover">
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
                                                                            <button type="button" class="btn btn-danger btn-md" v-on:click="removeDiscount(soIndex, itemIndex, discountIndex)">
                                                                                <span class="fa fa-minus"></span>
                                                                            </button>
                                                                        </td>
                                                                        <td width="10%">
                                                                            <input type="text" class="form-control text-right" v-bind:name="'so_' + soIndex + '_item_disc_percent['+itemIndex+'][]'"
                                                                                   v-model="discount.disc_percent" placeholder="%"
                                                                                   v-on:keyup="discountPercentToNominal(item, discount)"/>
                                                                        </td>
                                                                        <td width="25%">
                                                                            <input type="text" class="form-control text-right" v-bind:name="'so_' + soIndex + '_item_disc_value['+itemIndex+'][]'"
                                                                                   v-model="discount.disc_value" placeholder="Nominal"
                                                                                   v-on:keyup="discountNominalToPercent(item, discount)"/>
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
                                                                        <span class="control-label-normal">@{{ numbro(discountTotal(soIndex)).format() }}</span>
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
                                                        <table v-bind:id="'expensesListTable_' + soIndex" class="table table-bordered table-hover">
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
                                                                        <vue-iCheck name="'so_' + soIndex + '_is_internal_expense[]'" v-model="expense.is_internal_expense"></vue-iCheck>
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
                                                                               v-model="expense.amount" v-validate="'required|decimal:2'"/>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table v-bind:id="'expensesTotalListTable_' + soIndex" class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="80%"
                                                                        class="text-right">@lang('sales_order.create.table.total.body.total')</td>
                                                                    <td width="20%" class="text-right">
                                                                        <span class="control-label-normal">@{{ numbro(expenseTotal(soIndex)).format() }}</span>
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
                                                                    <td class="text-right valign-middle">@{{ numbro( ( grandTotal(soIndex) - discountTotal(soIndex) ) + expenseTotal(soIndex) ).format() }}</td>
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
                                                                    <td class="text-right valign-middle">@{{ numbro( ( grandTotal(soIndex) - discountTotal(soIndex) ) + expenseTotal(soIndex) - so.disc_value ).format() }}</td>
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
                                    <div class="col-md-5">
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">@lang('sales_order.create.box.transaction_summary')</h3>
                                            </div>
                                            <div class="box-body">
                                                <div class="col-xs-12">
                                                    <div class="box">
                                                        <div class="box-header text-center">
                                                            <template v-if="so.customer_type.code == 'CUSTOMERTYPE.R'">
                                                            <h4>@{{ so.customer.name }}</h4>
                                                            </template>

                                                            <template v-if="so.customer_type.code == 'CUSTOMERTYPE.WI'">
                                                            <h4>@{{ so.walk_in_cust }}</h4>
                                                            </template>
                                                        </div>

                                                        <div class="box-body table-responsive">
                                                            <table class="table">
                                                                <tr>
                                                                    <td>@lang('sales_order.create.so_date')</td>
                                                                    <td class="text-right">@{{ so.so_created }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('sales_order.create.field.shipping_date')</td>
                                                                    <td class="text-right">@{{ so.shipping_date }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('sales_order.create.so_code')</td>
                                                                    <td class="text-right">@{{ so.so_code }}</td>
                                                                </tr>
                                                            </table>

                                                            <hr>

                                                            <table class="table table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>@lang('sales_order.create.table.item.header.product_name')</th>
                                                                        <th>@lang('sales_order.create.table.item.header.quantity')</th>
                                                                        <th>@lang('sales_order.create.table.item.header.price_unit')</th>
                                                                        <th>@lang('sales_order.create.table.item.header.total_price')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <template v-for="(item, itemIndex) in so.items">
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
                                                                        <td class="text-right"><b>@lang('sales_order.create.table.item.header.total_price')</b></td>
                                                                        <td class="text-right">@{{ numbro(grandTotal(soIndex)).format() }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-right"><b>@lang('purchase_order.create.table.total.body.total_discount')</b></td>
                                                                        <td class="text-right">@{{ numbro(discountTotal(soIndex)).format() }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-right"><b>@lang('sales_order.create.box.expenses')</b></td>
                                                                        <td class="text-right">@{{ numbro(expenseTotal(soIndex)).format() }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-right"><b>@lang('purchase_order.create.box.discount_transaction')</b></td>
                                                                        <td class="text-right">@{{ numbro(so.disc_value).format() }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-right"><b>@lang('purchase_order.create.table.total.body.total_transaction')</b></td>
                                                                        <td class="text-right">@{{ numbro( ( grandTotal(soIndex) - discountTotal(soIndex) ) + expenseTotal(soIndex) - so.disc_value ).format() }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="box box-info" v-if="so.customer.last_sale">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">@lang('sales_order.create.box.last_sale')</h3>
                                            </div>
                                            <div class="box-body">
                                                <table class="table">
                                                    <tr>
                                                        <td>@lang('sales_order.create.table.open_sales.header.code')</td>
                                                        <td class="text-right">@{{ so.customer.last_sale.code }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('sales_order.create.table.open_sales.header.so_date')</td>
                                                        <td class="text-right">@{{ so.customer.last_sale.so_created }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('sales_order.create.table.open_sales.header.status')</td>
                                                        <td class="text-right">@{{ so.customer.last_sale.status_localized }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('sales_order.create.table.open_sales.header.amount')</td>
                                                        <td class="text-right">@{{ so.customer.last_sale.total_amount_text }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">@lang('sales_order.create.box.open_sales')</h3>
                                            </div>
                                            <div class="box-body">
                                                    <table v-bind:id="'openSalesTable_' + soIndex" class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">@lang('sales_order.create.table.open_sales.header.code')</th>
                                                                <th class="text-center">@lang('sales_order.create.table.open_sales.header.so_date')</th>
                                                                <th class="text-center">@lang('sales_order.create.table.open_sales.header.status')</th>
                                                                <th class="text-center">@lang('sales_order.create.table.open_sales.header.amount')</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(openSale, openSaleIndex) in so.customer.open_sales">
                                                                <td>@{{ openSale.code }}</td>
                                                                <td>@{{ openSale.so_created }}</td>
                                                                <td>@{{ openSale.status_localized }}</td>
                                                                <td class="text-right">@{{ openSale.total_amount_text }}</td>
                                                            </tr>
                                                            <tr v-if="!so.customer.open_sales || !so.customer.open_sales.length">
                                                                <td colspan="4" class="text-center">@lang('labels.DATA_NOT_FOUND')</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                            </div>
                                        </div>
                                        <div class="box box-info" v-if="so.sales_type.code === 'SOTYPE.S' || so.sales_type.code === 'SOTYPE.AC'">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">@lang('sales_order.create.box.latest_prices')</h3>
                                            </div>
                                            <div class="box-body">
                                                <table v-bind:id="'latestPricesTable_' + soIndex" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">@lang('sales_order.create.table.latest_prices.header.product_name')</th>
                                                            <th class="text-center">@lang('sales_order.create.table.latest_prices.header.market_price')</th>
                                                            <th class="text-center">@lang('sales_order.create.table.latest_prices.header.latest_price')</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(item, itemIndex) in so.items" v-bind:class="{ 'danger': (item.price < item.market_price), 'warning': ((item.market_price <= item.price) * (item.price < item.latest_price)) }">
                                                            <td>@{{ item.product.name }}</td>
                                                            <td class="text-right">@{{ numbro(item.market_price).format() }}</td>
                                                            <td class="text-right">@{{ numbro(item.latest_price).format() }}</td>
                                                        </tr>
                                                        <tr v-if="!so.items || !so.items.length">
                                                            <td colspan="2" class="text-center">@lang('labels.DATA_NOT_FOUND')</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
                                                <div>
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation" class="active">
                                                            <a v-bind:href="'#tab_remarks_' + soIndex" aria-controls="tab_remarks" role="tab" data-toggle="tab">@lang('sales_order.create.tab.remarks')</a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a v-bind:href="'#tab_internal_' + soIndex" aria-controls="tab_internal" role="tab" data-toggle="tab">@lang('sales_order.create.tab.internal')</a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a v-bind:href="'#tab_private_' + soIndex" aria-controls="tab_private" role="tab" data-toggle="tab">@lang('sales_order.create.tab.private')</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane active" v-bind:id="'tab_remarks_' + soIndex">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12">
                                                                            <textarea v-bind:id="'inputRemarks_' + soIndex" name="remarks" class="form-control" rows="5" v-model="so.remarks"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane" v-bind:id="'tab_internal_' + soIndex">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="col-sm-12">
                                                                            <textarea v-bind:id="'inputInternalRemarks_' + soIndex" name="internal_remarks" class="form-control" rows="5"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane" v-bind:id="'tab_private_' + soIndex">
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
                                    <div class="col-md-7 col-offset-md-5">
                                        <div class="btn-toolbar">
                                            <button type="button" class="btn btn-primary pull-right"
                                                    v-bind:id="'submitButton_' + soIndex" v-bind:value="soIndex" v-on:click="submitSales(soIndex)">@lang('buttons.submit_button')</button>&nbsp;&nbsp;&nbsp;
                                            <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                                            <button type="button" class="cancelButton btn btn-primary pull-right"
                                                    v-bind:id="'cancelButton_' + soIndex" v-bind:value="soIndex" v-on:click="cancelSales(soIndex)">@lang('buttons.cancel_button')</button>
                                        </div>
                                    </div>
                                </div>

                                @include('sales_order.customer_details_partial')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="text/javascript">
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
                defaultTabLabel: ''
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
                saveDraft: function(soIndex) {
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.so.create.savedraft') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#soForm')[0]))
                            .then(function(response) {
                                $('#loader-container').fadeOut('slow');
                                new noty({
                                    layout: 'topRight',
                                    text: 'Draft Updated.',
                                    type: 'success',
                                    theme: 'relax',
                                    timeout: 3000,
                                    progressBar: true
                                }).show();
                            });
                    }).catch(function() {

                    });
                },
                submitSales: function(soIndex) {
                    var vm = this;
                    this.$validator.validateAll('tab_' + soIndex).then(function(isValid) {
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.so.create') }}' + '?api_token=' + $('#secapi').val(), vm.SOs[soIndex])
                            .then(function(response) {
                                if (vm.SOs.length == 1) {
                                    window.location.href = '{{ route('db') }}';
                                } else {
                                    vm.SOs.splice(soIndex, 1);
                                    $('#loader-container').fadeOut('slow');
                                    new noty({
                                        layout: 'topRight',
                                        text: 'Sales Order Created.',
                                        type: 'success',
                                        theme: 'relax',
                                        timeout: 5000,
                                        progressBar: true
                                    }).show();
                                }
                            }).catch(function (e) {
                                $('#loader-container').fadeOut('slow');
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
                    }).catch(function() {

                    });
                },
                cancelSales: function(soIndex) {
                    if (soIndex == 0) {
                        window.location.href = '{{ route('db') }}';
                    } else {
                        this.SOs.splice(soIndex, 1);
                    }
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
                                vm.SOs[soIndex].customer = response.data;
                                return axios.get('{{ route('api.get.customer.last_sale') }}' + '?api_token=' + $('#secapi').val(), { params: { id: vm.SOs[soIndex].customer.id } });
                            }).then(function (response) {
                                vm.$set(vm.SOs[soIndex].customer, 'last_sale', response.data);
                                return axios.get('{{ route('api.get.customer.open_sales') }}' + '?api_token=' + $('#secapi').val(), { params: { id: vm.SOs[soIndex].customer.id } });
                            }).then(function (response) {
                                vm.$set(vm.SOs[soIndex].customer, 'open_sales', response.data);
                            });
                    }
                },
                onChangeUnit: function(soIndex, itemIndex) {
                    if (!this.SOs[soIndex].items[itemIndex].selected_unit.id) {
                        this.SOs[soIndex].items[itemIndex].selected_unit = this.defaultProductUnit;
                    } else {
                        var pUnit = _.find(this.SOs[soIndex].items[itemIndex].product.product_units, { id: this.SOs[soIndex].items[itemIndex].selected_unit.id });
                        _.merge(this.SOs[soIndex].items[itemIndex].selected_unit, pUnit);
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
                        so_created: '',
                        shipping_date: '',
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
                        expenses: [],
                        remarks: '',
                        internal_remarks: '',
                        private_remarks: ''
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
                            result += parseInt(numbro().unformat(expense.amount));
                        else
                            result -= parseInt(numbro().unformat(expense.amount));
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
                            expenseTotal += parseInt(numbro().unformat(expense.amount));
                        else
                            expenseTotal -= parseInt(numbro().unformat(expense.amount));
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
                            expenseTotal += parseInt(numbro().unformat(expense.amount));
                        else
                            expenseTotal -= parseInt(numbro().unformat(expense.amount));
                    });

                    var disc_percent = vm.SOs[index].disc_value / ( ( grandTotal - discountTotal ) + expenseTotal ) * 100 ;
                    if( disc_percent % 1 !== 0 )
                        disc_percent = disc_percent.toFixed(2);
                    vm.SOs[index].disc_percent = disc_percent;
                },
                insertProduct: function (index, product) {
                    var vm = this;
                    if(product.id != '') {
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

                        var latest_price = _.find(stock.latest_prices, function (price) {
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
                                id:'',
                                unit: {
                                    id: ''
                                },
                                conversion_value: 1
                            },
                            base_unit: _.cloneDeep(_.find(stock.product.product_units, function(unit) { return unit.is_base == 1 })),
                            quantity: 0,
                            current_quantity: stock.current_quantity,
                            price: stock_price ? stock_price.price : 0,
                            latest_price: latest_price ? latest_price.price : 0,
                            market_price: latest_price ? latest_price.market_price : 0,
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
                                amount: numbro(customer.expense_templates[i].amount).format('0,0'),
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
                validStock: function(soIndex) {
                    var vm = this;

                    if (vm.stocksDDL.length == 0) return [];
                    if (vm.SOs[soIndex].warehouse.id == undefined || vm.SOs[soIndex].warehouse.id == '') return [];

                    return _.filter(vm.stocksDDL, function(s) { return s.warehouse_id == vm.SOs[soIndex].warehouse.id });
                }
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
                },
                defaultProductUnit: function() {
                    return {
                        id: '',
                        unit: {
                            id: ''
                        },
                        conversion_value: 1
                    };
                }
            }
        });
    </script>
@endsection
