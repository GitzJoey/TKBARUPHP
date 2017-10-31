@extends('layouts.adminlte.master')

@section('title')
    @lang('product_type.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-cube fa-fw"></span>&nbsp;@lang('product_type.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('product_type.edit.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_product_type_edit', $prodtype->hId()) !!}
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

        <form id="prodTypeForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('product_type.edit.header.title')</h3>
                </div>
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
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = new Vue({
            el: '#prodTypeVue',
            data: {
                product_type: {
                    name:'{{ $prodtype->name }}',
                    short_code:'{{ $prodtype->short_code }}',
                    description:'{{ $prodtype->description }}',
                    status: '{{ $prodtype->status }}',
                },
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.master.producttype.edit', $prodtype->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#prodTypeForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.master.producttype') }}';
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
                defaultStatus: function() {
                    return '';
                }
            }
        });
    </script>
@endsection
