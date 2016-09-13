@extends('layouts.adminlte.master')

@section('title', 'Store Management')

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;Store
@endsection
@section('page_title_desc', '')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $store->store_name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputId" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10">
                            <label id="inputId" class="control-label">
                                <span class="control-label-normal">{{ $store->id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <label id="inputId" class="control-label">
                                <span class="control-label-normal">{{ $store->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            <label id="inputAddress" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $store->address }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-10">
                            <label id="inputPhone" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $store->phone_num }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFax" class="col-sm-2 control-label">Fax</label>
                        <div class="col-sm-10">
                            <label id="inputFax" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $store->fax_num }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTaxId" class="col-sm-2 control-label">Tax ID</label>
                        <div class="col-sm-10">
                            <label id="inputTaxId" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $store->tax_id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputIsDefault" class="col-sm-2 control-label">Default</label>
                        <div class="col-sm-10">
                            <label id="inputIsDefault" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $store->is_default }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-10">
                            <label id="inputRemarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $store->remarks }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.store') }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </form>
        </div>
    </div>
@endsection