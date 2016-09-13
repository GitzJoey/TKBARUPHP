@extends('layouts.adminlte.master')

@section('title', 'Store Management')

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;Store
@endsection
@section('page_title_desc', '')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Store</h3>
        </div>
        {!! Form::model($store, ['method' => 'PATCH','route' => ['db.admin.store.edit', $store->id], 'class' => 'form-horizontal']) !!}
        <div class="box-body">
            <div class="form-group">
                <label for="inputStoreName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input id="inputStoreName" name="store_name" type="text" class="form-control" value="{{ $store->name }}" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    <textarea id="inputAddress" class="form-control" rows="5" name="store_address">{{ $store->address }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <input id="inputPhone" name="phone_num" type="text" class="form-control" value="{{ $store->phone_num }}" placeholder="Phone">
                </div>
            </div>
            <div class="form-group">
                <label for="inputFax" class="col-sm-2 control-label">Fax</label>
                <div class="col-sm-10">
                    <input id="inputFax" name="fax_num" type="text" class="form-control" value="{{ $store->fax_num }}" placeholder="Fax">
                </div>
            </div>
            <div class="form-group">
                <label for="inputTax" class="col-sm-2 control-label">Tax ID</label>
                <div class="col-sm-10">
                    <input id="inputTax" name="tax_id" type="text" class="form-control" value="{{ $store->tax_id }}" placeholder="Tax ID"/>
                </div>
            </div>
            <div class="form-group">
                <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">

                </div>
            </div>
            <div class="form-group">
                <label for="inputIsDefault" class="col-sm-2 control-label">Default</label>
                <div class="col-sm-10">
                    &nbsp;
                </div>
            </div>
            <div class="form-group">
                <label for="inputRemarks" class="col-sm-2 control-label">Remarks</label>
                <div class="col-sm-10">
                    <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $store->remarks }}" placeholder="Remarks">
                </div>
            </div>
            <div class="form-group">
                <label for="inputButton" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <a href="{{ route('db.admin.store') }}" class="btn btn-default">Cancel</a>
                    <button class="btn btn-default" type="submit">Submit</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection