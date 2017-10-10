@extends('layouts.adminlte.master')

@section('title')
    @lang('vendor_trucking.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-ge fa-fw"></span>&nbsp;@lang('vendor_trucking.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('vendor_trucking.edit.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_vendor_trucking_edit', $vt->hId()) !!}
@endsection

@section('content')
    <div id="vTruckingVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="vTruckingForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('vendor_trucking.edit.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('vendor_trucking.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('vendor_trucking.field.name')"
                                v-model="vendor_trucking.name" v-validate="'required'" data-vv-as="{{ trans('vendor_trucking.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('address') }">
                        <label for="inputAddress" class="col-sm-2 control-label">@lang('vendor_trucking.field.address')</label>
                        <div class="col-sm-10">
                            <textarea id="inputAddress" name="address" class="form-control" placeholder="@lang('vendor_trucking.field.address')"
                                v-model="vendor_trucking.address" v-validate="'required'" data-vv-as="{{ trans('vendor_trucking.field.address') }}" rows="5"></textarea>
                            <span v-show="errors.has('address')" class="help-block" v-cloak>@{{ errors.first('address') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('phone_num') ? 'has-error' : '' }}">
                        <label for="inputPhone" class="col-sm-2 control-label">@lang('vendor_trucking.field.phone')</label>
                        <div class="col-sm-10">
                            <input id="inputPhone" name="phone_num" type="text" class="form-control" value="{{ $vt->phone_num }}" placeholder="Phone">
                            <span class="help-block">{{ $errors->has('phone_num') ? $errors->first('phone_num') : '' }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('tax_id') }">
                        <label for="inputTax" class="col-sm-2 control-label">@lang('vendor_trucking.field.tax_id')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="tax_id" type="text" class="form-control" placeholder="@lang('vendor_trucking.field.tax_id')"
                                v-model="vendor_trucking.tax_id" v-validate="'required'" data-vv-as="{{ trans('vendor_trucking.field.tax_id') }}" placeholder="Tax ID">
                            <span v-show="errors.has('tax_id')" class="help-block" v-cloak>@{{ errors.first('tax_id') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('status') }">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('vendor_trucking.field.status')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="status"
                                    v-model="vendor_trucking.status"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('vendor_trucking.field.status') }}">
                                <option v-bind:value="defaultStatus">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('status')" class="help-block" v-cloak>@{{ errors.first('status') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('vendor_trucking.field.remarks')</label>
                        <div class="col-sm-10">
                            <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $vt->remarks }}" placeholder="Remarks">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.vendor.trucking') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
            el: '#vTruckingVue',
            data: {
                vendor_trucking: {
                    name:'{{ $vt->name }}',
                    address:'{{ $vt->address }}',
                    tax_id:'{{ $vt->tax_id }}',
                    status:'{{ $vt->status }}'
                },
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.master.vendor.trucking.edit', $vt->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#vTruckingForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.master.vendor.trucking') }}';
                        }).catch(function(e) {
                            $('#loader-container').fadeOut('fast');
                            if (Object.keys(e.response.data.errors).length > 0) {
                                for (var key in e.response.data.errors) {
                                    for (var i = 0; i < e.response.data.errors[key].length; i++) {
                                        vm.$validator.errors.add('', e.response.data.errors[key][i], 'server', '__global__');
                                    }
                                }
                            } else {
                                vm.$validator.errors.add('', e.response.status + ' ' + e.response.statusText, 'server', '__global__');
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
