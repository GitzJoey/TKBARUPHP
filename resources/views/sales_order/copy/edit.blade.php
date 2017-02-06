@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.copy.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-code-fork fa-fw"></span>&nbsp;@lang('sales_order.copy.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.copy.edit.page_title_desc')
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

    <div id="soCopyVue">
        {!! Form::model($currentSOCopy, ['method' => 'PATCH', 'route' => ['db.so.copy.edit', $soCode, $currentSOCopy->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-11">
                <div class="row">
                    <div class="col-md-7">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('sales_order.copy.edit.box.customer')</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputCustomerType"
                                           class="col-sm-4 control-label">@lang('sales_order.copy.edit.field.customer_type')</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" readonly
                                               value="@lang('lookup.'.$currentSOCopy->customer_type)">
                                    </div>
                                </div>
                                @if($currentSOCopy->customer_type == 'CUSTOMERTYPE.R')
                                    <div class="form-group">
                                        <label for="inputCustomerId"
                                               class="col-sm-4 control-label">@lang('sales_order.copy.edit.field.customer_name')</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" readonly
                                                   value="{{ $currentSOCopy->customer->name }}">
                                        </div>
                                        <div class="col-sm-1">
                                            <button id="customerDetailButton" type="button"
                                                    class="btn btn-primary btn-sm"
                                                    data-toggle="modal" data-target="#customerDetailModal"><span
                                                        class="fa fa-info-circle fa-lg"></span></button>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label for="inputCustomerName"
                                               class="col-sm-4 control-label">@lang('sales_order.copy.edit.field.customer_name')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" readonly
                                                   value="{{ $currentSOCopy->walk_in_cust }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCustomerDetails"
                                               class="col-sm-4 control-label">@lang('sales_order.copy.edit.field.customer_details')</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" rows="5" readonly>{{ $currentSOCopy->walk_in_cust_detail }}
                                            </textarea>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('sales_order.copy.edit.box.sales_order_detail')</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputSoCode"
                                           class="col-sm-3 control-label">@lang('sales_order.copy.edit.field.so_code')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentSOCopy->main_so_code }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSoCopyCode"
                                           class="col-sm-3 control-label">@lang('sales_order.copy.edit.field.so_copy_code')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" readonly name="code" value="{{ $currentSOCopy->code }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSoType"
                                           class="col-sm-3 control-label">@lang('sales_order.copy.edit.field.so_type')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" readonly
                                               value="@lang('lookup.'.$currentSOCopy->so_type)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSoDate"
                                           class="col-sm-3 control-label">@lang('sales_order.copy.edit.field.so_date')</label>
                                    <div class="col-sm-9">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" readonly
                                                   value="{{ $currentSOCopy->so_created->format('d-m-Y') }}">
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
                                <h3 class="box-title">@lang('sales_order.copy.edit.box.shipping')</h3>
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputShippingDate"
                                           class="col-sm-3 control-label">@lang('sales_order.copy.edit.field.shipping_date')</label>
                                    <div class="col-sm-9">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control" readonly name="shipping_date"
                                                   value="{{ $currentSOCopy->shipping_date->format('d-m-Y') }}"
                                                   data-parsley-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputWarehouse"
                                           class="col-sm-3 control-label">@lang('sales_order.copy.edit.field.warehouse')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentSOCopy->warehouse->name }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputVendorTrucking"
                                           class="col-sm-3 control-label">@lang('sales_order.copy.edit.field.vendor_trucking')</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" readonly
                                               value="{{ empty($currentSOCopy->vendorTrucking->name) ? '':$currentSOCopy->vendorTrucking->name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
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
                                <h3 class="box-title">@lang('sales_order.copy.edit.box.transactions')</h3>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    @if($currentSOCopy->so_type == 'SOTYPE.SVC')
                                        <div class="col-md-11">
                                            <select id="inputProduct"
                                                    class="form-control"
                                                    v-model="so.product">
                                                <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="product in productDDL" v-bind:value="product">@{{ product.name }}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary btn-md"
                                                    v-on:click="insertProduct(so.product)"><span class="fa fa-plus"/>
                                            </button>
                                        </div>
                                    @else
                                        <div class="col-md-11">
                                            <select id="inputStock"
                                                    class="form-control"
                                                    v-model="so.stock">
                                                <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                                <option v-for="stock in stocksDDL" v-bind:value="stock"></option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary btn-md"
                                                    v-on:click="insertStock(so.stock)"><span class="fa fa-plus"/>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="itemsListTable" class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th width="30%">@lang('sales_order.copy.edit.table.item.header.product_name')</th>
                                                <th width="15%">@lang('sales_order.copy.edit.table.item.header.quantity')</th>
                                                <th width="15%"
                                                    class="text-right">@lang('sales_order.copy.edit.table.item.header.unit')</th>
                                                <th width="15%"
                                                    class="text-right">@lang('sales_order.copy.edit.table.item.header.price_unit')</th>
                                                <th width="5%">&nbsp;</th>
                                                <th width="20%"
                                                    class="text-right">@lang('sales_order.copy.edit.table.item.header.total_price')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(item, itemIndex) in so.items">
                                                <input type="hidden" name="item_id[]" v-bind:value="item.id">
                                                <input type="hidden" name="product_id[]" v-bind:value="item.product.id">
                                                <input type="hidden" name="stock_id[]" v-bind:value="item.stock.id">
                                                <input type="hidden" name="base_unit_id[]"
                                                       v-bind:value="item.base_unit.unit.id">
                                                <td class="valign-middle">@{{ item.product.name }}</td>
                                                <td>
                                                    <input type="text" class="form-control text-right" name="quantity[]"
                                                           v-model="item.quantity" data-parsley-required="true"
                                                           data-parsley-type="number">
                                                </td>
                                                <td>
                                                    <input type="hidden" name="selected_unit_id[]" v-bind:value="item.selected_unit.unit.id">
                                                    <select class="form-control"
                                                            v-model="item.selected_unit"
                                                            data-parsley-required="true">
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
                                                            v-on:click="removeItem(itemIndex)"><span
                                                                class="fa fa-minus"></span>
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
                                                    class="text-right">@lang('sales_order.copy.edit.table.total.body.total')</td>
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
                        <h3 class="box-title">@lang('sales_order.edit.box.transaction_summary')</h3>
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
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('sales_order.copy.edit.box.remarks')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea id="inputRemarks" class="form-control" rows="5"
                                                  readonly>{{ $currentSOCopy->main_so_remarks }}</textarea>
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
                        <h3 class="box-title">@lang('sales_order.copy.edit.box.so_copy_remarks')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea id="inputSoCopyRemarks" name="remarks" class="form-control"
                                                  rows="5">{{ $currentSOCopy->remarks }}</textarea>
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
                    <button id="submitButton" type="submit" class="btn btn-primary pull-right">
                        @lang('buttons.submit_button')</button>
                    &nbsp;&nbsp;&nbsp;
                    <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">
                        @lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                    <a id="cancelButton" href="{{ route('db.so.copy.index', $soCode) }}"
                       class="btn btn-primary pull-right" role="button">@lang('buttons.cancel_button')</a>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

        @include('sales_order.customer_details_partial')
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var currentSo = JSON.parse('{!! htmlspecialchars_decode($currentSOCopy->toJson()) !!}');
        var soCopyApp = new Vue({
            el: '#soCopyVue',
            data: {
                productDDL: JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}'),
                stocksDDL: JSON.parse('{!! htmlspecialchars_decode($stocksDDL) !!}'),
                so: {
                    customer: currentSo.customer ? _.cloneDeep(currentSo.customer) : {id: ''},
                    items: [],
                }
            },
            methods: {
                grandTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.so.items, function (item, key) {
                        result += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });
                    return result;
                },
                insertProduct: function (product) {
                    if(product.id != ''){
                        this.so.items.push({
                            stock_id: 0,
                            product: _.cloneDeep(product),
                            selected_unit: {
                                unit: {
                                    id: ''
                                },
                                conversion_value: 1
                            },
                            base_unit: _.cloneDeep(_.find(product.product_units, isBase)),
                            quantity: 0,
                            price: 0
                        });
                    }
                },
                insertStock: function (stock) {
                    if(stock.id != ''){
                        var vm = this;
                        var stock_price = _.find(stock.today_prices, function (price) {
                            return price.price_level_id === vm.so.customer.price_level_id;
                        });

                        vm.so.items.push({
                            stock_id: stock.id,
                            product: _.cloneDeep(stock.product),
                            selected_unit: {
                                unit: {
                                    id: ''
                                },
                                conversion_value: 1
                            },
                            base_unit: _.cloneDeep(_.find(stock.product.product_units, isBase)),
                            quantity: 0,
                            price: stock_price ? stock_price : 0
                        });
                    }
                },
                removeItem: function (index) {
                    this.so.items.splice(index, 1);
                }
            }
        });

        for (var i = 0; i < currentSo.items.length; i++) {
            soCopyApp.so.items.push({
                id: currentSo.items[i].id,
                stock: {
                    id: currentSo.items[i].stock_id
                },
                product: _.cloneDeep(currentSo.items[i].product),
                base_unit: _.cloneDeep(_.find(currentSo.items[i].product.product_units, isBase)),
                selected_unit: _.cloneDeep(_.find(currentSo.items[i].product.product_units, getSelectedUnit(currentSo.items[i].selected_unit_id))),
                quantity: currentSo.items[i].quantity % 1 != 0 ? parseFloat(currentSo.items[i].quantity).toFixed(1) : parseFloat(currentSo.items[i].quantity).toFixed(0),
                price: parseFloat(currentSo.items[i].price).toFixed(0)
            });
        }

        function getSelectedUnit(selectedUnitId) {
            return function (element) {
                return element.unit_id == selectedUnitId;
            }
        }

        function isBase(unit) {
            return unit.is_base == 1;
        }

        $(function () {
            $("#inputSoDate").datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment()
            });
            $("#inputShippingDate").datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment()
            });
        });
    </script>
@endsection