@extends('layouts.adminlte.master')

@section('title')
    @lang('phoneProvider.show.title')
@endsection

@section('custom_css')
    <style type="text/css">
        .control-label-normal {
            font-weight: 400;
            display:inline-block;
        }
    </style>
@endsection

@section('page_title')
    <span class="fa-volume-control-phone"></span>&nbsp;@lang('phoneProvider.show.page_title')
@endsection
@section('page_title_desc')
    @lang('phoneProvider.show.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $phoneProvider->plate_number }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputId" class="col-sm-2 control-label">Id</label>
                        <div class="col-sm-10">
                            <label id="id" class="control-label">
                                <span class="control-label-normal">{{ $phoneProvider->id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('truck.plate_number')</label>
                        <div class="col-sm-10">
                            <label id="plateNumber" class="control-label">
                                <span class="control-label-normal">{{ $phoneProvider->plate_number }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputInspectionDate" class="col-sm-2 control-label">@lang('truck.inspection_date')</label>
                        <div class="col-sm-10">
                            <label id="inspectionDate" class="control-label">
                                <span class="control-label-normal">{{ $phoneProvider->inspection_date }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDriver" class="col-sm-2 control-label">@lang('truck.driver')</label>
                        <div class="col-sm-10">
                            <label id="driver" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $phoneProvider->driver }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('truck.status')</label>
                        <div class="col-sm-10">
                            <label id="status" class="control-label control-label-normal">
                                <span class="control-label-normal">@lang('lookup.'.$unit->status)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('truck.remarks')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $phoneProvider->remarks }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.phoneProvider') }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </form>
        </div>
    </div>
@endsection