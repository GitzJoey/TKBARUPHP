@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.inflow.index.title')
@endsection

@section('page_title')
    <span class="fa fa-mail-forward fa-rotate-90 fa-fw"></span>&nbsp;@lang('warehouse.inflow.index.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.inflow.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('inflow') !!}
@endsection

@section('content')
    <div id="warehouseInflowVue">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('warehouse.inflow.index.header.warehouse')</h3>
            </div>
            <div class="box-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="inputWarehouse" class="col-sm-2 control-label">@lang('warehouse.inflow.field.warehouse')</label>
                        <div class="col-sm-10">
                            <select id="inputWarehouse"
                                    class="form-control"
                                    v-model="selectedWarehouse"
                                    v-on:change="getWarehousePOs(selectedWarehouse)">
                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="warehouse in warehouseDDL" v-bind:value="warehouse.hId">@{{ warehouse.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPOCode" class="col-sm-2 control-label">@lang('warehouse.inflow.field.po_code')</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="inputPOCode" v-model="po_code" placeholder="@lang('warehouse.inflow.field.po_code')">
                        </div>
                        <div class="col-sm-2">
                            <button id="btnSearch" class="btn btn-default" v-on:click="getWarehousePOByCode(po_code)"><span class="fa fa-search-plus fa-fw"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('warehouse.inflow.index.header.purchase_order')</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">@lang('warehouse.inflow.index.table.header.code')</th>
                            <th class="text-center">@lang('warehouse.inflow.index.table.header.po_date')</th>
                            <th class="text-center">@lang('warehouse.inflow.index.table.header.supplier')</th>
                            <th class="text-center">@lang('warehouse.inflow.index.table.header.shipping_date')</th>
                            <th class="text-center">@lang('labels.ACTION')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="po in POs" v-cloak>
                            <td class="text-center">@{{ po.code }}</td>
                            <td class="text-center">@{{ po.po_created }}</td>
                            <td class="text-center">@{{ po.supplier_type == 'SUPPLIERTYPE.R' ? po.supplier.name:po.walk_in_supplier }}</td>
                            <td class="text-center">@{{ po.shipping_date }}</td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-primary" v-bind:href="'{{ route('db.warehouse.inflow') }}/' + po.hId" title="Receipt"><span class="fa fa-pencil fa-fw"></span></a>
                            </td>
                        </tr>
                        <tr v-show="selectedWarehouse != '' && !POs.length" v-cloak>
                            <td colspan="5" class="text-center animated shake">@lang('labels.DATA_NOT_FOUND')</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = new Vue({
            el: '#warehouseInflowVue',
            data:{
                warehouseDDL: JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}'),
                selectedWarehouse: '',
                po_code: '',
                POs: []
            },
            methods: {
                getWarehousePOs: function (selectedWarehouse) {
                    var vm = this;
                    vm.POs = [];
                    if (selectedWarehouse != '') {
                        axios.get('{{ route('api.warehouse.inflow.po') }}/' + selectedWarehouse).then(function(response) {
                            vm.POs = response.data;
                        });
                    }
                },
                getWarehousePOByCode: function (code) {
                    var vm = this;
                    vm.POs = [];

                    axios.get('{{ route('api.warehouse.inflow.po.bycode') }}/' + code).then(function(response) {
                        vm.POs = response.data;
                    });
                },
                loadWarehouse: function(w) {
                    if (w == undefined || w == null) return;
                    var wh = _.find(this.warehouseDDL, function(wh) { return wh.hId == w; });
                    this.selectedWarehouse = wh.hId;
                    this.getWarehousePOs(wh.hId);
                }
            },
            mounted: function() {
                this.loadWarehouse(new URI().query(true)['w']);
            }
        });
    </script>
@endsection
