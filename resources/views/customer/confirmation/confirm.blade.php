@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.confirmation.confirm.title')
@endsection

@section('page_title')
    <span class="fa fa-check fa-fw"></span>&nbsp;@lang('customer.confirmation.confirm.page_title')
@endsection
@section('page_title_desc')
    @lang('customer.confirmation.confirm.page_title_desc')
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

    <form class="form-horizontal" action="{{ route('db.customer.confirmation.confirm', $so->hId())}}" method="post" data-parsley-validate="parsley">
        {{ csrf_field() }}
        <div ng-app="custConfirmModule" ng-controller="custConfirmController">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('customer.confirmation.confirm.box.sales_order')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSOCode" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.so_code')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $po->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputShippingDate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.shipping_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" readonly value="{{ $so->shipping_date->format('d-m-Y') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputConfirmDate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.deliver_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="inputDeliverDate" name="deliver_date" class="form-control" data-parsley-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputLicencePlate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.licence_plate')</label>
                                <div class="col-sm-8">
                                    <input type="text" id="inputLicencePlate" name="licence_plate" class="form-control" data-parsley-required="true">
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
                            <h3 class="box-title">@lang('customer.confirmation.confirm.box.items')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="" class="text-center">@lang('customer.confirmation.confirm.table.item.header.product_name')</th>
                                            <th width="" class="text-center">@lang('customer.confirmation.confirm.table.item.header.unit')</th>
                                            <th width="" class="text-center">@lang('customer.confirmation.confirm.table.item.header.brutto')</th>
                                            <th width="" class="text-center">@lang('customer.confirmation.confirm.table.item.header.netto')</th>
                                            <th width="" class="text-center">@lang('customer.confirmation.confirm.table.item.header.tare')</th>
                                            <th width="">&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="receipt in inflow.receipts">
                                            <input type="hidden" name="item_id[]" ng-value="item.id">
                                            <input type="hidden" name="product_id[]" ng-value="item.product_id">
                                            <input type="hidden" name="base_unit_id[]" ng-value="item.base_unit_id">
                                            <td class="valign-middle">@{{ item.product.name }}</td>
                                            <td>
                                                <select name="selected_unit_id[]" data-parsley-required="true"
                                                        class="form-control"
                                                        ng-model="selected_unit"
                                                        ng-options="product_unit as product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' for product_unit in item.product.product_units track by product_unit.unit.id">
                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input id="brutto_@{{ item.id }}" type="text" class="form-control text-right" name="brutto[]" ng-model="brutto"
                                                       data-parsley-required="true"
                                                       data-parsley-type="number"
                                                       data-parsley-checkequal="@{{ item.id }}"
                                                       data-parsley-trigger="change">
                                            </td>
                                            <td>
                                                <input id="netto_@{{ item.id }}" type="text" class="form-control text-right" name="netto[]" ng-model="netto"
                                                       data-parsley-required="true"
                                                       data-parsley-type="number"
                                                       data-parsley-checkequal="@{{ item.id }}"
                                                       data-parsley-trigger="change">
                                            </td>
                                            <td>
                                                <input id="tare_@{{ item.id }}" type="text" class="form-control text-right" name="tare[]" ng-model="tare"
                                                       data-parsley-required="true"
                                                       data-parsley-type="number"
                                                       data-parsley-checkequal="@{{ item.id }}"
                                                       data-parsley-trigger="change">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-md" ng-click="removeDeliver($index)"><span class="fa fa-minus"/></button>
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
                    <a id="cancelButton" class="btn btn-primary pull-right" href="{{ route('db.customer.confirmation.confirm.index', $po->warehouse->id) }}" >@lang('buttons.cancel_button')</a>
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
            var PO = {!! htmlspecialchars_decode($po) !!}

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
            $("#inputDeliverDate").daterangepicker({
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