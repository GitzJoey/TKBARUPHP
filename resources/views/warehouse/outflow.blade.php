@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.outflow.index.title')
@endsection

@section('page_title')
    <span class="fa fa-mail-forward fa-rotate-90 fa-fw"></span>&nbsp;@lang('warehouse.outflow.index.page_title')
@endsection
@section('page_title_desc')
    @lang('warehouse.outflow.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div ng-app="warehouseOutflowModule" ng-controller="warehouseOutflowController">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('warehouse.outflow.index.header.warehouse')</h3>
            </div>
            <div class="box-body">
                <select id="inputWarehouse"
                        class="form-control"
                        ng-model="warehouse"
                        ng-options="warehouse as warehouse.name for warehouse in warehouseDDL track by warehouse.id">
                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                </select>
            </div>
        </div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('warehouse.outflow.index.header.sales_order')</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">@lang('warehouse.outflow.index.table.header.code')</th>
                        <th class="text-center">@lang('warehouse.outflow.index.table.header.so_date')</th>
                        <th class="text-center">@lang('warehouse.outflow.index.table.header.customer')</th>
                        <th class="text-center">@lang('warehouse.outflow.index.table.header.shipping_date')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="so in selectedWarehouseSo(warehouse)">
                        <td class="text-center">@{{ so.code }}</td>
                        <td class="text-center">@{{ so.po_created }}</td>
                        <td class="text-center">@{{ so.supplier.name }}</td>
                        <td class="text-center">@{{ so.shipping_date }}</td>
                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-primary" href="{{ route('db.warehouse.outflow.index') }}/@{{ po.id }}" title="Deliver"><span class="fa fa-pencil fa-fw"></span></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('custom_js')
    <script type="application/javascript">
        var app = angular.module('warehouseOutflowModule', []);
        app.controller('warehouseOutflowController', ['$scope', function($scope) {
            $scope.warehouseDDL = JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}');
            $scope.allSOs = JSON.parse('{!! htmlspecialchars_decode($allSOs) !!}');

            $scope.selectedWarehouseSo = function (warehouse) {
                return _.filter($scope.allSOs, function (SO) {
                    return SO.warehouse_id === warehouse.id;
                });
            };
        }]);
    </script>
@endsection
