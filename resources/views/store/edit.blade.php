@extends('layouts.adminlte.master')

@section('title')
    @lang('store.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-umbrella fa-fw"></span>&nbsp;@lang('store.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('store.edit.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin_store_edit', $store->hId()) !!}
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
            <h3 class="box-title">@lang('store.edit.header.title')</h3>
        </div>
        {!! Form::model($store, ['id' => 'storeForm', 'method' => 'PATCH', 'route' => ['db.admin.store.edit', $store->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            <div id="storeVue">
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_store" data-toggle="tab">@lang('store.create.tab.store')&nbsp;<span id="storeDataTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_bank_account" data-toggle="tab">@lang('store.create.tab.bank_account')&nbsp;<span id="bankAccountTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_settings" data-toggle="tab">@lang('store.create.tab.settings')&nbsp;<span id="settingsTabError" class="parsley-asterisk hidden">*</span></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_store">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="inputStoreName" class="col-sm-2 control-label">@lang('store.field.name')</label>
                                    <div class="col-sm-10">
                                        <input id="inputStoreName" name="name" type="text" class="form-control" value="{{ $store->name }}" placeholder="Name" data-parsley-required="true" data-parsley-group="tab_store">
                                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('image_path') ? 'has-error' : '' }}">
                                    <label for="inputStoreImage" class="col-sm-2 control-label">&nbsp;</label>
                                    <div class="col-sm-10">
                                        @if(!empty($store->image_filename))
                                            <img src="{{ asset('images/'.$store->image_filename) }}" class="img-responsive img-circle" style="max-width: 150px; max-height: 150px;"/>
                                        @endif
                                        <input id="inputStoreImage" name="image_path" type="file" class="form-control" value="{{ old('image_path') }}">
                                        <span class="help-block">{{ $errors->has('image_path') ? $errors->first('image_path') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label for="inputAddress" class="col-sm-2 control-label">@lang('store.field.address')</label>
                                    <div class="col-sm-10">
                                        <textarea id="inputAddress" class="form-control" rows="5" name="address">{{ $store->address }}</textarea>
                                        <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('phone_num') ? 'has-error' : '' }}">
                                    <label for="inputPhone" class="col-sm-2 control-label">@lang('store.field.phone')</label>
                                    <div class="col-sm-10">
                                        <input id="inputPhone" name="phone_num" type="text" class="form-control" value="{{ $store->phone_num }}" placeholder="Phone">
                                        <span class="help-block">{{ $errors->has('phone_num') ? $errors->first('phone_num') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputFax" class="col-sm-2 control-label">@lang('store.field.fax')</label>
                                    <div class="col-sm-10">
                                        <input id="inputFax" name="fax_num" type="text" class="form-control" value="{{ $store->fax_num }}" placeholder="Fax">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputTax" class="col-sm-2 control-label">@lang('store.field.tax_id')</label>
                                    <div class="col-sm-10">
                                        <input id="inputTax" name="tax_id" type="text" class="form-control" value="{{ $store->tax_id }}" placeholder="Tax ID"/>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label for="inputStatus" class="col-sm-2 control-label">@lang('store.field.status')</label>
                                    <div class="col-sm-10">
                                        {{ Form::select('status', $statusDDL, $store->status, array('id' => 'statusSelect', 'class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true', 'data-parsley-checkactive' => $store->is_default, 'data-parsley-group' => 'tab_store')) }}
                                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('is_default') ? 'has-error' : '' }}">
                                    <label for="inputIsDefault" class="col-sm-2 control-label">@lang('store.field.default')</label>
                                    <div class="col-sm-10">
                                        {{ Form::select('is_default', $yesnoDDL, $store->is_default, array('id' => 'isDefaultSelect', 'class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true', 'data-parsley-isdefault_switch_no' => $store->is_default, 'data-parsley-group' => 'tab_store')) }}
                                        <span class="help-block">{{ $errors->has('is_default') ? $errors->first('is_default') : '' }}</span>&nbsp;
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('frontweb') ? 'has-error' : '' }}">
                                    <label for="inputFrontWeb" class="col-sm-2 control-label">@lang('store.field.frontweb')</label>
                                    <div class="col-sm-10">
                                        {{ Form::select('frontweb', $yesnoDDL, $store->frontweb, array('id'=> 'frontWebSelect', 'class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true', 'data-parsley-frontweb_switch_no' => $store->frontweb, 'data-parsley-group' => 'tab_store')) }}
                                        <span class="help-block">{{ $errors->has('frontweb') ? $errors->first('frontweb') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('store.field.remarks')</label>
                                    <div class="col-sm-10">
                                        <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $store->remarks }}" placeholder="Remarks">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_bank_account">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">@lang('store.create.table_bank.header.bank')</th>
                                            <th class="text-center">@lang('store.create.table_bank.header.account_name')</th>
                                            <th class="text-center">@lang('store.create.table_bank.header.account_number')</th>
                                            <th class="text-center">@lang('store.create.table_bank.header.remarks')</th>
                                            <th class="text-center">@lang('labels.ACTION')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="bank in banks">
                                            <td>
                                                <select class="form-control"
                                                        name="bank[]"
                                                        v-model="bank.bank_id" data-parsley-required="true" data-parsley-group="tab_bank">
                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                    <option v-for="b in bankDDL" v-bind:value="b.id">@{{ b.name }} (@{{ b.short_name }})</option>
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
                                                <button type="button" class="btn btn-xs btn-danger" data="@{{ $index }}" v-on:click="removeSelectedBank($index)"><span class="fa fa-close fa-fw"></span></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button class="btn btn-xs btn-default" type="button" v-on:click="addNewBank()">@lang('buttons.create_new_button')</button>
                            </div>
                            <div class="tab-pane" id="tab_settings">
                                <div class="form-group {{ $errors->has('date_format') ? 'has-error' : '' }}">
                                    <label for="inputDateFormat" class="col-sm-2 control-label">@lang('store.field.date_format')</label>
                                    <div class="col-sm-10">
                                        <select name="date_format" class="form-control">
                                            <option value="d/m/Y" {{ $store->date_format == 'd/m/Y' ? 'selected':'' }}>dd/MM/yyyy - {{ date('d/m/Y') }} (default)</option>
                                            <option value="d m Y" {{ $store->date_format == 'd m Y' ? 'selected':'' }}>dd MM yyyy - {{ date('d m Y') }}</option>
                                            <option value="d M Y" {{ $store->date_format == 'd M Y' ? 'selected':'' }}>dd MMM yyyy - {{ date('d M Y') }}</option>
                                            <option value="m/d/Y" {{ $store->date_format == 'm/d/Y' ? 'selected':'' }}>MM/dd/yyyy - {{ date('m/d/Y') }}</option>
                                        </select>
                                        <span class="help-block">{{ $errors->has('date_format') ? $errors->first('date_format') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('time_format') ? 'has-error' : '' }}">
                                    <label for="inputTimeFormat" class="col-sm-2 control-label">@lang('store.field.time_format')</label>
                                    <div class="col-sm-4">
                                        <div class="checkbox icheck">
                                            <input type="radio" name="time_format" value="H:i:s" {{ $store->time_format == 'H:i:s' ? 'checked':'' }}>
                                            <label>&nbsp;{{ date('H:i:s') }}</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="time_format" value="h:i A" {{ $store->time_format == 'h:i A' ? 'checked':'' }}>
                                            <label>&nbsp;{{ date('h:i A') }}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->has('time_format') ? $errors->first('time_format') : '' }}</span>
                                </div>
                                <div class="form-group {{ $errors->has('thousand_separator') ? 'has-error' : '' }}">
                                    <label for="inputThousandSeparator" class="col-sm-2 control-label">@lang('store.field.thousand_separator')</label>
                                    <div class="col-sm-10">
                                        <select name="thousand_separator" class="form-control">
                                            <option value="," {{ $store->thousand_separator == ',' ? 'selected':'' }}>@lang('store.field.comma')&nbsp;-&nbsp;1,000,000</option>
                                            <option value="." {{ $store->thousand_separator == '.' ? 'selected':'' }}>@lang('store.field.dot')&nbsp;-&nbsp;1.000.000</option>
                                            <option value=" " {{ $store->thousand_separator == ' ' ? 'selected':'' }}>@lang('store.field.space')&nbsp;-&nbsp;1 000 000</option>
                                        </select>
                                        <span class="help-block">{{ $errors->has('thousand_separator') ? $errors->first('thousand_separator') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDecimalSeparator" class="col-sm-2 control-label">@lang('store.field.decimal_separator')</label>
                                    <div class="col-sm-10">
                                        <select name="decimal_separator" class="form-control">
                                            <option value="," {{ $store->decimal_separator == ',' ? 'selected':'' }}>@lang('store.field.comma')&nbsp;-&nbsp;0,00</option>
                                            <option value="." {{ $store->decimal_separator == '.' ? 'selected':'' }}>@lang('store.field.dot')&nbsp;-&nbsp;0.00</option>
                                            <option value=" " {{ $store->decimal_separator == ' ' ? 'selected':'' }}>@lang('store.field.space')&nbsp;-&nbsp;0 00</option>
                                        </select>
                                        <span class="help-block">{{ $errors->has('decimal_separator') ? $errors->first('decimal_separator') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDecimalDigit" class="col-sm-2 control-label">@lang('store.field.decimal_digit')</label>
                                    <div class="col-sm-10">
                                        <input id="inputDecimalDigit" name="decimal_digit" type="text" class="form-control" value="{{ $store->decimal_digit }}" placeholder="Decimal Digit"
                                               data-parsley-required="true" data-parsley-type="number" data-parsley-max="4" data-parsley-group="tab_settings">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputRibbon" class="col-sm-2 control-label">@lang('store.field.ribbon')</label>
                                    <div class="col-sm-3">
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-none" {{ $store->ribbon == 'store-ribbon-none' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.none')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-blue" {{ $store->ribbon == 'store-ribbon-blue' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.blue')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-black" {{ $store->ribbon == 'store-ribbon-black' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.black')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-red" {{ $store->ribbon == 'store-ribbon-red' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.red')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-yellow" {{ $store->ribbon == 'store-ribbon-yellow' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.yellow')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-purple" {{ $store->ribbon == 'store-ribbon-purple' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.purple')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-green"  {{ $store->ribbon == 'store-ribbon-green' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.green')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-blue-light" {{ $store->ribbon == 'store-ribbon-blue-light' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.blue-light')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-black-light" {{ $store->ribbon == 'store-ribbon-black-light' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.black-light')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-red-light" {{ $store->ribbon == 'store-ribbon-red-light' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.red-light')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-yellow-light" {{ $store->ribbon == 'store-ribbon-yellow-light' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.yellow-light')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-purple-light" {{ $store->ribbon == 'store-ribbon-purple-light' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.purple-light')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-green-light" {{ $store->ribbon == 'store-ribbon-green-light' ? 'checked':'' }}>
                                            <label>&nbsp;@lang('store.field.green-light')</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.store') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
        $(document).ready(function() {
            var app = new Vue({
                el: '#storeVue',
                data: {
                    banks: JSON.parse('{!! empty(htmlspecialchars_decode($store->bankAccounts)) ? '[]':htmlspecialchars_decode($store->bankAccounts) !!}'),
                    bankDDL: JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}')
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
                    }
                }
            });

            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            $('#storeForm').parsley().on('field:validate', function() {
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

                if (true === $('#storeForm').parsley().isValid("tab_settings", false)) {
                    $('#settingsTabError').addClass('hidden');
                } else {
                    $('#settingsTabError').removeClass('hidden');
                }
            };
        });

        window.Parsley.addValidator('checkactive', function (value, is_default) {
            if (value == 'STATUS.INACTIVE' && is_default == 'YESNOSELECT.YES') {
                return false;
            } else {
                return true;
            }
        }, 32)
                .addMessage('en', 'checkactive', 'Default Store cannot be inactived')
                .addMessage('id', 'checkactive', 'Toko utama tidak bisa dinonaktifkan');

        window.Parsley.addValidator('isdefault_switch_no', function (value, old_value) {
            if (old_value == 'YESNOSELECT.YES' && value == 'YESNOSELECT.NO') {
                return false;
            } else {
                return true;
            }
        }, 32)
            .addMessage('en', 'isdefault_switch_no', 'Default Store cannot be switched off, replace other Store as YES instead.')
            .addMessage('id', 'isdefault_switch_no', 'Toko utama tidak bisa dinonaktifkan, pilih Toko lain sebagai pengganti terlebih dahulu');

        window.Parsley.addValidator('frontweb_switch_no', function (value, old_value) {
            if (old_value == 'YESNOSELECT.YES' && value == 'YESNOSELECT.NO') {
                return false;
            } else {
                return true;
            }
        }, 32)
            .addMessage('en', 'frontweb_switch_no', 'Front Web cannot be inactived, replace other Store as YES instead')
            .addMessage('id', 'frontweb_switch_no', 'Website tidak bisa dinonaktifkan, pilih Toko lain sebagai pengganti terlebih dahulu');

    </script>
@endsection