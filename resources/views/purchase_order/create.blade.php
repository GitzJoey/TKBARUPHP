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

    <form class="form-horizontal" action="{{ route('db.po.create') }}" method="post">
        {{ csrf_field() }}
        <div ng-app="poModule" ng-controller="poController">
            <div class="row">
                <div class="col-md-7">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.create.box.supplier')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSupplierType" class="col-sm-3 control-label">@lang('purchase_order.create.field.supplier_type')</label>
                                <div class="col-sm-9">
                                    {{-- Commented because it still not work --}}
                                    {{--<div ng-repeat="supplierType in supplierTypeDDL">--}}
                                        {{--<input id="supplier_type@{{ $index }}" type="radio" name="supplier_type" ng-model="selection.supplier_type" ng-value="supplierType.code">--}}
                                        {{--<label for="supplier_type@{{ $index }}">@{{ supplierType.description }}</label>--}}
                                    {{--</div>--}}
                                    {{--Code below is also not work--}}
                                    <input id="supplier_type0" type="radio" name="supplier_type" ng-model="po.supplier_type" ng-value="registeredType.code">
                                    <label for="supplier_type0">@{{ registeredType.description }}</label>
                                    <input id="supplier_type1" type="radio" name="supplier_type" ng-model="po.supplier_type" ng-value="walkinType.code">
                                    <label for="supplier_type1">@{{ walkinType.description }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSupplierId" class="col-sm-3 control-label">@lang('purchase_order.create.field.supplier_name')</label>
                                <div class="col-sm-9">
                                    <select id="inputSupplierId"
                                            name="supplier_id"
                                            class="form-control"
                                            ng-model="po.supplier"
                                            ng-options="supplier as supplier.name for supplier in supplierDDL track by supplier.id">
                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSupplierName" class="col-sm-3 control-label">@lang('purchase_order.create.field.supplier_name')</label>
                                <div class="col-sm-9">
                                    <input type="text" id="inputSupplierName" name="walk_in_supplier" class="form-control" ng-model="po.supplier_name"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSupplierDetails" class="col-sm-3 control-label">@lang('purchase_order.create.field.supplier_details')</label>
                                    <div class="col-sm-9">
                                        <textarea id="inputSupplierDetails" class="form-control" rows="5" name="walk_in_supplier_detail" ng-model="po.supplier_details"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('purchase_order.create.box.purchase_order_detail')</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputPoCode" class="col-sm-2 control-label">@lang('purchase_order.create.po_code')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPoCode" name="code" placeholder="PO Code" readonly ng-model="po.code">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPoType" class="col-sm-2 control-label">@lang('purchase_order.create.po_type')</label>
                                    <div class="col-sm-10">
                                        <select id="inputPoType"
                                                name="po_type"
                                                class="form-control"
                                                ng-model="po.poType"
                                                ng-options="poType as poType.description for poType in poTypeDDL track by poType.code">
                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPoDate" class="col-sm-2 control-label">@lang('purchase_order.create.po_date')</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" id="inputPoDate" name="po_created" ng-model="po.poCreated">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPoStatus" class="col-sm-2 control-label">@lang('purchase_order.create.po_status')</label>
                                    <div class="col-sm-10">
                                        <label class="control-label control-label-normal">@{{ po.status.description }}</label>
                                        <input type="hidden" name="status" value="@{{ po.status.code }}">
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
                            <h3 class="box-title">@lang('purchase_order.create.box.shipping')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputShippingDate" class="col-sm-3 control-label">@lang('purchase_order.create.field.shipping_date')</label>
                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" id="inputShippingDate" name="shipping_date" ng-model="po.shippingDate">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarehouse" class="col-sm-3 control-label">@lang('purchase_order.create.field.warehouse')</label>
                                <div class="col-sm-9">
                                    <select id="inputWarehouse"
                                            name="warehouse_id"
                                            class="form-control"
                                            ng-model="po.warehouse"
                                            ng-options="warehouse as warehouse.name for warehouse in warehouseDDL track by warehouse.id">
                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking" class="col-sm-3 control-label">@lang('purchase_order.create.field.vendor_trucking')</label>
                                <div class="col-sm-9">
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
                <div class="col-md-2">
                    <div class="box box-info">
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
                            <div class="col-md-11">
                                <select id="inputProduct"
                                        class="form-control"
                                        ng-model="po.product"
                                        ng-options="product as product.name for product in productDDL track by product.id">
                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary btn-md" ng-click="insertProduct(po.product)"><span class="fa fa-plus"/></button>
                            </div>
                            <br>
                            <br>
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="30%">@lang('purchase_order.create.table.item.header.product_name')</th>
                                            <th width="15%" class="text-center">@lang('purchase_order.create.table.item.header.header.quantity')</th>
                                            <th width="15%" class="text-center">@lang('purchase_order.create.table.item.header.unit')</th>
                                            <th width="15%" class="text-center">@lang('purchase_order.create.table.item.header.price_unit')</th>
                                            <th width="5%">&nbsp;</th>
                                            <th width="20%" class="text-center">@lang('purchase_order.create.table.item.header.total_price')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="item in po.items">
                                                <input type="hidden" name="product_id[]" ng-value="item.product.id">
                                                <input type="hidden" name="base_unit_id[]" ng-value="item.base_unit.unit.id">
                                                <td>@{{ item.product.name }}</td>
                                                <td>
                                                    <input type="text" class="form-control" name="quantity[]" ng-model="item.quantity">
                                                </td>
                                                <td>
                                                    <select name="selected_unit_id[]"
                                                            class="form-control"
                                                            ng-model="item.selected_unit"
                                                            ng-options="product_unit as product_unit.unit.symbol for product_unit in item.product.product_units track by product_unit.unit.id">
                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="price[]" ng-model="item.price">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-md" ng-click="removeProduct($index)"><span class="fa fa-minus"/></button>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="total_price[]" ng-value="item.quantity * item.price" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <table id="itemsTotalListTable" class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td width="80%" class="text-right">@lang('purchase_order.create.table.total.body.total')</td>
                                            <td width="20%" class="text-right">
                                                <input type="text" class="form-control" name="total_price" ng-model="grandTotal" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputRemarks" name="remarks" class="form-control" rows="5" ng-model="po.remarks"></textarea>
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
    </form>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module('poModule', []);

        app.controller("poController", ['$scope', function($scope) {
            $scope.supplierDDL = JSON.parse('{!! htmlspecialchars_decode($supplierDDL) !!}');
            $scope.warehouseDDL = JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}');
            $scope.poTypeDDL = JSON.parse('{!! htmlspecialchars_decode($poTypeDDL) !!}')
            $scope.supplierTypeDDL = JSON.parse('{!! htmlspecialchars_decode($supplierTypeDDL) !!}');
            $scope.vendorTruckingDDL = JSON.parse('{!! htmlspecialchars_decode($vendorTruckingDDL) !!}');
            $scope.productDDL = JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}');

            $scope.registeredType = $scope.supplierTypeDDL[0];
            $scope.walkinType = $scope.supplierTypeDDL[1];

            $scope.po = {
                status : JSON.parse('{!! htmlspecialchars_decode($poStatus) !!}')[0],
                code : '{{ $poCode }}',
                supplier_type: $scope.registeredType.code,
                items: []
            };

            function isBase(unit) {
                return unit.is_base == 1;
            }

            $scope.insertProduct = function (product){
                $scope.po.items.push({
                    'product': product,
                    'base_unit': product.product_units.find(isBase),
                    'quantity': 0,
                    'price': 0
                });
            }

            $scope.removeProduct = function (index) {
                $scope.po.items.splice(index, 1);
            }

        }]);

        $(function () {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });

            $("#inputPoDate").daterangepicker(
                    {
                        singleDatePicker: true,
                        showDropdowns: true
                    }
            );
            $("#inputShippingDate").daterangepicker(
                    {
                        singleDatePicker: true,
                        showDropdowns: true
                    }
            );
        });
    </script>
@endsection