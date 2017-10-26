@extends('layouts.adminlte.master')

@section('title')
    @lang('employee.create.title')
@endsection

@section('page_title')
    <span class="fa fa-odnoklassniki fa-fw"></span>&nbsp;@lang('employee.create.page_title')
@endsection

@section('page_title_desc')
    @lang('employee.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('employee.employee_create') !!}
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ mix('adminlte/fileinput/fileinput.css') }}">
@endsection

@section('content')
    <div id="employeeVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="employeeForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('employee.create.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('employee.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('employee.field.name')"
                                v-model="employee.name" v-validate="'required'" data-vv-as="{{ trans('employee.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label for="inputAddress" class="col-sm-2 control-label">@lang('employee.field.address')</label>
                        <div class="col-sm-10">
                            <input id="inputAddress" name="address" type="text" class="form-control"
                                   placeholder="@lang('employee.field.address')">
                            <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('ic_number') }">
                        <label for="inputIcNumber" class="col-sm-2 control-label">@lang('employee.field.ic_number')</label>
                        <div class="col-sm-10">
                            <input id="inputIcNumber" name="ic_number" type="text" class="form-control" placeholder="@lang('employee.field.ic_number')"
                                v-model="employee.ic_number" v-validate="'required'" data-vv-as="{{ trans('employee.field.ic_number') }}">
                            <span v-show="errors.has('ic_number')" class="help-block" v-cloak>@{{ errors.first('ic_number') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('start_date') }">
                        <label for="inputStartDate" class="col-sm-2 control-label">@lang('employee.field.start_date')</label>
                        <div class="col-sm-5">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <vue-datetimepicker name="start_date" value="" v-model="employee.start_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                <span v-show="errors.has('start_date')" class="help-block" v-cloak>@{{ errors.first('start_date') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('freelance') ? 'has-error' : '' }}">
                        <label for="inputFreelance" class="col-sm-2 control-label">@lang('employee.field.freelance')</label>
                        <div class="col-sm-5">
                            <vue-iCheck name="freelance" v-model="employee.freelance"></vue-iCheck>
                            <span class="help-block">{{ $errors->has('freelance') ? $errors->first('freelance') : '' }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('base_salary') }">
                        <label for="inputBaseSalary" class="col-sm-2 control-label">@lang('employee.field.base_salary')</label>
                        <div class="col-sm-5">
                            <input id="inputBaseSalary" name="base_salary" type="text" class="form-control" placeholder="@lang('employee.field.base_salary')"
                                v-model="employee.base_salary" v-validate="'numeric:2'" data-vv-as="{{ trans('employee.field.base_salary') }}">
                            <span v-show="errors.has('base_salary')" class="help-block" v-cloak>@{{ errors.first('base_salary') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('image_path') ? 'has-error' : '' }}">
                        <label for="inputImagePath" class="col-sm-2 control-label">@lang('employee.field.image_path')</label>
                        <div class="col-sm-10">
                            <input type="file" class="file form-control" id="inputImagePath" name="image_path"
                                   data-show-upload="false" data-allowed-file-extensions='["jpg","png"]'>
                            <span class="help-block">{{ $errors->has('image_path') ? $errors->first('image_path') : '' }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('status') }">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('employee.field.status')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="status"
                                    v-model="employee.status"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('employee.field.status') }}">
                                <option v-bind:value="defaultStatus">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('status')" class="help-block" v-cloak>@{{ errors.first('status') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.employee.employee') }}"
                               class="btn btn-default">@lang('buttons.cancel_button')</a>
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
<script type="application/javascript" src="{{ mix('adminlte/fileinput/fileinput.js') }}"></script>
<script type="application/javascript" src="{{ mix('adminlte/fileinput/id.js') }}"></script>

<script type="application/javascript">
        var app = new Vue({
            el: '#employeeVue',
            data: {
                employee: {
                    name:'',
                    ic_number:'',
                    start_date:'',
                    freelance: '',
                    base_salary:'',
                    status:''
                },
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.employee.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#employeeForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.employee.employee') }}';
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
            },
            computed: {
                defaultStatus : function() {
                    return '';
                }
            }
        });
    </script>
@endsection
