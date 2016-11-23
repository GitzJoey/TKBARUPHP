@extends('layouts.adminlte.master')

@section('title')
    @lang('price.index.title')
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/css/tooltipster.bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/css/tooltipster-sideTip-shadow.min.css') }}">
    <style>
        .price_history {
            display: none;
        }
    </style>
@endsection

@section('page_title')
    <span class="fa fa-barcode fa-fw"></span>&nbsp;@lang('price.index.page_title')
@endsection

@section('page_title_desc')
    @lang('price.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @foreach($productCategories as $categoryKey => $productCategory)
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $productCategory->name }}</h3>
                @if(!empty($productCategory->stocks))
                    <a id="updateCategoryPriceButton" class="btn btn-primary pull-right"
                       href="{{ route('db.price.category', $productCategory->hId()) }}">Update</a>
                @endif
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">@lang('price.index.table.header.stock_name')</th>
                        <th class="text-center">@lang('price.index.table.header.input_date')</th>
                        @foreach($priceLevels as $priceLevelKey => $priceLevel)
                            <th class="text-center">{{$priceLevel->name}}</th>
                        @endforeach
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productCategory->stocks as $stockKey => $stock)
                        @if(count($stock->priceHistory()) == 0)
                            <tr>
                                <td><span data-tooltip-content="#category_{{ $categoryKey }}_stock_{{ $stockKey }}_history"
                                          class="tooltips">{!! $stock->product->name !!}</span></td>
                                <td class="text-center">-</td>
                                @foreach($priceLevels as $priceLevelKey => $priceLevel)
                                    <td class="text-center">0</td>
                                @endforeach
                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary"
                                       href="{{ route('db.price.stock', $stock->hId()) }}">Update</a>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td><span data-tooltip-content="#category_{{ $categoryKey }}_stock_{{ $stockKey }}_history"
                                          class="tooltips">{!! $stock->product->name !!}</span></td>
                                <td class="text-center">{{ $stock->latestPrices()->first()->input_date }}</td>
                                @foreach($priceLevels as $priceLevelKey => $priceLevel)
                                    <td class="text-center">{{
                                                number_format($stock->latestPrices()->first(function ($price) use($priceLevel){
                                                    return $price->price_level_id === $priceLevel->id;
                                                })->price)
                                            }}
                                    </td>
                                @endforeach
                                <td class="text-center">
                                    <a class="btn btn-xs btn-primary"
                                       href="{{ route('db.price.stock', $stock->hId()) }}">Update</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

                <div class="price_history">
                    @foreach($productCategory->stocks as $stockKey => $stock)
                        <div id="category_{{ $categoryKey }}_stock_{{ $stockKey }}_history"
                             style="width:50%; height:300px;"></div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function () {
            $('.tooltips').tooltipster({
                theme: 'tooltipster-shadow',
                interactive: true,
                side: ['right', 'left', 'top', 'bottom']
            });
        });

        $(function () {
            @foreach($productCategories as $categoryKey => $productCategory)
                @if(!empty($productCategory->stocks))
                    @foreach($productCategory->stocks as $stockKey => $stock)
                        Highcharts.chart('category_{{ $categoryKey }}_stock_{{ $stockKey }}_history', {
                chart: {
                    type: 'spline'
                },
                title: {
                    text: '{{ $stock->product->name }}',
                    x: -20
                },
                subtitle: {
                    text: 'Price History in last 5 days',
                    x: -20
                },
                xAxis: {
                    type: 'datetime',
                    tickInterval: moment.duration(0.5, 'minutes').asMilliseconds()
                },
                yAxis: {
                    title: {
                        text: 'Price (IDR)'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }],
                    min: 0
                },
                plotOptions: {
                    spline: {
                        marker: {
                            enabled: true
                        }
                    }
                },
                tooltip: {
                    pointFormat: "Rp. {point.y:,.0f}",
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [
                        @foreach($priceLevels as $priceLevelKey => $priceLevel)
                    {
                        name: '{{ $priceLevel->name }}',
                        pointInterval: moment.duration(0.5, 'minutes').asMilliseconds(),
                        data: [
                                @foreach($stock->priceHistory() as $priceKey => $price)
                                @if($price->price_level_id === $priceLevel->id)
                            [moment.utc('{{ $price->input_date }}', 'YYYY-MM-DD HH:mm:ss').valueOf(), {{ $price->price }}],
                            @endif
                            @endforeach
                        ]
                    },
                    @endforeach
                ]
            });
            @endforeach
            @endif
            @endforeach
        });
    </script>
    <script type="application/javascript" src="{{ asset('adminlte/js/highcharts.js') }}"></script>
    <script type="application/javascript" src="{{ asset('adminlte/js/tooltipster.bundle.min.js') }}"></script>
@endsection