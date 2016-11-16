@extends('layouts.adminlte.master')

@section('title')
    @lang('store.create.title')
@endsection

@section('page_title')
    <span class="fa fa-umbrella fa-fw"></span>&nbsp;@lang('store.create.page_title')
@endsection
@section('page_title_desc')
    @lang('store.create.page_title_desc')
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
            <h3 class="box-title">@lang('store.create.header.title')</h3>
        </div>
        <form id="storeForm" class="form-horizontal" action="{{ route('db.admin.store.create') }}" enctype="multipart/form-data" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div ng-app="storeModule" ng-controller="storeController">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_store" data-toggle="tab">@lang('store.create.tab.store')&nbsp;<span id="storeDataTabError" class="parsley-asterisk hidden">*</span></a></li>
                                    <li><a href="#tab_bank_account" data-toggle="tab">@lang('store.create.tab.bank_account')&nbsp;<span id="bankAccountTabError" class="parsley-asterisk hidden">*</span></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_store">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label for="inputStoreName" class="col-sm-2 control-label">@lang('store.field.name')</label>
                                            <div class="col-sm-10">
                                                <input id="inputStoreName" name="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="Name" data-parsley-required="true" data-parsley-group="tab_store">
                                                <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('image_path') ? 'has-error' : '' }}">
                                            <label for="inputStoreImage" class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                                <input id="inputStoreImage" name="image_path" type="file" class="form-control">
                                                <span class="help-block">{{ $errors->has('image_path') ? $errors->first('image_path') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                            <label for="inputAddress" class="col-sm-2 control-label">@lang('store.field.address')</label>
                                            <div class="col-sm-10">
                                                <textarea id="inputAddress" class="form-control" rows="5" name="address">{{ old('address') }}</textarea>
                                                <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('phone_num') ? 'has-error' : '' }}">
                                            <label for="inputPhone" class="col-sm-2 control-label">@lang('store.field.phone')</label>
                                            <div class="col-sm-10">
                                                <input id="inputPhone" name="phone_num" type="text" class="form-control" value="{{ old('phone_num') }}" placeholder="Phone">
                                                <span class="help-block">{{ $errors->has('phone_num') ? $errors->first('phone_num') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputFax" class="col-sm-2 control-label">@lang('store.field.fax')</label>
                                            <div class="col-sm-10">
                                                <input id="inputFax" name="fax_num" type="text" class="form-control" value="{{ old('fax_num') }}" placeholder="Fax">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputTax" class="col-sm-2 control-label">@lang('store.field.tax_id')</label>
                                            <div class="col-sm-10">
                                                <input id="inputTax" name="tax_id" type="text" class="form-control" value="{{ old('tax_id') }}" placeholder="Tax ID" data-parsley-required="true" data-parsley-group="tab_store">
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                            <label for="inputStatus" class="col-sm-2 control-label">@lang('store.field.status')</label>
                                            <div class="col-sm-10">
                                                {{ Form::select('status', $statusDDL, null, array('id' => 'statusSelect', 'class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true', 'data-parsley-group' => 'tab_store')) }}
                                                <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('is_default') ? 'has-error' : '' }}">
                                            <label for="inputIsDefault" class="col-sm-2 control-label">@lang('store.field.default')</label>
                                            <div class="col-sm-10">
                                                {{ Form::select('is_default', $yesnoDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true', 'data-parsley-checkactive' => '#statusSelect', 'data-parsley-group' => 'tab_store')) }}
                                                <span class="help-block">{{ $errors->has('is_default') ? $errors->first('is_default') : '' }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputRemarks" class="col-sm-2 control-label">@lang('store.field.remarks')</label>
                                            <div class="col-sm-10">
                                                <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ old('remarks') }}" placeholder="Remarks">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_bank_account">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="text-center">@lang('store.create.table_bank.header.bank')</th>
                                                <th class="text-center">@lang('store.create.table_bank.header.account_number')</th>
                                                <th class="text-center">@lang('store.create.table_bank.header.remarks')</th>
                                                <th class="text-center">@lang('labels.ACTION')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="bank in banks">
                                                <td>
                                                    <select class="form-control"
                                                            name="bank[]"
                                                            ng-model="bank.bank_id"
                                                            ng-options="b.id as b.name + ' (' + b.short_name + ')' for b in bankDDL track by b.id"
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.store') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module("storeModule", []);
        app.controller("storeController", ['$scope', function($scope) {
            $scope.banks = [];
            $scope.bankDDL = JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}');

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
        }]);

        $(document).ready(function() {
            $.listen('parsley:field:validate', function() {
                validateFront();
            });

            var validateFront = function () {
                if (true === $('#storeForm').parsley().isValid("tab_store", false)) {
                    $('#storeDataTabError').addClass('hidden');
                } else {
                    $('#storeDataTabError').removeClass('hidden');
                }

                if (true === $('#storeForm').parsley().isValid("tab_bank", false)) {
                    $('#bankAccountTabError').addClass('hidden');
                } else {
                    $('#bankAccountTabError').removeClass('hidden');
                }
            };
        });

        window.Parsley.addValidator('checkactive', function (value, statusDDL) {
            if (value == 'YESNOSELECT.YES') {
                if ($(statusDDL).val() == 'STATUS.ACTIVE') {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }, 32)
                .addMessage('en', 'checkactive', 'Default Store cannot be inactived')
                .addMessage('id', 'checkactive', 'Toko utama tidak bisa dinonaktifkan');
    </script>
@endsection