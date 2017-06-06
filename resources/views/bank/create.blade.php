@extends('layouts.adminlte.master')

@section('title')
    @lang('bank.create.title')
@endsection

@section('page_title')
    <span class="fa fa-bank fa-fw"></span>&nbsp;@lang('bank.create.page_title')
@endsection

@section('page_title_desc')
    @lang('bank.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_bank_create') !!}
@endsection

@section('content')
    <div id="bankVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="bankForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('bank.create.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('bank.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('bank.field.name')"
                                v-model="bank.name" v-validate="'required'" data-vv-as="{{ trans('bank.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('short_name') }">
                        <label for="inputShortName" class="col-sm-2 control-label">@lang('bank.field.short_name')</label>
                        <div class="col-sm-10">
                            <input id="inputShortName" name="short_name" type="text" class="form-control" placeholder="@lang('bank.field.short_name')"
                                v-model="bank.short_name" v-validate="'required'" data-vv-as="{{ trans('bank.field.short_name') }}">
                            <span v-show="errors.has('short_name')" class="help-block" v-cloak>@{{ errors.first('short_name') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('branch') }">
                        <label for="inputBranch" class="col-sm-2 control-label">@lang('bank.field.branch')</label>
                        <div class="col-sm-10">
                            <input id="inputBranch" name="branch" type="text" class="form-control" placeholder="@lang('bank.field.branch')"
                                v-model="bank.branch" v-validate="'required'" data-vv-as="{{ trans('bank.field.branch') }}">
                            <span v-show="errors.has('branch')" class="help-block" v-cloak>@{{ errors.first('branch') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('branch_code') }">
                        <label for="inputBranchCode" class="col-sm-2 control-label">@lang('bank.field.branch_code')</label>
                        <div class="col-sm-10">
                            <input id="inputBranchCode" name="branch_code" type="text" class="form-control" placeholder="@lang('bank.field.branch_code')"
                                v-model="bank.branch_code" v-validate="'required'" data-vv-as="{{ trans('bank.field.branch_code') }}">
                            <span v-show="errors.has('branch_code')" class="help-block" v-cloak>@{{ errors.first('branch_code') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('status') }">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('bank.field.status')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="status"
                                    v-model="bank.status"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('bank.field.status') }}">
                                <option v-bind:value="defaultStatus">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('status')" class="help-block" v-cloak>@{{ errors.first('status') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('remarks') }">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('bank.field.remarks')</label>
                        <div class="col-sm-10">
                            <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="@lang('bank.field.remarks')"
                                v-model="bank.remarks" v-validate="'required'" data-vv-as="{{ trans('bank.field.remarks') }}">
                            <span v-show="errors.has('remarks')" class="help-block" v-cloak>@{{ errors.first('remarks') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.bank') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
        Vue.use(VeeValidate, { locale: '{!! LaravelLocalization::getCurrentLocale() !!}' });

        var app = new Vue({
            el: '#bankVue',
            data: {
                bank: {
                    name:'',
                    short_name:'',
                    branch:'',
                    branch_code:'',
                    status:'',
                    remarks:''
                },
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(result) {
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.master.bank.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#bankForm')[0]))
                            .then(function(response) {
                                window.location.href = '{{ route('db.master.bank') }}';
                            }).catch(function(e) {
                                $('#loader-container').fadeOut('fast');
                                if (e.response.data.address.length > 0) {
                                    for (var i=0; i < e.response.data.address.length; i++) {
                                        vm.$validator.errorBag.add('', e.response.data.address[i], 'server', '__global__');
                                    }
                                } else {
                                    vm.$validator.errorBag.add('', e.response.status + ' ' + e.response.statusText, 'server', '__global__');
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
