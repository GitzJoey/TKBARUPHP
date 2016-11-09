@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.revise.title')
@endsection

@section('page_title')
    <span class="fa fa-code-fork fa-fw"></span>&nbsp;@lang('sales_order.revise.page_title')
@endsection
@section('page_title_desc')
    @lang('sales_order.revise.page_title_desc')
@endsection
@section('breadcrumbs')
    {!! Breadcrumbs::render('revise_sales_order', $currentSo->hId()) !!}
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

    <div ng-app="soModule" ng-controller="soController">
        {!! Form::model($currentSo, ['method' => 'PATCH','route' => ['db.so.revise', $currentSo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
        {{ csrf_field() }}
        <div class="box-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.revise.box.customer')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputCustomerType"
                                       class="col-sm-3 control-label">@lang('sales_order.revise.field.customer_type')</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly
                                           value="@lang('lookup.'.$currentSo->customer_type)">
                                </div>
                            </div>
                            @if($currentSo->customer_type == 'CUSTOMERTYPE.R')
                                <div class="form-group">
                                    <label for="inputCustomerId"
                                           class="col-sm-3 control-label">@lang('sales_order.revise.field.customer_name')</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentSo->customer->name }}">
                                    </div>
                                    <div class="col-sm-2">
                                        <button id="customerDetailButton" type="button" class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#customerDetailModal"><span
                                                    class="fa fa-info-circle fa-lg"></span></button>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="inputCustomerName"
                                           class="col-sm-3 control-label">@lang('sales_order.revise.field.customer_name')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentSo->walk_in_cust }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCustomerDetails"
                                           class="col-sm-3 control-label">@lang('sales_order.revise.field.customer_details')</label>
                                    <div class="col-sm-9">
                                            <textarea class="form-control" rows="5" readonly>{{ $currentSo->walk_in_cust_detail }}
                                            </textarea>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.revise.box.sales_order_detail')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSoCode"
                                       class="col-sm-2 control-label">@lang('sales_order.revise.so_code')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="{{ $currentSo->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSoType"
                                       class="col-sm-2 control-label">@lang('sales_order.revise.so_type')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly
                                           value="@lang('lookup.'.$currentSo->so_type)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSoDate"
                                       class="col-sm-2 control-label">@lang('sales_order.revise.so_date')</label>
                                <div class="col-sm-10">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentSo->so_created->format('d-m-Y') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSoStatus"
                                       class="col-sm-2 control-label">@lang('sales_order.revise.so_status')</label>
                                <div class="col-sm-10">
                                    <label class="control-label control-label-normal">@lang('lookup.'.$currentSo->status)</label>
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
                            <h3 class="box-title">@lang('sales_order.revise.box.shipping')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputShippingDate"
                                       class="col-sm-3 control-label">@lang('sales_order.revise.field.shipping_date')</label>
                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        @if($currentSo->status == 'SOSTATUS.WD')
                                            <input type="text" class="form-control" id="inputShippingDate"
                                                   name="shipping_date"
                                                   value="{{ $currentSo->shipping_date->format('d-m-Y') }}"
                                                   data-parsley-required="true">
                                        @else
                                            <input type="text" class="form-control" readonly name="shipping_date"
                                                   value="{{ $currentSo->shipping_date->format('d-m-Y') }}"
                                                   data-parsley-required="true">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarehouse"
                                       class="col-sm-3 control-label">@lang('sales_order.revise.field.warehouse')</label>
                                <div class="col-sm-9">
                                    @if($currentSo->status == 'SOSTATUS.WD')
                                        <select id="inputWarehouse" data-parsley-required="true"
                                                name="warehouse_id"
                                                class="form-control"
                                                ng-model="so.warehouse"
                                                ng-options="warehouse as warehouse.name for warehouse in warehouseDDL track by warehouse.id">
                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                        </select>
                                    @else
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentSo->warehouse->name }}">
                                        <input type="hidden" name="warehouse_id"
                                               value="{{ $currentSo->warehouse->id }}">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking"
                                       class="col-sm-3 control-label">@lang('sales_order.revise.field.vendor_trucking')</label>
                                <div class="col-sm-9">
                                    @if($currentSo->status == 'SOSTATUS.WD')
                                        <select id="inputVendorTrucking"
                                                name="vendor_trucking_id"
                                                class="form-control"
                                                ng-model="so.vendorTrucking"
                                                ng-options="vendorTrucking as vendorTrucking.name for vendorTrucking in vendorTruckingDDL track by vendorTrucking.id">
                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                        </select>
                                    @else
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentSo->vendorTrucking->name }}">
                                        <input type="hidden" name="vendor_trucking_id"
                                               value="{{ $currentPo->vendorTrucking->id }}">
                                    @endif
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
                            <h3 class="box-title">@lang('sales_order.revise.box.transactions')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                @if($currentSo->status == 'SOSTATUS.WD')
                                    @if($currentSo->so_type == 'SOTYPE.SVC')
                                        <div class="col-md-11">
                                            <select id="inputProduct"
                                                    class="form-control"
                                                    ng-model="so.product"
                                                    ng-options="product as product.name for product in productDDL track by product.id">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary btn-md"
                                                    ng-click="insertProduct(so.product)"><span class="fa fa-plus"/>
                                            </button>
                                        </div>
                                    @else
                                        <div class="col-md-11">
                                            <select id="inputStock"
                                                    class="form-control"
                                                    ng-model="so.stock"
                                                    ng-options="stock as stock.product.name for stock in stocksDDL track by stock.id">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary btn-md"
                                                    ng-click="insertStock(so.stock)"><span class="fa fa-plus"/></button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="30%">@lang('sales_order.revise.table.item.header.product_name')</th>
                                            <th width="15%">@lang('sales_order.revise.table.item.header.header.quantity')</th>
                                            <th width="15%"
                                                class="text-right">@lang('sales_order.revise.table.item.header.unit')</th>
                                            <th width="15%"
                                                class="text-right">@lang('sales_order.revise.table.item.header.price_unit')</th>
                                            <th width="5%">&nbsp;</th>
                                            <th width="20%"
                                                class="text-right">@lang('sales_order.revise.table.item.header.total_price')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="item in so.items">
                                            <input type="hidden" name="item_id[]" ng-value="item.id">
                                            <input type="hidden" name="product_id[]" ng-value="item.product.id">
                                            <input type="hidden" name="stock_id[]" ng-value="item.stock.id">
                                            <input type="hidden" name="base_unit_id[]"
                                                   ng-value="item.base_unit.unit.id">
                                            <td class="valign-middle">@{{ item.product.name }}</td>
                                            <td>
                                                <input type="text" class="form-control text-right" name="quantity[]"
                                                       ng-model="item.quantity" data-parsley-required="true"
                                                       data-parsley-type="number" {{ $currentSo->status == 'SOSTATUS.WD' ? '' : 'readonly' }}>
                                            </td>
                                            <td>
                                                @if($currentSo->status == 'SOSTATUS.WD')
                                                    <select name="selected_unit_id[]" data-parsley-required="true"
                                                            class="form-control"
                                                            ng-model="item.selected_unit"
                                                            data-parsley-required="true"
                                                            ng-options="product_unit as product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' for product_unit in item.product.product_units track by product_unit.unit.id">
                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                    </select>
                                                @else
                                                    <input type="text" class="form-control" readonly
                                                           value="@{{ item.selected_unit.unit.name + ' (' + item.selected_unit.unit.symbol + ')' }}">
                                                    <input type="hidden" name="selected_unit_id[]"
                                                           ng-value="item.selected_unit.unit.id">
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" class="form-control text-right" name="price[]"
                                                       ng-model="item.price" data-parsley-required="true"
                                                       data-parsley-pattern="^(?!0\.00)\d{1,3}(,\d{3})*(\.\d\d)?$" fcsa-number>
                                            </td>
                                            <td class="text-center">
                                                @if($currentSo->status == 'SOSTATUS.WD')
                                                    <button type="button" class="btn btn-danger btn-md"
                                                            ng-click="removeItem($index)"><span class="fa fa-minus"/>
                                                    </button>
                                                @endif
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
                                    <table id="itemsTotalListTable" class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td width="80%"
                                                class="text-right">@lang('sales_order.revise.table.total.body.total')</td>
                                            <td width="20%" class="text-right">
                                                <span class="control-label-normal">@{{ grandTotal() | number }}</span>
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
                            <h3 class="box-title">@lang('sales_order.revise.box.remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                                <textarea id="inputRemarks" class="form-control" rows="5"
                                                          name="remarks">{{ $currentSo->remarks }}</textarea>
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
                        <button id="submitButton" type="submit" class="btn btn-primary pull-right">
                            @lang('buttons.submit_button')</button>
                        &nbsp;&nbsp;&nbsp;
                        <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">
                            @lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                        <a id="cancelButton" href="{{ route('db.so.revise.index') }}"
                           class="btn btn-primary pull-right" role="button">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module("soModule", ['fcsa-number']);
        app.controller("soController", ['$scope', function ($scope) {
            $scope.warehouseDDL = JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}');
            $scope.vendorTruckingDDL = JSON.parse('{!! htmlspecialchars_decode($vendorTruckingDDL) !!}');
            $scope.productDDL = JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}');
            $scope.stocksDDL = JSON.parse('{!! htmlspecialchars_decode($stocksDDL) !!}');
            $scope.customerDDL = JSON.parse('{!! empty($customerDDL) ? '[]' : htmlspecialchars_decode($customerDDL) !!}');

            var currentSo = JSON.parse('{!! htmlspecialchars_decode($currentSo->toJson()) !!}');

            console.log(currentSo);

            $scope.so = {
                customer: currentSo.customer,
                items: [],
                warehouse: {
                    id: currentSo.warehouse.id,
                    name: currentSo.warehouse.name
                },
                vendorTrucking: {
                    id: (currentSo.vendor_trucking == null) ? '' : currentSo.vendor_trucking.id,
                    name: (currentSo.vendor_trucking == null) ? '' : currentSo.vendor_trucking.name
                }
            };

            for (var i = 0; i < currentSo.items.length; i++) {
                $scope.so.items.push({
                    id: currentSo.items[i].id,
                    product: currentSo.items[i].product,
                    base_unit: _.find(currentSo.items[i].product.product_units, isBase),
                    selected_unit: _.find(currentSo.items[i].product.product_units, getSelectedUnit(currentSo.items[i].selected_unit_id)),
                    quantity: parseFloat(currentSo.items[i].quantity).toFixed(0),
                    price: parseFloat(currentSo.items[i].price).toFixed(0)
                });
            }

            $scope.grandTotal = function () {
                var result = 0;
                angular.forEach($scope.so.items, function (item, key) {
                    result += (item.selected_unit.conversion_value * item.quantity * item.price);
                });
                return result;
            };

            function getSelectedUnit(selectedUnitId) {
                return function (element) {
                    return element.unit_id == selectedUnitId;
                }
            }

            function isBase(unit) {
                return unit.is_base == 1;
            }

            $scope.insertProduct = function (product) {
                $scope.so.items.push({
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

            $scope.insertStock = function (stock) {
                $scope.so.items.push({
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

            $scope.removeItem = function (index) {
                $scope.so.items.splice(index, 1);
            };

        }]);

        $(function () {
            $("#inputSoDate").daterangepicker(
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
            $("#inputShippingDate").daterangepicker(
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