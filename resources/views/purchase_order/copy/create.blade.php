@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.copy.create.title')
@endsection

@section('page_title')
    <span class="fa fa-code-fork fa-rotate-180 fa-fw"></span>&nbsp;@lang('purchase_order.copy.create.page_title')
@endsection

@section('page_title_desc')
    @lang('purchase_order.copy.create.page_title_desc')
@endsection

@section('breadcrumbs')
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

    <div id="poCopyVue">
        {!! Form::model($poToBeCopied, ['method' => 'POST', 'route' => ['db.po.copy.create', $poCode], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">@lang('purchase_order.copy.create.box.supplier')</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputSupplierType"
                                               class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_type')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" readonly
                                                   value="@lang('lookup.'.$poToBeCopied->supplier_type)">
                                        </div>
                                    </div>
                                    @if($poToBeCopied->supplier_type == 'SUPPLIERTYPE.R')
                                        <div class="form-group">
                                            <label for="inputSupplierId"
                                                   class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_name')</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" readonly
                                                       value="{{ $poToBeCopied->supplier->name }}">
                                            </div>
                                            <div class="col-sm-2">
                                                <button id="supplierDetailButton" type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#supplierDetailModal"><span
                                                            class="fa fa-info-circle fa-lg"></span></button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="inputSupplierName"
                                                   class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_name')</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" readonly
                                                       value="{{ $poToBeCopied->walk_in_supplier }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputSupplierDetails"
                                                   class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_details')</label>
                                            <div class="col-sm-10">
                                            <textarea class="form-control" rows="5" readonly>{{ $poToBeCopied->walk_in_supplier_details }}
                                            </textarea>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">@lang('purchase_order.copy.create.box.purchase_order_detail')</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputPoCode"
                                               class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_code')</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly value="{{ $poToBeCopied->code }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPoCopyCode"
                                               class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_copy_code')</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly name="code" value="{{ $poCopyCode }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPoType"
                                               class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_type')</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" readonly
                                                   value="@lang('lookup.'.$poToBeCopied->po_type)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPoDate"
                                               class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_date')</label>
                                        <div class="col-sm-9">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" readonly
                                                       value="{{ $poToBeCopied->po_created->format('d-m-Y') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">@lang('purchase_order.copy.create.box.shipping')</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputShippingDate"
                                               class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.shipping_date')</label>
                                        <div class="col-sm-5">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" name="shipping_date" readonly
                                                       value="{{ $poToBeCopied->shipping_date->format('d-m-Y') }}"
                                                       data-parsley-required="true">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputWarehouse"
                                               class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.warehouse')</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" readonly
                                                   value="{{ $poToBeCopied->warehouse->name }}">
                                            <input type="hidden" name="warehouse_id" value="{{ $poToBeCopied->warehouse->id }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="inputVendorTrucking"
                                               class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.vendor_trucking')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" readonly
                                                   value="{{ empty($poToBeCopied->vendorTrucking->name) ? '':$poToBeCopied->vendorTrucking->name }}">
                                            <input type="hidden" name="vendor_trucking_id"
                                                   value="{{ empty($poToBeCopied->vendorTrucking->id) ? '':$poToBeCopied->vendorTrucking->id }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="box box-info">
                        <div class="box-header with-border">
                        </div>
                        <div class="box-body">
                            @for ($i = 0; $i < 23; $i++)
                                <br/>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">@lang('purchase_order.copy.create.box.transactions')</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <select id="inputProduct"
                                                    class="form-control"
                                                    v-model="po.product">
                                                <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="product in po.supplier.products" v-bind:value="product">@{{ product.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary btn-md"
                                                    v-on:click="insertItem(po.product)"><span class="fa fa-plus"/></button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="itemsListTable" class="table table-bordered table-hover">
                                                <thead>
                                                <tr>
                                                    <th width="30%">@lang('purchase_order.copy.create.table.item.header.product_name')</th>
                                                    <th width="15%"
                                                        class="text-center">@lang('purchase_order.copy.create.table.item.header.quantity')</th>
                                                    <th width="15%"
                                                        class="text-center">@lang('purchase_order.copy.create.table.item.header.unit')</th>
                                                    <th width="15%"
                                                        class="text-center">@lang('purchase_order.copy.create.table.item.header.price_unit')</th>
                                                    <th width="5%">&nbsp;</th>
                                                    <th width="20%"
                                                        class="text-center">@lang('purchase_order.revise.table.item.header.total_price')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="(item, itemIndex) in po.items">
                                                    <input type="hidden" name="product_id[]" v-bind:value="item.product.id">
                                                    <input type="hidden" name="base_unit_id[]" v-bind:value="item.base_unit.unit.id">
                                                    <td class="valign-middle">@{{ item.product.name }}</td>
                                                    <td>
                                                        <input type="text" class="form-control text-right"
                                                               data-parsley-required="true" data-parsley-type="number"
                                                               name="quantity[]"
                                                               v-model="item.quantity">
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="selected_unit_id[]" v-bind:value="item.selected_unit.unit.id"
                                                        <select class="form-control"
                                                                data-parsley-required="true"
                                                                v-model="item.selected_unit">
                                                            <option v-bind:value="{unit: {id: ''}, conversion_value: 1}">@lang('labels.PLEASE_SELECT')</option>
                                                            <option v-for="product_unit in item.product.product_units" v-bind:value="product_unit">@{{ product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' }}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control text-right" name="price[]"
                                                               v-model="item.price" data-parsley-required="true"
                                                               data-parsley-pattern="^(?!0\.00)\d{1,3}(,\d{3})*(\.\d\d)?$">
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-danger btn-md"
                                                                v-on:click="removeItem(itemIndex)"><span class="fa fa-minus"/>
                                                        </button>
                                                    </td>
                                                    <td class="text-right valign-middle">
                                                        @{{ item.selected_unit.conversion_value * item.quantity * item.price }}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="itemsTotalListTable" class="table table-bordered">
                                                <tbody>
                                                <tr>
                                                    <td width="80%"
                                                        class="text-right">@lang('purchase_order.copy.create.table.total.body.total')</td>
                                                    <td width="20%" class="text-right">
                                                        <span class="control-label-normal">@{{ grandTotal() }}</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.copy.create.box.transaction_summary')</h3>
                        </div>
                        <div class="box-body">
                            @for ($i = 0; $i < 25; $i++)
                                <br/>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.copy.create.box.remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputPoRemarks" class="form-control"
                                                      rows="5" readonly>{{ $poToBeCopied->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.copy.create.box.po_copy_remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputPoCopyRemarks" name="remarks" class="form-control"
                                                      rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-offset-md-5">
                    <div class="btn-toolbar">
                        <button id="submitButton" type="submit"
                                class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>
                        &nbsp;&nbsp;&nbsp;
                        <a id="printButton" href="#" target="_blank"
                           class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>
                        <a id="cancelButton" href="{{ route('db.po.copy.index', $poCode) }}" class="btn btn-primary pull-right"
                           role="button">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}

        @include('purchase_order.supplier_details_partial')
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function () {
            var currentPo = JSON.parse('{!! htmlspecialchars_decode($poToBeCopied->toJson()) !!}');

            var poApp = new Vue({
                el: '#po-vue',
                data: {
                    po: {
                        supplier: _.cloneDeep(currentPo.supplier),
                        items: [],
                        warehouse: _.cloneDeep(currentPo.warehouse),
                        vendorTrucking: _.cloneDeep(currentPo.vendor_trucking),
                        product: {
                            id: ''
                        }
                    }
                },
                mounted: function() {
                    for (var i = 0; i < currentPo.items.length; i++) {
                        poApp.po.items.push({
                            id: currentPo.items[i].id,
                            product: _.cloneDeep(currentPo.items[i].product),
                            base_unit: _.cloneDeep(_.find(currentPo.items[i].product.product_units, isBase)),
                            selected_unit: _.cloneDeep(_.find(currentPo.items[i].product.product_units, getSelectedUnit(currentPo.items[i].selected_unit_id))),
                            quantity: parseFloat(currentPo.items[i].quantity).toFixed(0),
                            price: parseFloat(currentPo.items[i].price).toFixed(0)
                        });
                    }

                    $('input[type="checkbox"], input[type="radio"]').iCheck({
                        checkboxClass: 'icheckbox_square-blue',
                        radioClass: 'iradio_square-blue'
                    });

                    $("#inputShippingDate").datetimepicker({
                        format: "DD-MM-YYYY hh:mm A",
                        defaultDate: moment()
                    });
                },
                methods: {
                    grandTotal: function () {
                        var vm = this;
                        var result = 0;
                        _.forEach(vm.po.items, function (item, key) {
                            result += (item.selected_unit.conversion_value * item.quantity * item.price);
                        });
                        return result;
                    },
                    insertItem: function (product) {
                        if(product.id != ''){
                            var vm = this;
                            vm.po.items.push({
                                id: null,
                                product: _.cloneDeep(product),
                                base_unit: _.cloneDeep(_.find(product.product_units, isBase)),
                                selected_unit: {
                                    unit: {
                                        id: ''
                                    },
                                    conversion_value: 1
                                },
                                quantity: 0,
                                price: 0
                            });
                        }
                    },
                    removeItem: function (index) {
                        var vm = this;
                        vm.po.items.splice(index, 1);
                    }
                }
            });

            function getSelectedUnit(selectedUnitId) {
                return function (element) {
                    return element.unit_id == selectedUnitId;
                }
            }

            function isBase(unit) {
                return unit.is_base == 1;
            }
        });
    </script>
@endsection