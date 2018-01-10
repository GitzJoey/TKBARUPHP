@extends('layouts.adminlte.master')

@section('title')
    @lang('dashboard.title')
@endsection

@section('page_title')
    <span class="fa fa-dashboard fa-fw"></span>&nbsp;@lang('dashboard.page_title')
@endsection

@section('page_title_desc')
    @lang('dashboard.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}
@endsection

@section('content')
    <div id="unfinishedSettingsNotice"></div>

    <div class="row">
        <div class="col-lg-4 col-xs-12">
            <div class="small-box bg-aqua" id="last-opname" v-cloak>
                <div class="inner">
                    <h3>@{{ last_opname_humanize }}</h3>
                    <p>@{{ last_opname }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-pricetags"></i>
                </div>
                <a href="{{ route('db.warehouse.stockopname.index') }}" class="small-box-footer">@lang('dashboard.last_opname.title')</a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="small-box bg-red" id="last-bank-upload" v-cloak>
                <div class="inner">
                    <h3>@{{ last_bank_upload_humanize }}</h3>
                    <p>@{{ last_bank_upload }}</p>
                </div>
                <div class="icon">
                    <i class="icon ion-ios-cash"></i>
                </div>
                <a href="{{ route('db.bank.upload') }}" class="small-box-footer">@lang('dashboard.last_bank_upload.title')</a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="small-box bg-yellow" id="last-price-update" v-cloak>
                <div class="inner">
                    <h3>@{{ last_price_update_humanize }}</h3>
                    <p>@{{ last_price_update }}</p>
                </div>
                <div class="icon">
                    <i class="ion ion-md-trending-up"></i>
                </div>
                <a href="#" class="small-box-footer">@lang('dashboard.last_price_update.title')</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10">
                            @lang('labels.DATA_NOT_FOUND')
                        </div>
                        <div class="col-md-2">
                            <div class="text-right">
                                <a href="{{ route('db.daily_log') }}" class="btn btn-xs btn-default">@lang('dashboard.daily_log.button')</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="progress" style="height:5px;">
                    <div class="progress-bar" style="width: 20%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('dashboard.number_of_created_so.title')</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="number-of-created-po-so-chart-container"></div>
                </div>
                <div class="box-footer clearfix"></div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('dashboard.so_total_amount.title')</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="total-so-amount-chart-container"></div>
                </div>
                <div class="box-footer clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-xs-12" id="due-purchase-order" v-cloak>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('dashboard.due_purchase_orders.title') - @{{ due_payment_day }}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-wrench"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a v-on:click.capture='fetchDuePurchaseOrders'>@lang('dashboard.due_purchase_orders.options.all')</a></li>
                                <li><a v-on:click.capture='fetchDuePurchaseOrders(1)'>@lang('dashboard.due_purchase_orders.options.1day')</a></li>
                                <li><a v-on:click.capture='fetchDuePurchaseOrders(3)'>@lang('dashboard.due_purchase_orders.options.3days')</a></li>
                                <li><a v-on:click.capture='fetchDuePurchaseOrders(5)'>@lang('dashboard.due_purchase_orders.options.5days')</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>@lang('dashboard.due_purchase_orders.table.po_code')</th>
                                <th>@lang('dashboard.due_purchase_orders.table.supplier_name')</th>
                                <th>@lang('dashboard.due_purchase_orders.table.payment_due_date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="duePurchaseOrder in duePurchaseOrders">
                                <td><a v-bind:href="'{{ route('db.po.payment.index') }}?pocode=' + duePurchaseOrder.code">@{{ duePurchaseOrder.code }}</a></td>
                                <td>@{{ duePurchaseOrder.supplier.name }}</td>
                                <td>@{{ countDueDate(duePurchaseOrder.receipts[0].receipt_date, duePurchaseOrder.supplier.payment_due_day) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="{{ route('db.po.payment.index') }}" class="btn btn-sm btn-default btn-flat pull-right">@lang('dashboard.due_purchase_orders.button.view_all_purchase_orders')</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12" id="due-sales-order" v-cloak>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('dashboard.due_sales_orders.title') - @{{ due_payment_day }}</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-wrench"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a v-on:click.capture='fetchDueSalesOrders'>@lang('dashboard.due_sales_orders.options.all')</a></li>
                                <li><a v-on:click.capture='fetchDueSalesOrders(1)'>@lang('dashboard.due_sales_orders.options.1day')</a></li>
                                <li><a v-on:click.capture='fetchDueSalesOrders(3)'>@lang('dashboard.due_sales_orders.options.3days')</a></li>
                                <li><a v-on:click.capture='fetchDueSalesOrders(5)'>@lang('dashboard.due_sales_orders.options.5days')</a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>@lang('dashboard.due_sales_orders.table.so_code')</th>
                                <th>@lang('dashboard.due_sales_orders.table.customer_name')</th>
                                <th>@lang('dashboard.due_sales_orders.table.payment_due_date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="dueSalesOrder in dueSalesOrders">
                                <td><a v-bind:href="'{{ route('db.so.payment.index') }}?socode=' + dueSalesOrder.code">@{{ dueSalesOrder.code }}</a></td>
                                <td>@{{ dueSalesOrder.customer.name }}</td>
                                <td>@{{ countDueDate(dueSalesOrder.delivers[0].deliver_date, dueSalesOrder.customer.payment_due_day) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="{{ route('db.po.payment.index') }}" class="btn btn-sm btn-default btn-flat pull-right">@lang('dashboard.due_sales_orders.button.view_all_sales_orders')</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xs-12" id="almost-due-giro" v-cloak>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('dashboard.almost_due_giro.title')</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <li class="item" v-for="dueGiro in dueGiros">
                            <div class="row">
                                <div class="col-md-8">
                                    <div style="font-weight: 600">@{{ dueGiro.bank.name }}</div>
                                    <span style="font-size: smaller;font-weight: bold;color: black;display: block">@{{ dueGiro.printed_name }}</span>
                                    <span style="font-size: smaller">@lang('dashboard.almost_due_giro.label.serial_number'): @{{ dueGiro.serial_number }}</span>
                                </div>
                                <div class="col-md-4" style="font-size: large; padding: 15px">@{{ dueGiro.amount }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="box-footer text-center">
                    <a href="{{ route('db.bank.giro') }}" class="uppercase">@lang('dashboard.almost_due_giro.link.view_all_giro')</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12" id="upcoming-events" v-cloak>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('dashboard.upcoming_events.title')</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <li class="item" v-for="eventCalendar in eventCalendars">
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="font-weight: 600">@{{ eventCalendar.event_title }}</div>
                                    <span style="font-size: smaller">@{{ eventCalendar.start_date }} - @{{ eventCalendar.end_date }}</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="box-footer text-center">
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-12" id="passive-customers" v-cloak>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('dashboard.passive_customers.title')</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>@lang('dashboard.passive_customers.table.header.customer')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="passiveCustomer in passiveCustomers">
                                <td><a>@{{ passiveCustomer.name }}</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12" id="unreceived-purchase-orders" v-cloak>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('dashboard.unreceived_po.title')</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <li class="item" v-for="unreceivedPurchaseOrder in unreceivedPurchaseOrders">
                            <div class="row">
                                <div class="col-md-8">
                                    <div style="font-weight: bold">@{{ unreceivedPurchaseOrder.supplier.name }}</div>
                                    <span style="font-size: smaller;display: block">
                                        <a v-bind:href="'{{ route('db.warehouse.inflow') }}/' + unreceivedPurchaseOrder.id">@{{ unreceivedPurchaseOrder.code }}</a> | @{{ unreceivedPurchaseOrder.shipping_date }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span style="font-weight: bold;display: block">@{{ unreceivedPurchaseOrder.totalAmount }}</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="box-footer text-center">
                    <a href="{{ route('db.warehouse.inflow.index') }}" class="uppercase">@lang('dashboard.unreceived_po.link.view_all_inflow')</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12" id="undelivered-sales-orders" v-cloak>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('dashboard.undelivered_so.title')</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                        <li class="item" v-for="undeliveredSalesOrder in undeliveredSalesOrders">
                            <div class="row">
                                <div class="col-md-8">
                                    <div style="font-weight: bold">@{{ undeliveredSalesOrder.customer.name }}</div>
                                    <span style="font-size: smaller;display: block">
                                        <a v-bind:href="'{{ route('db.warehouse.outflow') }}/' + undeliveredSalesOrder.id">@{{ undeliveredSalesOrder.code }}</a> | @{{ undeliveredSalesOrder.shipping_date }}</span>
                                </div>
                                <div class="col-md-4">
                                    <span style="font-weight: bold;display: block">@{{ undeliveredSalesOrder.totalAmount }}</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="box-footer text-center">
                    <a href="{{ route('db.warehouse.outflow.index') }}" class="uppercase">@lang('dashboard.undelivered_so.link.view_all_outflow')</a>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            checkUnfinish();

            @if (LaravelLocalization::getCurrentLocale() == 'id')
                Highcharts.setOptions({
                    lang: {
                        numericSymbols: ['Rb','Jt','G','T','P','E'],
                        shortMonths: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des']
                    }
                });
            @endif

            Highcharts.chart('total-so-amount-chart-container', {
                chart: {
                    animation: Highcharts.svg,
                    marginTop: 75,
                    events: {
                        load: function () {
                            // set up the updating of the sales order chart
                            var salesOrderAmountSeries = this.series[0];
//                            setInterval(function () {
                                $.ajax({
                                    url: '{{ route('api.sales_order.total_sales_order_amount_per_day') }}',
                                    dataType: 'json',
                                    error: function(){},
                                    success: function(results){
                                        var data = [];
                                        while(results.length > 0){
                                            var result = results.pop();
                                            data.push([moment.utc(result.date, 'YYYY-MM-DD HH:mm:ss').valueOf(), result.totalSOAmount]);
                                        }
                                        salesOrderAmountSeries.setData(data);
                                    }
                                });
//                            }, 50000);
                        }
                    }
                },
                title: {
                    text: '@lang('dashboard.so_total_amount.title')'
                },
                xAxis: {
                    type: 'datetime',
                    tickInterval: 24 * 3600 * 1000,
                    tickPixelInterval: 150
                },
                yAxis: {
                    title: 'Total Amount',
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }],
                    minTickInterval: 1
                },
                tooltip: {
                    formatter: function () {
                        return Highcharts.dateFormat('%A, %b %e, %Y', this.x) + '<br/>' +
                            'Rp. ' + Highcharts.numberFormat(this.y, 2);
                    }
                },
                exporting: {
                    enabled: false
                },
                series: [{
                    name: 'Sales Order',
                    data: []
                }]
            });

            Highcharts.chart('number-of-created-po-so-chart-container', {
                chart: {
                    type: 'bar',
                    marginTop: 75,
                    events: {
                        load: function () {
                            // set up the updating of the sales order chart
                            var salesOrderNumberSeries = this.series[0];
//                            setInterval(function () {
                                $.ajax({
                                    url: '{{ route('api.sales_order.number_of_created_sales_order_per_day') }}',
                                    dataType: 'json',
                                    error: function(){},
                                    success: function(results){
                                        var data = [];
                                        while(results.length > 0){
                                            var result = results.pop();
                                            data.push([moment.utc(result.date, 'YYYY-MM-DD HH:mm:ss').valueOf(), result.numberOfCreatedSO]);
                                        }
                                        salesOrderNumberSeries.setData(data);
                                    }
                                });
//                            }, 50000);
                        }
                    }
                },
                title: {
                    text: '@lang('dashboard.number_of_created_so.title')'
                },
                xAxis: {
                    type: 'datetime',
                    tickInterval: 24 * 3600 * 1000,
                    tickPixelInterval: 150
                },
                yAxis: {
                    title: 'Number',
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }],
                    minTickInterval: 1
                },
                exporting: {
                    enabled: false
                },
                series: [{
                    name: 'Sales Order',
                    data: []
                }]
            });

            function checkUnfinish() {
                $.ajax({
                    url: '{{ route('api.get.unfinish.store') }}',
                    type: "GET",
                    success: function (response) {
                        new noty({
                            text: '<div class=\"text-center\"><strong>Unfinish Store Detected</strong></div>',
                            container: '#unfinishedSettingsNotice',
                            type: 'info',
                            timeout: 10000,
                            theme: 'relax',
                            progressBar: true
                        }).show();
                    }
                });
                $.ajax({
                    url: '{{ route('api.get.unfinish.warehouse') }}',
                    type: "GET",
                    success: function (response) {
                        new noty({
                            text: '<div class=\"text-center\"><strong>Unfinish Warehouse Detected</strong></div>',
                            container: '#unfinishedSettingsNotice',
                            type: 'info',
                            timeout: 10000,
                            theme: 'relax',
                            progressBar: true
                        }).show();
                    }
                });
            }

            var app = new Vue({
                el: '#upcoming-events',
                data: {
                    eventCalendars: []
                },
                mounted() {
                    return this.fetchEventCalendars();
                },
                methods: {
                    fetchEventCalendars: function() {
                        axios.get('{{ route('api.user.get.calendar') }}?id={{ Auth::user()->id }}').then(response => {
                            // get body data
                            this.eventCalendars = response.data.userCalendar;
                    }, response => {
                            // error callback
                        });
                    }
                }
            });

            new Vue({
                el: '#due-purchase-order',
                data: {
                    duePurchaseOrders: [],
                    due_payment_day: 'All'
                },
                mounted() {
                    return this.fetchDuePurchaseOrders();
                },
                methods: {
                    fetchDuePurchaseOrders: function(due_payment_day) {
                        var dod = '';

                        if(due_payment_day > 1)
                            this.due_payment_day = due_payment_day + ' Days';
                        else if(due_payment_day == 1)
                            this.due_payment_day = due_payment_day + ' Day';
                        else
                            this.due_payment_day = 'All';

                        if(due_payment_day != undefined)
                            dod = '?dod='+ due_payment_day;

                        axios.get('{{ route('api.purchase_order.due_purchase_order') }}' + dod).then(response => {
                            // get body data
                            this.duePurchaseOrders = response.data;
                    }, response => {
                            // error callback
                        });
                    },
                    countDueDate: function(date, payment_due_day) {
                        return moment(date).add(payment_due_day, 'days').format('YYYY-MM-DD');
                    }
                }
            });

            new Vue({
                el: '#due-sales-order',
                data: {
                    dueSalesOrders: [],
                    due_payment_day: 'All'
                },
                mounted() {
                    return this.fetchDueSalesOrders();
                },
                methods: {
                    fetchDueSalesOrders: function(due_payment_day) {
                        var dod = '';

                        if(due_payment_day > 1)
                            this.due_payment_day = due_payment_day + ' Days';
                        else if(due_payment_day == 1)
                            this.due_payment_day = due_payment_day + ' Day';
                        else
                            this.due_payment_day = 'All';

                        if(due_payment_day != undefined)
                            dod = '?dod='+ due_payment_day;

                        axios.get('{{ route('api.sales_order.due_sales_order') }}' + dod).then(response => {
                            // get body data
                            this.dueSalesOrders = response.data;
                    }, response => {
                            // error callback
                        });
                    },
                    countDueDate: function(date, payment_due_day) {
                        return moment(date).add(payment_due_day, 'days').format('YYYY-MM-DD');
                    }
                }
            });

            new Vue({
                el: '#last-opname',
                data: {
                    last_opname_humanize: '',
                    last_opname: '',
                },
                mounted() {
                    return this.fetchLastOpname();
                },
                methods: {
                    fetchLastOpname: function() {
                        axios.get('{{ route('api.warehouse.stock_opname.last') }}').then(response => {
                            // get body data
                            this.last_opname = response.data;
                            if(this.last_opname.length > 0) {
                                moment.locale('{{ LaravelLocalization::getCurrentLocale() }}');
                                this.last_opname_humanize = moment(this.last_opname[0].opname_date).fromNow();
                                this.last_opname = moment(this.last_opname[0].opname_date).format('YYYY-MM-DD');
                            }
                            else {
                                this.last_opname_humanize = '@lang('dashboard.last_opname.label.never')';
                                this.last_opname = '@lang('dashboard.last_opname.label.no_data_found')';
                            }
                        }, response => {
                            // error callback
                        });
                    }
                }
            });

            new Vue({
                el: '#last-bank-upload',
                data: {
                    last_bank_upload_humanize: '',
                    last_bank_upload: '',
                },
                mounted() {
                    return this.fetchLastBankUpload();
                },
                methods: {
                    fetchLastBankUpload: function() {
                        axios.get('{{ route('api.bank.upload.last') }}').then(response => {
                        // get body data
                        this.last_bank_upload = response.data;

                        if(this.last_bank_upload.length > 0) {
                            moment.locale('{{ LaravelLocalization::getCurrentLocale() }}');
                            this.last_bank_upload_humanize = moment(this.last_bank_upload[0].created_at).fromNow();
                            this.last_bank_upload = moment(this.last_bank_upload[0].created_at).format('YYYY-MM-DD');
                        }
                        else
                        {
                            this.last_bank_upload_humanize = '@lang('dashboard.last_bank_upload.label.never')';
                            this.last_bank_upload = '@lang('dashboard.last_bank_upload.label.no_data_found')';
                        }
                    }, response => {
                            // error callback
                        });
                    }
                }
            });

            new Vue({
                el: '#last-price-update',
                data: {
                    last_price_update_humanize: '',
                    last_price_update: '',
                },
                mounted() {
                    return this.fetchLastPriceUpdate();
                },
                methods: {
                    fetchLastPriceUpdate: function() {
                        axios.get('{{ route('api.price.last_update') }}').then(response => {
                            // get body data
                            this.last_price_update = response.data;

                            if(this.last_price_update.date) {
                                moment.locale('{{ LaravelLocalization::getCurrentLocale() }}');
                                this.last_price_update_humanize = moment(this.last_price_update.date).fromNow();
                                this.last_price_update = moment(this.last_price_update.date).format('DD-MM-YYYY HH:mm A');
                            }
                            else
                            {
                                this.last_price_update_humanize = '@lang('dashboard.last_price_update.label.never')';
                                this.last_price_update = '@lang('dashboard.last_price_update.label.no_data_found')';
                            }
                        }, response => {
                            // error callback
                        });
                    }
                }
            });

            new Vue({
                el: '#almost-due-giro',
                data: {
                    dueGiros: [],
                },
                mounted() {
                    return this.fetchDueGiros();
                },
                methods: {
                    fetchDueGiros: function() {
                        axios.get('{{ route('api.giro.due_giro') }}').then(response => {
                            // get body data
                            this.dueGiros = response.data;
                    }, response => {
                            // error callback
                        });
                    }
                }
            });

            var app = new Vue({
                el: '#passive-customers',
                data: {
                    passiveCustomers: []
                },
                mounted() {
                    return this.fetchPassiveCustomers();
                },
                methods: {
                    fetchPassiveCustomers: function() {
                        axios.get('{{ route('api.customer.passive_customer') }}').then(response => {
                            // get body data
                            this.passiveCustomers = response.data;
                        }, response => {
                            // error callback
                        });
                    }
                }
            });

            new Vue({
                el: '#unreceived-purchase-orders',
                data: {
                    unreceivedPurchaseOrders: [],
                },
                mounted() {
                    return this.fetchUnreceivedPurchaseOrder();
                },
                methods: {
                    fetchUnreceivedPurchaseOrder: function() {
                        axios.get('{{ route('api.purchase_order.unreceived_purchase_order') }}').then(response => {
                            // get body data
                            this.unreceivedPurchaseOrders = response.data;
                    }, response => {
                            // error callback
                        });
                    }
                }
            });

            new Vue({
                el: '#undelivered-sales-orders',
                data: {
                    undeliveredSalesOrders: [],
                },
                mounted() {
                    return this.fetchUndeliveredSalesOrder();
                },
                methods: {
                    fetchUndeliveredSalesOrder: function() {
                        axios.get('{{ route('api.sales_order.undelivered_sales_order') }}').then(response => {
                            // get body data
                            this.undeliveredSalesOrders = response.data;
                    }, response => {
                            // error callback
                        });
                    }
                }
            });

        });
    </script>
    <script type="application/javascript" src="{{ mix('adminlte/js/highcharts.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/js/tooltipster.bundle.min.js') }}"></script>
@endsection
