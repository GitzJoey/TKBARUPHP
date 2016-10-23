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
                <div class="col-md-7">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.supplier')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSupplierType" class="col-sm-3 control-label">@lang('purchase_order.revise.field.supplier_type')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="@lang('lookup.'.$currentPo->supplier_type)">
                                </div>
                            </div>
                            @if($currentPo->supplier_type == 'SUPPLIERTYPE.r')
                            <div class="form-group">
                                <label for="inputSupplierId" class="col-sm-3 control-label">@lang('purchase_order.revise.field.supplier_name')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->supplier->name }}">
                                </div>
                            </div>
                            @else
                            <div class="form-group">
                                <label for="inputSupplierName" class="col-sm-3 control-label">@lang('purchase_order.revise.field.supplier_name')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->walk_in_supplier }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSupplierDetails" class="col-sm-3 control-label">@lang('purchase_order.revise.field.supplier_details')</label>
                                <div class="col-sm-9">
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
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->po_created }}">
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
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.shipping')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputShippingDate" class="col-sm-3 control-label">@lang('purchase_order.revise.field.shipping_date')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->shipping_date }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarehouse" class="col-sm-3 control-label">@lang('purchase_order.revise.field.warehouse')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->warehouse->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking" class="col-sm-3 control-label">@lang('purchase_order.revise.field.vendor_trucking')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->vendorTrucking->name }}">
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
                                                <input type="text" class="form-control" name="quantity[]" ng-model="item.quantity" {{ $currentPo->status == 'POSTATUS.WA' ? '' : 'disabled' }}>
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
                                                <input type="text" class="form-control" name="price[]" ng-model="item.price" {{ $currentPo->status == 'POSTATUS.WA' ? '' : 'disabled' }}>
                                            </td>
                                            <td>
                                                @if($currentPo->status == 'POSTATUS.WA')
                                                    <button type="button" class="btn btn-danger btn-md" ng-click="removeProduct($index)"><span class="fa fa-minus"/></button>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="total_price[]" ng-value="item.quantity * item.price" readonly>
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
                                            <td width="80%" class="text-right">@lang('purchase_order.revise.table.total.body.total')</td>
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
    {!! Form::close() !!}
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module('poModule', []);

        app.controller("poController", ['$scope', function($scope) {
            $scope.productDDL = JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}');
            $scope.currentPo = JSON.parse('{!! htmlspecialchars_decode($currentPo) !!}');
            $scope.po = {
              items: []
            };
            for(i = 0; i < $scope.currentPo.items.length; i++){
                $scope.po.items.push({
                    id: $scope.currentPo.items[i].id,
                    product: $scope.currentPo.items[i].product,
                    base_unit: $scope.currentPo.items[i].product.product_units.find(isBase),
                    quantity: $scope.currentPo.items[i].quantity,
                    price: $scope.currentPo.items[i].price
                });
            }
            function isBase(unit) {
                return unit.is_base == 1;
            }
            $scope.insertProduct = function (product){
                $scope.po.items.push({
                    id: null,
                    product: product,
                    base_unit: product.product_units.find(isBase),
                    quantity: 0,
                    price: 0
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