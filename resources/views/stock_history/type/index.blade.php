@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.revise.index.title')
@endsection

@section('page_title')
    <span class="fa fa-code-fork fa-rotate-180 fa-fw"></span>&nbsp;@lang('stock_history.page_title')
@endsection

@section('page_title_desc')
    @lang('purchase_order.revise.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('purchase_order') !!}
@endsection

@section('content')
    <div id="vueTable">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('stock_history.header_title')</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="5%">&nbsp;</td>
                            <td class="text-center" width="95%">@lang('stock_history.table.header.name')</td>
                        </tr>
                        <template v-for="(prodtype, prodtypeIndex) in prodtypes.data">
                            <tr class="accordion-toggle" v-on:click="toggle('#row', prodtype.id)">
                                <td class="text-center valign-middle"><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                                <td class="text-left">@{{ prodtype.name }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="hiddenRow" style="padding-left: 15px; padding-top: 15px;">
                                    <div class="accordian-body collapse" v-bind:id="'row'+prodtype.id ">
                                        <strong>@lang('stock_history.stock_history')</strong> <br/>
                                        <p v-if=" !prodtype.stocks.length ">@lang('stock_history.theres_no_data')</p>
                                        <template v-if=" prodtype.stocks.length " v-for="(stock, stockIndex) in prodtype.stocks">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>&nbsp;</th>
                                                    <th class="text-center">@lang('stock_history.table.header.code')</th>
                                                    <th class="text-center">@lang('stock_history.table.header.name')</th>
                                                    <th class="text-center">@lang('stock_history.table.header.short_code')</th>
                                                    <th class="text-center">@lang('stock_history.table.header.description')</th>
                                                    <th class="text-center">@lang('stock_history.table.header.qty')</th>
                                                    <th class="text-center">@lang('stock_history.table.header.current_qty')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-on:click="toggle('#rowstock', stock.id)" >
                                                        <td width="5%" class="valign-middle text-center"><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                                                        <td width="10%">@{{ stock.purchase_order.code }}</td>
                                                        <td width="15%">@{{ stock.product.name }}</td>
                                                        <td width="10%" class="text-center">@{{ stock.product.short_code }}</td>
                                                        <td width="20%">@{{ stock.product.description }}</td>
                                                        <td width="12%">@{{ formatDecimal(stock.quantity) }}</td>
                                                        <td width="13%">@{{ formatDecimal(stock.current_quantity) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="8" class="hiddenRow" style="padding-left: 15px; padding-top: 15px;">
                                                            <div class="accordian-body collapse" v-bind:id="'rowstock'+ stock.id">
                                                                <strong>@lang('stock_history.sales_history')</strong> <br/>
                                                                <p v-if=" !stock.so_items.length ">@lang('stock_history.theres_no_data')</p>
                                                                <table v-if=" stock.so_items.length " class="table table-bordered">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="text-center">@lang('stock_history.table.header.date')</th>
                                                                        <th class="text-center">@lang('stock_history.table.header.so_code')</th>
                                                                        <th class="text-center">@lang('stock_history.table.header.customer')</th>
                                                                        <th class="text-center">@lang('stock_history.table.header.qty')</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="(so_item, soItemIndex) in stock.so_items">
                                                                            <td width="30%" class="text-center">@{{ so_item.itemable.so_created }}</td>
                                                                            <td width="25%">@{{ so_item.itemable.code }}</td>
                                                                            <td width="25%">@{{ so_item.itemable.customer_type == 'CUSTOMERTYPE.R' ? so_item.itemable.customer.name : so_item.itemable.walk_in_cust }}</td>
                                                                            <td width="20%">@{{ formatDecimal(so_item.quantity) }} @{{ so_item.selected_unit.unit.name }}</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </template>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                {!! $prodtypeDdL->render() !!}
            </div>
        </div>
    </div>
@endsection


@section('custom_js')
    <script type="application/javascript">

         var soAppVue = new Vue({
            el: '#vueTable',
            data: {
                prodtypes: JSON.parse('{!! htmlspecialchars_decode($prodtypeDdL->toJson()) !!}'),
            },
            methods: {
                toggle: function(prefix, index){
                    $( prefix+index ).toggleClass( 'collapse' );
                },
                formatDecimal: function(value){
                    value = parseFloat(value);
                    if( value % 1 !== 0 )
                        value = value.toFixed(2);
                    return value.toFixed(0);
                },
            }
        });
        setInterval(function(){
            console.log('refresh data');
            var type_ids = [];
            $.map( soAppVue.prodtypes.data, function( data, i ) {
                type_ids.push(data.id);
            });
            $.ajax({
                    type: "GET",
                    url: "{{ route('db.stockhistory.type.index') }}",
                    cache: false,
                    dataType: "json",
                    data: {
                        type_ids: type_ids,
                        to_json: true
                    },
                    beforeSend: function(xhr) {
                        //
                 }
                }).done(function(result) {
                    soAppVue.prodtypes.data = result.data;
                });
        }, (1*60000) );
    </script>
@endsection