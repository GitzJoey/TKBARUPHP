@extends('layouts.adminlte.master')

@section('title')
    @lang('unit.edit.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-flash"></span>&nbsp;@lang('unit.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('unit.edit.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin_unit_edit', $unit->hId()) !!}
@endsection

@section('content')
    <div id="unitVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="unitForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('unit.edit.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('unit.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('unit.field.name')"
                                v-model="unit.name" v-validate="'required'" data-vv-as="{{ trans('unit.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('symbol') }">
                        <label for="inputSymbol" class="col-sm-2 control-label">@lang('unit.field.symbol')</label>
                        <div class="col-sm-10">
                            <input id="inputSymbol" name="symbol" type="text" class="form-control" placeholder="@lang('unit.field.symbol')"
                                v-model="unit.symbol" v-validate="'required'" data-vv-as="{{ trans('unit.field.symbol') }}">
                            <span v-show="errors.has('symbol')" class="help-block" v-cloak>@{{ errors.first('symbol') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('status') }">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('unit.field.status')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="status"
                                    v-model="unit.status"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('unit.field.status') }}">
                                <option v-bind:value="defaultStatus">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('status')" class="help-block" v-cloak>@{{ errors.first('status') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('unit.field.remarks')</label>
                        <div class="col-sm-10">
                            <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $unit->remarks }}" placeholder="Remarks">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.unit') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
            el: '#unitVue',
            data: {
                unit: {
                    name:'{{ $unit->name }}',
                    symbol:'{{ $unit->symbol }}',
                    status: '{{ $unit->status }}'
                },
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.admin.unit.edit', $unit->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#unitForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.admin.unit') }}';
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
