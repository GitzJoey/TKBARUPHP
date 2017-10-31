@extends('layouts.adminlte.master')

@section('title')
    @lang('product.create.title')
@endsection

@section('page_title')
    <span class="fa fa-cubes fa-fw"></span>&nbsp;@lang('product.create.page_title')
@endsection

@section('page_title_desc')
    @lang('product.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_product_create') !!}
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ mix('adminlte/fileinput/fileinput.css') }}">
@endsection

@section('content')
    <div id="productVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="productForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('product.create.header.title')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('type') }">
                        <label for="inputType" class="col-sm-2 control-label">@lang('product.field.type')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="type"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('product.field.type') }}">
                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in prodTypeDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('type')" class="help-block" v-cloak>@{{ errors.first('type') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                        <label for="inputCategory" class="col-sm-2 control-label">@lang('product.field.category')</label>
                        <div class="col-sm-10">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20%">@lang('product.create.table.category.header.code')</th>
                                        <th width="30%">@lang('product.create.table.category.header.name')</th>
                                        <th width="40%">@lang('product.create.table.category.header.description')</th>
                                        <th width="10%" class="text-center">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(cat, catIdx) in product_categories">
                                        <td v-bind:class="{ 'has-error':errors.has('pcat_code_' + catIdx) }">
                                            <input type="hidden" name="cat_level[]" v-bind:value="catIdx">
                                            <input type="text" class="form-control" id="inputCode" name="cat_code[]"
                                                v-validate="'required'" v-bind:data-vv-as="'{{ trans('product.create.table.category.header.code') }} ' + (catIdx + 1)"
                                                v-bind:data-vv-name="'pcat_code_' + catIdx">
                                        </td>
                                        <td v-bind:class="{ 'has-error':errors.has('pcat_name_' + catIdx) }">
                                            <input type="text" class="form-control" id="inputName" name="cat_name[]"
                                                   v-validate="'required'" v-bind:data-vv-as="'{{ trans('product.create.table.category.header.name') }} ' + (catIdx + 1)"
                                                   v-bind:data-vv-name="'pcat_name_' + catIdx">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="inputDescription" name="cat_description[]">
                                        </td>
                                        <td class="valign-middle text-center">
                                            <button type="button" class="btn btn-xs btn-danger" v-on:click="removeCategory(catIdx)"><span class="fa fa-close"></span></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button type="button" class="btn btn-xs btn-primary" v-on:click="addCategory()">@lang('buttons.create_new_button')</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('name') }">
                        <label for="inputName" class="col-sm-2 control-label">@lang('product.field.name')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" name="name" value="{{ old('name') }}" placeholder="@lang('product.field.name')"
                                   v-validate="'required'" data-vv-as="{{ trans('product.field.name') }}">
                            <span v-show="errors.has('name')" class="help-block" v-cloak>@{{ errors.first('name') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('image_path') ? 'has-error' : '' }}">
                        <label for="inputImagePath" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                            <input type="file" class="file form-control" id="inputImagePath" name="image_path"
                                   data-show-upload="false" data-allowed-file-extensions='["jpg","png"]'>
                            <span class="help-block">{{ $errors->has('image_path') ? $errors->first('image_path') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('short_code') ? 'has-error' : '' }}">
                        <label for="inputShortCode" class="col-sm-2 control-label">@lang('product.field.short_code')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputShortCode" name="short_code" value="{{ old('short_code') }}" placeholder="@lang('product.field.short_code')">
                            <span class="help-block">{{ $errors->has('short_code') ? $errors->first('short_code') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('barcode') ? 'has-error' : '' }}">
                        <label for="inputBarcode" class="col-sm-2 control-label">@lang('product.field.barcode')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputBarcode" name="barcode" value="{{ old('barcode') }}" placeholder="@lang('product.field.barcode')">
                            <span class="help-block">{{ $errors->has('barcode') ? $errors->first('barcode') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="inputDescription" class="col-sm-2 control-label">@lang('product.field.description')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputDescription" name="description" value="{{ old('description') }}" placeholder="@lang('product.field.description')">
                            <span class="help-block">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputProductUnit" class="col-sm-2 control-label">@lang('product.field.unit')</label>
                        <div class="col-sm-10">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center valign-middle">
                                            <input type="checkbox" v-model="selectedAll" v-on:click="checkAll()" />
                                        </th>
                                        <th>@lang('product.create.table.product.header.unit')</th>
                                        <th class="text-center">@lang('product.create.table.product.header.is_base')</th>
                                        <th>@lang('product.create.table.product.header.conversion_value')</th>
                                        <th>@lang('product.create.table.product.header.remarks')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(unit, unitIdx) in units">
                                        <td class="text-center valign-middle">
                                            <input type="checkbox" v-model="unit.selected" v-on:click="checkSelectAll()"/>
                                        </td>
                                        <td v-bind:class="{ 'has-error':errors.has('unit_' + unitIdx) }">
                                            <select class="form-control"
                                                    name="unit_id[]"
                                                    v-validate="'required'"
                                                    v-bind:data-vv-as="'{{ trans('product.create.table.product.header.unit') }} ' + (unitIdx + 1)"
                                                    v-bind:data-vv-name="'unit_' + unitIdx">
                                                <option v-bind:value="defaultUnit.id">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="(value, key) in unitDDL" v-bind:value="key">@{{ value }}</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" v-model="unit.is_base" v-on:click="checkOnlyOneIsBase(unitIdx)"/>
                                            <input type="hidden" v-model="unit.is_base_val" name="is_base[]"/>
                                        </td>
                                        <td v-bind:class="{ 'has-error':errors.has('conv_val_' + unitIdx) }">
                                            <input type="text" class="form-control" v-model="unit.conversion_value" name="conversion_value[]"
                                                   v-bind:readonly="unit.is_base" v-validate="'required'"
                                                   v-bind:data-vv-as="'{{ trans('product.create.table.product.header.conversion_value') }} ' + (unitIdx + 1)"
                                                   v-bind:data-vv-name="'conv_val_' + unitIdx"/>
                                        </td>
                                        <td> <input type="text" class="form-control" v-model="unit.remarks" name="unit_remarks[]"/> </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button type="button" class="btn btn-xs btn-danger" v-show="units.length" v-on:click="remove()">@lang('buttons.remove_button')</button>
                                            <button type="button" class="btn btn-xs btn-primary" v-on:click="addNew()">@lang('buttons.create_new_button')</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('minimal_in_stock') }">
                        <label for="inputMinimalInStock" class="col-sm-2 control-label">@lang('product.field.minimal_in_stock')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputMinimalInStock" name="minimal_in_stock"
                                   v-validate="'required|min_value:0|numeric'" placeholder="@lang('product.field.minimal_in_stock')"
                                   data-vv-as="{{ trans('product.field.minimal_in_stock') }}">
                            <span v-show="errors.has('minimal_in_stock')" class="help-block" v-cloak>@{{ errors.first('minimal_in_stock') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('status') }">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('product.field.status')</label>
                        <div class="col-sm-10">
                            <select class="form-control"
                                    name="status"
                                    v-validate="'required'"
                                    data-vv-as="{{ trans('product.field.status') }}">
                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="(value, key) in statusDDL" v-bind:value="key">@{{ value }}</option>
                            </select>
                            <span v-show="errors.has('status')" class="help-block" v-cloak>@{{ errors.first('status') }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('product.field.remarks')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputRemarks" name="remarks" value="{{ old('remarks') }}" placeholder="@lang('product.field.remarks')">
                            <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.product') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                            <button id="submitButton" class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript" src="{{ mix('adminlte/fileinput/fileinput.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/fileinput/id.js') }}"></script>

    <script type="application/javascript">
        var app = new Vue({
            el: '#productVue',
            data: {
                selectedAll: false,
                units: [{
                    selected: false,
                    unit_id: '',
                    is_base: false,
                    is_base_val: false,
                    conversion_value:'',
                    remarks: ''
                }],
                product_categories: [],
                prodTypeDDL: JSON.parse('{!! htmlspecialchars_decode($prodtypeDdL) !!}'),
                unitDDL: JSON.parse('{!! htmlspecialchars_decode($unitDDL) !!}'),
                statusDDL: JSON.parse('{!! htmlspecialchars_decode($statusDDL) !!}')
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.master.product.create') }}' + '?api_token=' + $('#secapi').val()
                            , new FormData($('#productForm')[0])
                            , { headers: { 'content-type': 'multipart/form-data' } })
                            .then(function(response) {
                                window.location.href = '{{ route('db.master.product') }}';
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
                    this.units.push({
                        'selected': false,
                        'unit_id': '',
                        'is_base': false,
                        'is_base_val': false,
                        'conversion_value': '',
                        'remarks': ''
                    });
                },
                remove: function () {
                    var newDataList = [];
                    this.selectedAll = false;

                    this.units.forEach(function (unit) {
                        if (!unit.selected) {
                            newDataList.push(unit);
                        }
                    });
                    this.units = newDataList;
                },
                checkAll: function () {
                    if (this.selectedAll) {
                        this.selectedAll = true;
                        this.units.forEach(function (unit) {
                            unit.selected = true;
                        });
                    } else {
                        this.selectedAll = false;
                        this.units.forEach(function (unit) {
                            unit.selected = false;
                        });
                    }
                },
                checkSelectAll: function () {
                    var check = true;
                    this.units.forEach(function (unit) {
                        if (unit.selected == false) {
                            check = false;
                        }
                    });
                    this.selectedAll = check;
                },
                checkOnlyOneIsBase: function (idx) {
                    for (var i = 0; i < this.units.length; i++) {
                        if (idx == i) {
                            this.units[i].conversion_value = 1;
                            this.units[i].is_base = true;
                            this.units[i].is_base_val = true;
                        } else {
                            this.units[i].is_base = false;
                            this.units[i].is_base_val = false;
                        }
                    }
                },
                addCategory: function() {
                    this.product_categories.push({
                        'code':'',
                        'name':'',
                        'description':'',
                        'level':0
                    });
                },
                removeCategory: function(idx) {
                    this.product_categories.splice(idx, 1);
                }
            },
            computed: {
                defaultUnit: function() {
                    return {
                        id: ''
                    };
                }
            }
        });
    </script>
@endsection