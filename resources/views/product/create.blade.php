@extends('layouts.adminlte.master')

@section('title')
    @lang('product.create.title')
@endsection

@section('page_title')
    <span class="fa fa-cubes fa-fw"></span>&nbsp;@lang('product.create.page_title')
@endsection
@section('page_title_desc')
    @lang('product.create.page_title_desc')
@endsection

@section('custom_css')
    <style type="text/css">
        table thead {
            background-color: lightgray;
        }
    </style>
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('product.create.header.title')</h3>
        </div>
        <form id="productForm" class="form-horizontal" action="{{ route('db.master.product.create') }}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="inputType" class="col-sm-2 control-label">@lang('product.field.type')</label>
                    <div class="col-sm-10">
                        {{ Form::select('type', $prodtypeDdL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">@lang('product.field.name')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name') }} " placeholder="@lang('product.field.name')">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('image_path') ? 'has-error' : '' }}">
                    <label for="inputImagePath" class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="inputImagePath" name="image_path">
                        <span class="help-block">{{ $errors->has('image_path') ? $errors->first('image_path') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('short_code') ? 'has-error' : '' }}">
                    <label for="inputShortCode" class="col-sm-2 control-label">@lang('product.field.short_code')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputShortCode" name="short_code" value="{{ old('short_code') }}" placeholder="@lang('product.field.short_code')">
                        <span class="help-block">{{ $errors->has('short_code') ? $errors->first('short_code') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="inputDescription" class="col-sm-2 control-label">@lang('product.field.description')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputDescription" name="description" value="{{ old('description') }}" placeholder="@lang('product.field.description')">
                        <span class="help-block">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputProductUnit" class="col-sm-2 control-label">@lang('product.field.unit')</label>
                    <div class="col-sm-10">
                        <div ng-app="addUnitModule" ng-controller="addUnit">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" ng-model="selectedAll" ng-click="checkAll()" /></th>
                                    <th>@lang('product.create.table.header.unit')</th>
                                    <th class="text-center">@lang('product.create.table.header.is_base')</th>
                                    <th>@lang('product.create.table.header.conversion_value')</th>
                                    <th>@lang('product.create.table.header.remarks')</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="unit in units">
                                        <td class="text-center">
                                            <input type="checkbox" ng-model="unit.selected" ng-click="checkSelectAll()"/>
                                        </td>
                                        <td>
                                            {{ Form::select('unit_id[]', $unitDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select', 'ng-model' => 'unit.unit_id')) }}
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" ng-model="unit.is_base" ng-click="checkOnlyOneIsBase($index)" name="is_base[]"/>
                                            <input type="hidden" ng-model="unit.is_base_val" name="is_base[]"/>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" ng-model="unit.conversion_value" name="conversion_value[]"/>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" ng-model="unit.remarks" name="remarks[]"/>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button type="button" class="btn btn-xs btn-danger" ng-hide="!units.length" ng-click="remove()">@lang('buttons.remove_button')</button>
                                            <button type="button" class="btn btn-xs btn-primary" ng-click="addNew()">@lang('buttons.create_new_button')</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('product.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('product.field.remarks')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="remarks" name="remarks" value="{{ old('remarks') }}" placeholder="@lang('product.field.remarks')">
                        <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.product') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button id="submitButton" class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module("addUnitModule", []);
        app.controller("addUnit", ['$scope', function($scope) {
            $scope.units = [{
                'unit_id': '',
                'is_base': false,
                'is_base_val': false,
                'conversion_value':'',
                'remarks': ''
            }];

            $scope.addNew = function(unit) {
                $scope.units.push({
                    'unit_id': '',
                    'is_base': false,
                    'is_base_val': false,
                    'conversion_value': '',
                    'remarks': ''
                });
            };

            $scope.remove = function() {
                var newDataList=[];
                $scope.selectedAll = false;
                angular.forEach($scope.units, function(selected){
                    if(!selected.selected){
                        newDataList.push(selected);
                    }
                });
                $scope.units = newDataList;
            };

            $scope.checkAll = function() {
                if ($scope.selectedAll) {
                    $scope.selectedAll = true;
                } else {
                    $scope.selectedAll = false;
                }

                angular.forEach($scope.units, function(unit) {
                    unit.selected = $scope.selectedAll;
                });
            };

            $scope.checkSelectAll = function() {
                angular.forEach($scope.units, function(unit) {
                    if (unit.selected == false) {
                        $scope.selectedAll = false;
                    }
                });
            };

            $scope.checkOnlyOneIsBase = function($index) {
                for (var i=0; i<$scope.units.length; i++) {
                    if ($index == i) {
                        $scope.units[i].conversion_value = 1;
                        $scope.units[i].is_base_val = true;
                    } else {
                        $scope.units[i].is_base = false;
                        $scope.units[i].is_base_val = false;
                    }
                }
            };
        }]);
    </script>
@endsection