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
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>150</h3>
                    <p>&nbsp;&nbsp;&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-disc"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>&nbsp;&nbsp;&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-stats"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>44</h3>
                    <p>&nbsp;&nbsp;&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>65</h3>
                    <p>&nbsp;&nbsp;&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-pie"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-6 col-xs-6">
            <div id="number-of-created-po-so-chart-container"></div>
        </div>

        <div class="col-lg-6 col-xs-6">
            <div id="total-so-amount-chart-container"></div>
        </div>
    </div>

    @for ($i = 0; $i < 100; $i++)
        <br/>
    @endfor
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            checkUnfinish();

            Highcharts.chart('total-so-amount-chart-container', {
                chart: {
                    animation: Highcharts.svg,
                    marginTop: 75,
                    events: {
                        load: function () {
                            // set up the updating of the sales order chart
                            var salesOrderAmountSeries = this.series[0];
                            setInterval(function () {
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
                            }, 5000);
                        }
                    }
                },
                title: {
                    text: 'Sales Order Total Amount'
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
                    marginTop: 75,
                    events: {
                        load: function () {
                            // set up the updating of the sales order chart
                            var salesOrderNumberSeries = this.series[0];
                            setInterval(function () {
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
                            }, 5000);
                        }
                    }
                },
                title: {
                    text: 'Number of Created Sales Order'
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
                        $('#unfinishedSettingsNotice').noty({
                            text: 'Unfinish Store Detected',
                            type: 'warning',
                            timeout: 30000,
                            progressBar: true
                        });
                    }
                });
                $.ajax({
                    url: '{{ route('api.get.unfinish.warehouse') }}',
                    type: "GET",
                    success: function (response) {
                        $('#unfinishedSettingsNotice').noty({
                            text: 'Unfinish Warehouse Detected',
                            type: 'warning',
                            timeout: 30000,
                            progressBar: true
                        });
                    }
                });
            }
            
        });
    </script>
    <script type="application/javascript" src="{{ asset('adminlte/js/highcharts.js') }}"></script>
    <script type="application/javascript" src="{{ asset('adminlte/js/tooltipster.bundle.min.js') }}"></script>
@endsection