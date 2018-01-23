@extends('layouts.adminlte.master')

@section('title')
    @lang('price.index.title')
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ mix('adminlte/css/tooltipster.bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('adminlte/css/tooltipster-sideTip-shadow.min.css') }}">
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

@section('breadcrumbs')
    {!! Breadcrumbs::render('price_level_today_price') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">
                            <div class="text-right">
                                <select id="selectPriceLevel" name="selected_price_level" class="form-control">
                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                    @foreach($priceLevels as $priceLevelKey => $priceLevel)
                                        <option value="{{ $priceLevel->hId() }}">{{ $priceLevel->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <a id="btnPreview" href="{{ route('db.price.today.download') }}" class="btn btn-xs btn-default">@lang('buttons.print_preview_button')</a>
                                <a id="btnPreviewXLS" href="{{ route('db.price.today.download') }}?f=xls" class="btn btn-xs btn-default">@lang('buttons.download_excel_button')</a>
                                <a id="btnPreviewPDF" href="{{ route('db.price.today.download') }}?f=pdf" class="btn btn-xs btn-default">@lang('buttons.download_pdf_button')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if(count($productCategories) == 0)
                <div class="box box-info animated bounceInUp">
                    <div class="box-body">
                        <div>
                            @lang('labels.DATA_NOT_FOUND')
                        </div>
                    </div>
                </div>
            @endif

            @foreach($productCategories as $categoryKey => $productCategory)
                <div class="box box-info collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $productCategory->name }}</h3>
                        <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">@lang('price.index.table.header.stock_name')</th>
                                <th class="text-center">@lang('price.index.table.header.input_date')</th>
                                @foreach($priceLevels as $priceLevelKey => $priceLevel)
                                    <th class="text-center">{{ $priceLevel->name }}</th>
                                @endforeach
                                <th class="text-center">@lang('labels.ACTION')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($productCategory->stocks as $stockKey => $stock)
                                @if(count($stock->latestPrices()) == 0)
                                    <tr>
                                        <td>
                                            {{ $stock->product->name }}
                                            <span data-tooltip-content="#category_{{ $categoryKey }}_stock_{{ $stockKey }}_history" class="tooltips">
                                            <button type="button" class="btn btn-xs btn-info pull-right"><span class="fa fa-info-circle fa-fw"></span></button>
                                        </span>
                                        </td>
                                        <td class="text-center">-</td>
                                        @foreach($priceLevels as $priceLevelKey => $priceLevel)
                                            <td class="text-center">0</td>
                                        @endforeach
                                        <td class="text-center">
                                            <a class="btn btn-xs btn-primary"
                                               href="{{ route('db.price.stock', $stock->hId()) }}">@lang('buttons.update_button')</a>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>
                                            {{ $stock->product->name }}
                                            <span data-tooltip-content="#category_{{ $categoryKey }}_stock_{{ $stockKey }}_history" class="tooltips">
                                            <button type="button" class="btn btn-xs btn-info pull-right"><span class="fa fa-info-circle fa-fw"></span></button>
                                        </span>
                                        </td>
                                        <td class="text-center">{{ $stock->latestPrices()->first()->input_date }}</td>
                                        @foreach($priceLevels as $priceLevelKey => $priceLevel)
                                            <td class="text-center">
                                                {{ number_format($stock->latestPrices()->first(function ($price) use($priceLevel) { return $price->price_level_id === $priceLevel->id;})->price) }}
                                            </td>
                                        @endforeach
                                        <td class="text-center">
                                            <a class="btn btn-xs btn-primary"
                                               href="{{ route('db.price.stock', $stock->hId()) }}">@lang('buttons.update_button')</a>
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
                    <div class="box-footer">
                        @if(count($productCategory->stocks) != 0)
                            <a id="updateCategoryPriceButton" class="btn btn-primary"
                               href="{{ route('db.price.category', $productCategory->hId()) }}">@lang('buttons.update_button')
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function () {
            $('.tooltips').tooltipster({
                theme: 'tooltipster-shadow',
                interactive: true,
                side: ['right', 'left', 'top', 'bottom']
            });

            $('#selectPriceLevel').change(function() {
                $('#btnPreview, #btnPreviewXLS, #btnPreviewPDF').each(function() {
                    $(this).attr('href', URI($(this).attr('href')).addQuery('pl', $('#selectPriceLevel').val()));
                });
            });

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
                                text: "@lang('price.index.price_history.chart.subtitle')",
                                x: -20
                            },
                            xAxis: {
                                type: 'datetime',
                                tickInterval: moment.duration(1, 'hours').asMilliseconds()
                            },
                            yAxis: {
                                title: {
                                    text: "@lang('price.index.price_history.chart.price')"
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
                                valuePrefix: "Rp. ",
                                crosshairs: [true]
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
                                    pointInterval: moment.duration(1, 'hours').asMilliseconds(),
                                    data: [
                                            @foreach($stock->priceHistory() as $priceKey => $price)
                                            @if($price->price_level_id === $priceLevel->id)
                                        [moment.utc('{{ $price->input_date }}', 'YYYY-MM-DD HH:mm:ss').valueOf(), {{ $price->price }}],
                                        @endif
                                        @endforeach
                                    ]
                                },
                                    @endforeach
                                {
                                    name: '@lang('price.index.price_history.chart.market_price')',
                                    pointInterval: moment.duration(1, 'hours').asMilliseconds(),
                                    data: [
                                            @foreach($stock->priceHistory()->unique('input_date')->values() as $priceKey => $price)
                                        [moment.utc('{{ $price->input_date }}', 'YYYY-MM-DD HH:mm:ss').valueOf(), {{ $price->market_price }}],
                                        @endforeach
                                    ]
                                }
                            ]
                        });
                    @endforeach
                @endif
            @endforeach
        });
    </script>

    <script type="application/javascript" src="{{ mix('adminlte/js/highcharts.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/js/tooltipster.bundle.min.js') }}"></script>
@endsection