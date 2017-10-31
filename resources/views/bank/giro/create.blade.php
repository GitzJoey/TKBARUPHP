@extends('layouts.adminlte.master')

@section('title')
    @lang('giro.create.title')
@endsection

@section('page_title')
    <span class="fa fa-book fa-fw"></span>&nbsp;@lang('giro.create.page_title')
@endsection

@section('page_title_desc')
    @lang('giro.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('bank_giro_create') !!}
@endsection

@section('content')
    <div id="giroVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="giroForm" class="form-horizontal" method="post" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('giro.create.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('bank') }">
                        <label for="inputBank" class="col-sm-2 control-label">@lang('giro.field.bank')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="bank"
                                    v-model="giro.bank"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('giro.field.bank') }}">
                                <option v-bind:value="defaultBank">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in bankDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('bank')" class="help-block" v-cloak>@{{ errors.first('bank') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('serial_number') }">
                        <label for="inputSerialNumber" class="col-sm-2 control-label">@lang('giro.field.serial_number')</label>
                        <div class="col-sm-10">
                            <input id="inputSerialNumber" name="serial_number" type="text" class="form-control" placeholder="@lang('giro.field.serial_number')"
                                v-model="giro.serial_number" v-validate="'required'" data-vv-as="{{ trans('giro.field.serial_number') }}">
                            <span v-show="errors.has('serial_number')" class="help-block" v-cloak>@{{ errors.first('serial_number') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('effective_date') }">
                        <label for="inputEffectiveDate" class="col-sm-2 control-label">@lang('giro.field.effective_date')</label>
                        <div class="col-sm-9">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <vue-datetimepicker name="effective_date" value="" v-model="giro.effective_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A"></vue-datetimepicker>
                                <span v-show="errors.has('effective_date')" class="help-block" v-cloak>@{{ errors.first('effective_date') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                        <label for="inputAmount" class="col-sm-2 control-label">@lang('giro.field.amount')</label>
                        <div class="col-sm-10">
                            <input id="inputAmount"
                                   name="amount"
                                   type="text"
                                   class="form-control"
                                   placeholder="@lang('giro.field.amount')"
                                   v-validate="'required:numeric:2'">
                            <span class="help-block">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('printed_name') }">
                        <label for="inputPrintedName" class="col-sm-2 control-label">@lang('giro.field.printed_name')</label>
                        <div class="col-sm-10">
                            <input id="inputPrintedName" name="printed_name" type="text" class="form-control" placeholder="@lang('giro.field.printed_name')"
                                v-model="giro.printed_name" v-validate="'required'" data-vv-as="{{ trans('giro.field.printed_name') }}">
                            <span v-show="errors.has('printed_name')" class="help-block" v-cloak>@{{ errors.first('printed_name') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('giro.field.status')</label>
                        <div class="col-sm-10">
                            <input id="inputStatus" name="status" type="text" class="form-control" value="@lang('lookup.GIROSTATUS.N')" readonly>
                            <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('giro.field.remarks')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="@lang('giro.field.remarks')">
                            <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.bank.giro') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
            el: '#giroVue',
            data: {
                giro: {
                    serial_number:'',
                    printed_name:'',
                    bank:'',
                    effective_date:''
                },
                bankDDL: JSON.parse('{!! htmlspecialchars_decode($bankDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.bank.giro.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#giroForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.bank.giro') }}';
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
                defaultBank: function() {
                    return '';
                }
            }
        });
    </script>
@endsection
