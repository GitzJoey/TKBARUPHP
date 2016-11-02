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
    <div ng-app="soModule" ng-controller="soController">
        <form class="form-horizontal so-form" action="{{ route('db.so.create') }}" method="post" data-parsley-validate="parsley">
        {{ csrf_field() }}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li ng-repeat="so in SOs" ng-class="{active: $last}">
                                    <a href="#tab_so@{{ $index + 1 }}" data-toggle="tab">@lang('sales_order.create.tab.sales') @{{ $index + 1 }}</a>
                                </li>
                                <li>
                                    <button type="button" class="btn btn-xs btn-default pull-right" ng-click="insertTab()">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div ng-repeat="so in SOs"
                                     ng-class="{active: $last}"
                                     class="tab-pane" id="tab_so@{{ $index + 1 }}">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="box box-info">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">@lang('sales_order.create.box.customer')</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="inputCustomerType_@{{ $index + 1 }}" class="col-sm-3 control-label">@lang('sales_order.create.field.customer_type')</label>
                                                        <div class="col-sm-5">
                                                            <select id="inputCustomerType_@{{ $index + 1 }}" data-parsley-required="true"
                                                                    class="form-control"
                                                                    name="customer_type[]"
                                                                    ng-model="so.customer_type"
                                                                    ng-options="key as value for (key, value) in customerTypeDDL track by key">
                                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div ng-show="so.customer_type == 'CUSTOMERTYPE.R'">
                                                        <div class="form-group">
                                                            <label for="inputCustomerId_@{{ $index + 1 }}" class="col-sm-3 control-label">@lang('sales_order.create.field.customer_name')</label>
                                                            <div class="col-sm-7">
                                                                <select id="inputCustomerId_@{{ $index + 1 }}"
                                                                        name="customer_id[]"
                                                                        class="form-control"
                                                                        ng-model="so.customer"
                                                                        ng-options="customer as customer.name for customer in customerDDL track by customer.id">
                                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div ng-show="so.customer_type == 'CUSTOMERTYPE.WI'">
                                                        <div class="form-group">
                                                            <label for="inputCustomerName_@{{ $index + 1 }}" class="col-sm-3 control-label">@lang('sales_order.create.field.customer_name')</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" id="inputCustomerName_@{{ $index + 1 }}"
                                                                       name="walk_in_customer[]" placeholder="Customer Name"
                                                                       ng-model="so.walk_in_customer">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputCustomerDetails_@{{ $index + 1 }}" class="col-sm-3 control-label">@lang('sales_order.create.field.customer_details')</label>
                                                            <div class="col-sm-9">
                                                                <textarea id="inputCustomerDetails_@{{ $index + 1 }}" class="form-control"
                                                                          rows="5" name="walk_in_customer_details[]"
                                                                          ng-model="so.walk_in_customer_details"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="box box-info">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">@lang('sales_order.create.box.purchase_order_detail')</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="inputSoCode_@{{ $index + 1 }}" class="col-sm-2 control-label">@lang('sales_order.create.so_code')</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="inputSoCode_@{{ $index + 1 }}"
                                                                   name="so_code[]" placeholder="SO Code" readonly
                                                                   ng-model="so.so_code">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputSoType_@{{ $index + 1 }}" class="col-sm-2 control-label">@lang('sales_order.create.so_type')</label>
                                                        <div class="col-sm-10">
                                                            <select id="inputSoType_@{{ $index + 1 }}" data-parsley-required="true"
                                                                    class="form-control"
                                                                    name="sales_type[]"
                                                                    ng-model="so.sales_type"
                                                                    ng-options="key as value for (key, value) in soTypeDDL track by key">
                                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputSoDate_@{{ $index + 1 }}" class="col-sm-2 control-label">@lang('sales_order.create.so_date')</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="text" class="form-control inputSoDate" id="inputSoDate_@{{ $index + 1 }}"
                                                                       name="so_created[]" ng-model="so.soCreated" data-parsley-required="true">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputSoStatus_@{{ $index + 1 }}" class="col-sm-2 control-label">@lang('sales_order.create.so_status')</label>
                                                        <div class="col-sm-10">
                                                            <label class="control-label control-label-normal">@lang('lookup.'.$soStatusDraft->first()->code)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
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
                                                                       name="shipping_date[]" ng-model="so.shippingDate" data-parsley-required="true">
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
                                        <div class="col-md-2">
                                            <div class="box box-info">

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
                                                        <div ng-show="so.sales_type == 'SOTYPE.SVC'">
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
                                                        <div ng-show="so.sales_type == 'SOTYPE.S'">
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
                                                            <table id="itemsListTable" class="table table-bordered table-hover">
                                                                <thead>
                                                                <tr>
                                                                    <th width="30%">@lang('sales_order.create.table.item.header.product_name')</th>
                                                                    <th width="15%">@lang('sales_order.create.table.item.header.header.quantity')</th>
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
                                                                               data-parsley-type="number" fcsa-number>
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
                                                <button id="submitButton" type="submit" class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>&nbsp;&nbsp;&nbsp;
                                                <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                                                <button id="cancelButton" type="submit" class="btn btn-primary pull-right">@lang('buttons.cancel_button')</button>
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
        var app = angular.module("soModule", ['fcsa-number']);
        app.controller("soController", ['$scope', '$http', '$q', function($scope, $http, $q) {
            $scope.soTypeDDL = JSON.parse('{!! htmlspecialchars_decode($soTypeDDL) !!}');
            $scope.customerTypeDDL = JSON.parse('{!! htmlspecialchars_decode($customerTypeDDL) !!}');
            $scope.customerDDL = JSON.parse('{!! htmlspecialchars_decode($customerDDL) !!}');
            $scope.warehouseDDL = JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}');
            $scope.vendorTruckingDDL = JSON.parse('{!! htmlspecialchars_decode($vendorTruckingDDL) !!}');
            $scope.productDDL = JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}');
            $scope.stocksDDL = JSON.parse('{!! htmlspecialchars_decode($stocksDDL) !!}');

            $scope.setSOCode = function(so){
                $http.get('{{ route('api.so.code') }}').success(function(data){
                    so.so_code = data;
                });
            };

            $scope.SOs = [{
                so_code: '',
                customer_type : '',
                items : []
            }];
            $scope.setSOCode($scope.SOs[0]);

            $scope.insertTab = function(){
                if(!$(".so-form").parsley().validate())
                    return;

                var so = {
                    so_code: '',
                    customer_type: '',
                    items : []
                }
                $scope.setSOCode(so);
                $scope.SOs.push(so);
                $(function () {
                    $(".inputSoDate").daterangepicker(
                            {
                                timePicker: true,
                                timePickerIncrement: 15,
                                locale: {
                                    format: 'DD-MM-YYYY'
                                },
                                singleDatePicker: true,
                                showDropdowns: true
                            }
                    );
                    $(".inputShippingDate").daterangepicker(
                            {
                                timePicker: true,
                                timePickerIncrement: 15,
                                locale: {
                                    format: 'DD-MM-YYYY'
                                },
                                singleDatePicker: true,
                                showDropdowns: true
                            }
                    );
                });
            };

            $scope.grandTotal = function (index) {
                var result = 0;
                angular.forEach($scope.SOs[index].items, function (item, key) {
                    result += (item.selected_unit.conversion_value * item.quantity * item.price);
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
                $scope.SOs[index].items.push({
                    stock_id: stock.id,
                    product: stock.product,
                    selected_unit: {
                        conversion_value: 1
                    },
                    base_unit: _.find(stock.product.product_units, isBase),
                    quantity: 0,
                    price: 0
                });
            };

            $scope.removeItem = function (SOIndex, index) {
                $scope.SOs[SOIndex].items.splice(index, 1);
            };

        }]);

        $(function () {
            $(".inputSoDate").daterangepicker(
                    {
                        timePicker: true,
                        timePickerIncrement: 15,
                        locale: {
                            format: 'DD-MM-YYYY'
                        },
                        singleDatePicker: true,
                        showDropdowns: true
                    }
            );
            $(".inputShippingDate").daterangepicker(
                    {
                        timePicker: true,
                        timePickerIncrement: 15,
                        locale: {
                            format: 'DD-MM-YYYY'
                        },
                        singleDatePicker: true,
                        showDropdowns: true
                    }
            );
        });
    </script>
@endsection