@extends('layouts.adminlte.master')

@section('title')
    @lang('report.monitoring.title')
@endsection

@section('page_title')
    <span class="fa fa-eye fa-fw"></span>&nbsp;@lang('report.monitoring.page_title')
@endsection

@section('page_title_desc')
    @lang('report.monitoring.page_title_desc')
@endsection

@section('custom_css')
    <style type="text/css">
        td.day {
            color: blue;
        }
    </style>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('report.monitoring.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            @if(Laratrust::can('report_monitoring-stockhistory'))
                                <li class="active">
                                    <a href="#tab_mon_stock" data-toggle="tab">
                                        @lang('stock_history.page_title')
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="#tab_mon_trx_po" data-toggle="tab">
                                    @lang('report.monitoring.componens.po.page_title')
                                </a>
                            </li>
                            <li>
                                <a href="#tab_mon_trx_so" data-toggle="tab">
                                    @lang('report.monitoring.componens.so.page_title')
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab_monitoring">
                            @if(Laratrust::can('report_monitoring-stockhistory'))
                                <div class="tab-pane active" id="tab_mon_stock">
                                    @include('report.monitoring_components.stock_histories')
                                </div>
                            @endif
                            <div class="tab-pane" id="tab_mon_trx_po">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="box">
                                            <div id="datetimepicker_po"></div>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                @include('report.monitoring_components.po')
                            </div>
                            <div class="tab-pane" id="tab_mon_trx_so">
                                @include('report.monitoring_components.so')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom_js')
    <script type="application/javascript">
        @if(Laratrust::can('report_monitoring-stockhistory'))
            var tabStockHistoryVue = new Vue({
                el: '#tab_mon_stock',
                data: {
                    lookup: JSON.parse('{!! json_encode(__('lookup')) !!}'),
                    stock_histories: {
                        data : [],
                        error : false,
                    },
                },
                methods: {
                    toggle: function(prefix, index){
                        $( prefix+index ).toggleClass( 'collapse' );
                    },
                    formatDecimal: function(value){
                        value = parseFloat(value);

                        if( value % 1 !== 0 )
                            value = value.toFixed(2);
                        return value;
                    },
                    fetchStockHistories: function () {
                        let vm = this;
                        axios.get('{{ route('api.report.mon.stockhistory.type.index') }}', {}).then((res) => {
                            vm.stock_histories.data = res.data;
                            vm.stock_histories.error = false;
                        }, (error) => {
                            vm.stock_histories.error = true;
                        })
                    },
                    download: function() {

                    }
                },
                mounted () {
                    this.fetchStockHistories();
                }
            });
        @endif
        @if(Laratrust::can('report_monitoring-po'))
            $(document).ready(function() {
                $.ajax({
                    url: '{{ route('api.purchase_order.list_po_dates') }}',
                    dataType: 'json',
                    error: function() {},
                    success: function(results){
                        $('#datetimepicker_po').datetimepicker({
                            format: 'DD/MM/YYYY',
                            inline: true,
                            sideBySide: true,
                            useCurrent: false
                        }).on('dp.change', function(e) {
                            tabPOVue.$data.purchaseOrderDateFilter = moment(e.date).format('YYYY-MM-DD');
                        });

                        let enabledDateLists = [];
                        $.each(results, function(index, element) {
                            enabledDateLists.push(element);
                        });

                        enabledDateLists.length > 0 ?
                            $('#datetimepicker_po').data('DateTimePicker').enabledDates(enabledDateLists):
                            $('#datetimepicker_po').data("DateTimePicker").minDate(moment()).maxDate(moment()).disabledDates([moment()]);
                    }
                });
            });

            var tabPOVue = new Vue({
                el: '#tab_mon_trx_po',
                data: {
                    lookup: JSON.parse('{!! json_encode(__('lookup')) !!}'),
                    purchaseOrderDateFilter: moment().format('YYYY-MM-DD'),
                    purchaseOrders: []
                },
                methods: {
                    toggle: function(prefix, index){
                        $( prefix+index ).toggleClass( 'collapse' );
                    },
                    formatDecimal: function(value){
                        value = parseFloat(value);

                        if( value % 1 !== 0 )
                            value = value.toFixed(2);
                        return value;
                    },
                    fetchPurchaseOrders: function (date) {
                        let vm = this;
                        axios.get('{{ route('api.purchase_order.purchase_order_by_date') }}?date=' + date).then(function (response) {
                            vm.purchaseOrders = vm.camelCasingKey(response.data);
                            vm.purchaseOrders = _.map(vm.purchaseOrders, function (purchaseOrder) {
                                purchaseOrder.poCreatedDate = purchaseOrder.poCreated.split(' ')[0];
                                return purchaseOrder;
                            })
                        });
                    }
                },
                watch: {
                    purchaseOrderDateFilter: function(value) {
                        this.fetchPurchaseOrders(value);
                    }
                },
                mounted: function() {
                    this.fetchPurchaseOrders(this.purchaseOrderDateFilter);
                }
            });
        @endif
        @if(Laratrust::can('report_monitoring-so'))
            var tabSOVue = new Vue({
                el: '#tab_mon_trx_so',
                data: {
                    lookup: JSON.parse('{!! json_encode(__('lookup')) !!}'),
                    salesOrderDateFilter: moment().format('YYYY-MM-DD'),
                    salesOrders: [],
                    loading: false
                },
                methods: {
                    toggle: function(prefix, index){
                        $( prefix+index ).toggleClass( 'collapse' );
                    },
                    formatDecimal: function(value){
                        value = parseFloat(value);

                        if( value % 1 !== 0 )
                            value = value.toFixed(2);
                        return value;
                    },
                    fetchSalesOrders: function (date) {
                        let vm = this;
                        vm.loading = true;
                        axios.get('{{ route('api.sales_order.sales_order_by_date') }}?date=' + date).then(function (response) {
                            vm.salesOrders = vm.camelCasingKey(response.data);
                            vm.salesOrders = _.map(vm.salesOrders, function (salesOrder) {
                                salesOrder.soCreatedDate = salesOrder.soCreated.split(' ')[0];
                                return salesOrder;
                            });
                            vm.loading = false;
                        });
                    }
                },
                watch: {
                    salesOrderDateFilter: function(value) {
                        this.fetchSalesOrders(value);
                    }
                },
                mounted: function() {
                    this.fetchSalesOrders(this.salesOrderDateFilter);
                }
            });
        @endif
    </script>
@endsection