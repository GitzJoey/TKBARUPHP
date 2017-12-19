@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.outflow.index.title')
@endsection

@section('page_title')
    <span class="fa fa-mail-reply fa-rotate-90 fa-fw"></span>&nbsp;@lang('warehouse.outflow.index.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.outflow.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('outflow') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div id="warehouseOutflowVue">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('warehouse.outflow.index.header.warehouse')</h3>
            </div>
            <div class="box-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="inputWarehouse" class="col-sm-2 control-label">@lang('warehouse.outflow.field.warehouse')</label>
                        <div class="col-sm-10">
                            <select id="inputWarehouse"
                                    class="form-control"
                                    v-model="selectedWarehouse"
                                    v-on:change="getWarehouseSOs(selectedWarehouse)">
                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="warehouse in warehouseDDL" v-bind:value="warehouse.hId">@{{ warehouse.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSOCode" class="col-sm-2 control-label">@lang('warehouse.outflow.field.so_code')</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="inputSOCode" v-model="so_code" placeholder="@lang('warehouse.outflow.field.so_code')">
                        </div>
                        <div class="col-sm-2">
                            <button id="btnSearch" class="btn btn-default" v-on:click="getWarehouseSOByCode(so_code)"><span class="fa fa-search-plus fa-fw"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('warehouse.outflow.index.header.sales_order')</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">@lang('warehouse.outflow.index.table.header.code')</th>
                            <th class="text-center">@lang('warehouse.outflow.index.table.header.so_date')</th>
                            <th class="text-center">@lang('warehouse.outflow.index.table.header.customer')</th>
                            <th class="text-center">@lang('warehouse.outflow.index.table.header.shipping_date')</th>
                            <th class="text-center">@lang('labels.ACTION')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="so in SOs" v-cloak>
                            <td class="text-center">@{{ so.code }}</td>
                            <td class="text-center">@{{ so.so_created }}</td>
                            <td class="text-center">@{{ so.customer_type == 'CUSTOMERTYPE.R' ? so.customer.name:so.walk_in_cust }}</td>
                            <td class="text-center">@{{ so.shipping_date }}</td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-primary" v-bind:href="'{{ route('db.warehouse.outflow') }}/' + so.hId" title="Deliver"><span class="fa fa-pencil fa-fw"></span></a>
                            </td>
                        </tr>
                        <tr v-show="selectedWarehouse != '' && !SOs.length" v-cloak>
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
            el: '#warehouseOutflowVue',
            data: {
                warehouseDDL: JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}'),
                selectedWarehouse: '',
                so_code: '',
                SOs: []
            },
            methods: {
                getWarehouseSOs: function (selectedWarehouse) {
                    var vm = this;
                    vm.SOs = [];
                    this.selectedWarehouse = selectedWarehouse;
                    axios.get('{{ route('api.warehouse.outflow.so') }}/' + selectedWarehouse).then(function (data) {
                        vm.SOs = data.data;
                    });
                },
                getWarehouseSOByCode: function (code) {
                    var vm = this;
                    vm.SOs = [];

                    axios.get('{{ route('api.warehouse.inflow.so.bycode') }}/' + code).then(function(response) {
                        vm.SOs = response.data;
                    });
                },
                loadWarehouse: function(w) {
                    if (w == undefined || w == null) return;
                    this.selectedWarehouse = _.find(this.warehouseDDL, function(wh) { return wh.hId == w; }).hId;
                    this.getWarehouseSOs(this.selectedWarehouse);
                }
            },
            mounted: function() {
                this.loadWarehouse(new URI().query(true)['w']);
            }
        });
    </script>
@endsection
