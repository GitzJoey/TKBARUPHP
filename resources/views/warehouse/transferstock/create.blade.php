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
    {!! Breadcrumbs::render('transferstock_create') !!}
@endsection

@section('content')
    <div id="tsVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="tsForm" class="form-horizontal" method="post" @submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.transfer_stock.create.header.title.stock_transfer')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <label for="inputTransferDate" class="col-md-2">
                                    @lang('warehouse.transfer_stock.field.transfer_date')
                                </label>
                                <div class="col-md-10">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputTransferDate" name="transfer_date" v-model="ts.transfer_date" format="YYYY-MM-DD hh:mm A"></vue-datetimepicker>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="inputRemarks">
                                        @lang('warehouse.transfer_stock.field.remarks')
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="remarks" v-bind:value="ts.remarks">
                                    <textarea id="inputRemarks" name="remarks" class="form-control" rows="5" v-model="ts.remarks"></textarea>
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
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('source_warehouse_id') }">
                                <label for="inputSourceWarehouse" class="col-sm-3 control-label">
                                    @lang('warehouse.transfer_stock.field.source_warehouse')
                                </label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="product_id" v-bind:value="ts.product.id">
                                    <input type="hidden" name="stock_id" v-bind:value="ts.stock.id">
                                    <select id="inputSourceWarehouse"
                                            name="source_warehouse_id"
                                            class="form-control"
                                            v-model="ts.source_warehouse.id"
                                            v-validate="'required'"
                                            v-on:change="showSourceStocks(ts.source_warehouse.id)"
                                            data-vv-as="{{ trans('warehouse.transfer_stock.field.source_warehouse') }}">
                                        <option v-bind:value="defaultWarehouse.id">@lang('labels.PLEASE_SELECT')</option>
                                        <option v-for="source_warehouse of warehouseDDL" v-bind:value="source_warehouse.id">@{{ source_warehouse.name }}</option>
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
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('destination_warehouse_id') }">
                                <label for="inputDestinationWarehouse" class="col-sm-3 control-label">
                                    @lang('warehouse.transfer_stock.field.destination_warehouse')
                                </label>
                                <div class="col-sm-9">
                                    <select id="inputDestinationWarehouse"
                                            name="destination_warehouse_id"
                                            v-validate="'required'"
                                            class="form-control"
                                            v-model="ts.destination_warehouse.id"
                                            v-on:change="showDestinationStocks(ts.destination_warehouse.id)"
                                            data-vv-as="{{ trans('warehouse.transfer_stock.field.destination_warehouse') }}">
                                        <option v-bind:value="defaultWarehouse.id">@lang('labels.PLEASE_SELECT')</option>
                                        <option v-if="destination_warehouse.id != ts.source_warehouse.id"
                                                v-for="destination_warehouse of warehouseDDL"
                                                v-bind:value="destination_warehouse.id">@{{ destination_warehouse.name }}</option>
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
                            <h3 class="box-title">@lang('warehouse.transfer_stock.create.header.title.stocks') @lang('warehouse.transfer_stock.create.header.title.in') @{{ ts.source_warehouse.name }}</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="stock_id" v-bind:value="ts.stock.id" >
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
                                                <td class="text-center">
                                                    <label v-on:click="selectProduct(s)">
                                                        <input type="radio" class="radio-button" v-bind:value="s" v-model="ts.stock">
                                                    </label>
                                                </td>
                                                <td>@{{ s.product.name }}</td>
                                                <td align="right">@{{ s.current_quantity }}</td>
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
                            <h3 class="box-title">@lang('warehouse.transfer_stock.create.header.title.stocks') @lang('warehouse.transfer_stock.create.header.title.in') @{{ ts.destination_warehouse.name }}</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="radio" class="radio-button" value="newStock" name="newOrExistingStock" v-model="newOrExistingStock">
                                        &nbsp;@lang('warehouse.transfer_stock.field.newstock')&nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label v-show="destination_stocks.length > 0">
                                        <input type="radio" class="radio-button" value="existingStock" name="newOrExistingStock" v-model="newOrExistingStock">&nbsp;@lang('warehouse.transfer_stock.field.existingstock')
                                    </label>
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
                                                <td>
                                                    <input type="text" v-bind:class="{ 'form-control':true, 'text-right':true, 'has-error':errors.has('quantity') }" name="quantity"
                                                           v-model="ts.quantity"
                                                           v-validate="'required|numeric:2|min_value:0'" data-vv-as="{{ trans('warehouse.transfer_stock.create.table.header.qty_to_transfer') }}">
                                                </td>
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
                                                <td class="text-center">
                                                    <input type="radio" name="destination-stocks" class="radio-button" v-model="ts.stock.id">
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
                        <button id="transferButton" type="submit" class="btn btn-primary pull-right">@lang('buttons.transfer')</button>
                        <a id="cancelButton" class="btn btn-primary pull-right"
                           href="{{ route('db.warehouse.transfer_stock.index') }}">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
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
                    transfer_date: '',
                    remarks: '',
                    quantity: '',
                },
                source_stocks: [],
                destination_stocks: [],
                newOrExistingStock: 'newStock'
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.warehouse.transfer_stock.transfer') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#tsForm')[0]))
                            .then(function(response) {
                                window.location.href = '{{ route('db.warehouse.transfer_stock.index') }}';
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
                showSourceStocks: function(warehouseId) {
                    var vm = this;
                    this.source_stocks = 0;
                    axios.get('{{ route('api.stock.current_stocks') }}' + '/' + this.ts.source_warehouse.id).then(function(data) {
                        vm.source_stocks = data.data;
                    });

                    vm.ts.source_warehouse.name = _.find(vm.warehouseDDL, { id: warehouseId }).name;
                },
                showDestinationStocks: function(warehouseId, productId) {
                    var vm = this;
                    this.destination_stocks = 0;
                    axios.get('{{ route('api.stock.current_stocks') }}' + '/' + this.ts.destination_warehouse.id).then(function(data) {
                        vm.destination_stocks = data.data;
                    });

                    vm.ts.destination_warehouse.name = _.find(vm.warehouseDDL, { id: warehouseId }).name;
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
            }
        });
    </script>
@endsection
