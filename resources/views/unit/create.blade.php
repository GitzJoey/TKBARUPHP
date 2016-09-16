@extends('layouts.adminlte.master')

@section('title', 'Unit Management')

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;Unit
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
            <h3 class="box-title">Create Unit</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.admin.unit.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('phoneProvider.name')</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('phoneProvider.name')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSymbol" class="col-sm-2 control-label">@lang('phoneProvider.name')</label>
                    <div class="col-sm-10">
                        <input id="inputSymbol" name="symbol" type="text" class="form-control" placeholder="@lang('phoneProvider.name')">
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('phoneProvider.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('phoneProvider.name')</label>
                    <div class="col-sm-10">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="@lang('phoneProvider.name')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.unit') }}" class="btn btn-default">Cancel</a>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection