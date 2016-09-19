@extends('layouts.adminlte.master')

@section('title')
    @lang('truck.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-fw"></span>&nbsp;@lang('truck.edit.page_title')
@endsection
@section('page_title_desc')
    @lang('truck.edit.page_title_desc')
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
            <h3 class="box-title">@lang('truck.edit.header.title')</h3>
        </div>
        {!! Form::model($truck, ['method' => 'PATCH','route' => ['db.master.truck.edit', $truck->id], 'class' => 'form-horizontal']) !!}
        <div class="box-body">
            <div class="form-group {{ $errors->has('plate_number') ? 'has-error' : '' }}">
                <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('truck.plate_number')</label>
                <div class="col-sm-10">
                    <input id="inputPlateNumber" name="plate_number" type="text" class="form-control" value="{{ $truck->plate_number }}" placeholder="Name">
                    <span class="help-block">{{ $errors->has('plate_number') ? $errors->first('plate_number') : '' }}</span>&nbsp;
                </div>
            </div>
            <div class="form-group {{ $errors->has('inspection_date') ? 'has-error' : '' }}">
                <label for="inputInspectionDate" class="col-sm-2 control-label">@lang('truck.inspection_date')</label>
                <div class="col-sm-10">
                    <textarea id="inputInspectionDate" class="form-control" rows="5" name="inspection_date">{{ $truck->inspection_date }}</textarea>
                    <span class="help-block">{{ $errors->has('inspection') ? $errors->first('inspection') : '' }}</span>&nbsp;
                </div>
            </div>
            <div class="form-group {{ $errors->has('driver') ? 'has-error' : '' }}">
                <label for="inputDriver" class="col-sm-2 control-label">@lang('truck.driver')</label>
                <div class="col-sm-10">
                    <input id="inputDriver" name="driver" type="text" class="form-control" value="{{ $truck->driver }} "placeholder="driver">
                    <span class="help-block">{{ $errors->has('driver') ? $errors->first('driver') : '' }}</span>&nbsp;
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="inputStatus" class="col-sm-2 control-label">@lang('truck.status')</label>
                <div class="col-sm-10">
                    {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                    <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                </div>
            </div>
            <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                <label for="inputRemarks" class="col-sm-2 control-label">@lang('truck.remarks')</label>
                <div class="col-sm-10">
                    <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $truck->remarks }}" placeholder="Remarks">
                    <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>&nbsp;
                </div>
            </div>
            <div class="form-group">
                <label for="inputButton" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <a href="{{ route('db.master.truck') }}" class="btn btn-default">@lang('buttons.edit.cancel')</a>
                    <button class="btn btn-default" type="submit">@lang('buttons.edit.save')</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection