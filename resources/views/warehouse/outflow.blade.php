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
                <select id="inputWarehouse"
                        class="form-control"
                        v-model="selectedWarehouse"
                        v-on:change="getWarehouseSOs(selectedWarehouse)">
                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                    <option v-for="warehouse in warehouseDDL" v-bind:value="warehouse">@{{ warehouse.name }}</option>
                </select>
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
                        <tr v-for="so in SOs">
                            <td class="text-center">@{{ so.code }}</td>
                            <td class="text-center">@{{ so.so_created }}</td>
                            <td v-show="so.customer_type == 'CUSTOMERTYPE.R'" class="text-center">@{{ so.customer.name }}</td>
                            <td v-show="so.customer_type == 'CUSTOMERTYPE.WI'" class="text-center">@{{ so.walk_in_cust }}</td>
                            <td class="text-center">@{{ so.shipping_date }}</td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-primary" href="{{ route('db.warehouse.outflow') }}/@{{ so.id }}" title="Deliver"><span class="fa fa-pencil fa-fw"></span></a>
                            </td>
                        </tr>
                        <tr v-show="selectedWarehouse != '' && !SOs.length">
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
        $(document).ready(function() {
            var app = new Vue({
                el: '#warehouseOutflowVue',
                data: {
                    warehouseDDL: JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}'),
                    selectedWarehouse: '',
                    SOs: []
                },
                methods: {
                    getWarehouseSOs: function (selectedWarehouse) {
                        this.$http.get('{{ route('api.warehouse.outflow.so') }}/' + this.selectedWarehouse.id).then(function (data) {
                            this.SOs = data.data;
                        });
                    }
                }
            });
        });
    </script>
@endsection
