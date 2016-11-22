@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.inflow.index.title')
@endsection

@section('page_title')
    <span class="fa fa-mail-forward fa-rotate-90 fa-fw"></span>&nbsp;@lang('warehouse.inflow.index.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.inflow.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('inflow') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div ng-app="warehouseInflowModule" ng-controller="warehouseInflowController">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('warehouse.inflow.index.header.warehouse')</h3>
            </div>
            <div class="box-body">
                <select id="inputWarehouse"
                        class="form-control"
                        ng-model="warehouse"
                        ng-options="warehouse as warehouse.name for warehouse in warehouseDDL track by warehouse.id"
                        ng-change="getWarehousePOs(warehouse)">
                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                </select>
            </div>
        </div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('warehouse.inflow.index.header.purchase_order')</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">@lang('warehouse.inflow.index.table.header.code')</th>
                        <th class="text-center">@lang('warehouse.inflow.index.table.header.po_date')</th>
                        <th class="text-center">@lang('warehouse.inflow.index.table.header.supplier')</th>
                        <th class="text-center">@lang('warehouse.inflow.index.table.header.shipping_date')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="po in POs">
                            <td class="text-center">@{{ po.code }}</td>
                            <td class="text-center">@{{ po.po_created }}</td>
                            <td class="text-center">@{{ po.supplier.name }}</td>
                            <td class="text-center">@{{ po.shipping_date }}</td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-primary" href="{{ route('db.warehouse.inflow') }}/@{{ po.id }}" title="Receipt"><span class="fa fa-pencil fa-fw"></span></a>
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
        var app = angular.module('warehouseInflowModule', []);
        app.controller('warehouseInflowController', ['$scope', '$http', function($scope, $http) {
            $scope.warehouseDDL = JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}');

            $scope.POs = [];

            $scope.getWarehousePOs = function (warehouse) {
                $http.get('{{ route('api.warehouse.inflow.po') }}/' + warehouse.id).success(function (data) {
                    $scope.POs = data;
                });
            }
        }]);
    </script>
@endsection
