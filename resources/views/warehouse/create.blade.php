@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.create.title')
@endsection

@section('page_title')
    <span class="fa fa-wrench fa-fw"></span>&nbsp;@lang('warehouse.create.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.create.page_title_desc')
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
            <h3 class="box-title">@lang('warehouse.create.page_title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.warehouse.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('warehouse.field.name')</label>
                    <div class="col-sm-10">
                        <input id="name" name="name" type="text" class="form-control" placeholder="@lang('warehouse.field.name')">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress" class="col-sm-2 control-label">@lang('warehouse.field.address')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputAddress" name="address" placeholder="@lang('warehouse.field.address')">
                        <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPhoneNum" class="col-sm-2 control-label">@lang('warehouse.field.phone_num')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputPhoneNum" name="phone_num" placeholder="@lang('warehouse.field.phone_num')">
                        <span class="help-block">{{ $errors->has('phone_num') ? $errors->first('phone_num') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('warehouse.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('warehouse.field.remarks')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputRemarks" name="remarks" placeholder="@lang('warehouse.field.remarks')">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.warehouse') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection