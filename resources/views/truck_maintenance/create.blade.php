@extends('layouts.adminlte.master')

@section('title', 'Truck Management')

@section('page_title')
    <span class="fa fa-truck fa-flip-horizontal fa-fw"></span>&nbsp;Truck
@endsection
@section('page_title_desc', '')

@section('custom_css')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/css/select2.min.css') }}">
@endsection

@section('custom_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(".select2").select2();
    </script>
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
            <h3 class="box-title">@lang('truck_maintenance.button.header.create')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.truck.maintenance.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('plate_number') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truck_maintenance.plate_number')</label>
                    <div class="col-sm-10">
                        {{ Form::select('plate_number', $trucklist, old('plate_number'), array('class' => 'form-control select2', 'style' =>'width: 100%;', 'placeholder' => trans('truck_maintenance.select.option.default.plate_number'))) }}

                        {{-- <select class="form-control select2" name="plate_number" style="width: 100%;">
                            <option value>- @lang('truck_maintenance.select.option.default') -</option>
                            @foreach ($trucklist as $key => $truck)
                                <option value="{{ $truck->id }}">{{ $truck->plate_number }}</option>
                            @endforeach
                        </select> --}}
                        <span class="help-block">{{ $errors->has('plate_number') ? $errors->first('plate_number') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('cost') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truck_maintenance.cost')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cost" name="cost" placeholder="@lang('truck_maintenance.cost')" value="{{ old('cost') }}">
                        <span class="help-block">{{ $errors->has('cost') ? $errors->first('cost') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('odometer') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truck_maintenance.odometer')</label>
                    <div class="col-sm-10">
                        <input id="odometer" name="odometer" type="text" class="form-control" placeholder="@lang('truck_maintenance.odometer')" value="{{ old('odometer') }}">
                        <span class="help-block">{{ $errors->has('odometer') ? $errors->first('odometer') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('maintenance_type') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truck_maintenance.maintenance_type')</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="maintenance_type">
                            <option value>@lang('truck_maintenance.select.option.default.maintenance_type')</option>
                            @foreach($statusDDL as $status)
                                <option value="{{$status}}" {{(old('maintenance_type')==$status)?'selected':''}}>@lang('lookup.'.$status)</option>
                            @endforeach
                        </select>
                        {{-- {{ Form::select('maintenance_type', $statusDDL, old('maintenance_type'), array('class' => 'form-control', 'placeholder' => trans('truck_maintenance.select.option.default.maintenance_type'))) }} --}}
                        <span class="help-block">{{ $errors->has('maintenance_type') ? $errors->first('maintenance_type') : '' }}</span>

                    </div>
                </div>
                <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truck_maintenance.remarks')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="@lang('truck_maintenance.remarks')" value="{{ old('remarks') }}">
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
        </form>
    </div>
@endsection