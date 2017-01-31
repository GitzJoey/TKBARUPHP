@extends('layouts.adminlte.master')

@section('title')
    @lang('price.category.title')
@endsection

@section('page_title')
    <span class="fa fa-barcode fa-fw"></span>&nbsp;@lang('price.category.page_title')
@endsection

@section('page_title_desc')
    @lang('price.category.page_title_desc')
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="categoryPriceVue">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('price.category.header.title', ['product_type' => $currentProductType->name])</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" action="{{ route('db.price.category', $currentProductType->hId()) }}"
                      method="post" data-parsley-validate="parsley">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group">
                            <label for="inputDate"
                                   class="col-sm-2 control-label">@lang('price.category.field.input_date')</label>
                            <div class="col-sm-4">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="inputDate" name="input_date"
                                           data-parsley-required="true">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="inputMarketPrice"
                                   class="col-sm-2 control-label">@lang('price.category.field.market_price')</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control text-right" name="market_price"
                                       data-parsley-required="true"
                                       data-parsley-pattern="^\d+(,\d+)?\.?\d*$" id="inputMarketPrice" autonumeric
                                       v-model="marketPrice"
                                       v-on:keyup="updatePrice(marketPrice)"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">@lang('price.category.field.price')</label>
                            @foreach($priceLevels as $key => $priceLevel)
                                <div class="col-sm-2">
                                    <input type="text" class="form-control text-right" name="price[]"
                                           data-parsley-required="true" data-parsley-pattern="^\d+(,\d+)?\.?\d*$"
                                           autonumeric v-model="price.price{{ $key }}" id="inputPrice_{{ $key }}"
                                           aria-describedby="helpBlock">
                                    <span id="helpBlock" class="help-block" title="{{ 'Type : ' . Lang::get('lookup.' . $priceLevel->type) . '&#013;' .
                                        ($priceLevel->type === 'PRICELEVELTYPE.INC' ?
                                        'Value : ' . $priceLevel->increment_value :
                                        'Value : ' . $priceLevel->percentage_value . '%') }}">
                                        @lang('price.category.price_level.' . $priceLevel->name)
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-toolbar">
                                <button id="submitButton" type="submit" name="submit"
                                        class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>
                                <a id="cancelButton" class="btn btn-primary pull-right"
                                   href="{{ route('db.price.today') }}">@lang('buttons.cancel_button')</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function () {
            var app = new Vue({
                el: '#categoryPriceVue',
                data: {
                    priceLevels: JSON.parse('{!! htmlspecialchars_decode($priceLevels) !!}'),
                    marketPrice: $("input[id='inputMarketPrice']").val(),
                    price: []
                },
                mounted: function() {
                    $("#inputDate").datetimepicker({
                        format: "DD-MM-YYYY hh:mm A",
                        defaultDate: moment()
                    });
                },
                methods: {
                    updatePrice: function(marketPrice) {
                        if ($.isNumeric(marketPrice))
                            marketPrice = parseFloat(marketPrice);
                        else
                            marketPrice = 0;

                        console.log('Inputed market price : ' + marketPrice);

                        for (var i = 0; i < this.priceLevels.length; i++) {
                            console.log('Price level ' + (i + 1));

                            var priceInput = $("#inputPrice_" + i);
                            var priceLevel = this.priceLevels[i];
                            var price = 0;

                            console.log('Price level type : ' + priceLevel.type);

                            if (priceLevel.type === 'PRICELEVELTYPE.INC') {
                                console.log('Increment value : ' + priceLevel.increment_value);
                                price = parseFloat(priceLevel.increment_value) + marketPrice;
                            }
                            else {
                                console.log('Percentage value : ' + priceLevel.percentage_value);
                                price = parseFloat(priceLevel.percentage_value) * marketPrice + marketPrice;
                            }

                            console.log('Calculated price : ' + price);

                            priceInput.val(numeral(price).format('0,0'));
                        }
                    }
                }
            });
        });
    </script>
@endsection
