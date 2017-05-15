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

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin_store_create') !!}
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
            <div id="storeVue">
                <div class="box-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_store" data-toggle="tab">@lang('store.create.tab.store')&nbsp;<span id="storeDataTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_bank_account" data-toggle="tab">@lang('store.create.tab.bank_account')&nbsp;<span id="bankAccountTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_currencies" data-toggle="tab">@lang('store.create.tab.currencies')&nbsp;<span id="currenciesTabError" class="parsley-asterisk hidden">*</span></a></li>
                            <li><a href="#tab_settings" data-toggle="tab">@lang('store.create.tab.settings')&nbsp;<span id="settingsTabError" class="parsley-asterisk hidden">*</span></a></li>
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
                                    <div class="col-sm-9">
                                        <textarea id="inputAddress" class="form-control" rows="5" name="address">{{ old('address') }}</textarea>
                                        <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-default btn-mini" data-toggle="modal" data-target="#myModal"><i class="fa fa-location-arrow"></i></button>
                                        <input id="inputLatitude" type="hidden" name="latitude">
                                        <input id="inputLongitude" type="hidden" name="longitude">
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('longitude') ? 'has-error' : '' }}">
                                    <label for="inputLongitude" class="col-sm-2 control-label">@lang('store.field.longitude')</label>
                                    <div class="col-sm-10">

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
                                <div class="form-group {{ $errors->has('frontweb') ? 'has-error' : '' }}">
                                    <label for="inputFrontWeb" class="col-sm-2 control-label">@lang('store.field.frontweb')</label>
                                    <div class="col-sm-10">
                                        {{ Form::select('frontweb', $yesnoDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true', 'data-parsley-group' => 'tab_store')) }}
                                        <span class="help-block">{{ $errors->has('frontweb') ? $errors->first('frontweb') : '' }}</span>
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
                                                        v-model="bank.bank_id">
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
                                            <td class="text-center valign-middle">
                                                <button type="button" class="btn btn-xs btn-danger" data="@{{ $index }}" v-on:click="removeSelectedBank($index)"><span class="fa fa-close fa-fw"></span></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button class="btn btn-xs btn-default" type="button" v-on:click="addNewBank()">@lang('buttons.create_new_button')</button>
                            </div>
                            <div class="tab-pane" id="tab_currencies">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">@lang('store.create.table_currencies.header.currencies')</th>
                                            <th class="text-center">@lang('store.create.table_currencies.header.base_currencies')</th>
                                            <th class="text-center">@lang('store.create.table_currencies.header.conversion_value')</th>
                                            <th class="text-center">@lang('store.create.table_currencies.header.remarks')</th>
                                            <th class="text-center">@lang('labels.ACTION')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item,idx) in currencies">
                                            <td>
                                                <select class="form-control"
                                                        name="currencies[]"
                                                        v-model="item.currencies_id" data-parsley-required="true">
                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                    <option v-for="c in currenciesDDL" v-bind:value="c.id">@{{ c.name }} (@{{ c.symbol }})</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" v-model="item.is_base" v-on:click="selectedBaseCurrencies(idx)"/>
                                                <input type="hidden" name="base_currencies[]" v-model="item.is_base">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="currencies_conversion_value[]" v-model="item.conversion_value" v-bind:readonly="(item.is_base != 0)" data-parsley-required="true" data-parsley-group="tab_currencies">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="currencies_remarks[]" v-model="item.remarks">
                                            </td>
                                            <td class="text-center valign-middle">
                                                <button type="button" class="btn btn-xs btn-danger" v-on:click="removeSelectedCurencies(idx)"><span class="fa fa-close fa-fw"></span></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button class="btn btn-xs btn-default" type="button" v-on:click="addNewCurrencies()">@lang('buttons.create_new_button')</button>                          
                            </div>
                            <div class="tab-pane" id="tab_settings">
                                <div class="form-group {{ $errors->has('date_format') ? 'has-error' : '' }}">
                                    <label for="inputDateFormat" class="col-sm-2 control-label">@lang('store.field.date_format')</label>
                                    <div class="col-sm-10">
                                        <select name="date_format" class="form-control">
                                            <option value="d/m/Y" selected>dd/MM/yyyy - {{ date('d/m/Y') }} (default)</option>
                                            <option value="d m Y">dd MM yyyy - {{ date('d m Y') }}</option>
                                            <option value="d M Y">dd MMM yyyy - {{ date('d M Y') }}</option>
                                            <option value="m/d/Y">MM/dd/yyyy - {{ date('m/d/Y') }}</option>
                                        </select>
                                        <span class="help-block">{{ $errors->has('date_format') ? $errors->first('date_format') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('time_format') ? 'has-error' : '' }}">
                                    <label for="inputTimeFormat" class="col-sm-2 control-label">@lang('store.field.time_format')</label>
                                    <div class="col-sm-4">
                                        <div class="checkbox icheck">
                                            <input type="radio" name="time_format" value="H:i:s" checked class="is_icheck">
                                            <label>&nbsp;{{ date('H:i:s') }}</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="time_format" value="h i" class="is_icheck">
                                            <label>&nbsp;{{ date('h:i A') }}</label>
                                        </div>
                                    </div>
                                    <span class="help-block">{{ $errors->has('time_format') ? $errors->first('time_format') : '' }}</span>
                                </div>
                                <div class="form-group {{ $errors->has('thousand_separator') ? 'has-error' : '' }}">
                                    <label for="inputThousandSeparator" class="col-sm-2 control-label">@lang('store.field.thousand_separator')</label>
                                    <div class="col-sm-10">
                                        <select name="thousand_separator" class="form-control">
                                            <option value=",">@lang('store.field.comma')&nbsp;-&nbsp;1,000,000</option>
                                            <option value=".">@lang('store.field.dot')&nbsp;-&nbsp;1.000.000</option>
                                            <option value=" ">@lang('store.field.space')&nbsp;-&nbsp;1 000 000</option>
                                        </select>
                                        <span class="help-block">{{ $errors->has('thousand_separator') ? $errors->first('thousand_separator') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDecimalSeparator" class="col-sm-2 control-label">@lang('store.field.decimal_separator')</label>
                                    <div class="col-sm-10">
                                        <select name="decimal_separator" class="form-control">
                                            <option value=",">@lang('store.field.comma')&nbsp;-&nbsp;0,00</option>
                                            <option value=".">@lang('store.field.dot')&nbsp;-&nbsp;0.00</option>
                                            <option value=" ">@lang('store.field.space')&nbsp;-&nbsp;0 00</option>
                                        </select>
                                        <span class="help-block">{{ $errors->has('decimal_separator') ? $errors->first('decimal_separator') : '' }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDecimalDigit" class="col-sm-2 control-label">@lang('store.field.decimal_digit')</label>
                                    <div class="col-sm-10">
                                        <input id="inputDecimalDigit" name="decimal_digit" type="text" class="form-control" value="0" placeholder="Decimal Digit" data-parsley-required="true" data-parsley-type="number" data-parsley-max="4" data-parsley-group="tab_settings">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputRibbon" class="col-sm-2 control-label">@lang('store.field.ribbon')</label>
                                    <div class="col-sm-3">
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-none" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.none')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-blue" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.blue')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-black" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.black')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-red" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.red')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-yellow" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.yellow')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-purple" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.purple')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-green" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.green')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-blue-light" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.blue-light')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-black-light" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.black-light')</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-red-light" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.red-light')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-yellow-light" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.yellow-light')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-purple-light" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.purple-light')</label>
                                        </div>
                                        <div class="checkbox icheck">
                                            <input type="radio" name="ribbon" value="store-ribbon-green-light" class="is_icheck">
                                            <label>&nbsp;@lang('store.field.green-light')</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-9">
                            <a href="{{ route('db.admin.store') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
                    <div id="map" style="width: 870px; height: 400px;"></div>
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
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ $mapsAPIKey }}"></script>
    <script type="application/javascript">
        $(document).ready(function() {

            var location;
            var map;
            var markers = [];

            var app = new Vue({
                el: '#storeVue',
                data: {
                    banks: [],
                    currencies: [],
                    bankDDL: JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}'),
                    currenciesDDL: JSON.parse('{!! htmlspecialchars_decode($currenciesDDL) !!}')
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
                    addNewCurrencies: function(){
                        this.currencies.push({
                            'currencies_id': '',
                            'is_base': 0,
                            'conversion_value': '',
                            'remarks': ''
                        });
                    },
                    selectedBaseCurrencies: function(idx){
                        for (var i = 0; i < this.currencies.length; i++) {
                            if (idx == i) {
                                this.currencies[i].conversion_value = 1;
                                this.currencies[i].is_base = 1;
                            } else {
                                this.currencies[i].is_base = 0;
                            }
                        }
                    },
                    removeSelectedCurencies: function(idx){
                        this.currencies.splice(idx, 1);
                    }
                }
            });

            $('input.is_icheck').iCheck({
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

                if (true === $('#storeForm').parsley().isValid("tab_currencies", false)) {
                    $('#currenciesTabError').addClass('hidden');
                } else {
                    $('#currenciesTabError').removeClass('hidden');
                }

                if (true === $('#storeForm').parsley().isValid("tab_settings", false)) {
                    $('#settingsTabError').addClass('hidden');
                } else {
                    $('#settingsTabError').removeClass('hidden');
                }
            };

            function init() {

                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 16
                });

                var input = document.getElementById('inputModalAddress');
                var address = input.value;
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo("bounds", map);

                deleteMarkers();

                var marker = new google.maps.Marker({map: map});

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
                            position: latLong
                        });
                        marker.setMap(map);

                        map.setZoom(16);
                        map.setCenter(marker.getPosition());
                        markers.push(marker);

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
                }
                else {
                    locateByAddress(address);
                }
            }

            $('#myModal').on('shown.bs.modal', function() {

                if($('#inputAddress').val() === '') {
                    $('#inputModalLat').val($('#inputLat').val());
                    $('#inputModalLng').val($('#inputLng').val());
                }
                else {
                    $('#inputModalAddress').val($('#inputAddress').val());
                }

                init();
            });

            $('#location-ok-btn').click(function() {

                if(location != undefined) {
                    $('#inputLat').val(location.geometry.location.lat());
                    $('#inputLng').val(location.geometry.location.lng());
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
                                position: results[0].geometry.location,
                                map: map
                            });
                            markers.push(marker);

                            google.maps.event.trigger(map, 'resize');
                            map.setCenter(results[0].geometry.location);
                        }
                    });

            }

            function locateByCoordinate(lat, lng) {

                deleteMarkers();

                var latLong = new google.maps.LatLng(lat, lng);

                var marker = new google.maps.Marker({
                    position: latLong,
                    map: map
                });
                markers.push(marker);

                google.maps.event.trigger(map, 'resize');
                map.setCenter(latLong);

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