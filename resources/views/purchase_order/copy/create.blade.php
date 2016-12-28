@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.copy.create.title')
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/css/bootstrap-datetimepicker.min.css') }}">
@endsection

@section('page_title')
    <span class="fa fa-code-fork fa-rotate-180 fa-fw"></span>&nbsp;@lang('purchase_order.copy.create.page_title')
@endsection

@section('page_title_desc')
    @lang('purchase_order.copy.create.page_title_desc')
@endsection

@section('breadcrumbs')
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

    <div ng-app="poCopyModule" ng-controller="poCopyController" ng-cloak>
        {!! Form::model($poToBeCopied, ['method' => 'POST', 'route' => ['db.po.copy.create', $poCode], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('purchase_order.copy.create.box.supplier')</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputSupplierType"
                                           class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_type')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                               value="@lang('lookup.'.$poToBeCopied->supplier_type)">
                                    </div>
                                </div>
                                @if($poToBeCopied->supplier_type == 'SUPPLIERTYPE.R')
                                    <div class="form-group">
                                        <label for="inputSupplierId"
                                               class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_name')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" readonly
                                                   value="{{ $poToBeCopied->supplier->name }}">
                                        </div>
                                        <div class="col-sm-2">
                                            <button id="supplierDetailButton" type="button" class="btn btn-primary btn-sm"
                                                    data-toggle="modal" data-target="#supplierDetailModal"><span
                                                        class="fa fa-info-circle fa-lg"></span></button>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="inputSupplierName"
                                               class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_name')</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" readonly
                                                   value="{{ $poToBeCopied->walk_in_supplier }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSupplierDetails"
                                               class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_details')</label>
                                        <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" readonly>{{ $poToBeCopied->walk_in_supplier_details }}
                                        </textarea>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('purchase_order.copy.create.box.purchase_order_detail')</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputPoCode"
                                           class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_code')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" readonly value="{{ $poToBeCopied->code }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPoCopyCode"
                                           class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_copy_code')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" readonly name="code" value="{{ $poCopyCode }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPoType"
                                           class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_type')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" readonly
                                               value="@lang('lookup.'.$poToBeCopied->po_type)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPoDate"
                                           class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_date')</label>
                                    <div class="col-sm-9">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" readonly
                                                   value="{{ $poToBeCopied->po_created->format('d-m-Y') }}">
                                        </div>
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
                                <h3 class="box-title">@lang('purchase_order.copy.create.box.shipping')</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputShippingDate"
                                           class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.shipping_date')</label>
                                    <div class="col-sm-5">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" name="shipping_date" readonly
                                                   value="{{ $poToBeCopied->shipping_date->format('d-m-Y') }}"
                                                   data-parsley-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputWarehouse"
                                           class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.warehouse')</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $poToBeCopied->warehouse->name }}">
                                        <input type="hidden" name="warehouse_id" value="{{ $poToBeCopied->warehouse->id }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="inputVendorTrucking"
                                           class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.vendor_trucking')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                               value="{{ empty($poToBeCopied->vendorTrucking->name) ? '':$poToBeCopied->vendorTrucking->name }}">
                                        <input type="hidden" name="vendor_trucking_id"
                                               value="{{ empty($poToBeCopied->vendorTrucking->id) ? '':$poToBeCopied->vendorTrucking->id }}">
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
                                <h3 class="box-title">@lang('purchase_order.copy.create.box.transactions')</h3>
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
                                                <th width="30%">@lang('purchase_order.copy.create.table.item.header.product_name')</th>
                                                <th width="15%"
                                                    class="text-center">@lang('purchase_order.copy.create.table.item.header.quantity')</th>
                                                <th width="15%"
                                                    class="text-center">@lang('purchase_order.copy.create.table.item.header.unit')</th>
                                                <th width="15%"
                                                    class="text-center">@lang('purchase_order.copy.create.table.item.header.price_unit')</th>
                                                <th width="5%">&nbsp;</th>
                                                <th width="20%"
                                                    class="text-center">@lang('purchase_order.revise.table.item.header.total_price')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="item in po.items">
                                                <input type="hidden" name="product_id[]" ng-value="item.product.id">
                                                <input type="hidden" name="base_unit_id[]" ng-value="item.base_unit.unit.id">
                                                <td class="valign-middle">@{{ item.product.name }}</td>
                                                <td>
                                                    <input type="text" class="form-control text-right"
                                                           data-parsley-required="true" data-parsley-type="number"
                                                           name="quantity[]"
                                                           ng-model="item.quantity">
                                                </td>
                                                <td>
                                                    <select name="selected_unit_id[]"
                                                            class="form-control"
                                                            data-parsley-required="true"
                                                            ng-model="item.selected_unit"
                                                            ng-options="product_unit as product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' for product_unit in item.product.product_units track by product_unit.unit.id">
                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control text-right" name="price[]"
                                                           ng-model="item.price" data-parsley-required="true"
                                                           data-parsley-pattern="^(?!0\.00)\d{1,3}(,\d{3})*(\.\d\d)?$" fcsa-number>
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
                                                    class="text-right">@lang('purchase_order.copy.create.table.total.body.total')</td>
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
            <div class="col-md-3">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('purchase_order.copy.create.box.transaction_summary')</h3>
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
                        <h3 class="box-title">@lang('purchase_order.copy.create.box.remarks')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea id="inputPoRemarks" class="form-control"
                                                  rows="5" readonly>{{ $poToBeCopied->remarks }}</textarea>
                                    </div>
                                </div>
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
                        <h3 class="box-title">@lang('purchase_order.copy.create.box.po_copy_remarks')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea id="inputPoCopyRemarks" name="remarks" class="form-control"
                                                  rows="5"></textarea>
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
                    <button id="submitButton" type="submit"
                            class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>
                    &nbsp;&nbsp;&nbsp;
                    <a id="printButton" href="#" target="_blank"
                       class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>
                    <a id="cancelButton" href="{{ route('db.po.copy.index', $poCode) }}" class="btn btn-primary pull-right"
                       role="button">@lang('buttons.cancel_button')</a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

        @include('purchase_order.supplier_details_partial')
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module('poCopyModule', ['fcsa-number']);
        app.controller('poCopyController', ['$scope', function ($scope) {
            var currentPo = JSON.parse('{!! htmlspecialchars_decode($poToBeCopied->toJson()) !!}');

            $scope.po = {
                supplier: currentPo.supplier,
                items: [],
                warehouse: {
                    id: currentPo.warehouse.id,
                    name: currentPo.warehouse.name
                },
                vendorTrucking: {
                    id: (currentPo.vendor_trucking == null) ? '' : currentPo.vendor_trucking.id,
                    name: (currentPo.vendor_trucking == null) ? '' : currentPo.vendor_trucking.name
                }
            };

            for (var i = 0; i < currentPo.items.length; i++) {
                $scope.po.items.push({
                    id: currentPo.items[i].id,
                    product: currentPo.items[i].product,
                    base_unit: _.find(currentPo.items[i].product.product_units, isBase),
                    selected_unit: _.find(currentPo.items[i].product.product_units, getSelectedUnit(currentPo.items[i].selected_unit_id)),
                    quantity: parseFloat(currentPo.items[i].quantity).toFixed(0),
                    price: parseFloat(currentPo.items[i].price).toFixed(0)
                });
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
                    id: null,
                    product: product,
                    base_unit: _.find(product.product_units, isBase),
                    selected_unit: null,
                    quantity: 0,
                    price: 0
                });
            };

            $scope.removeItem = function (index) {
                $scope.po.items.splice(index, 1);
            };

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

            $("#inputShippingDate").datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment()
            });
        });
    </script>
@endsection