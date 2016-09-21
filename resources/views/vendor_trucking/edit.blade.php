@extends('layouts.adminlte.master')

@section('title')
    @lang('vendor_trucking.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-ge fa-fw"></span>&nbsp;@lang('vendor_trucking.edit.page_title')
@endsection
@section('page_title_desc')
    @lang('vendor_trucking.edit.page_title_desc')
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
            <h3 class="box-title">@lang('vendor_trucking.edit.header.title')</h3>
        </div>
        {!! Form::model($vt, ['method' => 'PATCH','route' => ['db.master.vendor.trucking.edit', $vt->hId()], 'class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputStoreName" class="col-sm-2 control-label">@lang('vendor_trucking.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputStoreName" name="store_name" type="text" class="form-control" value="{{ $vt->name }}" placeholder="Name">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="inputAddress" class="col-sm-2 control-label">@lang('vendor_trucking.field.address')</label>
                    <div class="col-sm-10">
                        <textarea id="inputAddress" class="form-control" rows="5" name="store_address">{{ $vt->address }}</textarea>
                        <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('phone_num') ? 'has-error' : '' }}">
                    <label for="inputPhone" class="col-sm-2 control-label">@lang('vendor_trucking.field.phone')</label>
                    <div class="col-sm-10">
                        <input id="inputPhone" name="phone_num" type="text" class="form-control" value="{{ $vt->phone_num }}" placeholder="Phone">
                        <span class="help-block">{{ $errors->has('phone_num') ? $errors->first('phone_num') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTax" class="col-sm-2 control-label">@lang('vendor_trucking.field.tax_id')</label>
                    <div class="col-sm-10">
                        <input id="inputTax" name="tax_id" type="text" class="form-control" value="{{ $vt->tax_id }}" placeholder="Tax ID"/>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('vendor_trucking.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('vendor_trucking.field.remarks')</label>
                    <div class="col-sm-10">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $vt->remarks }}" placeholder="Remarks">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.vendor.trucking') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection