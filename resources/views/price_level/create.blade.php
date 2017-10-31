@extends('layouts.adminlte.master')

@section('title')
    @lang('price_level.create.title')
@endsection

@section('page_title')
    <span class="fa fa-table fa-fw"></span>&nbsp;@lang('price_level.create.page_title')
@endsection

@section('page_title_desc')
    @lang('price_level.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('price_level_create') !!}
@endsection

@section('content')
    <div id="priceLevelVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="priceLevelForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('price_level.create.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('type') }">
                        <label for="inputType" class="col-sm-2 control-label">@lang('price_level.field.type')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="type"
                                    id="priceLevelSelect"
                                    v-model="price_level.type"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('price_level.field.type') }}">
                                <option v-bind:value="defaultType">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in plTypeDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('type')" class="help-block" v-cloak>@{{ errors.first('type') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('weight') }">
                        <label for="inputWeight" class="col-sm-2 control-label">@lang('price_level.field.weight')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="weight"
                                    v-model="price_level.weight"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('price_level.field.weight') }}">
                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                @for($x =1; $x <= 10; $x++)
                                    @if($x == 1)
                                        <option v-bind:value="{{ $x }}">{{ $x }} - Lowest</option>
                                    @elseif($x == 10)
                                        <option v-bind:value="{{ $x }}">{{ $x }} - Highest</option>
                                    @else
                                        <option v-bind:value="{{ $x }}">{{ $x }}</option>
                                    @endif
                                @endfor
                            </select>
                            <span v-show="errors.has('weight')" class="help-block" v-cloak>@{{ errors.first('weight') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('price_level.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('price_level.field.name')"
                                v-model="price_level.name" v-validate="'required'" data-vv-as="{{ trans('price_level.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription" class="col-sm-2 control-label">@lang('price_level.field.description')</label>
                        <div class="col-sm-10">
                            <input id="inputDescription" name="description" type="text" class="form-control" value="{{ old('description') }}" placeholder="Description">
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('increment_value') }">
                        <label for="inputIncVal" class="col-sm-2 control-label">@lang('price_level.field.incval')</label>
                        <div class="col-sm-10">
                            <input id="inputIncVal" name="increment_value" type="text" class="form-control" placeholder="Increment Value" v-model="price_level.inc_val"
                                   v-bind:readonly="setIncReadOnly(price_level.type)" v-validate="setIncReadOnly(price_level.type) ? '':'required:numeric:2'" data-vv-as="{{ trans('price_level.field.incval') }}">
                            <span v-show="errors.has('increment_value')" class="help-block" v-cloak>@{{ errors.first('increment_value') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('percentage_value') }">
                        <label for="inputPctVal" class="col-sm-2 control-label">@lang('price_level.field.pctval')</label>
                        <div class="col-sm-10">
                            <input id="inputPctVal" name="percentage_value" type="text" class="form-control" placeholder="Percentage Value" v-model="price_level.pct_val"
                                   v-bind:readonly="setPctReadOnly(price_level.type)" v-validate="setPctReadOnly(price_level.type) ? '':'required:numeric:2'" data-vv-as="{{ trans('price_level.field.pctval') }}">
                            <span v-show="errors.has('percentage_value')" class="help-block" v-cloak>@{{ errors.first('percentage_value') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('status') }">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('price_level.field.status')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="status"
                                    v-model="price_level.status"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('price_level.field.status') }}">
                                <option v-bind:value="defaultStatus">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('status')" class="help-block" v-cloak>@{{ errors.first('status') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.price.price_level') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
            el: '#priceLevelVue',
            data: {
                price_level: {
                    type:'',
                    weight:'',
                    name:'',
                    status:'',
                    inc_val: 0,
                    pct_val: 0
                },
                plTypeDDL: JSON.parse('{!! htmlspecialchars_decode($plTypeDDL) !!}'),
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}')
            },
            methods: {
                onPriceLevelSelect: function(type) {
                    if (this.price_level.type == '') return;

                    if (this.price_level.type == 'PRICELEVELTYPE.INC') {
                        this.price_level.pct_val = 0;
                    } else {
                        this.price_level.inc_val = 0;
                    }
                },
                setIncReadOnly: function(type) {
                    if (type == '') return false;

                    if (type == 'PRICELEVELTYPE.INC') {
                        return false;
                    } else {
                        return true;
                    }
                },
                setPctReadOnly: function(type) {
                    if (type == '') return false;

                    if (type == 'PRICELEVELTYPE.PCT') {
                        return false;
                    } else {
                        return true;
                    }
                },
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.price.level.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#priceLevelForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.price.price_level') }}';
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
                defaultType: function() {
                    return '';
                },
                defaultWeight: function() {
                    return '';
                },
                defaultStatus: function() {
                    return '';
                }
            }
        });
    </script>
@endsection
