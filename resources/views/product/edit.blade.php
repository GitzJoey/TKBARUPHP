@extends('layouts.adminlte.master')

@section('title')
    @lang('product.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-cubes fa-fw"></span>&nbsp;@lang('product.edit.page_title')
@endsection
@section('page_title_desc')
    @lang('product.edit.page_title_desc')
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('product.edit.header.title')</h3>
        </div>
        {!! Form::model($product, ['method' => 'PATCH', 'route' => ['db.master.product.edit', $product->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="inputType" class="col-sm-2 control-label">@lang('product.field.type')</label>
                    <div class="col-sm-10">
                        {{ Form::select('type', $prodtypeDdL, $selected, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">@lang('product.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" type="text" class="form-control" value="{{ $product->name }}" placeholder="Name" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('short_code') ? 'has-error' : '' }}">
                    <label for="inputShortCode" class="col-sm-2 control-label">@lang('product.field.short_code')</label>
                    <div class="col-sm-10">
                        <input type="text" id="inputShortCode" class="form-control" name="short_name" value="{{ $product->short_code }}" placeholder="Short Name">
                        <span class="help-block">{{ $errors->has('short_code') ? $errors->first('short_code') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescription" class="col-sm-2 control-label">@lang('product.field.description')</label>
                    <div class="col-sm-10">
                        <input id="inputDescription" name="prefix" type="text" class="form-control" value="{{ $product->description }} "placeholder="prefix">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputProductUnit" class="col-sm-2 control-label">@lang('product.field.unit')</label>
                    <div class="col-sm-10">
                        <div id="productVue">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            <input type="checkbox" v-model="selectedAll" v-on:click="checkAll()" />
                                        </th>
                                        <th>@lang('product.edit.table.header.unit')</th>
                                        <th class="text-center">@lang('product.edit.table.header.is_base')</th>
                                        <th>@lang('product.edit.table.header.conversion_value')</th>
                                        <th>@lang('product.edit.table.header.remarks')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="unit in units">
                                        <td class="text-center">
                                            <input type="checkbox" v-model="unit.selected" v-on:click="checkSelectAll()"/>
                                        </td>
                                        <td>
                                            <select class="form-control"
                                                    name="unit_id[]"
                                                    data-parsley-required="true"
                                                    v-model="unit.unit_id">
                                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="(key, value) in unitDDL" v-bind:value="key">@{{ value }}</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" v-model="unit.is_base" v-on:click="checkOnlyOneIsBase($index)" name="is_base[]"/>
                                            <input type="hidden" v-model="unit.is_base_val" name="is_base[]"/>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" v-model="unit.conversion_value" name="conversion_value[]" data-parsley-required="true"/>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" v-model="unit.remarks" name="remarks[]"/>
                                        </td>
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
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('product.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('product.field.remarks')</label>
                    <div class="col-sm-10">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $product->remarks }}" placeholder="Remarks">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.product') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = new Vue({
            el: '#productVue',
            data: {
                selectedAll: false,
                units: JSON.parse('{!! $product->getProductUnitsJSON() !!}'),
                unitDDL: JSON.parse('{!! htmlspecialchars_decode($unitDDL) !!}')
            },
            methods: {
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
                            this.units[i].is_base_val = true;
                        } else {
                            this.units[i].is_base = false;
                            this.units[i].is_base_val = false;
                        }
                    }
                }
            }
        });
    </script>
@endsection