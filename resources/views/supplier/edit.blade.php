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
    <div id="supplierVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="supplierForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('supplier.edit.header.title')</h3>
                </div>
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_supplier" class="active" data-toggle="tab">@lang('supplier.edit.tab.supplier')&nbsp;<span id="suppDataTabError" v-bind:class="{ 'red-asterisk':true, 'hidden':errors.any('tab_supplier')?false:true }">*</span></a></li>
                            <li><a href="#tab_pic" data-toggle="tab">@lang('supplier.edit.tab.pic')&nbsp;<span id="picTabError" v-bind:class="{ 'red-asterisk':true, 'hidden':errors.any('tab_pic')?false:true }">*</span></a></li>
                            <li><a href="#tab_bank_account" data-toggle="tab">@lang('supplier.edit.tab.bank_account')&nbsp;<span id="bankAccountTabError" v-bind:class="{ 'red-asterisk':true, 'hidden':errors.any('tab_bank')?false:true }">*</span></a></li>
                            <li><a href="#tab_product" data-toggle="tab">@lang('supplier.edit.tab.product')</a></li>
                            <li><a href="#tab_expenses" data-toggle="tab">@lang('supplier.edit.tab.expenses')</a></li>
                            <li><a href="#tab_settings" data-toggle="tab">@lang('supplier.edit.tab.settings')&nbsp;<span id="settingsTabError" v-bind:class="{ 'red-asterisk':true, 'hidden':errors.any('tab_settings')?false:true }">*</span></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_supplier">
                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_supplier.name') }">
                                    <label for="inputName" class="col-sm-2 control-label">@lang('supplier.field.name')</label>
                                    <div class="col-sm-10">
                                        <input id="inputName" name="name" type="text" class="form-control" value="{{ $supplier->name }}" placeholder="@lang('supplier.field.name')"
                                               v-validate="'required'" data-vv-as="{{ trans('supplier.field.name') }}" data-vv-scope="tab_supplier">
                                        <span v-show="errors.has('tab_supplier.name')" class="help-block" v-cloak>@{{ errors.first('tab_supplier.name') }}</span>
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
                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_supplier.status') }">
                                    <label for="inputStatus" class="col-sm-2 control-label">@lang('supplier.field.status')</label>
                                    <div class="col-sm-10">
                                        <select id="inputStatus"
                                                class="form-control"
                                                name="status"
                                                v-model="status"
                                                v-validate="'required'"
                                                data-vv-as="{{ trans('supplier.field.status') }}"
                                                data-vv-scope="tab_supplier">
                                            <option v-bind:value="defaultStatus.code">@lang('labels.PLEASE_SELECT')</option>
                                            <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                                        </select>
                                        <span v-show="errors.has('tab_supplier.status')" class="help-block" v-cloak>@{{ errors.first('tab_supplier.status') }}</span>
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
                                        <button class="btn btn-xs btn-default" type="button" v-on:click="addNewProfile()">@lang('buttons.create_new_button')</button>
                                    </div>
                                    <div class="col-md-11">
                                        <div v-for="(profile, profileIdx) in profiles">
                                            <div class="box box-widget">
                                                <div class="box-header with-border">
                                                    <div class="user-block">
                                                        <strong>Person In Charge @{{ profileIdx + 1 }}</strong><br/>
                                                        &nbsp;&nbsp;&nbsp;@{{ profile.first_name }}&nbsp;@{{ profile.last_name }}
                                                    </div>
                                                    <div class="box-tools">
                                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_pic.first_name_' + profileIdx) }">
                                                        <label for="inputFirstName" class="col-sm-2 control-label">@lang('supplier.field.first_name')</label>
                                                        <div class="col-sm-10">
                                                            <input type="hidden" name="profile_id[]" v-bind:value="profile.id">
                                                            <input id="inputFirstName" type="text" name="first_name[]" class="form-control" v-model="profile.first_name" placeholder="@lang('supplier.field.first_name')"
                                                                    v-validate="'required'" v-bind:data-vv-as="'{{ trans('supplier.field.first_name') }} ' + (profileIdx + 1)" v-bind:data-vv-name="'first_name_' + profileIdx"
                                                                    data-vv-scope="tab_pic">
                                                            <span v-show="errors.has('tab_pic.first_name_' + profileIdx)" class="help-block" v-cloak>@{{ errors.first('tab_pic.first_name_' + profileIdx) }}</span>
                                                        </div>
                                                    </div>
                                                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_pic.last_name_' + profileIdx) }">
                                                        <label for="inputLastName" class="col-sm-2 control-label">@lang('supplier.field.last_name')</label>
                                                        <div class="col-sm-10">
                                                            <input id="inputLastName" type="text" name="last_name[]" class="form-control" v-model="profile.last_name" placeholder="@lang('supplier.field.last_name')"
                                                                   v-validate="'required'" v-bind:data-vv-as="'{{ trans('supplier.field.last_name') }} ' + (profileIdx + 1)" v-bind:data-vv-name="'last_name_' + profileIdx"
                                                                   data-vv-scope="tab_pic">
                                                            <span v-show="errors.has('tab_pic.last_name_' + profileIdx)" class="help-block" v-cloak>@{{ errors.first('tab_pic.last_name_' + profileIdx) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputAddress" class="col-sm-2 control-label">@lang('supplier.field.address')</label>
                                                        <div class="col-sm-10">
                                                            <input id="inputAddress" type="text" name="profile_address[]" class="form-control" v-model="profile.address" placeholder="@lang('supplier.field.address')">
                                                        </div>
                                                    </div>
                                                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_pic.ic_num_' + profileIdx) }">
                                                        <label for="inputICNum" class="col-sm-2 control-label">@lang('supplier.field.ic_num')</label>
                                                        <div class="col-sm-10">
                                                            <input id="inputICNum" type="text" name="ic_num[]" class="form-control" v-model="profile.ic_num" placeholder="@lang('supplier.field.ic_num')"
                                                                   v-validate="'required'" v-bind:data-vv-as="'{{ trans('supplier.field.ic_num') }} ' + (profileIdx + 1)" v-bind:data-vv-name="'ic_num_' + profileIdx"
                                                                   data-vv-scope="tab_pic">
                                                            <span v-show="errors.has('tab_pic.ic_num_' + profileIdx)" class="help-block" v-cloak>@{{ errors.first('tab_pic.ic_num_' + profileIdx) }}</span>
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
                                                                    <tr v-for="(ph, phIdx) in profile.phone_numbers">
                                                                        <td v-bind:class="{ 'has-error':errors.has('tab_pic.phoneprovider_' + phIdx) }">
                                                                            <input type="hidden" v-bind:name="'profile_' + profileIdx +'_phone_number_id[]'" v-bind:value="ph.id">
                                                                            <select v-bind:name="'profile_' + profileIdx + '_phone_provider[]'" class="form-control"
                                                                                    v-model="ph.phone_provider_id"
                                                                                    v-validate="'required'" v-bind:data-vv-as="'{{ trans('supplier.edit.table_phone.header.provider') }} ' + (phIdx + 1)"
                                                                                    v-bind:data-vv-name="'phoneprovider_' + phIdx">
                                                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                                                <option v-for="p in providerDDL" v-bind:value="p.id">@{{ p.name }} (@{{ p.short_name }} )</option>
                                                                            </select>
                                                                        </td>
                                                                        <td v-bind:class="{ 'has-error':errors.has('tab_pic.number_' + phIdx) }">
                                                                            <input type="text" v-bind:name="'profile_' + profileIdx + '_phone_number[]'" class="form-control" v-model="ph.number"
                                                                                   v-validate="'required'" v-bind:data-vv-as="'{{ trans('supplier.create.table_phone.header.number') }} ' + (phIdx + 1)"
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
                                            <th class="text-center">@lang('supplier.edit.table_bank.header.bank')</th>
                                            <th class="text-center">@lang('supplier.edit.table_bank.header.account_name')</th>
                                            <th class="text-center">@lang('supplier.edit.table_bank.header.account_number')</th>
                                            <th class="text-center">@lang('supplier.edit.table_bank.header.remarks')</th>
                                            <th class="text-center">@lang('labels.ACTION')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(bank, bankIdx) in banks">
                                            <td v-bind:class="{ 'has-error':errors.has('tab_bank.bank_' + bankIdx) }">
                                                <input type="hidden" name="bank_account_id[]" v-bind:value="bank.id">
                                                <select name="bank[]" class="form-control"
                                                        v-model="bank.bank_id"
                                                        v-validate="'required'"
                                                        v-bind:data-vv-as="'{{ trans('supplier.create.table_bank.header.bank') }} ' + (bankIdx + 1)"
                                                        v-bind:data-vv-name="'bank_' + bankIdx" data-vv-scope="tab_bank">
                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                    <option v-for="b in bankDDL" v-bind:value="b.id">@{{ b.name }} (@{{ b.short_name }})</option>
                                                </select>
                                            </td>
                                            <td v-bind:class="{ 'has-error':errors.has('tab_bank.account_name_' + bankIdx) }">
                                                <input type="text" class="form-control" name="account_name[]" v-model="bank.account_name"
                                                       v-validate="'required'"
                                                       v-bind:data-vv-as="'{{ trans('supplier.create.table_bank.header.account_name') }} ' + (bankIdx + 1)"
                                                       v-bind:data-vv-name="'account_name_' + bankIdx" data-vv-scope="tab_bank">
                                            </td>
                                            <td v-bind:class="{ 'has-error':errors.has('tab_bank.account_number_' + bankIdx) }">
                                                <input type="text" class="form-control" name="account_number[]" v-model="bank.account_number"
                                                       v-validate="'required|numeric'" v-bind:data-vv-as="'{{ trans('supplier.create.table_bank.header.account_number') }} ' + (bankIdx + 1)"
                                                       v-bind:data-vv-name="'account_number_' + bankIdx" data-vv-scope="tab_bank">
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
                                        <tr v-for="(p, pIdx) in productList">
                                            <td class="text-center"><input type="checkbox" name="productSelected[]" v-model="productSelected[p.id]" v-bind:value="p.id"></td>
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
                                            <th class="text-center">@lang('supplier.edit.table_expense.header.name')</th>
                                            <th class="text-center">@lang('supplier.edit.table_expense.header.type')</th>
                                            <th class="text-center">@lang('supplier.edit.table_expense.header.amount')</th>
                                            <th class="text-center">@lang('supplier.edit.table_expense.header.internal_expense')</th>
                                            <th class="text-center">@lang('supplier.edit.table_expense.header.remarks')</th>
                                            <th class="text-center">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(expense, expenseIdx) in expenses">
                                            <input type="hidden" name="expense_template_id[]" v-bind:value="expense.id">
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
                                                <button type="button" class="btn btn-xs btn-danger" v-on:click="removeSelectedExpense(expenseIdx)"><span class="fa fa-close fa-fw"></span></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_settings">
                                <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tab_settings.payment_due_day') }">
                                    <label for="inputPaymentDueDay" class="col-sm-2 control-label">@lang('supplier.field.payment_due_day')</label>
                                    <div class="col-sm-10">
                                        <input id="inputPaymentDueDay" name="payment_due_day" type="text" value="{{ $supplier->payment_due_day }}" class="form-control"
                                               v-validate="'required|numeric|max_value:100'" data-vv-as="{{ trans('supplier.field.payment_due_day') }}" data-vv-scope="tab_settings">
                                        <span v-show="errors.has('tab_settings.payment_due_day')" class="help-block" v-cloak>@{{ errors.first('tab_settings.payment_due_day') }}</span>
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
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = new Vue({
            el: '#supplierVue',
            data: {
                banks: JSON.parse('{!! empty(htmlspecialchars_decode($supplier->bankAccounts)) ? '[]':htmlspecialchars_decode($supplier->bankAccounts) !!}'),
                profiles: JSON.parse('{!! empty(htmlspecialchars_decode($supplier->profiles)) ? '[]':htmlspecialchars_decode($supplier->profiles) !!}'),
                expenses: JSON.parse('{!! empty(htmlspecialchars_decode($supplier->expenseTemplates)) ? '[]':htmlspecialchars_decode($supplier->expenseTemplates) !!}'),
                bankDDL: JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}'),
                providerDDL: JSON.parse('{!! htmlspecialchars_decode($providerDDL) !!}'),
                expenseTemplates: JSON.parse('{!! htmlspecialchars_decode($expenseTemplates) !!}'),
                productList: JSON.parse('{!! htmlspecialchars_decode($productList) !!}'),
                productSelected: JSON.parse('{!! json_encode($productSelected) !!}'),
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}'),
                expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}'),
                selectedExpense: '',
                status: '{{ $supplier->status }}'
            },
            methods: {
                validateBeforeSubmit: function() {
                    this.$validator.validateScopes().then(function(isValid) {
                        if (!isValid) return;
                        axios.post('{{ route('api.post.db.master.supplier.edit', $supplier->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#supplierForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.master.supplier') }}';
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
                },
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
    </script>
@endsection