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
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        @lang('warehouse.transfer_stock.create.header.title.warehouse')
                    </div>
                    <form class="form-horizontal" action="" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputsource_Warehouse" class="col-sm-4 control-label">
                                    @lang('warehouse.transfer_stock.field.source_warehouse')
                                </label>
                                <div class="col-sm-7">
                                    <input type="hidden" name="source_warehouse_id" v-bind:value="ts.source_warehouse.id">
                                    <select id="inputSourceWarehouse" data-parsley-required="true"
                                            class="form-control"
                                            v-model="ts.source_warehouse"
                                            v-on:change="showStocks(ts.source_warehouse.id)">
                                        <option v-bind:value="defaultWarehouse">@lang('labels.PLEASE_SELECT')</option>
                                        <option v-for="source_warehouse of warehouseDDL" v-bind:value="source_warehouse">@{{ source_warehouse.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <template v-if="ts.source_warehouse.id != ''">
                                <div class="form-group">
                                    <label for="inputDestinationWarehouse" class="col-sm-4 control-label">
                                        @lang('warehouse.transfer_stock.field.destination_warehouse')
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="hidden" name="destination_warehouse_id" v-bind:value="ts.destination_warehouse.id">
                                        <select id="inputDestinationWarehouse" data-parsley-required="true" class="form-control" v-model="ts.destination_warehouse">
                                            <option v-if="destination_warehouse.id != ts.source_warehouse.id"
                                                    v-for="destination_warehouse of warehouseDDL"
                                                    v-bind:value="destination_warehouse">@{{ destination_warehouse.name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('warehouse.transfer_stock.create.header.title.stocks')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="20%">@lang('warehouse.transfer_stock.create.table.header.product')</th>
                                            <th class="text-center" width="10%">@lang('warehouse.transfer_stock.create.table.header.current_qty')</th>
                                            <th class="text-center" width="60%">@lang('warehouse.transfer_stock.create.table.header.detail')</th>
                                            <th class="text-center" width="10%">@lang('labels.ACTION')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(s, sIdx) in stocks" v-cloak>
                                            <td>@{{ s.product.name }}</td>
                                            <td>@{{ s.current_quantity }}</td>
                                            <td></td>
                                            <td class="valign-middle text-center">
                                                <a href="#" class="btn btn-xs btn-primary"><span class="fa fa-info fa-fw"></span></a>
                                            </td>
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
                        source_warehouse: {
                            id: ''
                        },
                        destination_warehouse: {
                            id: ''
                        },
                    },
                    stocks: []
                },
                methods: {
                    showStocks: function(warehouseId) {
                        this.stocks = [];
                        this.$http.get('{{ route('api.stock.current_stocks') }}' + '/' + this.ts.source_warehouse.id).then(function(data) {
                            this.stocks = data.data;
                        });
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
        });
    </script>
@endsection
