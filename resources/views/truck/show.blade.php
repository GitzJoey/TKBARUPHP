@extends('layouts.adminlte.master')

@section('title')
    @lang('truck.show.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-flip-horizontal fa-fw"></span>&nbsp;@lang('truck.show.page_title')
@endsection

@section('page_title_desc')
    @lang('truck.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_truck_show', $truck->hId()) !!}
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('truck.show.header.title') : {{ $truck->plate_number }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputTruckType" class="col-sm-2 control-label">@lang('truck.field.truck_type')</label>
                        <div class="col-sm-10">
                            <span class="control-label-normal">@lang('lookup.'.$truck->type)</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('truck.field.plate_number')</label>
                        <div class="col-sm-10">
                            <label id="plateNumber" class="control-label">
                                <span class="control-label-normal">{{ $truck->plate_number }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputInspectionDate" class="col-sm-2 control-label">@lang('truck.field.inspection_date')</label>
                        <div class="col-sm-10">
                            <label id="inspectionDate" class="control-label">
                                <span class="control-label-normal">{{ $truck->inspection_date }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDriver" class="col-sm-2 control-label">@lang('truck.field.driver')</label>
                        <div class="col-sm-10">
                            <label id="driver" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $truck->driver }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('truck.field.status')</label>
                        <div class="col-sm-10">
                            <label id="status" class="control-label control-label-normal">
                                <span class="control-label-normal">@lang('lookup.' . $truck->status)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('truck.field.remarks')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $truck->remarks }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.truck') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </form>
        </div>
    </div>
@endsection