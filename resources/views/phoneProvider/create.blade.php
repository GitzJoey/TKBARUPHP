@extends('layouts.adminlte.master')

@section('title', 'phoneProvider Management')

@section('page_title')
    <span class="fa fa-phoneProvider fa-fw"></span>&nbsp;Truck
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
            <h3 class="box-title">Create Truck</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.phoneProvider.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('phoneProvider.plate_number')</label>
                    <div class="col-sm-10">
                        <input id="plate_number" name="plate_number" type="text" class="form-control" placeholder="plate_number">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">@lang('phoneProvider.inspection_date')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inspection_date" name="inspection_date" placeholder="inspection_date">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRoles" class="col-sm-2 control-label">@lang('phoneProvider.driver')</label>
                    <div class="col-sm-10">
                        <input id="driver" name="driver" type="text" class="form-control" placeholder="driver">
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
                    <label for="inputPasswordConfirmation" class="col-sm-2 control-label">@lang('phoneProvider.remarks')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="remarks">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.truck') }}" class="btn btn-default">Cancel</a>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection