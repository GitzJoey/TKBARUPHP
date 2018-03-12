@extends('layouts.adminlte.master')

@section('title')
    @lang('user.create.title')
@endsection

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;@lang('user.create.page_title')
@endsection

@section('page_title_desc')
    @lang('user.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin_user_create') !!}
@endsection

@section('content')
    <div id="userVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="userForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('user.create.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('user.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('user.field.name')"
                                v-model="user.name" v-validate="'required'" data-vv-as="{{ trans('user.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('email') }">
                        <label for="inputEmail" class="col-sm-2 control-label">@lang('user.field.email')</label>
                        <div class="col-sm-10">
                            <input id="inputEmail" name="email" type="text" class="form-control" placeholder="@lang('user.field.email')"
                                v-model="user.email" v-validate="'required|email'" data-vv-as="{{ trans('user.field.email') }}">
                            <span v-show="errors.has('email')" class="help-block" v-cloak>@{{ errors.first('email') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('store') }">
                        <label for="inputStore" class="col-sm-2 control-label">@lang('user.field.store')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="store"
                                    v-model="user.store"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('user.field.store') }}">
                                <option v-bind:value="defaultStore">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in storeDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('store')" class="help-block" v-cloak>@{{ errors.first('store') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('roles') }">
                        <label for="inputRoles" class="col-sm-2 control-label">@lang('user.field.roles')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="roles"
                                    v-model="user.roles"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('user.field.roles') }}">
                                <option v-bind:value="defaultRoles">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in rolesDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('roles')" class="help-block" v-cloak>@{{ errors.first('roles') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('password') }">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('user.field.password')</label>
                        <div class="col-sm-10">
                            <input id="inputEmail" name="password" type="password" class="form-control" placeholder="@lang('user.field.password')"
                                v-model="user.password" v-validate="'required'" data-vv-as="{{ trans('user.field.password') }}">
                            <span v-show="errors.has('password')" class="help-block" v-cloak>@{{ errors.first('password') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('password_confirmation') }">
                        <label for="inputPasswordConfirmation" class="col-sm-2 control-label">@lang('user.field.retype_password')</label>
                        <div class="col-sm-10">
                            <input id="inputEmail" name="password_confirmation" type="password" class="form-control" placeholder="@lang('user.field.retype_password')"
                                v-model="user.password_confirmation" v-validate="'required|confirmed:password'" data-vv-as="{{ trans('user.field.password_confirmation') }}">
                            <span v-show="errors.has('password_confirmation')" class="help-block" v-cloak>@{{ errors.first('password_confirmation') }}</span>
                        </div>
                    </div>
                    <hr>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('user_type') }">
                        <label for="inputUserType" class="col-sm-2 control-label">@lang('user.field.user_type')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="user_type"
                                    v-model="user.user_type"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('user.field.user_type') }}">
                                <option v-bind:value="defaultUserType">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in userTypeDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('user_type')" class="help-block" v-cloak>@{{ errors.first('user_type') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('allow_login') ? 'has-error' : '' }}">
                        <label for="inputAllowLogin" class="col-sm-2 control-label">@lang('user.field.allow_login')</label>
                        <div class="col-sm-10">
                            <vue-iCheck name="allow_login" v-model="user.allow_login"></vue-iCheck>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLinkProfiles" class="col-sm-2 control-label">@lang('user.field.link_profile')</label>
                        <div class="col-sm-10">
                            <select id="profileDDL" name="link_profile" class="form-control">
                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                {{--
                                @foreach($profiles as $p)
                                    @if ($p->owner_type == 'App\Model\Supplier')
                                        <option value="{{ $p->id }}">[Supplier] Name: {{ $p->owner->name }}, PIC: {{ $p->first_name }} {{ $p->last_name }}</option>
                                    @else
                                        <option value="{{ $p->id }}">[Customer] Name: {{ $p->owner->name }}, PIC: {{ $p->first_name }} {{ $p->last_name }}</option>
                                    @endif
                                @endforeach
                                --}}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.user') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
            el: '#userVue',
            data: {
                user: {
                    name: '',
                    email: '',
                    store: '',
                    roles: '',
                    password: '',
                    password_confirmation: '',
                    user_type: '',
                    allow_login: ''
                },
                storeDDL: JSON.parse('{!! htmlspecialchars_decode($storeDDL) !!}'),
                rolesDDL: JSON.parse('{!! htmlspecialchars_decode($rolesDDL) !!}'),
                userTypeDDL: JSON.parse('{!! htmlspecialchars_decode($usertypeDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.admin.user.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#userForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.admin.user') }}';
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
                defaultStore: function() {
                    return '';
                },
                defaultRoles: function() {
                    return '';
                },
                defaultUserType: function() {
                    return '';
                }
            }
        });
    </script>
@endsection
