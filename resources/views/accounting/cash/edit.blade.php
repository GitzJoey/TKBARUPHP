@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.cash.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.cash.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.cash.edit.page_title_desc')
@endsection

@section('breadcrumbs')

@endsection

@section('content')
    <div id="cashVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="cashForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('accounting.cash.edit.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('type') }">
                        <label for="inputType" class="col-sm-2 control-label">@lang('accounting.cash.field.type')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="type"
                                    v-model="cash.type"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('accounting.cash.field.type') }}">
                                <option v-bind:value="defaultType">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in typeDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('type')" class="help-block" v-cloak>@{{ errors.first('type') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('code') }">
                        <label for="inputCode" class="col-sm-2 control-label">@lang('accounting.cash.field.code')</label>
                        <div class="col-sm-10">
                            <input id="inputCode" name="code" type="text" class="form-control" placeholder="@lang('accounting.cash.field.code')"
                                v-model="cash.code" v-validate="'required'" data-vv-as="{{ trans('accounting.cash.field.code') }}">
                            <span v-show="errors.has('code')" class="help-block" v-cloak>@{{ errors.first('code') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('accounting.cash.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('accounting.cash.field.name')"
                                v-model="cash.name" v-validate="'required'" data-vv-as="{{ trans('accounting.cash.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputIsDefault" class="col-sm-2 control-label">@lang('accounting.cash.field.is_default')</label>
                        <div class="col-sm-10">
                            <div class="checkbox icheck">
                                <label>
                                    @if ($acccash->is_default)
                                        <input type="checkbox" name="is_default" class="is_icheck" checked>&nbsp;
                                    @else
                                        <input type="checkbox" name="is_default" class="is_icheck">&nbsp;
                                    @endif
                                </label>
                            </div>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('status') }">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('accounting.cash.field.status')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="status"
                                    v-model="cash.status"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('accounting.cash.field.status') }}">
                                <option v-bind:value="defaultStatus">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('status')" class="help-block" v-cloak>@{{ errors.first('status') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.acc.cash') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
            el: '#cashVue',
            data: {
                cash: {
                    type:'{{ $acccash->type }}',
                    name:'{{ $acccash->name }}',
                    code:'{{ $acccash->code }}',
                    status:'{{ $acccash->status }}'
                },
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}'),
                typeDDL: JSON.parse('{!! htmlspecialchars_decode($typeDDL) !!}'),
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.acc.cash.edit', $acccash->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#cashForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.acc.cash') }}';
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
                defaultType: function() {
                    return '';
                }
            }
        });
    </script>
@endsection
