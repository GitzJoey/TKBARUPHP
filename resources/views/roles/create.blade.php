@extends('layouts.adminlte.master')

@section('title')
    @lang('role.create.title')
@endsection

@section('page_title')
    <span class="fa fa-key fa-fw"></span>&nbsp;@lang('role.create.page_title')
@endsection

@section('page_title_desc')
    @lang('role.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin_role_create') !!}
@endsection

@section('content')
    <div id="rolesVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="rolesForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('role.create.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('role.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('role.field.name')"
                                v-model="role.name" v-validate="'required'" data-vv-as="{{ trans('role.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('display_name') }">
                        <label for="inputDisplayName" class="col-sm-2 control-label">@lang('role.field.display_name')</label>
                        <div class="col-sm-10">
                            <input id="inputDisplayName" name="display_name" type="text" class="form-control" placeholder="@lang('role.field.display_name')"
                                v-model="role.display_name" v-validate="'required'" data-vv-as="{{ trans('role.field.display_name') }}">
                            <span v-show="errors.has('display_name')" class="help-block" v-cloak>@{{ errors.first('display_name') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('description') }">
                        <label for="inputDescription" class="col-sm-2 control-label">@lang('role.field.description')</label>
                        <div class="col-sm-10">
                            <input id="inputDescription" name="description" type="text" class="form-control" placeholder="@lang('role.field.description')"
                                v-model="role.description" v-validate="'required'" data-vv-as="{{ trans('role.field.description') }}">
                            <span v-show="errors.has('description')" class="help-block" v-cloak>@{{ errors.first('description') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPermission" class="col-sm-2 control-label">@lang('role.field.permission')</label>
                        <div class="col-sm-10">
                            <select multiple name="permission[]" class="form-control" size="25">
                                @foreach($permission as $key => $p)
                                    <option value="{{ $p->id }}">{{ $p->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.roles') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
            el: '#rolesVue',
            data: {
                role: {
                    name:'',
                    display_name:'',
                    description:''
                }
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(result) {
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.admin.roles.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#rolesForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.admin.roles') }}';
                        }).catch(function(e) {
                            $('#loader-container').fadeOut('fast');
                            if (Object.keys(e.response.data).length > 0) {
                                for (var key in e.response.data) {
                                    for (var i = 0; i < e.response.data[key].length; i++) {
                                        vm.$validator.errorBag.add('', e.response.data[key][i], 'server', '__global__');
                                    }
                                }
                            } else {
                                vm.$validator.errorBag.add('', e.response.status + ' ' + e.response.statusText, 'server', '__global__');
                            }
                        });
                    });
                },
            }
        });
    </script>
@endsection
