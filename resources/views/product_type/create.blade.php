@extends('layouts.adminlte.master')

@section('title')
    @lang('product_type.create.title')
@endsection

@section('page_title')
    <span class="fa fa-cube fa-fw"></span>&nbsp;@lang('product_type.create.page_title')
@endsection

@section('page_title_desc')
    @lang('product_type.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_product_type_create') !!}
@endsection

@section('content')
    <div id="prodTypeVue">
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
                <h3 class="box-title">@lang('product_type.create.header.title')</h3>
            </div>
            <form id="prodTypeForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
                {{ csrf_field() }}
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('product_type.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('product_type.field.name')"
                                v-model="product_type.name" v-validate="'required'" data-vv-as="{{ trans('product_type.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('short_code') }">
                        <label for="inputShortCode" class="col-sm-2 control-label">@lang('product_type.field.short_code')</label>
                        <div class="col-sm-10">
                            <input id="inputShortCode" name="short_code" type="text" class="form-control" placeholder="@lang('product_type.field.short_code')"
                                v-model="product_type.short_code" v-validate="'required'" data-vv-as="{{ trans('product_type.field.short_code') }}">
                            <span v-show="errors.has('short_code')" class="help-block" v-cloak>@{{ errors.first('short_code') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('description') }">
                        <label for="inputDescription" class="col-sm-2 control-label">@lang('product_type.field.description')</label>
                        <div class="col-sm-10">
                            <input id="inputDescription" name="description" type="text" class="form-control" placeholder="@lang('product_type.field.description')"
                                v-model="product_type.description" v-validate="'required'" data-vv-as="{{ trans('product_type.field.description') }}">
                            <span v-show="errors.has('description')" class="help-block" v-cloak>@{{ errors.first('description') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('status') }">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('product_type.field.status')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="status"
                                    v-model="product_type.status"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('product_type.field.status') }}">
                                <option v-bind:value="defaultStatus">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('status')" class="help-block" v-cloak>@{{ errors.first('status') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.producttype') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                            <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
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
        Vue.use(VeeValidate, { locale: '{!! LaravelLocalization::getCurrentLocale() !!}' });

        var app = new Vue({
            el: '#prodTypeVue',
            data: {
                product_type: {
                    name:'',
                    short_code:'',
                    description:'',
                    status: '',
                },
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(result) {
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.master.producttype.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#prodTypeForm')[0]))
                            .then(function(response) {
                                window.location.href = '{{ route('db.master.producttype') }}';
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
                defaultStatus: function() {
                    return '';
                }
            }
        });
    </script>
@endsection
