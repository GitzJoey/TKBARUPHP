@extends('layouts.adminlte.master')

@section('title')
    @lang('product.show.title')
@endsection

@section('page_title')
    <span class="fa fa-cubes fa-fw"></span>&nbsp;@lang('product.show.page_title')
@endsection

@section('page_title_desc')
    @lang('product.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_product_show', $product->hId()) !!}
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('product.show.header.title') : {{ $product->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputType" class="col-sm-2 control-label">@lang('product.field.type')</label>
                        <div class="col-sm-10">
                            <label id="inputType" class="control-label">
                                <span class="control-label-normal">{{ $product->type->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCategory" class="col-sm-2 control-label">@lang('product.field.category')</label>
                        <div class="col-sm-10">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20%">@lang('product.show.table.category.header.code')</th>
                                        <th width="30%">@lang('product.show.table.category.header.name')</th>
                                        <th width="40%">@lang('product.show.table.category.header.description')</th>
                                        <th width="10%">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->productCategories as $pc)
                                        <tr>
                                            <td>{{ $pc->code }}</td>
                                            <td>{{ $pc->name }}</td>
                                            <td>{{ $pc->description }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('product.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputName" class="control-label">
                                <span class="control-label-normal">{{ $product->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputProductImage" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                            @if(!empty($product->image_path))
                                <img src="{{ asset('images/' . $product->image_path) }}" width="200px" height="200px" class="img-responsive">
                            @else
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputShortCode" class="col-sm-2 control-label">@lang('product.field.short_code')</label>
                        <div class="col-sm-10">
                            <label id="inputShortCode" class="control-label">
                                <span class="control-label-normal">{{ $product->short_code }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputBarcode" class="col-sm-2 control-label">@lang('product.field.barcode')</label>
                        <div class="col-sm-10">
                            <label id="inputBarcode" class="control-label">
                                <span class="control-label-normal">{{ $product->barcode }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription" class="col-sm-2 control-label">@lang('product.field.description')</label>
                        <div class="col-sm-10">
                            <label id="inputDescription" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->description }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputProductUnit" class="col-sm-2 control-label">@lang('product.field.unit')</label>
                        <div class="col-sm-10">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>@lang('product.show.table.product.header.unit')</th>
                                        <th class="text-center">@lang('product.show.table.product.header.is_base')</th>
                                        <th>@lang('product.show.table.product.header.conversion_value')</th>
                                        <th>@lang('product.show.table.product.header.remarks')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product->productUnits as $produnit)
                                        <tr>
                                            <td>{{ $produnit->unit->name }}</td>
                                            <td>{{ $produnit->is_base ? trans('lookup.YESNOSELECT.YES'):trans('lookup.YESNOSELECT.NO') }}</td>
                                            <td>{{ $produnit->conversion_value }}</td>
                                            <td>{{ $produnit->remarks }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMinimalInStock" class="col-sm-2 control-label">@lang('product.field.minimal_in_stock')</label>
                        <div class="col-sm-10">
                            <label id="inputMinimalInStock" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->minimal_in_stock }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('product.field.status')</label>
                        <div class="col-sm-10">
                            <label id="inputStatus" class="control-label control-label-normal">
                                <span class="control-label-normal">@lang('lookup.'.$product->status)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('product.field.remarks')</label>
                        <div class="col-sm-10">
                            <label id="inputRemarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->remarks }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.product') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="box-footer"></div>
    </div>
@endsection