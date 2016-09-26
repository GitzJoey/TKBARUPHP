@extends('layouts.adminlte.master')

@section('title')
    @lang('product.show.index.title')
@endsection

@section('page_title')
    <span class="fa fa-cubes fa-fw"></span>&nbsp;@lang('product.show.page_title')
@endsection
@section('page_title_desc')
    @lang('product.show.page_title_desc')
@endsection

@section('custom_css')
    <style type="text/css">
        .control-label-normal {
            font-weight: 400;
            display:inline-block;
        }
    </style>
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
                        <label for="inputName" class="col-sm-2 control-label">@lang('product.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputName" class="control-label">
                                <span class="control-label-normal">{{ $product->name }}</span>
                            </label>
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
                        <label for="inputDescription" class="col-sm-2 control-label">@lang('product.field.description')</label>
                        <div class="col-sm-10">
                            <label id="inputDescription" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->description }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('product.field.status')</label>
                        <div class="col-sm-10">
                            <label id="status" class="control-label control-label-normal">
                                <span class="control-label-normal">@lang('lookup.'.$product->status)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('product.field.remarks')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->remarks }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.product') }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection