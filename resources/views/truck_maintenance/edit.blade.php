@extends('layouts.adminlte.master')

@section('title')
    @lang('truckmtc.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-flip-horizontal fa-fw"></span>&nbsp;@lang('truckmtc.edit.page_title')
@endsection

@section('page_title_desc')

@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('truck_maintenance_edit', $truckMtc->hId()) !!}
@endsection

@section('content')
   <div id="truckMtcVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="truckMtcForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('truckmtc.edit.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('maintenance_date') }">
                        <label for="inputInspectionDate" class="col-sm-2 control-label">@lang('truckmtc.field.maintenance_date')</label>
                        <div class="col-sm-9">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <vue-datetimepicker name="maintenance_date" value="" v-model="maintenanceTruck.maintenance_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                <span v-show="errors.has('maintenance_date')" class="help-block" v-cloak>@{{ errors.first('maintenance_date') }}</span>
                            </div>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('plate_number') }">
                        <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('truckmtc.field.plate_number')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="plate_number"
                                    v-model="maintenanceTruck.plate_number"
                                    v-validate="'required'"
                                    v-bind:disabled="true"
                                    data-vv-as="{{ trans('truckmtc.field.plate_number') }}">
                                <option v-bind:value="defaultPlateNumber">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in plateNumberDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('plate_number')" class="help-block" v-cloak>@{{ errors.first('plate_number') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('maintenance_type') }">
                        <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('truckmtc.field.maintenance_type')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="maintenance_type"
                                    v-model="maintenanceTruck.maintenance_type"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('truckmtc.field.maintenance_type') }}">
                                <option v-bind:value="defaultMtcType">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in mtctypeDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('maintenance_type')" class="help-block" v-cloak>@{{ errors.first('maintenance_type') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('cost') }">
                        <label for="inputCost" class="col-sm-2 control-label">@lang('truckmtc.field.cost')</label>
                        <div class="col-sm-10">
                            <vue-autonumeric id="inputCost" type="text" name="cost" class="form-control"
                                             v-bind:placeholder="@lang('truckmtc.field.cost')"
                                             v-model="maintenanceTruck.cost"
                                             v-validate="'required'" data-vv-as="{{ trans('truckmtc.field.cost') }}"
                                             v-bind:options="{
                                                digitGroupSeparator: '{{ Auth::user()->store->thousand_separator }}',
                                                decimalCharacter: '{{ Auth::user()->store->decimal_separator }}',
                                                decimalPlaces: '{{ Auth::user()->store->decimal_digit }}',
                                                minimumValue: '0',
                                                emptyInputBehavior: 'null' }"></vue-autonumeric>
                            <span v-show="errors.has('cost')" class="help-block" v-cloak>@{{ errors.first('cost') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('odometer') }">
                        <label for="inputOdometer" class="col-sm-2 control-label">@lang('truckmtc.field.odometer')</label>
                        <div class="col-sm-10">
                            <vue-autonumeric id="inputOdometer" name="odometer" type="text" class="form-control" placeholder="@lang('truckmtc.field.odometer')"
                                             value="" v-model="maintenanceTruck.odometer" v-validate="'required'" data-vv-as="{{ trans('truckmtc.field.odometer') }}"
                                             v-bind:options="{
                                                digitGroupSeparator: '{{ Auth::user()->store->thousand_separator }}',
                                                decimalCharacter: '{{ Auth::user()->store->decimal_separator }}',
                                                decimalPlaces: 0,
                                                minimumValue: '0',
                                                emptyInputBehavior: 'null' }"></vue-autonumeric>
                            <span v-show="errors.has('odometer')" class="help-block" v-cloak>@{{ errors.first('odometer') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                        <label class="col-sm-2 control-label">@lang('truckmtc.field.remarks')</label>
                        <div class="col-sm-10">
                            <input name="remarks" type="text" class="form-control" value="{{ (old('remarks'))?old('remarks'):$truckMtc->remarks }}" placeholder="@lang('truckmtc.field.remarks')">
                            <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.truck.maintenance') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
            el: '#truckMtcVue',
            data: {
                maintenanceTruck: {
                    maintenance_date: '{{ $truckMtc->maintenance_date }}',
                    plate_number:'{{ $truckMtc->truck->id }}',
                    maintenance_type: '{{ $truckMtc->maintenance_type }}',
                    cost: '{{ $truckMtc->cost }}',
                    odometer: '{{ $truckMtc->odometer }}'
                },
                plateNumberDDL: JSON.parse('{!! htmlspecialchars_decode($trucklist) !!}'),
                mtctypeDDL: JSON.parse('{!! htmlspecialchars_decode($mtctypeDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.maintenance.truck.edit', $truckMtc->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#truckMtcForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.truck.maintenance') }}';
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
                }
            },
            computed: {
                defaultPlateNumber: function() {
                    return '';
                },
                defaultMtcType: function() {
                    return '';
                },
            }
        });
    </script>
@endsection
