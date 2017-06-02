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

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('truck.create.header.title')</h3>
            </div>
            <form id="truckForm" class="form-horizontal" action="{{ route('db.master.truck.create') }}" method="post" v-on:submit.prevent="validateBeforeSubmit()">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group {{ $errors->has('truck_type') ? 'has-error' : '' }}">
                        <label for="inputTruckType" class="col-sm-2 control-label">@lang('truck.field.truck_type')</label>
                        <div class="col-sm-10">
                            {{ Form::select('truck_type', $truckTypeDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                            <span class="help-block">{{ $errors->has('truck_type') ? $errors->first('truck_type') : '' }}</span>
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
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('truck.field.status')</label>
                        <div class="col-sm-10">
                            {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                            <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
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
            </form>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $('#inputInspectionDate').datetimepicker({
            format: 'DD-MM-YYYY',
            defaultDate: moment().toDate(),
            showTodayButton: true,
            showClose: true
        });

        Vue.use(VeeValidate, { locale: '{!! LaravelLocalization::getCurrentLocale() !!}' });

        Vue.component('vue-datetimepicker', {
            template: "<input type='text' v-bind:id='id' v-bind:name='name' class='form-control' v-bind:value='value' v-model='value' v-bind:format='format' v-bind:readonly='readonly'>",
            props: ['id', 'name', 'value', 'format', 'readonly'],
            mounted: function() {
                var vm = this;

                if (this.value == undefined || this.value == NaN) this.value = '';
                if (this.format == undefined || this.format == NaN) this.format = 'DD-MM-YYYY hh:mm A';
                if (this.readonly == undefined || this.readonly == NaN) this.readonly = 'false';

                $(this.$el).datetimepicker({
                    format: this.format,
                    defaultDate: this.value == '' ? moment():moment(this.value),
                    showTodayButton: true,
                    showClose: true
                }).on("dp.change", function(e) {
                    vm.$emit('input', this.value);
                });

                if (this.value == '') { vm.$emit('input', moment().format(this.format)); }
            },
            destroyed: function() {
                $(this.$el).data("DateTimePicker").destroy();
            }
        });

        var app = new Vue({
            el: '#truckVue',
            data: {
                truck: {
                    name:'',
                    sections: [{
                        'plate_number': '',
                        'inspection_date': '',
                        'driver': '',
                    }],
                    status: ''
                }
            },
            methods: {
                validateBeforeSubmit: function() {
                    this.$validator.validateAll().then(function(isValid) {
                        axios.post('{{ route('api.post.db.master.truck.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#truckForm')[0]))
                            .then(function(response) {
                                if (response.data.result == 'success') { window.location.href = '{{ route('db.master.truck') }}'; }
                            });
                    })
                },
                addNew: function () {
                    this.truck.sections.push({
                        'plate_number': '',
                        'inspection_date': '',
                        'driver': '',
                    });
                },
            },
            computed: {
                defaultStatus: function() {
                    return '';
                }
            }
        });
    </script>
@endsection
