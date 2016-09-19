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
    <span class="fa fa-@lang('customer.icon') fa-fw"></span>&nbsp;@lang('customer.index.page_title')
@endsection
@section('page_title_desc', '')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $customer->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputId" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10">
                            <label id="id" class="control-label">
                                <span class="control-label-normal">{{ $customer->id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('customer.name')</label>
                        <div class="col-sm-10">
                            <label id="plateNumber" class="control-label">
                                <span class="control-label-normal">{{ $customer->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputInspectionDate" class="col-sm-2 control-label">@lang('customer.address')</label>
                        <div class="col-sm-10">
                            <label id="inspectionDate" class="control-label">
                                <span class="control-label-normal">{{ $customer->address }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDriver" class="col-sm-2 control-label">@lang('customer.city')</label>
                        <div class="col-sm-10">
                            <label id="driver" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $customer->city }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('customer.name')</label>
                        <div class="col-sm-10">
                            <label id="status" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $customer->phone }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('customer.remarks')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $customer->remarks }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('customer.tax_id')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $customer->tax_id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('customer.payment_due_date')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $customer->payment_due_date }}</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.customer') }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </form>
        </div>
    </div>
@endsection
