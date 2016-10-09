@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.create.title')
@endsection

@section('page_title')
    <span class="fa fa-smile-o fa-fw"></span>&nbsp;@lang('customer.create.page_title')
@endsection
@section('page_title_desc')
    @lang('customer.create.page_title_desc')
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
            <h3 class="box-title">@lang('customer.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.customer.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li><a href="#tab_customer" data-toggle="tab">@lang('customer.create.tab.customer')</a></li>
                                <li><a href="#tab_pic" data-toggle="tab">@lang('customer.create.tab.pic')</a></li>
                                <li><a href="#tab_bank_account" data-toggle="tab">@lang('customer.create.tab.bank_account')</a></li>
                                <li><a href="#tab_settings" data-toggle="tab">@lang('customer.create.tab.settings')</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_customer">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">@lang('customer.field.name')</label>
                                        <div class="col-sm-10">
                                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('customer.field.name')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                        <div class="col-sm-10">
                                            <textarea name="address" id="inputAddress" class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity" class="col-sm-2 control-label">@lang('customer.filed.city')</label>
                                        <div class="col-sm-10">
                                            <input id="inputCity" name="city" type="text" class="form-control" placeholder="@lang('customer.field.city')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-sm-2 control-label">@lang('customer.field.phone')</label>
                                        <div class="col-sm-10">
                                            <input id="inputPhone" name="phone" type="tel" class="form-control" placeholder="@lang('customer.field.phone')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('customer.field.remarks')</label>
                                        <div class="col-sm-10">
                                            <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="@lang('customer.field.remarks')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTaxId" class="col-sm-2 control-label">@lang('customer.field.tax_id')</label>
                                        <div class="col-sm-10">
                                            <input id="inputTaxId" name="tax_id" type="text" class="form-control" placeholder="@lang('customer.field.tax_id')">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_pic">
                                    <div ng-app="addCustomerProfileModule" ng-controller="addProfile">
                                        <div class="box-group" id="accordion">
                                            <div class="panel box box-default">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a class="collapsed" aria-expanded="false" href="#collapseOne" data-toggle="collapse" data-parent="#accordion">
                                                            @lang('customer.create.tab.header.profile_lists')
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false">
                                                    <div class="box-body">
                                                        <div class="row">
                                                            <div ng-repeat="profile in profiles">
                                                                <div class="col-md-3">
                                                                    <div class="box-body box-profile">
                                                                        <img class="profile-user-img img-responsive img-circle" alt="User profile picture" src="{{ asset('images/blank.png') }}">

                                                                        <h3 class="profile-username text-center">@{{ profile.first_name }}&nbsp;@{{ profile.last_name }}</h3>

                                                                        <p class="text-muted text-center">@{{ profile.designation }}</p>

                                                                        <ul class="list-group list-group-unbordered">
                                                                            <li class="list-group-item">
                                                                                <b>@lang('customer.field.ic_num')</b> <a class="pull-right">@{{ profile.ic_num }}</a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>@lang('customer.field.address')</b> <a class="pull-right">@{{ profile.address }}</a>
                                                                            </li>
                                                                        </ul>
                                                                        <button class="btn btn-danger btn-block" data="$index" ng-click="removeSelected($index)"><b>@lang('buttons.remove_button')</b></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel box box-default">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a class="collapsed" aria-expanded="false" href="#collapseTwo" data-toggle="collapse" data-parent="#accordion">
                                                            @lang('customer.create.tab.header.profile_inputs')
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="collapseTwo" aria-expanded="false" style="height: 0px;">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="inputFirstName" class="col-sm-2 control-label">@lang('customer.field.first_name')</label>
                                                            <div class="col-sm-10">
                                                                <input id="inputFirstName" type="text" class="form-control" ng-model="inputProfile.first_name" placeholder="@lang('customer.field.first_name')">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputLastName" class="col-sm-2 control-label">@lang('customer.field.last_name')</label>
                                                            <div class="col-sm-10">
                                                                <input id="inputLastName" type="text" class="form-control" ng-model="inputProfile.last_name" placeholder="@lang('customer.field.last_name')">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputAddress" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                                            <div class="col-sm-10">
                                                                <input id="inputAddress" type="text" class="form-control" ng-model="inputProfile.address" placeholder="@lang('customer.field.address')">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputICNum" class="col-sm-2 control-label">@lang('customer.field.ic_num')</label>
                                                            <div class="col-sm-10">
                                                                <input id="inputICNum" type="text" class="form-control" ng-model="inputProfile.ic_num" placeholder="@lang('customer.field.ic_num')">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputProfileButtons" class="col-sm-2 control-label">&nbsp;</label>
                                                            <div class="col-sm-10">
                                                                <button class="btn btn-xs btn-default" type="button" ng-click="resetInput()">@lang('buttons.reset_button')</button>
                                                                <button class="btn btn-xs btn-default" type="button" ng-click="addNew()">@lang('buttons.create_new_button')</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_bank_account">
                                    <div ng-app="addCustomerBankModule" ng-controller="addBank">
                                        <div class="box-group" id="accordion">
                                            <div class="panel box box-default">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a class="collapsed" aria-expanded="false" href="#collapseOne" data-toggle="collapse" data-parent="#accordion">
                                                            @lang('customer.create.tab.header.bank_lists')
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false">
                                                    <div class="box-body">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th class="text-center">@lang('customer.create.table.bank.header.bank')</th>
                                                                <th class="text-center">@lang('customer.create.table.bank.header.account_number')</th>
                                                                <th class="text-center">@lang('customer.create.table.bank.header.remarks')</th>
                                                                <th class="text-center">@lang('labels.ACTION')</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr ng-repeat="bank in banks">
                                                                    <td>
                                                                        @{{ bank.bank_name }}
                                                                        <input type="hidden" name="bank[]" value="@{{ bank.id }}">
                                                                    </td>
                                                                    <td>
                                                                        @{{ bank.account_number }}
                                                                        <input type="hidden" name="account_number[]" value="@{{ bank.account_number }}">
                                                                    </td>
                                                                    <td>
                                                                        @{{ bank.remarks }}
                                                                        <input type="hidden" name="remarks[]" value="@{{ bank.remarks }}">
                                                                    </td>
                                                                    <td class="text-center">
                                                                        <button type="button" class="btn btn-xs btn-danger" data="@{{ $index }}" ng-click="removeSelected($index)"><span class="fa fa-close fa-fw"></span></button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel box box-default">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a class="collapsed" aria-expanded="false" href="#collapseTwo" data-toggle="collapse" data-parent="#accordion">
                                                            @lang('customer.create.tab.header.bank_inputs')
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="collapseTwo" aria-expanded="false" style="height: 0px;">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="inputBank" class="col-sm-2 control-label">@lang('customer.field.bank')</label>
                                                            <div class="col-sm-10">
                                                                <select id="inputBank" class="form-control" ng-model="inputBank.id">
                                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                    @foreach($bankDDL as $bank)
                                                                        <option value="{{ $bank->id }}">{{ $bank->bank_full_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputBankAccount" class="col-sm-2 control-label">@lang('customer.field.bank_account')</label>
                                                            <div class="col-sm-10">
                                                                <input id="inputBankAccount" type="text" class="form-control" ng-model="inputBank.bank_account" placeholder="@lang('customer.field.bank_account')">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputRemarks" class="col-sm-2 control-label">@lang('customer.field.remarks')</label>
                                                            <div class="col-sm-10">
                                                                <input id="inputRemarks" type="text" class="form-control" ng-model="inputBank.remarks" placeholder="@lang('customer.field.remarks')">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputBankButtons" class="col-sm-2 control-label">&nbsp;</label>
                                                            <div class="col-sm-10">
                                                                <button class="btn btn-xs btn-default" type="button" ng-click="resetInput()">@lang('buttons.reset_button')</button>
                                                                <button class="btn btn-xs btn-default" type="button" ng-click="addNew()">@lang('buttons.create_new_button')</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_settings">
                                    <div class="form-group">
                                        <label for="inputPaymentDueDay" class="col-sm-2 control-label">@lang('customer.field.payment_due_day')</label>
                                        <div class="col-sm-10">
                                            <input id="inputPaymentDueDay" name="payment_due_day" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                        <a href="{{ route('db.master.customer') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module("addCustomerBankModule", []);
        app.controller("addBank", ['$scope', function($scope) {
            $scope.banks = [];

            $scope.addNew = function() {
                $scope.banks.push({
                    'id': $scope.inputBank.id,
                    'bank_name': $('#inputBank option:selected').text(),
                    'account_number': $scope.inputBank.bank_account,
                    'remarks': $scope.inputBank.remarks
                });
            };

            $scope.removeSelected = function(idx) {
                $scope.banks.splice(idx, 1);
            };

            $scope.resetInput = function() {
                $scope.inputBank = {};
            }
        }]);

        var app = angular.module("addCustomerProfileModule", []);
        app.controller("addProfile", ['$scope', function($scope) {
            $scope.profiles = [{
                'first_name': '',
                'last_name': '',
                'address': '',
                'ic_num': '',
                'image_filename': ''
            }];

            $scope.addNew = function() {
                $scope.banks.profiles({
                    'first_name': '',
                    'last_name': '',
                    'address': '',
                    'ic_num': '',
                    'image_filename': ''
                });
            };

            $scope.removeSelected = function(idx) {
                $scope.profiles.splice(idx, 1);
            };
        }]);
    </script>
@endsection