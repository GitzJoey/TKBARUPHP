@extends('layouts.adminlte.master')

@section('title')
    @lang('phone_provider.create.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-phone"></span>&nbsp;@lang('phone_provider.create.page_title')
@endsection

@section('page_title_desc')
    @lang('phone_provider.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin_phone_provider_create') !!}
@endsection

@section('content')
    <div id="phoneProviderVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="phoneProviderForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('phone_provider.create.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('phone_provider.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('phone_provider.field.name')"
                                v-model="phone_provider.name" v-validate="'required'" data-vv-as="{{ trans('phone_provider.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('short_name') }">
                        <label for="inputShortName" class="col-sm-2 control-label">@lang('phone_provider.field.short_name')</label>
                        <div class="col-sm-10">
                            <input id="inputShortName" name="short_name" type="text" class="form-control" placeholder="@lang('phone_provider.field.short_name')"
                                v-model="phone_provider.short_name" v-validate="'required'" data-vv-as="{{ trans('phone_provider.field.short_name') }}">
                            <span v-show="errors.has('short_name')" class="help-block" v-cloak>@{{ errors.first('short_name') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPrefix" class="col-sm-2 control-label">@lang('phone_provider.field.prefix')</label>
                        <div class="col-sm-5">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>@lang('phone_provider.create.table.header.prefix')</th>
                                        <th class="text-center">@lang('labels.ACTION')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(p, pIdx) in prefixes">
                                        <td v-bind:class="{ 'has-error':errors.has('prefixes' + pIdx) }">
                                            <input type="hidden" name="level[]" v-bind:value="pIdx">
                                            <input type="text" class="form-control"    v-model="p.prefix" name="prefixes[]"
                                                v-validate="'required'" v-bind:data-vv-as="'{{ trans('phone_provider.field.prefix') }} ' + (pIdx + 1)"
                                                v-bind:data-vv-name="'prefixes' + pIdx">
                                        </td>
                                        <td class="text-center valign-middle">
                                            <button type="button" class="btn btn-xs btn-danger" v-show="prefixes.length" v-on:click="remove()">@lang('buttons.remove_button')</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-xs btn-primary" v-on:click="addNew()">@lang('buttons.create_new_button')</button>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('status') }">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('phone_provider.field.status')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="status"
                                    v-model="phone_provider.status"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('phone_provider.field.status') }}">
                                <option v-bind:value="defaultStatus">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('status')" class="help-block" v-cloak>@{{ errors.first('status') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('phone_provider.field.remarks')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputRemarks" name="remarks" placeholder="@lang('phone_provider.field.remarks')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.phone_provider') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                            <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = new Vue({
            el: '#phoneProviderVue',
            data: {
                phone_provider: {
                    name:'',
                    short_name:'',
                    status:''
                },
                prefixes: [],
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}')
            },
            methods: {
                addNew: function () {
                    this.prefixes.push({
                        'phone_provider_id': '',
                        'prefix': ''
                    });
                },
                remove: function (idx) {
                    this.prefixes.splice(idx, 1);
                },
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.admin.phone_provider.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#phoneProviderForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.admin.phone_provider') }}';
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
                }
            }
        });
    </script>
@endsection
