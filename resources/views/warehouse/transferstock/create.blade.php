@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.transfer_stock.create.title')
@endsection

@section('page_title')
    <span class="fa fa-refresh fa-fw"></span>&nbsp;@lang('warehouse.transfer_stock.create.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.transfer_stock.create.page_title_desc')
@endsection

@section('breadcrumbs')

@endsection

@section('content')
    <div id="tsVue">
        <form class="form-horizontal" action="{{ route('db.warehouse.transfer_stock.transfer') }}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.transfer_stock.create.header.title.stock_transfer')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <label for="inputDestinationWarehouse" class="col-md-2">
                                    @lang('warehouse.transfer_stock.field.transfer_date')
                                </label>
                                <div class="col-md-10">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" id="inputTransferDate"
                                               name="transfer_date"
                                               data-parsley-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="inputDestinationWarehouse">
                                        @lang('warehouse.transfer_stock.field.remarks')
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="remarks" v-bind:value="ts.remarks">
                                    <textarea id="inputRemarks" name="remarks" class="form-control" rows="5"
                                              v-model="ts.remarks"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.transfer_stock.create.header.title.stock_location')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputsource_Warehouse" class="col-sm-3 control-label">
                                    @lang('warehouse.transfer_stock.field.source_warehouse')
                                </label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="source_warehouse_id" v-bind:value="ts.source_warehouse.id">
                                    <input type="hidden" name="product_id" v-bind:value="ts.product.id">
                                    <input type="hidden" name="stock_id" v-bind:value="ts.stock.id">
                                    <select id="inputSourceWarehouse" data-parsley-required="true"
                                            class="form-control"
                                            v-model="ts.source_warehouse"
                                            v-on:change="showSourceStocks(ts.source_warehouse.id)">
                                        <option v-bind:value="defaultWarehouse">@lang('labels.PLEASE_SELECT')</option>
                                        <option v-for="source_warehouse of warehouseDDL" v-bind:value="source_warehouse">@{{ source_warehouse.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" v-show="ts.source_warehouse.id != ''">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.transfer_stock.create.header.title.transferred_to')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputDestinationWarehouse" class="col-sm-3 control-label">
                                    @lang('warehouse.transfer_stock.field.destination_warehouse')
                                </label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="destination_warehouse_id" v-bind:value="ts.destination_warehouse.id">
                                    <select id="inputDestinationWarehouse"
                                            data-parsley-required="true"
                                            class="form-control"
                                            v-model="ts.destination_warehouse"
                                            v-on:change="showDestinationStocks(ts.destination_warehouse.id)">
                                        <option v-if="destination_warehouse.id != ts.source_warehouse.id"
                                                v-for="destination_warehouse of warehouseDDL"
                                                v-bind:value="destination_warehouse">@{{ destination_warehouse.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" v-show="ts.source_warehouse.id != ''">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.transfer_stock.create.header.title.stocks') in @{{ ts.source_warehouse.name }}</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="po_id" v-bind:value="ts.po.id" >
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center" width="10%">@lang('warehouse.transfer_stock.create.table.header.select')</th>
                                            <th class="text-center" width="60%">@lang('warehouse.transfer_stock.create.table.header.product')</th>
                                            <th class="text-center" width="30%">@lang('warehouse.transfer_stock.create.table.header.current_qty')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(s, sIdx) in source_stocks" v-cloak>
                                            <td>
                                                <label v-on:click="selectProduct(s)">
                                                    <input type="radio" class="radio-button" v-bind:value="s" v-model="ts.stock">
                                                </label>
                                            </td>
                                            <td>@{{ s.product.name }}</td>
                                            <td>@{{ s.current_quantity }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer"></div>
                    </div>
                </div>
                <div class="col-md-6" v-show="ts.destination_warehouse.id != '' && ts.product.id != ''">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.transfer_stock.create.header.title.stocks') in @{{ ts.destination_warehouse.name }}</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label><input type="radio" class="radio-button" value="newStock" v-model="newOrExistingStock"> New Stock</label>
                                    <label v-show="destination_stocks.length > 0"><input type="radio" class="radio-button" value="existingStock" v-model="newOrExistingStock"> Existing Stock</label>
                                </div>
                            </div>
                            <div class="row" v-show="newOrExistingStock == 'newStock'">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center" width="60%">@lang('warehouse.transfer_stock.create.table.header.product')</th>
                                            <th class="text-center" width="30%">@lang('warehouse.transfer_stock.create.table.header.qty_to_transfer')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>@{{ ts.product.name }}</td>
                                            <td><input type="text" class="form-control text-right" name="quantity" v-model="ts.quantity" data-parsley-required="true" data-parsley-type="number"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" v-show="newOrExistingStock == 'existingStock'">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center" width="10%">@lang('warehouse.transfer_stock.create.table.header.select')</th>
                                            <th class="text-center" width="60%">@lang('warehouse.transfer_stock.create.table.header.product')</th>
                                            <th class="text-center" width="30%">@lang('warehouse.transfer_stock.create.table.header.qty_to_transfer')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(s, sIdx) in destination_stocks" v-cloak>
                                            <td>
                                                <input type="radio" name="destination-stocks" class="radio-button" v-bind:value="s" v-model="ts.stock">
                                            </td>
                                            <td>@{{ s.product.name }}</td>
                                            <td><input type="text"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <div class="btn-toolbar">
                        <button id="transferButton" type="submit"
                                class="btn btn-primary pull-right" name="transfer"
                                value="transfer">@lang('buttons.transfer')</button>
                        <a id="cancelButton" class="btn btn-primary pull-right"
                           href="{{ route('db') }}">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function () {
            var tsApp = new Vue({
                el: '#tsVue',
                data: {
                    warehouseDDL: JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}'),
                    ts: {
                        store: {
                            id: ''
                        },
                        source_warehouse: {
                            id: '',
                            name: ''
                        },
                        destination_warehouse: {
                            id: '',
                            name: ''
                        },
                        product: {
                            id: '',
                            name: ''
                        },
                        stock: {
                            id: ''
                        },
                        po: {
                            id: ''
                        },
                        remarks: '',
                        quantity: 0,
                    },
                    source_stocks: [],
                    destination_stocks: [],
                    newOrExistingStock: 'newStock'
                },
                methods: {
                    showSourceStocks: function(warehouseId) {
                        this.source_stocks = 0;
                        axios.get('{{ route('api.stock.current_stocks') }}' + '/' + this.ts.source_warehouse.id).then(function(data) {
                            this.source_stocks = data.data;
                        });
                    },
                    showDestinationStocks: function(warehouseId, productId) {
                        this.destination_stocks = 0;
                        axios.get('{{ route('api.stock.current_stocks') }}' + '/' + this.ts.destination_warehouse.id).then(function(data) {
                            this.destination_stocks = data.data;
                        });
                    },
                    selectProduct: function(stock) {

                        this.ts.product.id = stock.product_id;
                        this.ts.product.name = stock.product.name;
                        this.ts.po.id = stock.po_id;

                    }
                },
                computed: {
                    defaultWarehouse: function() {
                        return {
                            id: ''
                        }
                    }
                },
                updated: function () { }
            });

            $("#inputTransferDate").datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment()
            });
        });
    </script>
@endsection
