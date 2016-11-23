@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.create.title')
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/css/bootstrap-datetimepicker.min.css') }}">
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
    <div ng-app="poModule" ng-controller="poController" ng-cloak>
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
                                            <select id="inputSupplierType" data-parsley-required="true"
                                                    name="supplier_type"
                                                    class="form-control"
                                                    ng-model="po.supplier_type"
                                                    ng-options="st as st.description for st in supplierTypeDDL track by st.code">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div ng-show="po.supplier_type.code == 'SUPPLIERTYPE.R'">
                                        <div class="form-group">
                                            <label for="inputSupplierId"
                                                   class="col-sm-2 control-label">@lang('purchase_order.create.field.supplier_name')</label>
                                            <div class="col-sm-8">
                                                <select id="inputSupplierId"
                                                        name="supplier_id"
                                                        class="form-control"
                                                        ng-model="po.supplier"
                                                        ng-options="supplier as supplier.name for supplier in supplierDDL track by supplier.id">
                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button id="supplierDetailButton" type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#supplierDetailModal"><span
                                                            class="fa fa-info-circle fa-lg"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div ng-show="po.supplier_type.code == 'SUPPLIERTYPE.WI'">
                                        <div class="form-group">
                                            <label for="inputSupplierName"
                                                   class="col-sm-2 control-label">@lang('purchase_order.create.field.supplier_name')</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="inputSupplierName" name="walk_in_supplier"
                                                       class="form-control" ng-model="po.supplier_name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSupplierDetails"
                                                   class="col-sm-2 control-label">@lang('purchase_order.create.field.supplier_details')</label>
                                            <div class="col-sm-10">
                                        <textarea id="inputSupplierDetails" class="form-control" rows="5"
                                                  name="walk_in_supplier_detail"
                                                  ng-model="po.supplier_details"></textarea>
                                            </div>
                                        </div>
                                    </div>
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
                                               class="col-sm-2 control-label">@lang('purchase_order.create.po_code')</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputPoCode" name="code"
                                                   placeholder="PO Code" readonly value="{{ $poCode }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPoType"
                                               class="col-sm-2 control-label">@lang('purchase_order.create.po_type')</label>
                                        <div class="col-sm-10">
                                            <select id="inputPoType" data-parsley-required="true"
                                                    name="po_type"
                                                    class="form-control"
                                                    ng-model="po.poType"
                                                    ng-options="poType as poType.description for poType in poTypeDDL track by poType.code">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPoDate"
                                               class="col-sm-2 control-label">@lang('purchase_order.create.po_date')</label>
                                        <div class="col-sm-10">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="inputPoDate" name="po_created"
                                                       ng-model="po.poCreated" data-parsley-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPoStatus"
                                               class="col-sm-2 control-label">@lang('purchase_order.create.po_status')</label>
                                        <div class="col-sm-10">
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
                                        <label for="inputShippingDate" class="col-sm-2 control-label">@lang('purchase_order.create.field.shipping_date')</label>
                                        <div class="col-sm-5">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="inputShippingDate"
                                                       name="shipping_date" ng-model="po.shippingDate"
                                                       data-parsley-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputWarehouse"
                                               class="col-sm-2 control-label">@lang('purchase_order.create.field.warehouse')</label>
                                        <div class="col-sm-5">
                                            <select id="inputWarehouse" data-parsley-required="true"
                                                    name="warehouse_id"
                                                    class="form-control"
                                                    ng-model="po.warehouse"
                                                    ng-options="warehouse as warehouse.name for warehouse in warehouseDDL track by warehouse.id">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="inputVendorTrucking"
                                               class="col-sm-2 control-label">@lang('purchase_order.create.field.vendor_trucking')</label>
                                        <div class="col-sm-8">
                                            <select id="inputVendorTrucking"
                                                    name="vendor_trucking_id"
                                                    class="form-control"
                                                    ng-model="po.vendorTrucking"
                                                    ng-options="vendorTrucking as vendorTrucking.name for vendorTrucking in vendorTruckingDDL track by vendorTrucking.id">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
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
                                        <div class="col-md-11">
                                            <select id="inputProduct"
                                                    class="form-control"
                                                    ng-model="po.product"
                                                    ng-options="product as product.name for product in po.supplier.products track by product.id">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary btn-md"
                                                    ng-click="insertItem(po.product)"><span class="fa fa-plus"/></button>
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
                                                <tr ng-repeat="item in po.items">
                                                    <input type="hidden" name="product_id[]" ng-value="item.product.id">
                                                    <input type="hidden" name="base_unit_id[]" ng-value="item.base_unit.unit.id">
                                                    <td class="valign-middle">@{{ item.product.name }}</td>
                                                    <td>
                                                        <input type="text" class="form-control text-right" name="quantity[]"
                                                               ng-model="item.quantity" data-parsley-required="true"
                                                               data-parsley-type="number">
                                                    </td>
                                                    <td>
                                                        <select name="selected_unit_id[]" data-parsley-required="true"
                                                                class="form-control"
                                                                ng-model="item.selected_unit"
                                                                data-parsley-required="true"
                                                                ng-options="product_unit as product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' for product_unit in item.product.product_units track by product_unit.unit.id">
                                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control text-right" name="price[]"
                                                               ng-model="item.price" data-parsley-required="true"
                                                               data-parsley-pattern="^\d+(,\d+)?$" fcsa-number/>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-danger btn-md"
                                                                ng-click="removeItem($index)"><span class="fa fa-minus"/>
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
                                            <table id="itemsTotalListTable" class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td width="80%"
                                                        class="text-right">@lang('purchase_order.create.table.total.body.total')</td>
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
                </div>
                <div class="col-md-2">
                    <div class="box box-info">
                        <div class="box-header with-border">
                        </div>
                        <div class="box-body">
                            @for ($i = 0; $i < 40; $i++)
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
                                                      ng-model="po.remarks"></textarea>
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
                                class="btn btn-primary pull-right" name="submitcreate" value="create_new">@lang('buttons.submit_button')&nbsp;&amp;&nbsp;@lang('buttons.create_new_button')</button>
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
        var app = angular.module('poModule', ['fcsa-number']);
        app.controller("poController", ['$scope', function ($scope) {
            $scope.supplierDDL = JSON.parse('{!! htmlspecialchars_decode($supplierDDL) !!}');
            $scope.warehouseDDL = JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}');
            $scope.poTypeDDL = JSON.parse('{!! htmlspecialchars_decode($poTypeDDL) !!}');
            $scope.supplierTypeDDL = JSON.parse('{!! htmlspecialchars_decode($supplierTypeDDL) !!}');
            $scope.vendorTruckingDDL = JSON.parse('{!! htmlspecialchars_decode($vendorTruckingDDL) !!}');

            $scope.po = {
                supplier_type: '',
                items: []
            };

            function isBase(unit) {
                return unit.is_base == 1;
            }

            $scope.grandTotal = function () {
                var result = 0;
                angular.forEach($scope.po.items, function (item, key) {
                    result += (item.selected_unit.conversion_value * item.quantity * item.price);
                });
                return result;
            };

            $scope.insertItem = function (product) {
                $scope.po.items.push({
                    product: product,
                    selected_unit: {
                      conversion_value: 1
                    },
                    base_unit: _.find(product.product_units, isBase),
                    quantity: 0,
                    price: 0
                });
            };

            $scope.removeItem = function (index) {
                $scope.po.items.splice(index, 1);
            };
        }]);

        $(function () {
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
    <script type="application/javascript" src="{{ asset('adminlte/js/bootstrap-datetimepicker.min.js') }}"></script>
@endsection