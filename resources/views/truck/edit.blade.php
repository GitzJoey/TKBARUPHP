@extends('layouts.adminlte.master')

@section('title', 'Truck Management')

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;Truck
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
            <h3 class="box-title">Edit Truck</h3>
        </div>
        {!! Form::model($truck, ['method' => 'PATCH','route' => ['db.master.truck.edit', $truck->id], 'class' => 'form-horizontal']) !!}
        <div class="box-body">
            <div class="form-group">
                <label for="inputPlateNumber" class="col-sm-2 control-label">Plate Number</label>
                <div class="col-sm-10">
                    <input id="inputPlateNumber" name="plate_number" type="text" class="form-control" value="{{ $truck->plate_number }}" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputInspectionDate" class="col-sm-2 control-label">Inspection Date</label>
                <div class="col-sm-10">
                    <textarea id="inputInspectionDate" class="form-control" rows="5" name="inspection_date">{{ $truck->inspection_date }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputDriver" class="col-sm-2 control-label">Driver</label>
                <div class="col-sm-10">
                    <input id="inputDriver" name="driver" type="text" class="form-control" value="{{ $truck->driver }} "placeholder="driver">
                </div>
            </div>
            <div class="form-group">
                <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                    <input id="inputStatus" name="status" type="text" class="form-control" value="{{ $truck->status }}" placeholder="status"/>
                </div>
            </div>
            <div class="form-group">
                <label for="inputRemarks" class="col-sm-2 control-label">Remarks</label>
                <div class="col-sm-10">
                    <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $truck->remarks }}" placeholder="Remarks">
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
        {!! Form::close() !!}
    </div>
@endsection