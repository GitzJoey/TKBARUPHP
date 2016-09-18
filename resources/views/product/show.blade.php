@extends('layouts.adminlte.master')

@section('title', 'Truck Management')

@section('custom_css')
    <style type="text/css">
        .control-label-normal {
            font-weight: 400;
            display:inline-block;
        }
    </style>
@endsection

@section('page_title')
    <span class="fa fa-truck fa-fw"></span>&nbsp;Phone Provider
@endsection
@section('page_title_desc', '')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $product->plate_number }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputId" class="col-sm-2 control-label">Id</label>
                        <div class="col-sm-10">
                            <label id="id" class="control-label">
                                <span class="control-label-normal">{{ $product->id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('truck.store_id')</label>
                        <div class="col-sm-10">
                            <label id="plateNumber" class="control-label">
                                <span class="control-label-normal">{{ $product->store_id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputInspectionDate" class="col-sm-2 control-label">@lang('truck.product_type_id')</label>
                        <div class="col-sm-10">
                            <label id="inspectionDate" class="control-label">
                                <span class="control-label-normal">{{ $product->product_type_id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDriver" class="col-sm-2 control-label">@lang('truck.type')</label>
                        <div class="col-sm-10">
                            <label id="driver" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->type }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('truck.name')</label>
                        <div class="col-sm-10">
                            <label id="status" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('truck.short_code')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->short_code }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('truck.description')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->description }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('truck.image_path')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->image_path }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('truck.status')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->status }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('truck.remarks')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $product->remarks }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.product') }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </form>
        </div>
    </div>
@endsection