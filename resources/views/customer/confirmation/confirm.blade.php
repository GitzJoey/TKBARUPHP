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
                                    <input type="text" class="form-control" readonly value="{{ $so->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDeliverDate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.deliver_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" readonly value="{{ $so->items()->first()->delivers()->first()->deliver_date->format('d-m-Y') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputLicensePlate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.license_plate')</label>
                                <div class="col-sm-8">
                                    <input type="text" id="inputLicensePlate" name="license_plate" value="{{ $so->items()->first()->delivers()->first()->license_plate }}" class="form-control" data-parsley-required="true" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputConfirmReceiveDate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.confirm_receive_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="inputConfirmReceiveDate" name="confirm_receive_date" class="form-control" data-parsley-required="true">
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
                            <h3 class="box-title">@lang('customer.confirmation.confirm.box.items')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="20%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.product_name')</th>
                                                <th width="15%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.unit')</th>
                                                <th width="5%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.brutto')</th>
                                                <th width="15%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.netto')</th>
                                                <th width="15%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.tare')</th>
                                                <th width="25%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.remarks')</th>
                                                <th width="5%">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="deliver in outflow.delivers">
                                                <input type="hidden" name="item_id[]" ng-value="item.id">
                                                <input type="hidden" name="product_id[]" ng-value="item.product_id">
                                                <input type="hidden" name="base_unit_id[]" ng-value="item.base_unit_id">
                                                <td class="valign-middle">@{{ deliver.item.product.name }}</td>
                                                <td>
                                                    <select name="selected_unit_id[]" data-parsley-required="true"
                                                            class="form-control"
                                                            ng-model="selected_unit"
                                                            ng-options="product_unit as product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' for product_unit in deliver.item.product.product_units track by product_unit.unit.id">
                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input id="brutto_@{{ deliver.item.id }}" type="text" class="form-control text-right" name="brutto[]" ng-model="deliver.brutto"
                                                           data-parsley-required="true"
                                                           data-parsley-type="number"
                                                           data-parsley-trigger="change"
                                                           readonly>
                                                </td>
                                                <td>
                                                    <input id="netto_@{{ deliver.item.id }}" type="text" class="form-control text-right" name="netto[]" ng-model="deliver.netto"
                                                           data-parsley-required="true"
                                                           data-parsley-type="number"
                                                           data-parsley-checkequal="@{{ deliver.item.id }}"
                                                           data-parsley-trigger="change">
                                                </td>
                                                <td>
                                                    <input id="tare_@{{ deliver.item.id }}" type="text" class="form-control text-right" name="tare[]" ng-model="deliver.tare"
                                                           data-parsley-required="true"
                                                           data-parsley-type="number"
                                                           data-parsley-checkequal="@{{ deliver.item.id }}"
                                                           data-parsley-trigger="change">
                                                </td>
                                                <td>
                                                    <input id="remarks_@{{ deliver.item.id }}" type="text" class="form-control text-right" name="remarks[]" ng-model="deliver.remarks">
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
                    <a id="cancelButton" class="btn btn-primary pull-right" href="{{ route('db.customer.confirmation.confirm.customer', $so->warehouse->id) }}" >@lang('buttons.cancel_button')</a>
                </div>
            </div>
        </div>
        </div>
    </form>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module('custConfirmModule', []);
        app.controller("custConfirmController", ['$scope', function($scope) {
            var SO = JSON.parse('{!! htmlspecialchars_decode($so) !!}');

            $scope.outflow = {
                delivers : []
            };

            for(var i = 0; i < SO.items.length; i++){
                $scope.outflow.delivers.push({
                    item: SO.items[i],
                    selected_unit: _.find(SO.items[i].product.product_units, getSelectedUnit(SO.items[i].selected_unit_id)),
                    brutto: SO.items[i].quantity,
                    netto: 0,
                    tare: 0,
                    remarks: ''
                });
            }

            $scope.removeDeliver = function (index) {
                $scope.outflow.delivers.splice(index, 1);
            }

            function getSelectedUnit(selectedUnitId) {
                return function (element) {
                    return element.unit_id == selectedUnitId;
                }
            }
        }]);

        $(function () {
            $("#inputConfirmReceiveDate").daterangepicker({
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
                return false;
            } else {
                return false;
            }
        }, 32)
                .addMessage('en', 'checkequal', 'Netto and Tare value not equal with Bruto')
                .addMessage('id', 'checkequal', 'Nilai bersih dan Tara tidak sama dengan Nilai Kotor');
    </script>
@endsection