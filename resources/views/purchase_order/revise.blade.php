@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.revise.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-fw"></span>&nbsp;@lang('purchase_order.revise.page_title')
@endsection
@section('page_title_desc')
    @lang('purchase_order.revise.page_title_desc')
@endsection

@section('content')
    {!! Form::model($currentPo, ['method' => 'PATCH','route' => ['db.po.revise', $currentPo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
        {{ csrf_field() }}
        <div ng-app="poModule" ng-controller="poController">
            <div class="row">
                <div class="col-md-5">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.supplier')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSupplierType" class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_type')</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly value="@lang('lookup.'.$currentPo->supplier_type)">
                                </div>
                            </div>
                            @if($currentPo->supplier_type == 'SUPPLIERTYPE.r')
                            <div class="form-group">
                                <label for="inputSupplierId" class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_name')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->supplier->name }}">
                                </div>
                            </div>
                            @else
                            <div class="form-group">
                                <label for="inputSupplierName" class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_name')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->walk_in_supplier }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSupplierDetails" class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_details')</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="5" readonly>{{ $currentPo->walk_in_supplier_details }}
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
                            <h3 class="box-title">@lang('purchase_order.revise.box.purchase_order_detail')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPoCode" class="col-sm-2 control-label">@lang('purchase_order.revise.po_code')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoType" class="col-sm-2 control-label">@lang('purchase_order.revise.po_type')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="@lang('lookup.'.$currentPo->po_type)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoDate" class="col-sm-2 control-label">@lang('purchase_order.revise.po_date')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->po_created->format('d-m-Y') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoStatus" class="col-sm-2 control-label">@lang('purchase_order.revise.po_status')</label>
                                <div class="col-sm-10">
                                    <label class="control-label control-label-normal">@lang('lookup.'.$currentPo->status)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-offset-1">
                    &nbsp;
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.shipping')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputShippingDate" class="col-sm-2 control-label">@lang('purchase_order.revise.field.shipping_date')</label>
                                <div class="col-sm-5">
                                    @if($currentPo->status == 'POSTATUS.WA')
                                        <input type="text" class="form-control" id="inputShippingDate" name="shipping_date" value="{{ $currentPo->shipping_date->format('d-m-Y') }}" data-parsley-required="true">
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $currentPo->shipping_date->format('d-m-Y') }}" data-parsley-required="true">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarehouse" class="col-sm-2 control-label">@lang('purchase_order.revise.field.warehouse')</label>
                                <div class="col-sm-5">
                                    @if($currentPo->status == 'POSTATUS.WA')
                                    <select id="inputWarehouse" data-parsley-required="true"
                                            name="warehouse_id"
                                            class="form-control"
                                            ng-model="po.warehouse"
                                            ng-options="warehouse as warehouse.name for warehouse in warehouseDDL track by warehouse.id">
                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                    </select>
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $currentPo->warehouse->name }}">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking" class="col-sm-2 control-label">@lang('purchase_order.revise.field.vendor_trucking')</label>
                                <div class="col-sm-8">
                                    @if($currentPo->status == 'POSTATUS.WA')
                                    <select id="inputVendorTrucking" data-parsley-required="true"
                                            name="vendor_trucking_id"
                                            class="form-control"
                                            ng-model="po.vendorTrucking"
                                            ng-options="vendorTrucking as vendorTrucking.name for vendorTrucking in vendorTruckingDDL track by vendorTrucking.id">
                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                    </select>
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $currentPo->vendorTrucking->name }}">
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
                <div class="col-md-11">
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
                                                ng-model="po.product"
                                                ng-options="product as product.name for product in productDDL track by product.id">
                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-primary btn-md" ng-click="insertProduct(po.product)"><span class="fa fa-plus"/></button>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="30%">@lang('purchase_order.revise.table.item.header.product_name')</th>
                                            <th width="15%" class="text-center">@lang('purchase_order.revise.table.item.header.header.quantity')</th>
                                            <th width="15%" class="text-center">@lang('purchase_order.revise.table.item.header.unit')</th>
                                            <th width="15%" class="text-center">@lang('purchase_order.revise.table.item.header.price_unit')</th>
                                            <th width="5%">&nbsp;</th>
                                            <th width="20%" class="text-center">@lang('purchase_order.revise.table.item.header.total_price')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="item in po.items">
                                            <input type="hidden" name="id[]" ng-value="item.id">
                                            <input type="hidden" name="product_id[]" ng-value="item.product.id">
                                            <input type="hidden" name="base_unit_id[]" ng-value="item.base_unit.unit.id">
                                            <td>@{{ item.product.name }}</td>
                                            <td>
                                                <input type="text" class="form-control text-right" name="quantity[]" ng-model="item.quantity" {{ $currentPo->status == 'POSTATUS.WA' ? '' : 'disabled' }}>
                                            </td>
                                            <td>
                                                @if($currentPo->status == 'POSTATUS.WA')
                                                <select name="selected_unit_id[]"
                                                        class="form-control"
                                                        ng-model="item.selected_unit"
                                                        ng-options="product_unit as product_unit.unit.symbol for product_unit in item.product.product_units track by product_unit.unit.id">
                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                </select>
                                                @else
                                                    <input type="text" class="form-control" readonly value="@{{ item.selected_unit.unit.symbol }}">
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" class="form-control text-right" name="price[]" ng-model="item.price">
                                            </td>
                                            <td class="text-center">
                                                @if($currentPo->status == 'POSTATUS.WA')
                                                    <button type="button" class="btn btn-danger btn-md" ng-click="removeProduct($index)"><span class="fa fa-minus"/></button>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" class="form-control text-right" name="total_price[]" ng-value="item.quantity * item.price" readonly>
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
                                            <td width="80%" class="text-right">@lang('purchase_order.create.table.total.body.total')</td>
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
                <div class="col-md-offset-1">
                    &nbsp;
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.remarks')</h3>
                        </div>
                        <div class="box-body">
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
        </div>
    {!! Form::close() !!}
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module('poModule', []);

        app.controller("poController", ['$scope', function($scope) {
            $scope.productDDL = JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}');
            $scope.currentPo = JSON.parse('{!! htmlspecialchars_decode($currentPo) !!}');
            $scope.warehouseDDL = JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}');
            $scope.vendorTruckingDDL = JSON.parse('{!! htmlspecialchars_decode($vendorTruckingDDL) !!}');

            $scope.po = {
              items: [],
              warehouse: {
                  id: $scope.currentPo.warehouse.id,
                  name: $scope.currentPo.warehouse.name
              },
              vendorTrucking : {
                  id: $scope.currentPo.vendor_trucking.id,
                  name: $scope.currentPo.vendor_trucking.name
              }
            };

            for(i = 0; i < $scope.currentPo.items.length; i++){
                $scope.po.items.push({
                    product: $scope.currentPo.items[i].product,
                    base_unit: _.find($scope.currentPo.items[i].product.product_units, isBase),
                    selected_unit: _.find($scope.currentPo.items[i].product.product_units, getSelectedUnit($scope.currentPo.items[i].selected_unit_id)),
                    quantity: $scope.currentPo.items[i].quantity,
                    price: $scope.currentPo.items[i].price
                });
            }

            $scope.grandTotal = function() {
                var result = 0;
                angular.forEach($scope.po.items, function(item, key) {
                    result += (item.quantity * item.price);
                });
                return result;
            };

            $scope.insertProduct = function (product){
                $scope.po.items.push({
                    product: product,
                    base_unit: _.find(product.product_units, isBase),
                    selected_unit: null,
                    quantity: 0,
                    price: 0
                });
            };

            $scope.removeProduct = function (index) {
                $scope.po.items.splice(index, 1);
            }

            function getSelectedUnit(selectedUnitId) {
                return function (element) {
                    return element.unit_id == selectedUnitId;
                }
            }

            function isBase(unit) {
                return unit.is_base == 1;
            }
        }]);

        $(function () {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });
            $("#inputShippingDate").daterangepicker(
                    {
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