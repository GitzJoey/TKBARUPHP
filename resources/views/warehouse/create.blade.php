@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.create.title')
@endsection

@section('page_title')
    <span class="fa fa-wrench fa-fw"></span>&nbsp;@lang('warehouse.create.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_warehouse_create') !!}
@endsection

@section('content')
    <div id="warehouseVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="warehouseForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('warehouse.create.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('warehouse.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('warehouse.field.name')"
                                v-model="warehouse.name" v-validate="'required'" data-vv-as="{{ trans('warehouse.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress" class="col-sm-2 control-label">@lang('warehouse.field.address')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputAddress" name="address" placeholder="@lang('warehouse.field.address')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPhoneNum" class="col-sm-2 control-label">@lang('warehouse.field.phone_num')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPhoneNum" name="phone_num" placeholder="@lang('warehouse.field.phone_num')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSection" class="col-sm-2 control-label">@lang('warehouse.field.section')</label>
                        <div class="col-sm-10">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>@lang('warehouse.create.table.header.name')</th>
                                        <th>@lang('warehouse.create.table.header.position')</th>
                                        <th>@lang('warehouse.create.table.header.capacity')</th>
                                        <th>@lang('warehouse.create.table.header.capacity_unit')</th>
                                        <th>@lang('warehouse.create.table.header.remarks')</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(c, cI) in warehouse.sections">
                                        <td v-bind:class="{ 'has-error':errors.has('secname_' + cI) }">
                                            <input type="text" class="form-control" v-model="c.name" name="section_name[]"
                                                   v-validate="'required'" v-bind:data-vv-as="'{{ trans('warehouse.create.table.header.name') }} ' + (cI + 1)" v-bind:data-vv-name="'secname_' + cI"/>
                                        </td>
                                        <td v-bind:class="{ 'has-error':errors.has('secpos_' + cI) }">
                                            <input type="text" class="form-control" v-model="c.position" name="section_position[]"
                                                   v-validate="'required'" v-bind:data-vv-as="'{{ trans('warehouse.create.table.header.position') }} ' + (cI + 1)" v-bind:data-vv-name="'secpos_' + cI"/>
                                        </td>
                                        <td v-bind:class="{ 'has-error':errors.has('seccap_' + cI) }">
                                            <input type="text" class="form-control text-right" name="section_capacity[]"
                                                   v-validate="'required|numeric'" v-bind:data-vv-as="'{{ trans('warehouse.create.table.header.capacity') }} ' + (cI + 1)" v-bind:data-vv-name="'seccap_' + cI"/>
                                        </td>
                                        <td v-bind:class="{ 'has-error':errors.has('seccapunit_' + cI) }">
                                            <select class="form-control"
                                                    name="section_capacity_unit[]"
                                                    v-model="c.capacity_unit_id"
                                                    v-validate="'required'"
                                                    v-bind:data-vv-as="'{{ trans('warehouse.create.table.header.capacity_unit') }} ' + (cI + 1)"
                                                    v-bind:data-vv-name="'seccapunit_' + cI">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="(value, key) in unitDDL" v-bind:value="key">@{{ value }}</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control" v-model="c.remarks" name="section_remarks[]"/></td>
                                        <td class="text-center valign-middle">
                                            <button type="button" class="btn btn-xs btn-danger" v-bind:data="cI" v-on:click="removeSelected(cI)">
                                                <span class="fa fa-close fa-fw"></span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <button type="button" class="btn btn-xs btn-default" v-on:click="addNew()">@lang('buttons.create_new_button')</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('status') }">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('warehouse.field.status')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="status"
                                    v-model="warehouse.status"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('warehouse.field.status') }}">
                                <option v-bind:value="defaultStatus">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('status')" class="help-block" v-cloak>@{{ errors.first('status') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('warehouse.field.remarks')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputRemarks" name="remarks" placeholder="@lang('warehouse.field.remarks')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.warehouse') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
            el: '#warehouseVue',
            data: {
                warehouse: {
                    name:'',
                    sections: [{
                        'name': '',
                        'position': '',
                        'capacity': 0,
                        'capacity_unit_id': '',
                        'remarks': ''
                    }],
                    status: ''
                },
                unitDDL: JSON.parse('{!! htmlspecialchars_decode($unitDDL) !!}'),
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.master.warehouse.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#warehouseForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.master.warehouse') }}';
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
                addNew: function () {
                    this.warehouse.sections.push({
                        'name': '',
                        'position': '',
                        'capacity': 0,
                        'capacity_unit_id': '',
                        'remarks': ''
                    });
                },
                removeSelected: function (idx) {
                    this.warehouse.sections.splice(idx, 1);
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