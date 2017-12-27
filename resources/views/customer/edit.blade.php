@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-smile-o fa-fw"></span>&nbsp;@lang('customer.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('customer.edit.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_customer_edit', $customer->hId()) !!}
@endsection

@section('custom_css')
    <style>
        .pac-container {
            background-color: #FFF;
            z-index: 2000;
            position: fixed;
            display: inline-block;
            float: left;
        }
        .modal{
            z-index: 2000;
        }
        .modal-backdrop{
            z-index: 1000;
        }​
    </style>
@endsection

@section('content')
    <div id="customerVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="customerForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('customer.edit.header.title')</h3>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_customer" data-toggle="tab">@lang('customer.edit.tab.customer')&nbsp;<span id="custDataTabError" v-bind:class="{ 'red-asterisk':true, 'hidden':errors.any('tab_customer')?false:true }">*</span></a></li>
                            <li><a href="#tab_pic" data-toggle="tab">@lang('customer.edit.tab.pic')&nbsp;<span id="picTabError" v-bind:class="{ 'red-asterisk':true, 'hidden':errors.any('tab_pic')?false:true }">*</span></a></li>
                            <li><a href="#tab_bank_account" data-toggle="tab">@lang('customer.edit.tab.bank_account')&nbsp;<span id="bankAccountTabError" v-bind:class="{ 'red-asterisk':true, 'hidden':errors.any('tab_bank')?false:true }">*</span></a></li>
                            <li><a href="#tab_expenses" data-toggle="tab">@lang('customer.edit.tab.expenses')</a></li>
                            <li><a href="#tab_settings" data-toggle="tab">@lang('customer.edit.tab.settings')&nbsp;<span id="settingsTabError" v-bind:class="{ 'red-asterisk':true, 'hidden':errors.any('tab_settings')?false:true }">*</span></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_customer">
                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_customer.name') }">
                                    <label for="inputName" class="col-sm-2 control-label">@lang('customer.field.name')</label>
                                    <div class="col-sm-10">
                                        <input id="inputName" name="name" type="text" class="form-control" value="{{ $customer->name }}" placeholder="@lang('customer.field.name')"
                                               v-validate="'required'" data-vv-as="{{ trans('customer.field.name') }}" data-vv-scope="tab_customer">
                                        <span v-show="errors.has('tab_customer.name')" class="help-block" v-cloak>@{{ errors.first('tab_customer.name') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                    <div class="col-sm-9">
                                        <textarea name="address" id="inputAddress" class="form-control" rows="4">{{ $customer->address }}</textarea>
                                    </div>
                                    <div class="col-sm-1">
                                        <button id="btnChooseLocation" type="button" class="btn btn-default btn-mini" data-toggle="modal" data-target="#myModal"><i class="fa fa-location-arrow"></i></button>
                                        <input id="inputLatitude" type="hidden" name="latitude" value="{{ $customer->latitude }}">
                                        <input id="inputLongitude" type="hidden" name="longitude" value="{{ $customer->longitude }}">
                                        <input id="inputDistance" type="hidden" name="distance" value="{{ $customer->distance }}">
                                        <input id="inputDistanceText" type="hidden" name="distance_text" value="{{ $customer->distance_text }}">
                                        <input id="inputDuration" type="hidden" name="duration" value="{{ $customer->duration }}">
                                        <input id="inputDurationText" type="hidden" name="duration_text" value="{{ $customer->duration_text }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCity" class="col-sm-2 control-label">@lang('customer.field.city')</label>
                                    <div class="col-sm-10">
                                        <input id="inputCity" name="city" type="text" class="form-control" value="{{ $customer->city }}" placeholder="@lang('customer.field.city')">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPhone" class="col-sm-2 control-label">@lang('customer.field.phone')</label>
                                    <div class="col-sm-10">
                                        <input id="inputPhone" name="phone" type="tel" class="form-control" value="{{ $customer->phone }}" placeholder="@lang('customer.field.phone')">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTaxId" class="col-sm-2 control-label">@lang('customer.field.tax_id')</label>
                                    <div class="col-sm-10">
                                        <input id="inputTaxId" name="tax_id" type="text" class="form-control" value="{{ $customer->tax_id }}" placeholder="@lang('customer.field.tax_id')">
                                    </div>
                                </div>
                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_customer.status') }">
                                    <label for="inputStatus" class="col-sm-2 control-label">@lang('customer.field.status')</label>
                                    <div class="col-sm-10">
                                        <select id="inputStatus"
                                                class="form-control"
                                                name="status"
                                                v-model="status"
                                                v-validate="'required'"
                                                data-vv-as="{{ trans('customer.field.status') }}"
                                                data-vv-scope="tab_customer">
                                            <option v-bind:value="defaultStatus.code">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                                        </select>
                                        <span v-show="errors.has('tab_customer.status')" class="help-block" v-cloak>@{{ errors.first('tab_customer.status') }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('customer.field.remarks')</label>
                                    <div class="col-sm-10">
                                        <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $customer->remarks }}" placeholder="@lang('customer.field.remarks')">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_pic">
                                <div class="row">
                                    <div class="col-md-1">
                                        <button class="btn btn-xs btn-default" type="button" v-on:click="addNewProfile()">@lang('buttons.create_new_button')</button>
                                    </div>
                                    <div class="col-md-11">
                                        <div v-for="(profile, profileIdx) in profiles">
                                            <div class="box box-widget">
                                                <div class="box-header with-border">
                                                    <div class="user-block">
                                                        <strong>@lang('customer.field.person_in_charge') @{{ profileIdx + 1 }}</strong><br/>
                                                        &nbsp;&nbsp;&nbsp;@{{ profile.first_name }}&nbsp;@{{ profile.last_name }}
                                                    </div>
                                                    <div class="box-tools">
                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_pic.first_name_' + profileIdx) }">
                                                        <label for="inputFirstName" class="col-sm-2 control-label">@lang('customer.field.first_name')</label>
                                                        <div class="col-sm-10">
                                                            <input type="hidden" name="profile_id[]" v-bind:value="profile.id">
                                                            <input id="inputFirstName" type="text" name="first_name[]" class="form-control" v-model="profile.first_name" placeholder="@lang('customer.field.first_name')"
                                                                   v-validate="'required'" v-bind:data-vv-as="'{{ trans('customer.field.first_name') }} ' + (profileIdx + 1)" v-bind:data-vv-name="'first_name_' + profileIdx"
                                                                   data-vv-scope="tab_pic">
                                                            <span v-show="errors.has('tab_pic.first_name_' + profileIdx)" class="help-block" v-cloak>@{{ errors.first('tab_pic.first_name_' + profileIdx) }}</span>
                                                        </div>
                                                    </div>
                                                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_pic.last_name_' + profileIdx) }">
                                                        <label for="inputLastName" class="col-sm-2 control-label">@lang('customer.field.last_name')</label>
                                                        <div class="col-sm-10">
                                                            <input id="inputLastName" type="text" name="last_name[]" class="form-control" v-model="profile.last_name" placeholder="@lang('customer.field.last_name')"
                                                                   v-validate="'required'" v-bind:data-vv-as="'{{ trans('customer.field.last_name') }} ' + (profileIdx + 1)" v-bind:data-vv-name="'last_name_' + profileIdx"
                                                                   data-vv-scope="tab_pic">
                                                            <span v-show="errors.has('tab_pic.last_name_' + profileIdx)" class="help-block" v-cloak>@{{ errors.first('tab_pic.last_name_' + profileIdx) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputAddress" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                                        <div class="col-sm-10">
                                                            <input id="inputAddress" type="text" name="profile_address[]" class="form-control" v-model="profile.address" placeholder="@lang('customer.field.address')">
                                                        </div>
                                                    </div>
                                                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_pic.ic_num_' + profileIdx) }">
                                                        <label for="inputICNum" class="col-sm-2 control-label">@lang('customer.field.ic_num')</label>
                                                        <div class="col-sm-10">
                                                            <input id="inputICNum" type="text" name="ic_num[]" class="form-control" v-model="profile.ic_num" placeholder="@lang('customer.field.ic_num')"
                                                                   v-validate="'required'" v-bind:data-vv-as="'{{ trans('customer.field.ic_num') }} ' + (profileIdx + 1)" v-bind:data-vv-name="'ic_num_' + profileIdx"
                                                                   data-vv-scope="tab_pic">
                                                            <span v-show="errors.has('tab_pic.ic_num_' + profileIdx)" class="help-block" v-cloak>@{{ errors.first('tab_pic.ic_num_' + profileIdx) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPhoneNumber" class="col-sm-2 control-label">@lang('customer.field.phone_number')</label>
                                                        <div class="col-sm-10">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>@lang('customer.edit.table_phone.header.provider')</th>
                                                                        <th>@lang('customer.edit.table_phone.header.number')</th>
                                                                        <th>@lang('customer.edit.table_phone.header.remarks')</th>
                                                                        <th class="text-center">@lang('labels.ACTION')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(ph, phIdx) in profile.phone_numbers">
                                                                        <td v-bind:class="{ 'has-error':errors.has('tab_pic.phoneprovider_' + phIdx) }">
                                                                            <input type="hidden" v-bind:name="'profile_' + profileIdx + '_phone_number_id[]'" v-bind:value="ph.id">
                                                                            <select v-bind:name="'profile_' + profileIdx + '_phone_provider[]'" class="form-control"
                                                                                    v-model="ph.phone_provider_id"
                                                                                    v-validate="'required'" v-bind:data-vv-as="'{{ trans('customer.create.table_phone.header.provider') }} ' + (phIdx + 1)"
                                                                                    v-bind:data-vv-name="'phoneprovider_' + phIdx" data-vv-scope="tab_pic">
                                                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                                <option v-for="p in providerDDL" v-bind:value="p.id">@{{ p.name }} (@{{ p.short_name }})</option>
                                                                            </select>
                                                                        </td>
                                                                        <td v-bind:class="{ 'has-error':errors.has('tab_pic.number_' + phIdx) }">
                                                                            <input type="text" v-bind:name="'profile_' + profileIdx + '_phone_number[]'" class="form-control" v-model="ph.number"
                                                                                   v-validate="'required|numeric'" v-bind:data-vv-as="'{{ trans('customer.create.table_phone.header.number') }} ' + (phIdx + 1)"
                                                                                   v-bind:data-vv-name="'number_' + phIdx" data-vv-scope="tab_pic">
                                                                        </td>
                                                                        <td><input type="text" class="form-control" v-bind:name="'profile_' + profileIdx + '_remarks[]'" v-model="ph.remarks"></td>
                                                                        <td class="text-center">
                                                                            <button type="button" class="btn btn-xs btn-danger" v-bind:data="phIdx" v-on:click="removeSelectedPhone(profileIdx, phIdx)">
                                                                                <span class="fa fa-close fa-fw"></span>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="4">
                                                                            <button type="button" class="btn btn-xs btn-default" v-on:click="addNewPhone(profileIdx)">@lang('buttons.create_new_button')</button>
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
                                            <th class="text-center">@lang('customer.create.table_bank.header.bank')</th>
                                            <th class="text-center">@lang('customer.create.table_bank.header.account_name')</th>
                                            <th class="text-center">@lang('customer.create.table_bank.header.account_number')</th>
                                            <th class="text-center">@lang('customer.create.table_bank.header.remarks')</th>
                                            <th class="text-center">@lang('labels.ACTION')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(bank, bankIdx) in banks">
                                            <td v-bind:class="{ 'has-error':errors.has('tab_bank.bank_' + bankIdx) }">
                                                <input type="hidden" name="bank_account_id[]" v-bind:value="bank.id">
                                                <select class="form-control"
                                                        name="bank[]"
                                                        v-model="bank.bank_id"
                                                        v-validate="'required'"
                                                        v-bind:data-vv-as="'{{ trans('customer.create.table_bank.header.bank') }} ' + (bankIdx + 1)"
                                                        v-bind:data-vv-name="'bank_' + bankIdx"
                                                        data-vv-scope="tab_bank">
                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                    <option v-for="b in bankDDL" v-bind:value="b.id">@{{ b.name }} (@{{ b.short_name }})</option>
                                                </select>
                                            </td>
                                            <td v-bind:class="{ 'has-error':errors.has('tab_bank.account_name_' + bankIdx) }">
                                                <input type="text" class="form-control" name="account_name[]" v-model="bank.account_name"
                                                       v-validate="'required'"
                                                       v-bind:data-vv-as="'{{ trans('customer.create.table_bank.header.account_name') }} ' + (bankIdx + 1)"
                                                       v-bind:data-vv-name="'account_name_' + bankIdx"
                                                       data-vv-scope="tab_bank">
                                            </td>
                                            <td v-bind:class="{ 'has-error':errors.has('tab_bank.account_number_' + bankIdx) }">
                                                <input type="text" class="form-control" name="account_number[]" v-model="bank.account_number"
                                                       v-validate="'required|numeric'" v-bind:data-vv-as="'{{ trans('customer.create.table_bank.header.account_number') }} ' + (bankIdx + 1)"
                                                       v-bind:data-vv-name="'account_number_' + bankIdx"
                                                       data-vv-scope="tab_bank">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="bank_remarks[]" v-model="bank.remarks">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-xs btn-danger" v-bind:data="bankIdx" v-on:click="removeSelectedBank(bankIdx)"><span class="fa fa-close fa-fw"></span></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button class="btn btn-xs btn-default" type="button" v-on:click="addNewBank()">@lang('buttons.create_new_button')</button>
                            </div>
                            <div class="tab-pane" id="tab_expenses">
                                <div class="form-group">
                                    <div class="col-md-11">
                                        <select id="inputExpense"
                                                class="form-control"
                                                v-model="selectedExpense">
                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="(value, key) in expenseTypes" v-bind:value="key">@{{ value }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-primary btn-md"
                                                v-on:click="addExpense(selectedExpense)"><span class="fa fa-plus"/></button>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">@lang('customer.create.table_expense.header.name')</th>
                                            <th class="text-center">@lang('customer.create.table_expense.header.type')</th>
                                            <th class="text-center">@lang('customer.create.table_expense.header.amount')</th>
                                            <th class="text-center">@lang('customer.create.table_expense.header.internal_expense')</th>
                                            <th class="text-center">@lang('customer.create.table_expense.header.remarks')</th>
                                            <th class="text-center">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(expense, expenseIdx) in expenses">
                                            <input type="hidden" name="expense_template_id[]" value="@{{ expense.id }}">
                                            <td class="text-center valign-middle">
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
                                                <button type="button" class="btn btn-xs btn-danger" v-on:click="removeSelectedExpense(expenseIdx)"><span class="fa fa-close fa-fw"></span></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_settings">
                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_settings.price_level') }">
                                    <label for="inputPriceLevel" class="col-sm-2 control-label">@lang('customer.field.price_level')</label>
                                    <div class="col-sm-10">
                                        <select name="price_level" v-model="price_level" class="form-control"
                                                v-validate="'required'" data-vv-as="{{ trans('customer.field.price_level') }}" data-vv-scope="tab_settings">
                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="pp in pricelevelDDL" v-bind:value="pp.id">@{{ pp.name }} (@{{ pp.description }})
                                        </select>
                                    </div>
                                </div>
                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_settings.payment_due_day') }">
                                    <label for="inputPaymentDueDay" class="col-sm-2 control-label">@lang('customer.field.payment_due_day')</label>
                                    <div class="col-sm-10">
                                        <input id="inputPaymentDueDay" name="payment_due_day" type="text" value="{{ $customer->payment_due_day }}" class="form-control"
                                               v-validate="'required|numeric|max_value:100'" data-vv-as="{{ trans('customer.field.payment_due_day') }}" data-vv-scope="tab_settings">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.customer') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                            <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Choose Location</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputModalAddress3">Address:</label>
                        <input type="text" class="form-control" id="inputModalAddress" name="inputModalAddress1">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputModalLat">Latitude:</label>
                                    <input type="text" class="form-control col-sm-6" id="inputModalLat" name="inputModalLat">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputModalLng">Longitude:</label>
                                    <input type="text" class="form-control col-sm-6" id="inputModalLng" name="inputModalLng">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputModalDistance">Distance:</label>
                                    <input type="hidden" id="inputModalDistance">
                                    <input type="text" class="form-control col-sm-6" id="inputModalDistanceText">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="inputModalDuration">Duration:</label>
                                    <input type="hidden" id="inputModalDuration">
                                    <input type="text" class="form-control col-sm-6" id="inputModalDurationText">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="map" style="width: 870px; height: 300px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="location-ok-btn">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script async defer src="https://maps.googleapis.com/maps/api/js?callback=mapsCallback&libraries=places&key={{ $mapsAPIKey }}"></script>
    <script type="application/javascript">
        var app = new Vue({
            el: '#customerVue',
            data: {
                banks: JSON.parse('{!! empty(htmlspecialchars_decode($customer->bankAccounts)) ? '[]':htmlspecialchars_decode($customer->bankAccounts) !!}'),
                profiles: JSON.parse('{!! empty(htmlspecialchars_decode($customer->profiles)) ? '[]':htmlspecialchars_decode($customer->profiles) !!}'),
                expenses: JSON.parse('{!! empty(htmlspecialchars_decode($customer->expenseTemplates)) ? '[]':htmlspecialchars_decode($customer->expenseTemplates) !!}'),
                bankDDL: JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}'),
                providerDDL: JSON.parse('{!! htmlspecialchars_decode($providerDDL) !!}'),
                pricelevelDDL: JSON.parse('{!! htmlspecialchars_decode($priceLevelDDL) !!}'),
                price_level: '{!! htmlspecialchars_decode($customer->priceLevel->id) !!}',
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}'),
                status: '{!! htmlspecialchars_decode($customer->status) !!}',
                expenseTemplates: JSON.parse('{!! htmlspecialchars_decode($expenseTemplates) !!}'),
                expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}'),
                selectedExpense: ''
            },
            methods: {
                validateBeforeSubmit: function() {
                    this.$validator.validateScopes().then(function(isValid) {
                        var vm = this;
                        if (!isValid) return;
                        axios.post('{{ route('api.post.db.master.customer.edit', $customer->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#customerForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.master.customer') }}';
                        }).catch(function(e) {
                            $('#loader-container').fadeOut('fast');
                            if (e.response.data.errors != undefined && Object.keys(e.response.data.errors).length > 0) {
                                for (var key in e.response.data.errors) {
                                    for (var i = 0; i < e.response.data.errors[key].length; i++) {
                                        vm.$validator.errors.add('', e.response.data.errors[key][i], 'server', '__global__');
                                    }
                                }
                            } else {
                                vm.$validator.errors.add('', e.response.status + ' ' + e.response.statusText, 'server', '__global__');
                                if (e.response.data.message != undefined) { console.log(e.response.data.message); }
                            }
                        });
                    });
                },
                addNewBank: function() {
                    this.banks.push({
                        'bank_id': '',
                        'account_name': '',
                        'account_number': '',
                        'remarks': ''
                    });
                },
                removeSelectedBank: function(idx) {
                    this.banks.splice(idx, 1);
                },
                addNewProfile: function() {
                    this.profiles.push({
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
                },
                removeSelectedProfile: function(idx) {
                    this.profiles.splice(idx, 1);
                },
                addNewPhone: function(parentIndex) {
                    this.profiles[parentIndex].phone_numbers.push({
                        'phone_provider_id': '',
                        'number': '',
                        'remarks': ''
                    });
                },
                removeSelectedPhone: function(parentIndex, idx) {
                    this.profiles[parentIndex].phone_numbers.splice(idx, 1);
                },
                addExpense: function(selectedExpense) {
                    var se = _.find(this.expenseTemplates, function(et) { return et.Type = selectedExpense });
                    this.expenses.push({
                        id: se.id,
                        name: se.name,
                        type: this.expenseTypes[selectedExpense],
                        amount: numbro(se.amount).format('0,0'),
                        is_internal_expense: se.is_internal_expense,
                        remarks: se.remarks
                    });
                },
                removeSelectedExpense: function(idx) {
                    this.expenses.splice(idx, 1);
                }
            },
            mounted: function() {
                _.forEach(this.expenses, function (expense, index) {
                    if(expense.is_internal_expense){
                        expense.is_internal_expense = "@lang('lookup.YESNOSELECT.YES')";
                    }
                    else{
                        expense.is_internal_expense = "@lang('lookup.YESNOSELECT.NO')";
                    }
                });

                _.forEach(this.expenseTemplates, function (expenseTemplate, index) {
                    if(expenseTemplate.is_internal_expense){
                        expenseTemplate.is_internal_expense = "@lang('lookup.YESNOSELECT.YES')";
                    }
                    else{
                        expenseTemplate.is_internal_expense = "@lang('lookup.YESNOSELECT.NO')";
                    }
                });
            },
            computed: {
                defaultStatus: function() {
                    return {
                        code: ''
                    };
                }
            }
        });

        function mapsCallback() {
            $('#btnChooseLocation').show();
        }

        $(document).ready(function() {
            var location;
            var map;
            var markers = [];

            function init() {
                map = new google.maps.Map(document.getElementById('map'), { zoom: 16 });

                var input = document.getElementById('inputModalAddress');
                var address = input.value;
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo("bounds", map);

                deleteMarkers();

                var marker = new google.maps.Marker({
                    draggable: true,
                    map: map
                });

                google.maps.event.addListener(autocomplete, "place_changed", function() {
                    var place = autocomplete.getPlace();

                    location = place;

                    if(place.geometry != undefined) {
                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(16);
                        }

                        $('#inputModalAddress').val(place.formatted_address);
                        $('#inputModalLat').val(place.geometry.location.lat());
                        $('#inputModalLng').val(place.geometry.location.lng());

                        marker.setPosition(place.geometry.location);
                        markers.push(marker);
                        setDraggableMarker(markers);
                        getDistanceMatrix(place.geometry.location);
                    }
                });

                if(address.length === 0) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        // Do stuff with the geo data...
                        var lat = position.coords.latitude;
                        var lng = position.coords.longitude;
                        var latLong = new google.maps.LatLng(lat, lng);

                        deleteMarkers();

                        marker = new google.maps.Marker({
                            draggable: true,
                            position: latLong
                        });
                        marker.setMap(map);

                        map.setZoom(16);
                        map.setCenter(marker.getPosition());
                        markers.push(marker);
                        setDraggableMarker(markers);
                        getDistanceMatrix(marker.getPosition());

                        var geocoder = new google.maps.Geocoder();
                        geocoder.geocode({ 'location': latLong }, function(results, status) {
                            if(status === 'OK') {
                                if(results[0]) {
                                    location = results[0];

                                    $('#inputModalAddress').val(location.formatted_address);
                                    $('#inputModalLat').val(location.geometry.location.lat());
                                    $('#inputModalLng').val(location.geometry.location.lng());

                                }
                            }
                        });

                    }, function(error) {
                        alert(error.code + ": " + error.message);
                    });
                } else {
                    locateByAddress(address);
                }

                google.maps.event.addListener(map, 'click', function(event) {
                    $('#inputModalLat').val(event.latLng.lat());
                    $('#inputModalLng').val(event.latLng.lng());
                    marker.setPosition(event.latLng);
                });
            }

            $('#myModal').on('shown.bs.modal', function() {
                if($('#inputAddress').val() === '') {
                    $('#inputModalLat').val($('#inputLatitude').val());
                    $('#inputModalLng').val($('#inputLongitude').val());
                } else {
                    $('#inputModalAddress').val($('#inputAddress').val());
                }

                init();
            });

            $('#location-ok-btn').click(function() {
                if(location != undefined) {
                    $('#inputLatitude').val(location.geometry.location.lat());
                    $('#inputLongitude').val(location.geometry.location.lng());
                    $('#inputDistanceText').val($('#inputModalDistanceText').val());
                    $('#inputDistance').val($('#inputModalDistance').val());
                    $('#inputDurationText').val($('#inputModalDurationText').val());
                    $('#inputDuration').val($('#inputModalDuration').val());
                }
            });

            function locateByAddress(address) {
                var geocoder = new google.maps.Geocoder();

                geocoder.geocode({
                        'address': address
                    },
                    function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {

                            location = results[0];

                            $('#inputModalAddress').val(location.formatted_address);
                            $('#inputModalLat').val(location.geometry.location.lat());
                            $('#inputModalLng').val(location.geometry.location.lng());

                            deleteMarkers();

                            var marker = new google.maps.Marker({
                                draggable: true,
                                position: results[0].geometry.location,
                                map: map
                            });
                            markers.push(marker);
                            setDraggableMarker(markers);
                            getDistanceMatrix(results[0].geometry.location);

                            google.maps.event.trigger(map, 'resize');
                            map.setCenter(results[0].geometry.location);
                        }
                    }
                );
            }

            function locateByCoordinate(lat, lng) {
                deleteMarkers();

                var latLong = new google.maps.LatLng(lat, lng);

                var marker = new google.maps.Marker({
                    draggable: true,
                    position: latLong,
                    map: map
                });
                markers.push(marker);
                setDraggableMarker(markers);
                getDistanceMatrix(marker.getPosition());

                google.maps.event.trigger(map, 'resize');
                map.setCenter(latLong);

                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'location': latLong }, function(results, status) {
                    if(status === 'OK') {
                        if(results[0]) {
                            location = results[0];

                            $('#inputModalAddress').val(location.formatted_address);
                            $('#inputModalLat').val(location.geometry.location.lat());
                            $('#inputModalLng').val(location.geometry.location.lng());

                        }
                    }
                });
            }

            $('#inputModalAddress').keypress(function(event) {
                if(event.keyCode == 13) {
                    locateByAddress($('#inputModalAddress').val());
                }
            });

            $('#inputModalLat').keypress(function(event) {
                if(event.keyCode == 13) {
                    locateByCoordinate($('#inputModalLat').val(), $('#inputModalLng').val());
                }
            });

            $('#inputModalLng').keypress(function(event) {
                if(event.keyCode == 13) {
                    locateByCoordinate($('#inputModalLat').val(), $('#inputModalLng').val());
                }
            });

            // Deletes all markers in the array by removing references to them.
            function deleteMarkers() {

                for (var i = 0; i < markers.length; i++) {
                    markers[i].setMap(null);
                }

                markers = [];
            }

            function getDistanceMatrix(destination) {
                var service = new google.maps.DistanceMatrixService;

                var lat = '{{ empty($store->latitude) ? 0:$store->latitude }}';
                var lng = '{{ empty($store->longitude) ? 0:$store->longitude }}';

                var origin = new google.maps.LatLng(lat, lng);

                service.getDistanceMatrix({
                    origins: [origin],
                    destinations: [destination],
                    travelMode: 'DRIVING',
                    unitSystem: google.maps.UnitSystem.METRIC
                }, function(response, status) {
                    if(status !== 'OK') {
                        alert('Error was: ' + status);
                    } else {
                        var originList = response.originAddresses;
                        var destinationList = response.destinationAddresses;
                        for(var i = 0; i < originList.length; i++) {
                            var results = response.rows[i].elements;
                            for(var j = 0; j < results.length; j++) {
                                $('#inputModalDistanceText').val(results[j].distance.text);
                                $('#inputModalDistance').val(results[j].distance.value);
                                $('#inputModalDurationText').val(results[j].duration.text);
                                $('#inputModalDuration').val(results[j].duration.value);
                            }
                        }
                    }
                })
            }

            function setDraggableMarker(markers) {
                markers.forEach(function(marker) {
                    google.maps.event.addListener(marker, 'dragend', function(event) {
                        $('#inputModalLat').val(event.latLng.lat());
                        $('#inputModalLng').val(event.latLng.lng());
                        locateByCoordinate($('#inputModalLat').val(), $('#inputModalLng').val());
                    });
                });
            }
        });
    </script>
@endsection