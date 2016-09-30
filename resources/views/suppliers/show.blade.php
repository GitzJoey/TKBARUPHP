@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.index.title')
@endsection

@section('page_title')
    <span class="fa fa-umbrella fa-fw"></span>&nbsp;@lang('supplier.index.page_title')
@endsection
@section('page_title_desc')
    @lang('supplier.index.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $supplier->supplier_name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputId" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10">
                            <label id="inputId" class="control-label">
                                <span class="control-label-normal">{{ $supplier->id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('supplier.edit.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputId" class="control-label">
                                <span class="control-label-normal">{{ $supplier->supplier_name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress" class="col-sm-2 control-label">@lang('supplier.edit.field.address')</label>
                        <div class="col-sm-10">
                            <label id="inputAddress" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $supplier->supplier_address }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPhone" class="col-sm-2 control-label">@lang('supplier.edit.field.phone')</label>
                        <div class="col-sm-10">
                            <label id="inputPhone" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $supplier->phone_number }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFax" class="col-sm-2 control-label">Fax</label>
                        <div class="col-sm-10">
                            <label id="inputFax" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $supplier->fax_num }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTaxId" class="col-sm-2 control-label">@lang('supplier.edit.field.tax')</label>
                        <div class="col-sm-10">
                            <label id="inputTaxId" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $supplier->tax_id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <label id="inputTaxId" class="control-label control-label-normal">
                                @if ($supplier->status == 1)
                                <span class="control-label-normal">@lang('supplier.status.true')</span>
                                @else
                                <span class="control-label-normal">@lang('supplier.status.false')</span>
                                @endif
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('supplier.edit.field.remarks')</label>
                        <div class="col-sm-10">
                            <label id="inputRemarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $supplier->remarks }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.supplier') }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </form>
        </div>
    </div>
@endsection