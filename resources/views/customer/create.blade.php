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

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_customer_create') !!}
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
        <form id="customerForm" class="form-horizontal" action="{{ route('db.master.customer.create') }}" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div id="customerVue">
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_customer" data-toggle="tab">@lang('customer.create.tab.customer')&nbsp;<span id="custDataTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_pic" data-toggle="tab">@lang('customer.create.tab.pic')&nbsp;<span id="picTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_bank_account" data-toggle="tab">@lang('customer.create.tab.bank_account')&nbsp;<span id="bankAccountTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_expenses" data-toggle="tab">@lang('customer.create.tab.expenses')&nbsp;<span id="expensesTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_settings" data-toggle="tab">@lang('customer.create.tab.settings')&nbsp;<span id="settingsTabError" class="parsley-asterisk hidden">*</span></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_customer">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">@lang('customer.field.name')</label>
                                    <div class="col-sm-10">
                                        <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('customer.field.name')" data-parsley-required="true" data-parsley-group="tab_cust">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                    <div class="col-sm-10">
                                        <textarea name="address" id="inputAddress" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCity" class="col-sm-2 control-label">@lang('customer.field.city')</label>
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
                                    <label for="inputTaxId" class="col-sm-2 control-label">@lang('customer.field.tax_id')</label>
                                    <div class="col-sm-10">
                                        <input id="inputTaxId" name="tax_id" type="text" class="form-control" placeholder="@lang('customer.field.tax_id')">
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label for="inputStatus" class="col-sm-2 control-label">@lang('customer.field.status')</label>
                                    <div class="col-sm-10">
                                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true', 'data-parsley-group' => 'tab_cust')) }}
                                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('customer.field.remarks')</label>
                                    <div class="col-sm-10">
                                        <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="@lang('customer.field.remarks')">
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
                                                    <div class="form-group">
                                                        <label for="inputFirstName" class="col-sm-2 control-label">@lang('customer.field.first_name')</label>
                                                        <div class="col-sm-10">
                                                            <input id="inputFirstName" type="text" name="first_name[]" class="form-control" v-model="profile.first_name" placeholder="@lang('customer.field.first_name')" data-parsley-required="true" data-parsley-group="tab_pic">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputLastName" class="col-sm-2 control-label">@lang('customer.field.last_name')</label>
                                                        <div class="col-sm-10">
                                                            <input id="inputLastName" type="text" name="last_name[]" class="form-control" v-model="profile.last_name" placeholder="@lang('customer.field.last_name')" data-parsley-required="true" data-parsley-group="tab_pic">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputAddress" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                                        <div class="col-sm-10">
                                                            <input id="inputAddress" type="text" name="profile_address[]" class="form-control" v-model="profile.address" placeholder="@lang('customer.field.address')">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputICNum" class="col-sm-2 control-label">@lang('customer.field.ic_num')</label>
                                                        <div class="col-sm-10">
                                                            <input id="inputICNum" type="text" name="ic_num[]" class="form-control" v-model="profile.ic_num" placeholder="@lang('customer.field.ic_num')" data-parsley-required="true" data-parsley-group="tab_pic">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPhoneNumber" class="col-sm-2 control-label">@lang('customer.field.phone_number')</label>
                                                        <div class="col-sm-10">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>@lang('customer.create.table_phone.header.provider')</th>
                                                                        <th>@lang('customer.create.table_phone.header.number')</th>
                                                                        <th>@lang('customer.create.table_phone.header.remarks')</th>
                                                                        <th class="text-center">@lang('labels.ACTION')</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(ph, phIdx) in profile.phone_numbers">
                                                                        <td>
                                                                            <select name="profile_@{{ profileIdx }}_phone_provider[]" class="form-control" v-model="ph.phone_provider_id"
                                                                                    data-parsley-required="true" data-parsley-group="tab_pic">
                                                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                                <option v-for="p in providerDDL" v-bind:value="p.id">@{{ p.name }} (@{{ p.short_name }})</option>
                                                                            </select>
                                                                        </td>
                                                                        <td><input type="text" name="profile_@{{ profileIdx }}_phone_number[]" class="form-control" v-model="ph.number" data-parsley-required="true" data-parsley-group="tab_pic"></td>
                                                                        <td><input type="text" class="form-control" name="profile_@{{ profileIdx }}_remarks[]" v-model="ph.remarks"></td>
                                                                        <td class="text-center">
                                                                            <button type="button" class="btn btn-xs btn-danger" data="@{{ phIdx }}" v-on:click="removeSelectedPhone(profileIdx, phIdx)">
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
                                            <th>@lang('customer.create.table_bank.header.account_name')</th>
                                            <th class="text-center">@lang('customer.create.table_bank.header.account_number')</th>
                                            <th class="text-center">@lang('customer.create.table_bank.header.remarks')</th>
                                            <th class="text-center">@lang('labels.ACTION')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(bank, bankIdx) in banks">
                                            <td>
                                                <select class="form-control"
                                                        name="bank[]"
                                                        v-model="bank.bank_id"
                                                        data-parsley-required="true" data-parsley-group="tab_bank">
                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                    <option v-for="b in bankDDL" v-bind:value="b.id">@{{ b.name }} (@{{ b.short_name }}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="account_name[]" v-model="bank.account_name" data-parsley-required="true" data-parsley-group="tab_bank">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="account_number[]" v-model="bank.account_number" data-parsley-required="true" data-parsley-group="tab_bank">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="bank_remarks[]" v-model="bank.remarks">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-xs btn-danger" data="@{{ bankIdx }}" v-on:click="removeSelectedBank(bankIdx)"><span class="fa fa-close fa-fw"></span></button>
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
                                            <option v-for="expense in expenseTemplates" v-bind:value="expense">@{{ expense.name }}</option>
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
                                        <tr v-for="expense in expenses">
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
                                                <button type="button" class="btn btn-xs btn-danger" v-on:click="removeSelectedExpense($index)"><span class="fa fa-close fa-fw"></span></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_settings">
                                <div class="form-group">
                                    <label for="inputPriceLevel" class="col-sm-2 control-label">@lang('customer.field.price_level')</label>
                                    <div class="col-sm-10">
                                        <select name="price_level" class="form-control" data-parsley-required="true"
                                                data-parsley-required="true" data-parsley-group="tab_setting">
                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="pp in pricelevelDDL" v-bind:value="pp.id">@{{ pp.name }} (@{{ pp.description }})</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPaymentDueDay" class="col-sm-2 control-label">@lang('customer.field.payment_due_day')</label>
                                    <div class="col-sm-10">
                                        <input id="inputPaymentDueDay" name="payment_due_day" type="text" class="form-control" data-parsley-required="true" data-parsley-group="tab_setting">
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
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            var app = new Vue({
                el: '#customerVue',
                data: {
                    banks: [],
                    profiles: [],
                    expenses: [],
                    bankDDL: JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}'),
                    providerDDL: JSON.parse('{!! htmlspecialchars_decode($providerDDL) !!}'),
                    pricelevelDDL: JSON.parse('{!! htmlspecialchars_decode($priceLevelDDL) !!}'),
                    expenseTemplates: JSON.parse('{!! htmlspecialchars_decode($expenseTemplates) !!}'),
                    selectedExpense: ''
                },
                methods: {
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
                    resetInputBank: function() {
                        this.inputBank = {};
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
                        console.log(parentIndex);
                        console.log(idx);
                        this.profiles[parentIndex].phone_number.splice(idx, 1);
                    },
                    addExpense: function(selectedExpense) {
                        this.expenses.push({
                            id: selectedExpense.id,
                            name: selectedExpense.name,
                            type: selectedExpense.type,
                            amount: numeral(selectedExpense.amount).format('0,0'),
                            is_internal_expense: selectedExpense.is_internal_expense,
                            remarks: selectedExpense.remarks
                        });
                    },
                    removeSelectedExpense: function(idx) {
                        this.expenses.splice(idx, 1);
                    }
                },
                ready: function() {
                    _.forEach(this.expenseTemplates, function (expenseTemplate, index) {
                        if(expenseTemplate.is_internal_expense){
                            expenseTemplate.is_internal_expense = "@lang('lookup.YESNOSELECT.YES')";
                        }
                        else{
                            expenseTemplate.is_internal_expense = "@lang('lookup.YESNOSELECT.NO')";
                        }
                    });
                }
            });

            window.Parsley.on('parsley:field:validate', function() {
                validateFront();
            });

            var validateFront = function () {
                if (true === $('#customerForm').parsley().isValid("tab_cust", false)) {
                    $('#custDataTabError').addClass('hidden');
                } else {
                    $('#custDataTabError').removeClass('hidden');
                }

                if (true === $('#customerForm').parsley().isValid("tab_pic", false)) {
                    $('#picTabError').addClass('hidden');
                } else {
                    $('#picTabError').removeClass('hidden');
                }

                if (true === $('#customerForm').parsley().isValid("tab_bank", false)) {
                    $('#bankAccountTabError').addClass('hidden');
                } else {
                    $('#bankAccountTabError').removeClass('hidden');
                }

                if (true === $('#customerForm').parsley().isValid("tab_setting", false)) {
                    $('#settingsTabError').addClass('hidden');
                } else {
                    $('#settingsTabError').removeClass('hidden');
                }

                if (true === $('#customerForm').parsley().isValid("tab_expense", false)) {
                    $('#expensesTabError').addClass('hidden');
                } else {
                    $('#expensesTabError').removeClass('hidden');
                }
            };
        });
    </script>
@endsection