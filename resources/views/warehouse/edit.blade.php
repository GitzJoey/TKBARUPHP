@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-wrench fa-fw"></span>&nbsp;@lang('warehouse.edit.page_title')
@endsection
@section('page_title_desc')
    @lang('warehouse.edit.page_title_desc')
@endsection

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
            <h3 class="box-title">@lang('warehouse.edit.header.title')</h3>
        </div>
        {!! Form::model($warehouse, ['method' => 'PATCH','route' => ['db.master.warehouse.edit', $warehouse->hId()], 'class' => 'form-horizontal']) !!}
        <div class="box-body">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">@lang('warehouse.field.name')</label>
                <div class="col-sm-10">
                    <input id="inputName" name="name" type="text" class="form-control" value="{{ $warehouse->name }}" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress" class="col-sm-2 control-label">@lang('warehouse.field.address')</label>
                <div class="col-sm-10">
                    <input id="inputAddress" name="address" type="text" class="form-control" value="{{ $warehouse->address }}" placeholder="Address">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPhoneNum" class="col-sm-2 control-label">@lang('warehouse.field.phone_num')</label>
                <div class="col-sm-10">
                    <input id="inputPhoneNum" name="phone_num" type="text" class="form-control" value="{{ $warehouse->phone_num}}" placeholder="Phone Number">
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="inputStatus" class="col-sm-2 control-label">@lang('bank.field.status')</label>
                <div class="col-sm-10">
                    {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                    <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputRemarks" class="col-sm-2 control-label">@lang('bank.field.remarks')</label>
                <div class="col-sm-10">
                    <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $warehouse->remarks }}" placeholder="Remarks">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="form-group">
                <label for="inputButton" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <a href="{{ route('db.master.bank') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                    <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
