@extends('layouts.adminlte.master')

@section('title')
    @lang('truck.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-flip-horizontal fa-fw"></span>&nbsp;@lang('truck.edit.page_title')
@endsection
@section('page_title_desc')
    @lang('truck.edit.page_title_desc')
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
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
        {!! Form::model($truck, ['method' => 'PATCH', 'route' => ['db.master.truck.edit', $truck->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->has('truck_type') ? 'has-error' : '' }}">
                    <label for="inputTruckType" class="col-sm-2 control-label">@lang('truck.field.truck_type')</label>
                    <div class="col-sm-10">
                        {{ Form::select('truck_type', $truckTypeDDL, $truck->type, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('truck_type') ? $errors->first('truck_type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('plate_number') ? 'has-error' : '' }}">
                    <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('truck.field.plate_number')</label>
                    <div class="col-sm-10">
                        <input id="inputPlateNumber" name="plate_number" type="text" class="form-control" value="{{ $truck->plate_number }}" placeholder="@lang('truck.field.plate_number')" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('plate_number') ? $errors->first('plate_number') : '' }}</span>&nbsp;
                    </div>
                </div>
                <div class="form-group {{ $errors->has('inspection_date') ? 'has-error' : '' }}">
                    <label for="inputInspectionDate" class="col-sm-2 control-label">@lang('truck.field.inspection_date')</label>
                    <div class="col-sm-10">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="inspection_date" name="inspection_date" data-parsley-required="true" value="{{ date('d-m-Y', strtotime($truck->inspection_date)) }}">
                        </div>
                        <span class="help-block">{{ $errors->has('inspection_date') ? $errors->first('inspection_date') : '' }}</span>&nbsp;
                    </div>
                </div>
                <div class="form-group {{ $errors->has('driver') ? 'has-error' : '' }}">
                    <label for="inputDriver" class="col-sm-2 control-label">@lang('truck.field.driver')</label>
                    <div class="col-sm-10">
                        <input id="inputDriver" name="driver" type="text" class="form-control" value="{{ $truck->driver }} "placeholder="@lang('truck.field.driver')">
                        <span class="help-block">{{ $errors->has('driver') ? $errors->first('driver') : '' }}</span>&nbsp;
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('truck.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('truck.field.remarks')</label>
                    <div class="col-sm-10">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $truck->remarks }}" placeholder="@lang('truck.field.remarks')">
                        <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>&nbsp;
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.truck') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $("#inspection_date").daterangepicker({
            locale: {
                format: 'DD-MM-YYYY'
            },
            singleDatePicker: true,
            showDropdowns: true
        });
    </script>
@endsection