@extends('layouts.adminlte.master')

@section('title', 'Truck Management')

@section('page_title')
    <span class="fa fa-truck fa-flip-horizontal fa-fw"></span>&nbsp;Truck
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
            <h3 class="box-title">@lang('truck_maintenance.button.header.edit')</h3>
        </div>
        {!! Form::model($truck, ['method' => 'PATCH','route' => ['db.master.truck.maintenance.edit', $truck->id], 'class' => 'form-horizontal']) !!}
        <div class="box-body">
            <div class="form-group {{ $errors->has('plate_number') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">@lang('truck_maintenance.plate_number')</label>
                <div class="col-sm-10">
                    {{ Form::select('plate_number', $trucklist, $truck->truck_id, array('class' => 'form-control', 'disabled'=>'', 'style'=>"width: 100%;")) }}
                    <span class="help-block">{{ $errors->has('plate_number') ? $errors->first('plate_number') : '' }}</span>
                </div>
            </div>
            <div class="form-group {{ $errors->has('cost') ? 'has-error' : '' }}">
                <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('truck_maintenance.cost')</label>
                <div class="col-sm-10">
                    <input name="cost" type="text" class="form-control" value="{{ (old('cost'))?old('cost'):$truck->cost }}" placeholder="@lang('truck_maintenance.cost')">
                    <span class="help-block">{{ $errors->has('cost') ? $errors->first('cost') : '' }}</span>
                </div>
            </div>
            <div class="form-group {{ $errors->has('odometer') ? 'has-error' : '' }}">
                <label for="inputInspectionDate" class="col-sm-2 control-label">@lang('truck_maintenance.odometer')</label>
                <div class="col-sm-10">
                    <input class="form-control" placeholder="@lang('truck_maintenance.odometer')" name="odometer" value="{{(old('odometer'))?old('odometer'):$truck->odometer }}">
                    <span class="help-block">{{ $errors->has('odometer') ? $errors->first('odometer') : '' }}</span>
                </div>
            </div>
            <div class="form-group {{ $errors->has('maintenance_type') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">@lang('truck_maintenance.maintenance_type')</label>
                <div class="col-sm-10">
                    <select class="form-control" name="maintenance_type">
                        <option value>@lang('truck_maintenance.select.option.default.maintenance_type')</option>
                        @foreach($statusDDL as $status)
                            @if(old('maintenance_type'))
                                <option value="{{$status}}" {{(old('maintenance_type')==$status)?'selected':''}}>@lang('lookup.'.$status)</option>
                            @else
                                <option value="{{$status}}" {{($truck->maintenance_type==$status)?'selected':''}}>@lang('lookup.'.$status)</option>
                            @endif
                        @endforeach
                    </select>
                    {{-- {{ Form::select('maintenance_type', $statusDDL, old('maintenance_type', $truck->maintenance_type), array('class' => 'form-control', 'placeholder' => trans('truck_maintenance.select.option.default.maintenance_type'))) }} --}}
                    <span class="help-block">{{ $errors->has('maintenance_type') ? $errors->first('maintenance_type') : '' }}</span>
                </div>
            </div>
            <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                <label class="col-sm-2 control-label">@lang('truck_maintenance.remarks')</label>
                <div class="col-sm-10">
                    <input name="remarks" type="text" class="form-control" value="{{ (old('remarks'))?old('remarks'):$truck->remarks }}" placeholder="@lang('truck_maintenance.remarks')">
                    <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <a href="{{ route('db.master.truck.maintenance') }}" class="btn btn-default">@lang('truck_maintenance.button.cancel')</a>
                    <button class="btn btn-default" type="submit">@lang('truck_maintenance.button.submit')</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection