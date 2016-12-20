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

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_supplier_edit', $supplier->hId()) !!}
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
        {!! Form::model($supplier, ['id' => 'supplierForm', 'method' => 'PATCH', 'route' => ['db.master.supplier.edit', $supplier->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            {{ csrf_field() }}
            <div ng-app="supplierModule" ng-controller="supplierController">
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_supplier" class="active" data-toggle="tab">@lang('supplier.edit.tab.supplier')&nbsp;<span id="suppDataTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_pic" data-toggle="tab">@lang('supplier.edit.tab.pic')&nbsp;<span id="picTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_bank_account" data-toggle="tab">@lang('supplier.edit.tab.bank_account')&nbsp;<span id="bankAccountTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_product" data-toggle="tab">@lang('supplier.edit.tab.product')</a></li>
                            <li><a href="#tab_expenses" data-toggle="tab">@lang('supplier.edit.tab.expenses')&nbsp;<span id="expensesTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_settings" data-toggle="tab">@lang('supplier.edit.tab.settings')&nbsp;<span id="settingsTabError" class="parsley-asterisk hidden">*</span></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_supplier">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">@lang('supplier.field.name')</label>
                                    <div class="col-sm-10">
                                        <input id="inputName" name="name" type="text" class="form-control" value="{{ $supplier->name }}" placeholder="@lang('supplier.field.name')" data-parsley-required="true" data-parsley-group="tab_supp">
                                        <span class="help-block"></span>
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
                                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label for="inputStatus" class="col-sm-2 control-label">@lang('supplier.field.status')</label>
                                    <div class="col-sm-10">
                                        {{ Form::select('status', $statusDDL, $supplier->status, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true', 'data-parsley-group' => 'tab_supp')) }}
                                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
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
                                                            <input type="hidden" name="profile_id[]" ng-value="profile.id">
                                                            <input id="inputFirstName" type="text" name="first_name[]" class="form-control" ng-model="profile.first_name" placeholder="@lang('supplier.field.first_name')" data-parsley-required="true" data-parsley-group="tab_pic">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputLastName" class="col-sm-2 control-label">@lang('supplier.field.last_name')</label>
                                                        <div class="col-sm-10">
                                                            <input id="inputLastName" type="text" name="last_name[]" class="form-control" ng-model="profile.last_name" placeholder="@lang('supplier.field.last_name')" data-parsley-required="true" data-parsley-group="tab_pic">
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
                                                            <input id="inputICNum" type="text" name="ic_num[]" class="form-control" ng-model="profile.ic_num" placeholder="@lang('supplier.field.ic_num')" data-parsley-required="true" data-parsley-group="tab_pic">
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
                                                                <tr ng-repeat="ph in profile.phone_numbers">
                                                                    <td>
                                                                        <input type="hidden" name="profile_@{{ $parent.$index }}_phone_number_id[]" ng-value="ph.id">
                                                                        <select name="profile_@{{ $parent.$index }}_phone_provider[]" class="form-control"
                                                                                ng-init="phone_provider = { id: ph.phone_provider_id }"
                                                                                ng-model="phone_provider"
                                                                                ng-change="ph.phone_provider_id = phone_provider.id"
                                                                                ng-options="p as p.name + ' (' + p.short_name + ')' for p in providerDDL track by p.id"
                                                                                data-parsley-required="true" data-parsley-group="tab_pic">
                                                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="text" name="profile_@{{ $parent.$index }}_phone_number[]" class="form-control" ng-model="ph.number" data-parsley-required="true" data-parsley-group="tab_pic"></td>
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
                                            <input type="hidden" name="bank_account_id[]" ng-value="bank.id">
                                            <select name="bank[]" class="form-control"
                                                    ng-init="bank_list = { id: bank.bank_id }"
                                                    ng-model="bank_list"
                                                    ng-change="bank.bank_id = bank_list.id"
                                                    ng-options="b as b.name + ' (' + b.short_name + ')' for b in bankDDL track by b.id"
                                                    data-parsley-required="true" data-parsley-group="tab_bank">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="account_number[]" ng-model="bank.account_number" data-parsley-required="true" data-parsley-group="tab_bank">
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
                            <div class="tab-pane" id="tab_product">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">@lang('supplier.edit.table.header.type')</th>
                                        <th class="text-center">@lang('supplier.edit.table.header.name')</th>
                                        <th class="text-center">@lang('supplier.edit.table.header.short_code')</th>
                                        <th class="text-center">@lang('supplier.edit.table.header.description')</th>
                                        <th class="text-center">@lang('supplier.edit.table.header.remarks')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="p in productList">
                                        <td class="text-center"><input type="checkbox" name="productSelected[]" ng-model="productSelected[p.id]" value="@{{ p.id }}"></td>
                                        <td>@{{ p.type.name }}</td>
                                        <td>@{{ p.name }}</td>
                                        <td>@{{ p.short_code }}</td>
                                        <td>@{{ p.description }}</td>
                                        <td>@{{ p.remarks }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_expenses">
                                <div class="form-group">
                                    <div class="col-md-11">
                                        <select id="inputExpense"
                                                class="form-control"
                                                ng-model="expense"
                                                ng-options="expense as expense.name for expense in expenseTemplates track by expense.id">
                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-primary btn-md"
                                                ng-click="addExpense(expense)"><span class="fa fa-plus"/></button>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center">@lang('supplier.edit.table_expense.header.name')</th>
                                        <th class="text-center">@lang('supplier.edit.table_expense.header.type')</th>
                                        <th class="text-center">@lang('supplier.edit.table_expense.header.amount')</th>
                                        <th class="text-center">@lang('supplier.edit.table_expense.header.internal_expense')</th>
                                        <th class="text-center">@lang('supplier.edit.table_expense.header.remarks')</th>
                                        <th class="text-center">&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="expense in expenses">
                                        <input type="hidden" name="expense_template_id[]" value="@{{ expense.id }}">
                                        <td class="valign-middle">
                                            @{{ expense.name }}
                                        </td>
                                        <td class="text-center valign-middle">
                                            @{{ expense.type }}
                                        </td>
                                        <td class="text-center valign-middle">
                                            @{{ expense.amount }}
                                        </td>
                                        <td class="text-center valign-middle">
                                            @{{ expense.is_internal_expense }}
                                        </td>
                                        <td class="valign-middle">
                                            @{{ expense.remarks }}
                                        </td>
                                        <td class="text-center valign-middle">
                                            <button type="button" class="btn btn-xs btn-danger" ng-click="removeSelectedExpense($index)"><span class="fa fa-close fa-fw"></span></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_settings">
                                <div class="form-group">
                                    <label for="inputPaymentDueDay" class="col-sm-2 control-label">@lang('supplier.field.payment_due_day')</label>
                                    <div class="col-sm-10">
                                        <input id="inputPaymentDueDay" name="payment_due_day" type="text" value="{{ $supplier->payment_due_day }}" class="form-control" data-parsley-required="true" data-parsley-group="tab_setting">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.supplier') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                            <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module("supplierModule", []);
        app.controller("supplierController", ['$scope', function($scope) {
            $scope.banks = JSON.parse('{!! empty(htmlspecialchars_decode($supplier->bankAccounts)) ? '[]':htmlspecialchars_decode($supplier->bankAccounts) !!}');
            $scope.profiles = JSON.parse('{!! empty(htmlspecialchars_decode($supplier->profiles)) ? '[]':htmlspecialchars_decode($supplier->profiles) !!}');
            $scope.expenses = JSON.parse('{!! empty(htmlspecialchars_decode($supplier->expenseTemplates)) ? '[]':htmlspecialchars_decode($supplier->expenseTemplates) !!}');
            $scope.bankDDL = JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}');
            $scope.providerDDL = JSON.parse('{!! htmlspecialchars_decode($providerDDL) !!}');
            $scope.expenseTemplates = JSON.parse('{!! htmlspecialchars_decode($expenseTemplates) !!}');
            $scope.productList = JSON.parse('{!! htmlspecialchars_decode($productList) !!}');
            $scope.productSelected = JSON.parse('{!! json_encode($productSelected) !!}');

            _.forEach($scope.expenses, function (expense, index) {
                if(expense.is_internal_expense){
                    expense.is_internal_expense = "@lang('lookup.YESNOSELECT.YES')";
                }
                else{
                    expense.is_internal_expense = "@lang('lookup.YESNOSELECT.NO')";
                }
            });

            _.forEach($scope.expenseTemplates, function (expenseTemplate, index) {
                if(expenseTemplate.is_internal_expense){
                    expenseTemplate.is_internal_expense = "@lang('lookup.YESNOSELECT.YES')";
                }
                else{
                    expenseTemplate.is_internal_expense = "@lang('lookup.YESNOSELECT.NO')";
                }
            });

            $scope.toInt = function(val) {
                return parseInt(val,10);
            };

            $scope.addNewBank = function() {
                $scope.banks.push({
                    'bank_id': '',
                    'account_number': '',
                    'remarks': ''
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
                    'phone_numbers':[{
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
                $scope.profiles[parentIndex].phone_numbers.push({
                    'phone_provider_id': '',
                    'number': '',
                    'remarks': ''
                });
            };

            $scope.removeSelectedPhone = function(parentIndex, idx) {
                $scope.profiles[parentIndex].phone_numbers.splice(idx, 1);
            };

            $scope.addExpense = function(expense) {
                $scope.expenses.push({
                    id: expense.id,
                    name: expense.name,
                    type: expense.type,
                    amount: numeral(expense.amount).format('0,0'),
                    is_internal_expense: expense.is_internal_expense,
                    remarks: expense.remarks
                });
            };

            $scope.removeSelectedExpense = function(idx) {
                $scope.expenses.splice(idx, 1);
            };
        }]);

        $(document).ready(function() {
            window.Parsley.on('parsley:field:validate', function() {
                validateFront();
            });

            var validateFront = function () {
                if (true === $('#supplierForm').parsley().isValid("tab_supp", false)) {
                    $('#suppDataTabError').addClass('hidden');
                } else {
                    $('#suppDataTabError').removeClass('hidden');
                }

                if (true === $('#supplierForm').parsley().isValid("tab_pic", false)) {
                    $('#picTabError').addClass('hidden');
                } else {
                    $('#picTabError').removeClass('hidden');
                }

                if (true === $('#supplierForm').parsley().isValid("tab_bank", false)) {
                    $('#bankAccountTabError').addClass('hidden');
                } else {
                    $('#bankAccountTabError').removeClass('hidden');
                }

                if (true === $('#supplierForm').parsley().isValid("tab_setting", false)) {
                    $('#settingsTabError').addClass('hidden');
                } else {
                    $('#settingsTabError').removeClass('hidden');
                }

                if (true === $('#supplierForm').parsley().isValid("tab_expense", false)) {
                    $('#expensesTabError').addClass('hidden');
                } else {
                    $('#expensesTabError').removeClass('hidden');
                }
            };
        });
    </script>
@endsection