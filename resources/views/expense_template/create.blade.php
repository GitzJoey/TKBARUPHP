@extends('layouts.adminlte.master')

@section('title')
    @lang('expense_template.create.title')
@endsection

@section('page_title')
    <span class="fa fa-ticket fa-fw"></span>&nbsp;@lang('expense_template.create.page_title')
@endsection

@section('page_title_desc')
    @lang('expense_template.create.page_title_desc')
@endsection

@section('content')
    <div id="expTemplateVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="expTemplateForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('expense_template.create.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('expense_template.field.name')</label>
                        <div class="col-sm-8">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('expense_template.field.name')"
                                v-model="expense_template.name" v-validate="'required'" data-vv-as="{{ trans('expense_template.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('type') }">
                        <label for="inputType" class="col-sm-2 control-label">@lang('expense_template.field.type')</label>
                        <div class="col-sm-8">
                            <select class="form-control"
                                    name="type"
                                    v-model="expense_template.type"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('expense_template.field.type') }}">
                                <option v-bind:value="defaultType">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in expenseTypes" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('type')" class="help-block" v-cloak>@{{ errors.first('type') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('amount') }">
                        <label for="inputAmount" class="col-sm-2 control-label">@lang('expense_template.field.amount')</label>
                        <div class="col-sm-8">
                            <input id="inputAmount" name="amount" type="text" class="form-control" placeholder="@lang('expense_template.field.amount')"
                                v-model="expense_template.amount" v-validate="'required|numeric:2'" data-vv-as="{{ trans('expense_template.field.amount') }}">
                            <span v-show="errors.has('amount')" class="help-block" v-cloak>@{{ errors.first('amount') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('remarks') }">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('expense_template.field.remarks')</label>
                        <div class="col-sm-8">
                            <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="@lang('expense_template.field.remarks')"
                                v-model="expense_template.remarks" v-validate="'required'" data-vv-as="{{ trans('expense_template.field.remarks') }}">
                            <span v-show="errors.has('remarks')" class="help-block" v-cloak>@{{ errors.first('remarks') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputInternalExpense" class="col-sm-2 control-label">@lang('expense_template.field.internal_expense')</label>
                        <div class="col-sm-8">
                            <vue-iCheck name="expense_template.is_internal_expense" v-model="expense_template.is_internal_expense"></vue-iCheck>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <a href="{{ route('db.master.expense_template') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
    <script type="application/javascript">
        var app = new Vue({
            el: '#expTemplateVue',
            data: {
                expense_template: {
                    name:'',
                    type:'',
                    amount:'',
                    remarks:'',
                    is_internal_expense: false
                },
                expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.master.expense_template.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#expTemplateForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.master.expense_template') }}';
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
                defaultType : function() {
                    return '';
                }
            }
        });
    </script>
@endsection
