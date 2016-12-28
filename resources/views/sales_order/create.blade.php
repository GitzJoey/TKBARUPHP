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
    <div ng-app="soModule" ng-controller="soController" ng-cloak>
        <form class="form-horizontal" id="so-form" action="{{ route('db.so.create') }}" method="post" data-parsley-validate="parsley">
        {{ csrf_field() }}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li ng-repeat="so in SOs" ng-class="{active: $last}">
                                    <a href="#tab_so_@{{ $index + 1 }}" data-toggle="tab">
                                        @{{ so.customer_type.code == 'CUSTOMERTYPE.R' ? so.customer.name || (defaultTabLabel + " " + ($index + 1))
                                        : so.customer_type.code == 'CUSTOMERTYPE.WI' ? so.walk_in_cust || (defaultTabLabel + " " + ($index + 1))
                                        : (defaultTabLabel + " " + ($index + 1)) }}</a>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-xs btn-default pull-right" ng-click="insertTab(SOs)">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div ng-repeat="so in SOs"
                                     ng-class="{active: $last}"
                                     class="tab-pane" id="tab_so_@{{ $index + 1 }}">
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
                                                                <label for="inputCustomerType_@{{ $index + 1 }}" class="col-sm-4 control-label">@lang('sales_order.create.field.customer_type')</label>
                                                                <div class="col-sm-6">
                                                                    <select id="inputCustomerType_@{{ $index + 1 }}" data-parsley-required="true"
                                                                            class="form-control"
                                                                            name="customer_type[]"
                                                                            ng-model="so.customer_type"
                                                                            ng-options="customerType as customerType.description for customerType in customerTypeDDL track by customerType.code">
                                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div ng-show="so.customer_type.code === 'CUSTOMERTYPE.R'">
                                                                <div class="form-group">
                                                                    <label for="inputCustomerId_@{{ $index + 1 }}" class="col-sm-4 control-label">@lang('sales_order.create.field.customer_name')</label>
                                                                    <div class="col-sm-6">
                                                                        <ui-select ng-model="so.customer"
                                                                                   spinner-enabled="true"
                                                                                   ng-change="insertDefaultExpense($index, so.customer)">
                                                                            <ui-select-match placeholder="Choose customer..."
                                                                                             allow-clear="true">@{{$select.selected.name}}</ui-select-match>
                                                                            <ui-select-choices repeat="customer in customerDDL track by customer.id"
                                                                                               refresh="refreshCustomers($select.search)"
                                                                                               refresh-delay="0">
                                                                                <span ng-bind="customer.name"></span>
                                                                            </ui-select-choices>
                                                                        </ui-select>
                                                                        <input type="hidden" name="customer_id[]" ng-value="so.customer.id" >
                                                                    </div>
                                                                    <div class="col-sm-2">
                                                                        <button id="customerDetailButton_@{{ $index }}" type="button" class="btn btn-primary btn-sm"
                                                                                data-toggle="modal" data-target="#customerDetailModal_@{{ $index }}"><span
                                                                                    class="fa fa-info-circle fa-lg"></span></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div ng-show="so.customer_type.code === 'CUSTOMERTYPE.WI'">
                                                                <div class="form-group">
                                                                    <label for="inputCustomerName_@{{ $index + 1 }}" class="col-sm-4 control-label">@lang('sales_order.create.field.customer_name')</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" id="inputCustomerName_@{{ $index + 1 }}"
                                                                               name="walk_in_customer[]" placeholder="Customer Name"
                                                                               ng-model="so.walk_in_cust">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputCustomerDetails_@{{ $index + 1 }}" class="col-sm-4 control-label">@lang('sales_order.create.field.customer_details')</label>
                                                                    <div class="col-sm-8">
                                                                <textarea id="inputCustomerDetails_@{{ $index + 1 }}" class="form-control"
                                                                          rows="5" name="walk_in_customer_details[]"
                                                                          ng-model="so.walk_in_cust_details"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="box box-info">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">@lang('sales_order.create.box.purchase_order_detail')</h3>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="inputSoCode_@{{ $index + 1 }}" class="col-sm-3 control-label">@lang('sales_order.create.so_code')</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="inputSoCode_@{{ $index + 1 }}"
                                                                           name="so_code[]" placeholder="SO Code" readonly
                                                                           ng-model="so.so_code">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputSoType_@{{ $index + 1 }}" class="col-sm-3 control-label">@lang('sales_order.create.so_type')</label>
                                                                <div class="col-sm-9">
                                                                    <select id="inputSoType_@{{ $index + 1 }}" data-parsley-required="true"
                                                                            class="form-control"
                                                                            name="sales_type[]"
                                                                            ng-model="so.sales_type"
                                                                            ng-options="salesType as salesType.description for salesType in soTypeDDL track by salesType.code">
                                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputSoDate_@{{ $index + 1 }}" class="col-sm-3 control-label">@lang('sales_order.create.so_date')</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group date">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <input type="text" class="form-control inputSoDate" id="inputSoDate_@{{ $index + 1 }}"
                                                                               name="so_created[]" ng-model="so.so_created" data-parsley-required="true">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputSoStatus_@{{ $index + 1 }}" class="col-sm-3 control-label">@lang('sales_order.create.so_status')</label>
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
                                                                <label for="inputShippingDate_@{{ $index + 1 }}" class="col-sm-3 control-label">@lang('sales_order.create.field.shipping_date')</label>
                                                                <div class="col-sm-9">
                                                                    <div class="input-group date">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <input type="text" class="form-control inputShippingDate" id="inputShippingDate_@{{ $index + 1 }}"
                                                                               name="shipping_date[]" ng-model="so.shipping_date" data-parsley-required="true">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputWarehouse_@{{ $index + 1 }}" class="col-sm-3 control-label">@lang('sales_order.create.field.warehouse')</label>
                                                                <div class="col-sm-9">
                                                                    <select id="inputWarehouse_@{{ $index + 1 }}" data-parsley-required="true"
                                                                            name="warehouse_id[]"
                                                                            class="form-control"
                                                                            ng-model="so.warehouse"
                                                                            ng-options="warehouse as warehouse.name for warehouse in warehouseDDL track by warehouse.id">
                                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputVendorTrucking_@{{ $index + 1 }}" class="col-sm-3 control-label">@lang('sales_order.create.field.vendor_trucking')</label>
                                                                <div class="col-sm-9">
                                                                    <select id="inputVendorTrucking_@{{ $index + 1 }}"
                                                                            name="vendor_trucking_id[]"
                                                                            class="form-control"
                                                                            ng-model="so.vendorTrucking"
                                                                            ng-options="vendorTrucking as vendorTrucking.name for vendorTrucking in vendorTruckingDDL track by vendorTrucking.id">
                                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
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
                                                                <div ng-show="so.sales_type.code === 'SOTYPE.SVC'">
                                                                    <div class="col-md-11">
                                                                        <select id="inputProduct_@{{ $index + 1 }}"
                                                                                class="form-control"
                                                                                ng-model="so.product"
                                                                                ng-options="product as product.name for product in productDDL track by product.id">
                                                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <button type="button" class="btn btn-primary btn-md"
                                                                                ng-click="insertProduct($index, so.product)"><span class="fa fa-plus"/></button>
                                                                    </div>
                                                                </div>
                                                                <div ng-show="so.sales_type.code == 'SOTYPE.S'">
                                                                    <div class="col-md-11">
                                                                        <select id="inputStock_@{{ $index + 1 }}"
                                                                                class="form-control"
                                                                                ng-model="so.stock"
                                                                                ng-options="stock as stock.product.name for stock in stocksDDL track by stock.id">
                                                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <button type="button" class="btn btn-primary btn-md"
                                                                                ng-click="insertStock($index, so.stock)"><span class="fa fa-plus"/></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table id="itemsListTable_@{{ $index + 1 }}" class="table table-bordered table-hover">
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
                                                                        <tr ng-repeat="item in so.items">
                                                                            <input type="hidden" name="so_@{{ $parent.$index }}_product_id[]" ng-value="item.product.id">
                                                                            <input type="hidden" name="so_@{{ $parent.$index }}_stock_id[]" ng-value="item.stock_id">
                                                                            <input type="hidden" name="so_@{{ $parent.$index }}_base_unit_id[]" ng-value="item.base_unit.unit.id">
                                                                            <td class="valign-middle">@{{ item.product.name }}</td>
                                                                            <td>
                                                                                <input type="text" class="form-control text-right" name="so_@{{ $parent.$index }}_quantity[]"
                                                                                       ng-model="item.quantity" data-parsley-required="true"
                                                                                       data-parsley-type="number">
                                                                            </td>
                                                                            <td>
                                                                                <select name="so_@{{ $parent.$index }}_selected_unit_id[]" data-parsley-required="true"
                                                                                        class="form-control"
                                                                                        ng-model="item.selected_unit"
                                                                                        data-parsley-required="true"
                                                                                        ng-options="product_unit as product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' for product_unit in item.product.product_units track by product_unit.unit.id">
                                                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                                </select>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control text-right" name="so_@{{ $parent.$index }}_price[]"
                                                                                       ng-model="item.price" data-parsley-required="true"
                                                                                       data-parsley-pattern="^\d+(,\d+)*$" fcsa-number>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <button type="button" class="btn btn-danger btn-md"
                                                                                        ng-click="removeItem($parent.$index, $index)"><span class="fa fa-minus"/>
                                                                                </button>
                                                                            </td>
                                                                            <td class="text-right valign-middle">
                                                                                @{{ item.selected_unit.conversion_value * item.quantity * item.price | number }}
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table id="itemsTotalListTable_@{{ $index + 1 }}" class="table table-bordered">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td width="80%"
                                                                                class="text-right">@lang('sales_order.create.table.total.body.total')</td>
                                                                            <td width="20%" class="text-right">
                                                                                <span class="control-label-normal">@{{ grandTotal($index) | number }}</span>
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
                                                                    ng-click="insertExpense($index)"><span class="fa fa-plus fa-fw"></span></button>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table id="expensesListTable_@{{ $index + 1 }}" class="table table-bordered table-hover">
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
                                                                        <tr ng-repeat="expense in so.expenses">
                                                                            <td>
                                                                                <input name="so_@{{ $parent.$index }}_expense_name[]" type="text" class="form-control"
                                                                                       ng-model="expense.name" data-parsley-required="true">
                                                                            </td>
                                                                            <td>
                                                                                <select name="so_@{{ $parent.$index }}_expense_type[]" data-parsley-required="true"
                                                                                        class="form-control" ng-model="expense.type"
                                                                                        ng-options="expenseType as expenseType.description for expenseType in expenseTypes track by expenseType.code">
                                                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                                </select>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <input name="so_@{{ $parent.$index }}_is_internal_expense[]" ng-model="expense.is_internal_expense" type="checkbox">
                                                                            </td>
                                                                            <td>
                                                                                <input name="so_@{{ $parent.$index }}_expense_remarks[]" type="text" class="form-control"
                                                                                       ng-model="expense.remarks"/>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <button type="button" class="btn btn-danger btn-md"
                                                                                        ng-click="removeExpense($parent.$index, $index)"><span class="fa fa-minus"/>
                                                                                </button>
                                                                            </td>
                                                                            <td>
                                                                                <input name="so_@{{ $parent.$index }}_expense_amount[]" type="text" class="form-control text-right"
                                                                                       ng-model="expense.amount" data-parsley-required="true"
                                                                                       data-parsley-pattern="^(?!0\.00)\d{1,3}(,\d{3})*(\.\d\d)?$" fcsa-number/>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table id="expensesTotalListTable_@{{ $index + 1 }}" class="table table-bordered">
                                                                        <tbody>
                                                                        <tr>
                                                                            <td width="80%"
                                                                                class="text-right">@lang('sales_order.create.table.total.body.total')</td>
                                                                            <td width="20%" class="text-right">
                                                                                <span class="control-label-normal">@{{ expenseTotal($index) | number }}</span>
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
                                                                    <textarea id="inputRemarks_@{{ $index + 1 }}" class="form-control" rows="5" name="remarks[]"
                                                                              ng-model="so.remarks"></textarea>
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
                                                <button id="submitButton_@{{ $index }}" type="submit" name="submit" ng-value="$index" class="submitButton btn btn-primary pull-right">@lang('buttons.submit_button')</button>&nbsp;&nbsp;&nbsp;
                                                <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                                                <button id="cancelButton_@{{ $index }}" type="submit" name="cancel" ng-value="$index" class="cancelButton btn btn-primary pull-right">@lang('buttons.cancel_button')</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="customerDetailModal_@{{ $index }}" tabindex="-1" role="dialog"
                                         aria-labelledby="customerDetailModalLabel_@{{ $index }}">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="customerDetailModalLabel_@{{ $index }}">Customer Detail</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="nav-tabs-custom">
                                                        <ul class="nav nav-tabs">
                                                            <li class="active"><a href="#tab_customer_@{{ $index }}" data-toggle="tab">@lang('customer.show.tab.customer')</a></li>
                                                            <li><a href="#tab_pic_@{{ $index }}" data-toggle="tab">@lang('customer.show.tab.pic')</a></li>
                                                            <li><a href="#tab_bank_account_@{{ $index }}" data-toggle="tab">@lang('customer.show.tab.bank_account')</a></li>
                                                            <li><a href="#tab_expenses_@{{ $index }}" data-toggle="tab">@lang('customer.show.tab.expenses')</a></li>
                                                            <li><a href="#tab_settings_@{{ $index }}" data-toggle="tab">@lang('customer.show.tab.settings')</a></li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tab_customer_@{{ $index }}">
                                                                <div class="form-group">
                                                                    <label for="inputName_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.name')</label>
                                                                    <div class="col-sm-10">
                                                                        <label id="inputName_@{{ $index }}" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.name }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputAddress_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                                                    <div class="col-sm-10">
                                                                        <label id="inputAddress_@{{ $index }}" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.address }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputCity_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.city')</label>
                                                                    <div class="col-sm-10">
                                                                        <label id="inputCity_@{{ $index }}" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.city }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPhone_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.phone')</label>
                                                                    <div class="col-sm-10">
                                                                        <label id="inputPhone_@{{ $index }}" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.phone }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputTaxId_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.tax_id')</label>
                                                                    <div class="col-sm-10">
                                                                        <label id="inputTaxId_@{{ $index }}" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.tax_id }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputRemarks_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.remarks')</label>
                                                                    <div class="col-sm-10">
                                                                        <label id="inputRemarks_@{{ $index }}" class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.remarks }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane" id="tab_pic_@{{ $index }}">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div ng-repeat="profile in so.customer.profiles">
                                                                            <div class="box box-widget">
                                                                                <div class="box-header with-border">
                                                                                    <div class="user-block">
                                                                                        <strong>@lang('customer.field.person_in_charge') @{{ $index + 1 }}</strong><br/>
                                                                                        &nbsp;&nbsp;&nbsp;@{{ profile.first_name }}&nbsp;@{{ profile.last_name }}
                                                                                    </div>
                                                                                    <div class="box-tools">
                                                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="box-body">
                                                                                    <div class="form-group">
                                                                                        <label for="inputFirstName_@{{ $parent.index }}_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.first_name')</label>
                                                                                        <div class="col-sm-10">
                                                                                            <label id="inputFirstName_@{{ $parent.index }}_@{{ $index }}" class="control-label">
                                                                                                <span class="control-label-normal">@{{ profile.first_name }}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="inputLastName_@{{ $parent.index }}_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.last_name')</label>
                                                                                        <div class="col-sm-10">
                                                                                            <label id="inputLastName_@{{ $parent.index }}_@{{ $index }}" class="control-label">
                                                                                                <span class="control-label-normal">@{{ profile.last_name }}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="inputAddress" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                                                                        <div class="col-sm-10">
                                                                                            <label id="inputAddress_@{{ $parent.index }}_@{{ $index }}" class="control-label">
                                                                                                <span class="control-label-normal">@{{ profile.address }}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="inputICNum_@{{ $parent.index }}_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.ic_num')</label>
                                                                                        <div class="col-sm-10">
                                                                                            <label id="inputICNum_@{{ $parent.index }}_@{{ $index }}" class="control-label">
                                                                                                <span class="control-label-normal">@{{ profile.ic_num }}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label for="inputPhoneNumber_@{{ $parent.index }}_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.phone_number')</label>
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
                                                                                                    <tr ng-repeat="phone in profile.phone_numbers">
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
                                                            <div class="tab-pane" id="tab_bank_account_@{{ $index }}">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">@lang('customer.show.table_bank.header.bank')</th>
                                                                            <th class="text-center">@lang('customer.show.table_bank.header.account_number')</th>
                                                                            <th class="text-center">@lang('customer.show.table_bank.header.remarks')</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr ng-repeat="ba in so.customer.bank_accounts">
                                                                            <td>@{{ ba.bank.name }}&nbsp;(@{{ ba.bank.name }})</td>
                                                                            <td>@{{ ba.account_number }}</td>
                                                                            <td>@{{ ba.remarks }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="tab-pane" id="tab_expenses_@{{ $index }}">
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
                                                                        <tr ng-repeat="et in so.customer.expense_templates">
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
                                                                                <div ng-if="et.is_internal_expense">
                                                                                    @lang('lookup.YESNOSELECT.YES')
                                                                                </div>
                                                                                <div ng-if="!et.is_internal_expense">
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
                                                            <div class="tab-pane" id="tab_settings_@{{ $index }}">
                                                                <div class="form-group">
                                                                    <label for="inputPriceLevel_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.price_level')</label>
                                                                    <div class="col-sm-10">
                                                                        <label class="control-label">
                                                                            <span class="control-label-normal">@{{ so.customer.price_level.name }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPaymentDueDay_@{{ $index }}" class="col-sm-2 control-label">@lang('customer.field.payment_due_day')</label>
                                                                    <div class="col-sm-10">
                                                                        <label id="inputPaymentDueDay_@{{ $index }}" class="control-label">
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
            $('.cancelButton').on('click', function(e){
                var form = $("#so-form");
                form.parsley().destroy();
                form.submit();
            });
        });

        var app = angular.module("soModule", ['fcsa-number', 'ui.select', 'ngSanitize']);
        app.controller("soController", ['$scope', '$http', function($scope, $http) {
            $scope.soTypeDDL = JSON.parse('{!! htmlspecialchars_decode($soTypeDDL) !!}');
            $scope.customerTypeDDL = JSON.parse('{!! htmlspecialchars_decode($customerTypeDDL) !!}');
            $scope.customerDDL = [];
            $scope.warehouseDDL = JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}');
            $scope.vendorTruckingDDL = JSON.parse('{!! htmlspecialchars_decode($vendorTruckingDDL) !!}');
            $scope.productDDL = JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}');
            $scope.stocksDDL = JSON.parse('{!! htmlspecialchars_decode($stocksDDL) !!}');
            $scope.SOs = JSON.parse('{!! htmlspecialchars_decode($userSOs) !!}');
            $scope.defaultTabLabel = '@lang('sales_order.create.tab.sales')';
            $scope.expenseTypes = JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}');

            $scope.setSOCode = function(so){
                $http.get('{{ route('api.so.code') }}').then(function(data){
                    so.so_code = data.data;
                });
            };

            $scope.insertTab = function(SOs){
                if(!$("#so-form").parsley().validate())
                    return;
                var so = {
                    so_code: '',
                    customer_type: '',
                    items : [],
                    expenses: []
                };
                $scope.setSOCode(so);
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

                console.log(SOs);
            };

            if($scope.SOs.length == 0){
                $scope.insertTab($scope.SOs);
            }

            $scope.grandTotal = function (index) {
                var result = 0;
                angular.forEach($scope.SOs[index].items, function (item, key) {
                    result += (item.selected_unit.conversion_value * item.quantity * item.price);
                });
                return result;
            };

            $scope.expenseTotal = function (index) {
                var result = 0;
                angular.forEach($scope.SOs[index].expenses, function (expense, key) {
                    if(expense.type.code === 'EXPENSETYPE.ADD')
                        result += parseInt(numeral().unformat(expense.amount));
                    else
                        result -= parseInt(numeral().unformat(expense.amount));
                });
                return result;
            };

            function isBase(unit) {
                return unit.is_base == 1;
            }

            $scope.insertProduct = function (index, product) {
                $scope.SOs[index].items.push({
                    stock_id: 0,
                    product: product,
                    selected_unit: {
                        conversion_value: 1
                    },
                    base_unit: _.find(product.product_units, isBase),
                    quantity: 0,
                    price: 0
                });
            };

            $scope.insertStock = function (index, stock) {
                var stock_price = _.find(stock.today_prices, function (price) {
                    return price.price_level_id === $scope.SOs[index].customer.price_level_id;
                });

                $scope.SOs[index].items.push({
                    stock_id: stock.id,
                    product: stock.product,
                    selected_unit: {
                        conversion_value: 1
                    },
                    base_unit: _.find(stock.product.product_units, isBase),
                    quantity: 0,
                    price: stock_price ? stock_price.price : 0
                });
            };

            $scope.removeItem = function (SOIndex, index) {
                $scope.SOs[SOIndex].items.splice(index, 1);
            };

            $scope.insertDefaultExpense = function (SOIndex, customer) {
                if(customer){
                    $scope.SOs[SOIndex].expenses = [];
                    for(var i = 0; i < customer.expense_templates.length; i++){
                        $scope.SOs[SOIndex].expenses.push({
                            name: customer.expense_templates[i].name,
                            type: {
                                code: customer.expense_templates[i].type
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
                    $scope.SOs[SOIndex].expenses = [];
                }
            };

            $scope.insertExpense = function (index) {
                $scope.SOs[index].expenses.push({
                    name: '',
                    type: '',
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
            };

            $scope.removeExpense = function (SOIndex, index) {
                $scope.SOs[SOIndex].expenses.splice(index, 1);
            };

            $scope.refreshCustomers = function (param) {
                return $http.get('{{ route('api.customer.search') }}/' + param)
                    .then(function (response) {
                        $scope.customerDDL = response.data;
                        console.log($scope.customerDDL);
                    });
            };
        }]);
    </script>
@endsection