@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.inflow.receipt.title')
@endsection

@section('page_title')
    <span class="fa fa-mail-forward fa-rotate-90 fa-fw"></span>&nbsp;@lang('warehouse.inflow.receipt.page_title')
@endsection
@section('page_title_desc')
    @lang('warehouse.inflow.receipt.page_title_desc')
@endsection
@section('breadcrumbs')
    {!! Breadcrumbs::render('receipt', $po->hId(), $po->warehouse_id) !!}
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

    <form class="form-horizontal" action="{{ route('db.warehouse.inflow', $po->hId())}}" method="post" data-parsley-validate="parsley">
        {{ csrf_field() }}
        <div ng-app="warehouseInflowModule" ng-controller="warehouseInflowController">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.inflow.receipt.box.receipt')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputWarehouse" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.warehouse')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $po->warehouse->name }}">
                                    <input type="hidden" name="warehouse_id" value="{{ $po->warehouse->id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPOCode" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.po_code')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $po->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputShippingDate" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.shipping_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" readonly value="{{ $po->shipping_date->format('d-m-Y') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputReceiptDate" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.receipt_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="inputReceiptDate" name="receipt_date" class="form-control" data-parsley-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.vendor_trucking')</label>
                                <div class="col-sm-8">
                                    @if (empty($po->vendorTrucking))
                                        <input type="text" class="form-control" readonly value="" >
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $po->vendorTrucking->name }}" >
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputLicensePlate" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.license_plate')</label>
                                <div class="col-sm-8">
                                    <input type="text" id="inputLicensePlate" name="license_plate" class="form-control" data-parsley-required="true">
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
                            <h3 class="box-title">@lang('warehouse.inflow.receipt.box.items')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.product_name')</th>
                                            <th width="" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.unit')</th>
                                            <th width="" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.brutto')</th>
                                            <th width="" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.netto')</th>
                                            <th width="" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.tare')</th>
                                            <th width="">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="receipt in inflow.receipts">
                                            <input type="hidden" name="item_id[]" ng-value="receipt.item.id">
                                            <input type="hidden" name="product_id[]" ng-value="receipt.item.product_id">
                                            <input type="hidden" name="base_unit_id[]" ng-value="receipt.item.base_unit_id">
                                            <td class="valign-middle">@{{ receipt.item.product.name }}</td>
                                            <td>
                                                <select name="selected_unit_id[]" data-parsley-required="true"
                                                        class="form-control"
                                                        ng-model="receipt.selected_unit"
                                                        ng-options="product_unit as product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' for product_unit in receipt.item.product.product_units track by product_unit.unit.id">
                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input id="brutto_@{{ receipt.item.id }}" type="text" class="form-control text-right" name="brutto[]" ng-model="receipt.brutto"
                                                       data-parsley-required="true"
                                                       data-parsley-type="number"
                                                       data-parsley-checkequal="@{{ receipt.item.id }}"
                                                       data-parsley-trigger="change">
                                            </td>
                                            <td>
                                                <input id="netto_@{{ receipt.item.id }}" type="text" class="form-control text-right" name="netto[]" ng-model="receipt.netto"
                                                       data-parsley-required="true"
                                                       data-parsley-type="number"
                                                       data-parsley-checkequal="@{{ receipt.item.id }}"
                                                       data-parsley-trigger="change">
                                            </td>
                                            <td>
                                                <input id="tare_@{{ receipt.item.id }}" type="text" class="form-control text-right" name="tare[]" ng-model="receipt.tare"
                                                       data-parsley-required="true"
                                                       data-parsley-type="number"
                                                       data-parsley-checkequal="@{{ receipt.item.id }}"
                                                       data-parsley-trigger="change">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-md" ng-click="removeReceipt($index)"><span class="fa fa-minus"/></button>
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
        <div class="row">
            <div class="col-md-7 col-offset-md-5">
                <div class="btn-toolbar">
                    <button id="submitButton" type="submit" class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>&nbsp;&nbsp;&nbsp;
                    <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                    <a id="cancelButton" class="btn btn-primary pull-right" href="{{ route('db.warehouse.inflow.index', $po->warehouse->id) }}" >@lang('buttons.cancel_button')</a>
                </div>
            </div>
        </div>
        </div>
    </form>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module('warehouseInflowModule', []);
        app.controller("warehouseInflowController", ['$scope', function($scope) {
            var PO =JSON.parse('{!! htmlspecialchars_decode($po) !!}');

            $scope.inflow = {
                receipts : []
            };

            for(var i = 0; i < PO.items.length; i++){
                $scope.inflow.receipts.push({
                    item: PO.items[i],
                    selected_unit: _.find(PO.items[i].product.product_units, getSelectedUnit(PO.items[i].selected_unit_id)),
                    brutto: PO.items[i].quantity,
                    netto: PO.items[i].quantity,
                    tare: 0
                });
            }

            $scope.removeReceipt = function (index) {
                $scope.inflow.receipts.splice(index, 1);
            }

            function getSelectedUnit(selectedUnitId) {
                return function (element) {
                    return element.unit_id == selectedUnitId;
                }
            }
        }]);

        $(function () {
            $("#inputReceiptDate").daterangepicker({
                locale: {
                    format: 'DD-MM-YYYY'
                },
                singleDatePicker: true,
                showDropdowns: true
            });
        });

        window.Parsley.addValidator('checkequal', function (value, itemId) {
            var brutto = '#brutto_' + itemId;
            var netto = '#netto_' + itemId;
            var tare = '#tare_' + itemId;

            if (Number($(brutto).val()) == (Number($(netto).val()) + Number($(tare).val()))) {
                return true;
            } else {
                return false;
            }
        }, 32)
                .addMessage('en', 'checkequal', 'Netto and Tare value not equal with Bruto')
                .addMessage('id', 'checkequal', 'Nilai bersih dan Tara tidak sama dengan Nilai Kotor');
    </script>
@endsection