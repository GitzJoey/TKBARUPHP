@extends('layouts.adminlte.master')

@section('title')
    @lang('truck.create.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-flip-horizontal fa-fw"></span>&nbsp;@lang('truck.create.page_title')
@endsection

@section('page_title_desc')
    @lang('truck.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_truck_create') !!}
@endsection

@section('content')
    <div id="truckVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="truckForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('truck.create.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('truck_type') }">
                        <label for="inputTruckType" class="col-sm-2 control-label">@lang('truck.field.truck_type')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="type"
                                    v-model="truck.truck_type"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('truck.field.truck_type') }}">
                                <option v-bind:value="defaultTruckType">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in truckTypeDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('truck_type')" class="help-block" v-cloak>@{{ errors.first('truck_type') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('plate_number') }">
                        <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('truck.field.plate_number')</label>
                        <div class="col-sm-10">
                            <input id="inputPlateNumber" name="plate_number" type="text" class="form-control" placeholder="@lang('truck.field.plate_number')"
                                v-model="truck.plate_number" v-validate="'required'" data-vv-as="{{ trans('truck.field.plate_number') }}">
                            <span v-show="errors.has('plate_number')" class="help-block" v-cloak>@{{ errors.first('plate_number') }}</span>

                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('inspection_date') }">
                        <label for="inputInspectionDate" class="col-sm-2 control-label">@lang('truck.field.inspection_date')</label>
                        <div class="col-sm-9">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <vue-datetimepicker name="inspection_date" value="" v-model="truck.inspection_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                <span v-show="errors.has('inspection_date')" class="help-block" v-cloak>@{{ errors.first('inspection_date') }}</span>
                            </div>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('driver') }">
                        <label for="inputDriver" class="col-sm-2 control-label">@lang('truck.field.driver')</label>
                        <div class="col-sm-10">
                            <input id="inputDriver" name="driver" type="text" class="form-control" placeholder="@lang('truck.field.driver')"
                                v-model="truck.driver" v-validate="'required'" data-vv-as="{{ trans('truck.field.driver') }}">
                            <span v-show="errors.has('driver')" class="help-block" v-cloak>@{{ errors.first('driver') }}</span>

                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('status') }">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('truck.field.status')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="status"
                                    v-model="truck.status"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('truck.field.status') }}">
                                <option v-bind:value="defaultStatus">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('status')" class="help-block" v-cloak>@{{ errors.first('status') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('truck.field.remarks')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputRemarks" name="remarks" placeholder="@lang('truck.field.remarks')">
                            <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.truck') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                            <button class="btn btn-default" type="submit">@lang('buttons.create_new_button')</button>
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
            el: '#truckVue',
            data: {
                truck: {
                    truck_type: '',
                    plate_number: '',
                    driver: '',
                    status: '',
                    inspection_date: ''
                },
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}'),
                truckTypeDDL: JSON.parse('{!! htmlspecialchars_decode($truckTypeDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.master.truck.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#truckForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.master.truck') }}';
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
                defaultStatus: function() {
                    return '';
                },
                defaultTruckType: function() {
                    return '';
                }
            }
        });
    </script>
@endsection
