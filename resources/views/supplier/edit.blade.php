@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-building-o fa-fw"></span>&nbsp;@lang('supplier.edit.page_title')
@endsection
@section('page_title_desc')
    @lang('supplier.edit.page_title_desc')
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

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('supplier.edit.header.title')</h3>
        </div>
        {!! Form::model($supplier, ['method' => 'PATCH','route' => ['db.master.supplier.edit', $supplier->hId()], 'class' => 'form-horizontal']) !!}
            {{ csrf_field() }}
            <div ng-app="supplierModule" ng-controller="supplierController">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li><a href="#tab_supplier" data-toggle="tab">@lang('supplier.edit.tab.supplier')</a></li>
                                    <li><a href="#tab_pic" data-toggle="tab">@lang('supplier.edit.tab.pic')</a></li>
                                    <li><a href="#tab_bank_account" data-toggle="tab">@lang('supplier.edit.tab.bank_account')</a></li>
                                    <li><a href="#tab_bank_account" data-toggle="tab">@lang('supplier.edit.tab.product')</a></li>
                                    <li><a href="#tab_settings" data-toggle="tab">@lang('supplier.edit.tab.settings')</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_customer">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-2 control-label">@lang('supplier.field.name')</label>
                                            <div class="col-sm-10">
                                                <input id="inputName" name="name" type="text" class="form-control" value="{{ $supplier->name }}" placeholder="@lang('supplier.field.name')">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputAddress" class="col-sm-2 control-label">@lang('supplier.field.address')</label>
                                            <div class="col-sm-10">
                                                <textarea name="address" id="inputAddress" class="form-control" rows="4">{{ $supplier->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputCity" class="col-sm-2 control-label">@lang('supplier.field.city')</label>
                                            <div class="col-sm-10">
                                                <input id="inputCity" name="city" type="text" class="form-control" value="{{ $supplier->city }}" placeholder="@lang('supplier.field.city')">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPhone" class="col-sm-2 control-label">@lang('supplier.field.phone')</label>
                                            <div class="col-sm-10">
                                                <input id="inputPhone" name="phone" type="tel" class="form-control" value="{{ $supplier->phone }}" placeholder="@lang('supplier.field.phone')">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputTaxId" class="col-sm-2 control-label">@lang('supplier.field.tax_id')</label>
                                            <div class="col-sm-10">
                                                <input id="inputTaxId" name="tax_id" type="text" class="form-control" value="{{ $supplier->tax_id }}" placeholder="@lang('supplier.field.tax_id')">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputRemarks" class="col-sm-2 control-label">@lang('supplier.field.remarks')</label>
                                            <div class="col-sm-10">
                                                <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $supplier->remarks }}" placeholder="@lang('supplier.field.remarks')">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_pic">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <button class="btn btn-xs btn-default" type="button" ng-click="addNewProfile()">@lang('buttons.create_new_button')</button>
                                            </div>
                                            <div class="col-md-11">
                                                <div ng-repeat="profile in profiles">
                                                    <div class="box box-widget">
                                                        <div class="box-header with-border">
                                                            <div class="user-block">
                                                                <strong>Person In Charge @{{ $index + 1 }}</strong><br/>
                                                                &nbsp;&nbsp;&nbsp;@{{ profile.first_name }}&nbsp;@{{ profile.last_name }}
                                                            </div>
                                                            <div class="box-tools">
                                                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="inputFirstName" class="col-sm-2 control-label">@lang('supplier.field.first_name')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputFirstName" type="text" name="first_name[]" class="form-control" ng-model="profile.first_name" placeholder="@lang('supplier.field.first_name')">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputLastName" class="col-sm-2 control-label">@lang('supplier.field.last_name')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputLastName" type="text" name="last_name[]" class="form-control" ng-model="profile.last_name" placeholder="@lang('supplier.field.last_name')">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress" class="col-sm-2 control-label">@lang('supplier.field.address')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputAddress" type="text" name="profile_address[]" class="form-control" ng-model="profile.address" placeholder="@lang('supplier.field.address')">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputICNum" class="col-sm-2 control-label">@lang('supplier.field.ic_num')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputICNum" type="text" name="ic_num[]" class="form-control" ng-model="profile.ic_num" placeholder="@lang('supplier.field.ic_num')">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputPhoneNumber" class="col-sm-2 control-label">@lang('supplier.field.phone_number')</label>
                                                                <div class="col-sm-10">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>@lang('supplier.edit.table_phone.header.provider')</th>
                                                                            <th>@lang('supplier.edit.table_phone.header.number')</th>
                                                                            <th>@lang('supplier.edit.table_phone.header.remarks')</th>
                                                                            <th class="text-center">@lang('labels.ACTION')</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr ng-repeat="ph in profile.get_phone_number">
                                                                            <td>
                                                                                <select name="profile_@{{ $parent.$index }}_phone_provider[]" class="form-control"
                                                                                        ng-model="ph.phone_provider_id"
                                                                                        ng-options="p.id as p.name + ' (' + p.short_name + ')' for p in providerDDL track by p.id">
                                                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                                </select>
                                                                            </td>
                                                                            <td><input type="text" name="profile_@{{ $parent.$index }}_phone_number[]" class="form-control" ng-model="ph.number"></td>
                                                                            <td><input type="text" class="form-control" name="profile_@{{ $parent.$index }}_remarks[]" ng-model="ph.remarks"></td>
                                                                            <td class="text-center">
                                                                                <button type="button" class="btn btn-xs btn-danger" data="@{{ $index }}" ng-click="removeSelectedPhone($parent.$index, $index)">
                                                                                    <span class="fa fa-close fa-fw"></span>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                        <tfoot>
                                                                        <tr>
                                                                            <td colspan="4">
                                                                                <button type="button" class="btn btn-xs btn-default" ng-click="addNewPhone($index)">@lang('buttons.create_new_button')</button>
                                                                            </td>
                                                                        </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_bank_account">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="text-center">@lang('supplier.edit.table_bank.header.bank')</th>
                                                <th class="text-center">@lang('supplier.edit.table_bank.header.account_number')</th>
                                                <th class="text-center">@lang('supplier.edit.table_bank.header.remarks')</th>
                                                <th class="text-center">@lang('labels.ACTION')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="bank in banks">
                                                <td>
                                                    <select class="form-control"
                                                            name="bank[]"
                                                            ng-model="bank.bank_id"
                                                            ng-options="b.id as b.name + ' (' + b.short_name + ')' for b in bankDDL track by b.id">
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="account_number[]" ng-model="bank.account_number">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="bank_remarks[]" ng-model="bank.remarks">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-xs btn-danger" data="@{{ $index }}" ng-click="removeSelectedBank($index)"><span class="fa fa-close fa-fw"></span></button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-xs btn-default" type="button" ng-click="addNewBank()">@lang('buttons.create_new_button')</button>
                                    </div>
                                    <div class="tab-pane" id="tab_settings">
                                        <div class="form-group">
                                            <label for="inputPaymentDueDay" class="col-sm-2 control-label">@lang('supplier.field.payment_due_day')</label>
                                            <div class="col-sm-10">
                                                <input id="inputPaymentDueDay" name="payment_due_day" type="text" value="{{ $supplier->payment_due_day }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-2">
                            <a href="{{ route('db.master.supplier') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                            <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                        </div>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module("supplierModule", []);
        app.controller("supplierController", ['$scope', function($scope) {
            $scope.banks = JSON.parse('{!! empty(htmlspecialchars_decode($supplier->getBankAccount)) ? '[]':htmlspecialchars_decode($supplier->getBankAccount) !!}');
            $scope.profiles = JSON.parse('{!! empty(htmlspecialchars_decode($supplier->getProfiles)) ? '[]':htmlspecialchars_decode($supplier->getProfiles) !!}');
            $scope.bankDDL = JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}');
            $scope.providerDDL = JSON.parse('{!! htmlspecialchars_decode($providerDDL) !!}');

            $scope.addNewBank = function() {
                $scope.banks.push({
                    'bank_id': '',
                    'account_number': '',
                    'remarks': '',
                });
            };

            $scope.removeSelectedBank = function(idx) {
                $scope.banks.splice(idx, 1);
            };

            $scope.resetInputBank = function() {
                $scope.inputBank = {};
            };

            $scope.addNewProfile = function() {
                $scope.profiles.push({
                    'first_name': '',
                    'last_name': '',
                    'address': '',
                    'ic_num': '',
                    'image_filename': '',
                    'get_phone_number':[{
                        'phone_provider_id': '',
                        'number': '',
                        'remarks': ''
                    }]
                });
            };

            $scope.removeSelectedProfile = function(idx) {
                $scope.profiles.splice(idx, 1);
            };

            $scope.addNewPhone = function(parentIndex) {
                $scope.profiles[parentIndex].get_phone_number.push({
                    'phone_provider_id': '',
                    'number': '',
                    'remarks': ''
                });
            };

            $scope.removeSelectedPhone = function(parentIndex, idx) {
                $scope.profiles[parentIndex].get_phone_number.splice(idx, 1);
            };
        }]);
    </script>
@endsection