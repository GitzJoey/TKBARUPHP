@extends('layouts.adminlte.master')

@section('title')
    @lang('unit.edit.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-flash"></span>&nbsp;@lang('unit.edit.page_title')
@endsection
@section('page_title_desc')
    @lang('unit.edit.page_title_desc')
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
            <h3 class="box-title">@lang('unit.edit.header.title')</h3>
        </div>
        {!! Form::model($unit, ['method' => 'PATCH','route' => ['db.admin.unit.edit', $unit->hId()], 'class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputUnitName" class="col-sm-2 control-label">@lang('unit.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputUnitName" name="name" type="text" class="form-control" value="{{ $unit->name }}" placeholder="Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSymbol" class="col-sm-2 control-label">@lang('unit.field.symbol')</label>
                    <div class="col-sm-10">
                        <input id="inputSymbol" class="form-control" name="symbol" type="text" placeholder="Symbol">
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('unit.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('unit.field.remarks')</label>
                    <div class="col-sm-10">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $unit->remarks }}" placeholder="Remarks">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.unit') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection