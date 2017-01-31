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
        <form class="form-horizontal" id="so-form" action="{{ route('db.so.create') }}" method="post" data-parsley-validate="parsley">
        {{ csrf_field() }}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li v-for="(so, soIndex) in SOs" v-bind:class="{active: soIndex === SOs.length - 1}">
                                    <a v-bind:href="'#tab_so_' + (soIndex + 1)" data-toggle="tab">
                                        @{{ so.customer_type.code == 'CUSTOMERTYPE.R' ? so.customer.name || (defaultTabLabel + " " + (soIndex + 1))
                                        : so.customer_type.code == 'CUSTOMERTYPE.WI' ? so.walk_in_cust || (defaultTabLabel + " " + (soIndex + 1))
                                        : (defaultTabLabel + " " + (soIndex + 1)) }}</a>
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
                                                    <button id="draftButton" type="submit" name="draft" value="draft" class="btn btn-xs btn-primary pull-right"><span class="fa fa-save fa-fw"></span>Save as Draft</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="box box-info">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">@lang('sales_order.create.box.customer')</h3>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label v-bind:for="'inputCustomerType_' + ( soIndex + 1)" class="col-sm-4 control-label">@lang('sales_order.create.field.customer_type')</label>
                                                                <div class="col-sm-6">
                                                                    <input type="hidden" name="customer_type[]" v-bind:value="so.customer_type.code">
                                                                    <select v-bind:id="'inputCustomerType_' + (soIndex + 1)" data-parsley-required="true"
                                                                            class="form-control"
                                                                            v-model="so.customer_type">
                                                                        <option v-bind:value="{code: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                                        <option v-for="customerType in customerTypeDDL" v-bind:value="customerType">@{{ customerType.description }}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div v-show="so.customer_type.code === 'CUSTOMERTYPE.R'">
                                                                <div class="form-group">
                                                                    <label v-bind:for="'inputCustomerId_' + (soIndex + 1)" class="col-sm-4 control-label">@lang('sales_order.create.field.customer_name')</label>
                                                                    <div class="col-sm-6">
                                                                        <select class="form-control" name="customer_id[]" v-bind:id="'customerSelect' + soIndex">
                                                                            <option></option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <button v-bind:id="'customerDetailButton_' + soIndex" type="button" class="btn btn-primary btn-sm"
                                                                                data-toggle="modal" v-bind:data-target="'#customerDetailModal_' + soIndex"><span
                                                                                    class="fa fa-info-circle fa-lg"></span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div v-show="so.customer_type.code === 'CUSTOMERTYPE.WI'">
                                                                <div class="form-group">
                                                                    <label v-bind:for="'inputCustomerName_' + (soIndex + 1)" class="col-sm-4 control-label">@lang('sales_order.create.field.customer_name')</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" v-bind:id="'inputCustomerName_' + (soIndex + 1)"
                                                                               name="walk_in_customer[]" placeholder="Customer Name"
                                                                               v-model="so.walk_in_cust">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label v-bind:for="'inputCustomerDetails_' + (soIndex + 1)" class="col-sm-4 control-label">@lang('sales_order.create.field.customer_details')</label>
                                                                    <div class="col-sm-8">
                                                                    <textarea v-bind:id="'inputCustomerDetails_' + (soIndex + 1)" class="form-control"
                                                                          rows="5" name="walk_in_customer_details[]"
                                                                          v-model="so.walk_in_cust_details"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                                    <input type="hidden" name="sales_type[]" v-bind:value="so.soType.code">
                                                                    <select v-bind:id="'inputSoType_' + (soIndex + 1)" data-parsley-required="true"
                                                                            class="form-control"
                                                                            v-model="so.soType">
                                                                        <option v-bind:value="{code: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                                        <option v-for="salesType in soTypeDDL" v-bind:value="salesType">@{{ salesType.description }}</option>
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
                                                                        <input type="text" class="form-control inputSoDate" v-bind:id="'inputSoDate_' + (soIndex + 1)"
                                                                               name="so_created[]" data-parsley-required="true">
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
                                                                <div class="col-sm-9">
                                                                    <div class="input-group date">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <input type="text" class="form-control inputShippingDate" v-bind:id="'inputShippingDate_' + (soIndex + 1)"
                                                                               name="shipping_date[]" data-parsley-required="true">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label v-bind:for="'inputWarehouse_' + (soIndex + 1)" class="col-sm-3 control-label">@lang('sales_order.create.field.warehouse')</label>
                                                                <div class="col-sm-9">
                                                                    <input type="hidden" name="warehouse_id[]" v-bind:value="so.warehouse.id">
                                                                    <select v-bind:id="'inputWarehouse_' + (soIndex + 1)" data-parsley-required="true"
                                                                            class="form-control"
                                                                            v-model="so.warehouse">
                                                                        <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                                        <option v-for="warehouse in warehouseDDL" v-bind:value="warehouse">@{{warehouse.name}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label v-bind:for="'inputVendorTrucking_' + (soIndex + 1)" class="col-sm-3 control-label">@lang('sales_order.create.field.vendor_trucking')</label>
                                                                <div class="col-sm-9">
                                                                    <input type="hidden" name="vendor_trucking_id[]" v-bind:value="so.vendorTrucking.id">
                                                                    <select v-bind:id="'inputVendorTrucking_' + (soIndex + 1)"
                                                                            class="form-control"
                                                                            v-model="so.vendorTrucking">
                                                                        <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                                        <option v-for="vendorTrucking in vendorTruckingDDL" v-bind:value="vendorTrucking">@{{ vendorTrucking.name }}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="box box-info">
                                                <div class="box-header with-border">
                                                </div>
                                                <div class="box-body">
                                                    @for ($i = 0; $i < 23; $i++)
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
                                                            <h3 class="box-title">@lang('sales_order.create.box.transactions')</h3>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="row">
                                                                <div v-show="so.soType.code === 'SOTYPE.SVC'">
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
                                                                <div v-show="so.soType.code === 'SOTYPE.S'">
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
                                                                            <input type="hidden" v-bind:name="'so_' + soIndex + '_product_id[]'" v-bind:value="item.product.id">
                                                                            <input type="hidden" v-bind:name="'so_' + soIndex + '_stock_id[]'" v-bind:value="item.stock_id">
                                                                            <input type="hidden" v-bind:name="'so_' + soIndex + '_base_unit_id[]'" v-bind:value="item.base_unit.unit.id">
                                                                            <td class="valign-middle">@{{ item.product.name }}</td>
                                                                            <td>
                                                                                <input type="text" class="form-control text-right" v-bind:name="'so_' + soIndex + '_quantity[]'"
                                                                                       v-model="item.quantity" data-parsley-required="true"
                                                                                       data-parsley-type="number">
                                                                            </td>
                                                                            <td>
                                                                                <input type="hidden" v-bind:name="'so_' + soIndex + '_selected_unit_id[]'" v-bind:value="item.selected_unit.unit.id">
                                                                                <select data-parsley-required="true" class="form-control"
                                                                                        v-model="item.selected_unit"
                                                                                        data-parsley-required="true">
                                                                                    <option v-bind:value="{unit: {id: ''}, conversion_value: 1}">@lang('labels.PLEASE_SELECT')</option>
                                                                                    <option v-for="product_unit in item.product.product_units" v-bind:value="product_unit">@{{ product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' }}</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control text-right" v-bind:name="'so_' + soIndex + '_price[]'"
                                                                                       v-model="item.price" data-parsley-required="true"
                                                                                       data-parsley-pattern="^\d+(,\d+)*$">
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <button type="button" class="btn btn-danger btn-md"
                                                                                        v-on:click="removeItem(soIndex, itemIndex)"><span class="fa fa-minus"/>
                                                                                </button>
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
                                                                    <table v-bind:id="'itemsTotalListTable_' + (soIndex + 1)" class="table table-bordered">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td width="80%"
                                                                                class="text-right">@lang('sales_order.create.table.total.body.total')</td>
                                                                            <td width="20%" class="text-right">
                                                                                <span class="control-label-normal">@{{ grandTotal(soIndex) }}</span>
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
                                                                            <th width="30%">@lang('sales_order.create.table.expense.header.name')</th>
                                                                            <th width="20%"
                                                                                class="text-center">@lang('sales_order.create.table.expense.header.type')</th>
                                                                            <th width="20%"
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
                                                                                       v-model="expense.name" data-parsley-required="true">
                                                                            </td>
                                                                            <td>
                                                                                <select v-bind:name="'so_' + soIndex + '_expense_type[]'" data-parsley-required="true"
                                                                                        class="form-control" v-model="expense.type">
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
                                                                    <table v-bind:id="'expensesTotalListTable_' + (soIndex + 1)" class="table table-bordered">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td width="80%"
                                                                                class="text-right">@lang('sales_order.create.table.total.body.total')</td>
                                                                            <td width="20%" class="text-right">
                                                                                <span class="control-label-normal">@{{ expenseTotal(soIndex)}}</span>
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
                                                    <h3 class="box-title">@lang('sales_order.create.box.remarks')</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <textarea v-bind:id="'inputRemarks_' + (soIndex + 1)" class="form-control" rows="5" name="remarks[]"
                                                                              v-model="so.remarks"></textarea>
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

                                    <div class="modal fade" v-bind:id="'customerDetailModal_' + soIndex" tabindex="-1" role="dialog"
                                         v-bind:aria-labelledby="'customerDetailModalLabel_' + soIndex">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" v-bind:id="'customerDetailModalLabel_' + soIndex">Customer Detail</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="nav-tabs-custom">
                                                        <ul class="nav nav-tabs">
                                                            <li class="active"><a v-bind:href="'#tab_customer_' + soIndex" data-toggle="tab">@lang('customer.show.tab.customer')</a></li>
                                                            <li><a v-bind:href="'#tab_pic_' + soIndex" data-toggle="tab">@lang('customer.show.tab.pic')</a></li>
                                                            <li><a v-bind:href="'#tab_bank_account_' + soIndex" data-toggle="tab">@lang('customer.show.tab.bank_account')</a></li>
                                                            <li><a v-bind:href="'#tab_expenses_' + soIndex" data-toggle="tab">@lang('customer.show.tab.expenses')</a></li>
                                                            <li><a v-bind:href="'#tab_settings_' + soIndex" data-toggle="tab">@lang('customer.show.tab.settings')</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" v-bind:id="'tab_customer_' + soIndex">
                                                                <div class="form-group">
                                                                    <label v-bind:for="'inputName_' + soIndex" class="col-sm-2 control-label">@lang('customer.field.name')</label>
                                                                    <div class="col-sm-10">
                                                                        <label v-bind:id="'inputName_' + soIndex" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.name }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label v-bind:for="'inputAddress_' + soIndex" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                                                    <div class="col-sm-10">
                                                                        <label v-bind:id="'inputAddress_' + soIndex" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.address }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label v-bind:for="'inputCity_' + soIndex" class="col-sm-2 control-label">@lang('customer.field.city')</label>
                                                                    <div class="col-sm-10">
                                                                        <label v-bind:id="'inputCity_' + soIndex" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.city }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label v-bind:for="'inputPhone_' + soIndex" class="col-sm-2 control-label">@lang('customer.field.phone')</label>
                                                                    <div class="col-sm-10">
                                                                        <label v-bind:id="'inputPhone_' + soIndex" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.phone }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label v-bind:for="'inputTaxId_' + soIndex" class="col-sm-2 control-label">@lang('customer.field.tax_id')</label>
                                                                    <div class="col-sm-10">
                                                                        <label v-bind:id="'inputTaxId_' + soIndex" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.tax_id }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label v-bind:for="'inputRemarks_' + soIndex" class="col-sm-2 control-label">@lang('customer.field.remarks')</label>
                                                                    <div class="col-sm-10">
                                                                        <label v-bind:id="'inputRemarks_' + soIndex" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.remarks }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" v-bind:id="'tab_pic_' + soIndex">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div v-for="(profile, profileIndex) in so.customer.profiles">
                                                                            <div class="box box-widget">
                                                                                <div class="box-header with-border">
                                                                                    <div class="user-block">
                                                                                        <strong>@lang('customer.field.person_in_charge') @{{ profileIndex + 1 }}</strong><br/>
                                                                                        &nbsp;&nbsp;&nbsp;@{{ profile.first_name }}&nbsp;@{{ profile.last_name }}
                                                                                    </div>
                                                                                    <div class="box-tools">
                                                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="box-body">
                                                                                    <div class="form-group">
                                                                                        <label v-bind:for="'inputFirstName_' + soIndex + '_' + profileIndex" class="col-sm-2 control-label">@lang('customer.field.first_name')</label>
                                                                                        <div class="col-sm-10">
                                                                                            <label v-bind:id="'inputFirstName_' + soIndex + '_' + profileIndex" class="control-label">
                                                                                                <span class="control-label-normal">@{{ profile.first_name }}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label v-bind:for="'inputLastName_' + soIndex + '_' + profileIndex" class="col-sm-2 control-label">@lang('customer.field.last_name')</label>
                                                                                        <div class="col-sm-10">
                                                                                            <label v-bind:id="'inputLastName_' + soIndex + '_' + profileIndex" class="control-label">
                                                                                                <span class="control-label-normal">@{{ profile.last_name }}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label v-bind:for="'inputAddress_' + soIndex + '_' + profileIndex" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                                                                        <div class="col-sm-10">
                                                                                            <label v-bind:id="'inputAddress_' + soIndex + '_' + profileIndex" class="control-label">
                                                                                                <span class="control-label-normal">@{{ profile.address }}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label v-bind:for="'inputICNum_' + soIndex + '_' + profileIndex" class="col-sm-2 control-label">@lang('customer.field.ic_num')</label>
                                                                                        <div class="col-sm-10">
                                                                                            <label v-bind:id="'inputICNum_' + soIndex + '_' + profileIndex" class="control-label">
                                                                                                <span class="control-label-normal">@{{ profile.ic_num }}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label v-bind:for="'inputPhoneNumber_' + soIndex + '_' + profileIndex" class="col-sm-2 control-label">@lang('customer.field.phone_number')</label>
                                                                                        <div class="col-sm-10">
                                                                                            <table class="table table-bordered">
                                                                                                <thead>
                                                                                                <tr>
                                                                                                    <th>@lang('customer.show.table_phone.header.provider')</th>
                                                                                                    <th>@lang('customer.show.table_phone.header.number')</th>
                                                                                                    <th>@lang('customer.show.table_phone.header.remarks')</th>
                                                                                                </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr v-for="phone in profile.phone_numbers">
                                                                                                        <td>@{{ phone.provider.name }}</td>
                                                                                                        <td>@{{ phone.number }}</td>
                                                                                                        <td>@{{ phone.remarks }}</td>
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
                                                            </div>
                                                            <div class="tab-pane" v-bind:id="'tab_bank_account_' + soIndex">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">@lang('customer.show.table_bank.header.bank')</th>
                                                                            <th class="text-center">@lang('customer.show.table_bank.header.account_number')</th>
                                                                            <th class="text-center">@lang('customer.show.table_bank.header.remarks')</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="ba in so.customer.bank_accounts">
                                                                            <td>@{{ ba.bank.name }}&nbsp;(@{{ ba.bank.name }})</td>
                                                                            <td>@{{ ba.account_number }}</td>
                                                                            <td>@{{ ba.remarks }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="tab-pane" v-bind:id="'tab_expenses_' + soIndex">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="text-center">@lang('customer.show.table_expense.header.name')</th>
                                                                        <th class="text-center">@lang('customer.show.table_expense.header.type')</th>
                                                                        <th class="text-center">@lang('customer.show.table_expense.header.amount')</th>
                                                                        <th class="text-center">@lang('customer.show.table_expense.header.internal_expense')</th>
                                                                        <th class="text-center">@lang('customer.show.table_expense.header.remarks')</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="et in so.customer.expense_templates">
                                                                            <td class="text-center valign-middle">
                                                                                @{{ et.name }}
                                                                            </td>
                                                                            <td class="text-center valign-middle">
                                                                                @{{ et.type }}
                                                                            </td>
                                                                            <td class="text-center valign-middle">
                                                                                @{{ et.amount }}
                                                                            </td>
                                                                            <td class="text-center valign-middle">
                                                                                <div v-if="et.is_internal_expense">
                                                                                    @lang('lookup.YESNOSELECT.YES')
                                                                                </div>
                                                                                <div v-if="!et.is_internal_expense">
                                                                                    @lang('lookup.YESNOSELECT.NO')
                                                                                </div>
                                                                            </td>
                                                                            <td class="valign-middle">
                                                                                @{{ et.remarks }}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="tab-pane" v-bind:id="'tab_settings_' + soIndex">
                                                                <div class="form-group">
                                                                    <label v-bind:for="'inputPriceLevel_' + soIndex" class="col-sm-2 control-label">@lang('customer.field.price_level')</label>
                                                                    <div class="col-sm-10">
                                                                        <label class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.price_level.name }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label v-bind:for="'inputPaymentDueDay_' + soIndex" class="col-sm-2 control-label">@lang('customer.field.payment_due_day')</label>
                                                                    <div class="col-sm-10">
                                                                        <label v-bind:id="'inputPaymentDueDay_' + soIndex" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.payment_due_day }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('buttons.close_button')</button>
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
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function () {
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
                defaultTabLabel: '@lang('sales_order.create.tab.sales')'
            },
            methods: {
                setSOCode: function(so){
                    this.$http.get('{{ route('api.so.code') }}').then(function(data){
                        so.so_code = data.data;
                    });
                },
                insertTab: function(SOs){
                    var vm = this;

                    if(!$("#so-form").parsley().validate()){
                        return;
                    }

                    var so = {
                        so_code: '',
                        customer_type: {
                            code: ''
                        },
                        customer: {
                            id: '',
                            price_level: {
                                name: ''
                            }
                        },
                        soType: {
                            code: ''
                        },
                        warehouse: {
                            id: ''
                        },
                        vendorTrucking: {
                            id: ''
                        },
                        product: {
                            id: ''
                        },
                        stock: {
                            id: ''
                        },
                        items : [],
                        expenses: []
                    };

                    vm.setSOCode(so);
                    SOs.push(so);

                    $(function () {
                        $(".inputSoDate").datetimepicker({
                            format: "DD-MM-YYYY hh:mm A",
                            defaultDate: moment()
                        });
                        $(".inputShippingDate").datetimepicker({
                            format: "DD-MM-YYYY hh:mm A",
                            defaultDate: moment()
                        });
                    });
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
                insertProduct: function (index, product) {
                    var vm = this;
                    if(product.id != ''){
                        vm.SOs[index].items.push({
                            stock_id: 0,
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
                insertStock: function (index, stock) {
                    var vm = this;
                    if(stock.id != ''){
                        var stock_price = _.find(stock.today_prices, function (price) {
                            return price.price_level_id === vm.SOs[index].customer.price_level_id;
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
                            base_unit: _.cloneDeep(_.find(stock.product.product_units, isBase)),
                            quantity: 0,
                            price: stock_price ? stock_price.price : 0
                        });
                    }
                },
                removeItem: function (SOIndex, index) {
                    this.SOs[SOIndex].items.splice(index, 1);
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
                                is_internal_expense: customer.expense_templates[i].is_internal_expense === 1,
                                amount: numeral(customer.expense_templates[i].amount).format('0,0'),
                                remarks: customer.expense_templates[i].remarks
                            });
                        }

                        $(function () {
                            $('input[type="checkbox"], input[type="radio"]').iCheck({
                                checkboxClass: 'icheckbox_square-blue',
                                radioClass: 'iradio_square-blue'
                            });
                        });
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

                    $(function () {
                        $('input[type="checkbox"], input[type="radio"]').iCheck({
                            checkboxClass: 'icheckbox_square-blue',
                            radioClass: 'iradio_square-blue'
                        });
                    });
                },
                removeExpense: function (SOIndex, index) {
                    this.SOs[SOIndex].expenses.splice(index, 1);
                },
            },
            updated: function(){
                var vm = this;
                for(var i = 0; i < vm.SOs.length; i++){
                    var index = i;
                    $("#customerSelect" + i).select2({
                        allowClear: true,
                        width: '100%',
                        data: [ vm.SOs[index].customer ],
                        ajax: {
                            url: function(params){
                                return '{{ route('api.customer.search') }}?q=' + params.term;
                            },
                            delay: 250,
                            dataType: 'json',
                            processResults: function (data, params) {
                                return {
                                    results: data
                                }
                            }
                        },
                        templateResult: function(customer){
                            return customer.name;
                        },
                        templateSelection: function(customer){
                            vm.SOs[index].customer = _.cloneDeep(customer);
                            return customer.name;
                        }
                    });
                    $("#customerSelect" + index).val(vm.SOs[index].customer.id).trigger('change');
                }

                $(function () {
                    $(".inputSoDate").datetimepicker({
                        format: "DD-MM-YYYY hh:mm A",
                        defaultDate: moment()
                    });
                    $(".inputShippingDate").datetimepicker({
                        format: "DD-MM-YYYY hh:mm A",
                        defaultDate: moment()
                    });
                });    
            }
        });

        if(soApp.SOs.length == 0){
            soApp.insertTab(soApp.SOs);
        }else{
            for(var i = 0; i < soApp.SOs.length; i++){
                var index = i;
                $("#customerSelect" + i).select2({
                    allowClear: true,
                    width: '100%',
                    data: [ vm.SOs[index].customer ],
                    ajax: {
                        url: function(params){
                            return '{{ route('api.customer.search') }}?q=' + params.term;
                        },
                        delay: 250,
                        dataType: 'json',
                        processResults: function (data, params) {
                            return {
                                results: data
                            }
                        }
                    },
                    templateResult: function(customer){
                        return customer.name;
                    },
                    templateSelection: function(customer){
                        soApp.SOs[index].customer = _.cloneDeep(customer);
                        return customer.name;
                    }
                });
                $("#customerSelect" + index).val(vm.SOs[index].customer.id).trigger('change');
            }
        }

        function isBase(unit) {
            return unit.is_base == 1;
        }

        $('.cancelButton').on('click', function(e){
            var form = $("#so-form");
            form.parsley().destroy();
            form.submit();
        });
    });
</script>
@endsection