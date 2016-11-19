@extends('layouts.adminlte.master')

@section('title')
    @lang('price.index.title')
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

    @foreach($productCategories as $key => $productCategory)
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $productCategory->name }}</h3>
            <a id="updateCategoryPriceButton" class="btn btn-primary pull-right" href="{{ route('db.price.category', $productCategory->hId()) }}">Update Price</a>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('price.index.table.header.stock_name')</th>
                    <th class="text-center">@lang('price.index.table.header.input_date')</th>
                    @foreach($priceLevels as $key => $priceLevel)
                        <th class="text-center">{{$priceLevel->name}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                    @foreach($productCategory->stocks as $key => $stock)
                        @if(count($stock->prices) > 0)
                            <tr>
                                <td>{{  $stock->product->name }}</td>
                                <td>{{ $stock->prices[0]->input_date }}</td>
                                @foreach($stock->prices as $key => $price)
                                    <td>{{ $price->price }}</td>
                                @endforeach
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
@endsection