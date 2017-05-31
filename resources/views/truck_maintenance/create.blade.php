@extends('layouts.adminlte.master')

@section('title')
    @lang('truckmtc.create.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-flip-horizontal fa-fw"></span>&nbsp;@lang('truckmtc.create.page_title')
@endsection

@section('page_title_desc')
    @lang('truckmtc.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('truck_maintenance_create') !!}
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
            <h3 class="box-title">@lang('truckmtc.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.truck.maintenance.create') }}" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputMaintenanceDate" class="col-sm-2 control-label">@lang('truckmtc.field.maintenance_date')</label>
                    <div class="col-sm-10">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="inputMaintenanceDate" name="maintenance_date" data-parsley-required="true">
                        </div>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('plate_number') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truckmtc.field.plate_number')</label>
                    <div class="col-sm-10">
                        {{ Form::select('plate_number', $trucklist, old('plate_number'), array('class' => 'form-control', 'placeholder' => trans('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('plate_number') ? $errors->first('plate_number') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('maintenance_type') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truckmtc.field.maintenance_type')</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="maintenance_type" data-parsley-required="true">
                            <option value>@lang('labels.PLEASE_SELECT')</option>
                            @foreach($mtctypeDDL as $t)
                                <option value="{{$t}}" {{(old('maintenance_type')==$t)?'selected':''}}>@lang('lookup.'.$t)</option>
                            @endforeach
                        </select>
                        <span class="help-block">{{ $errors->has('maintenance_type') ? $errors->first('maintenance_type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('cost') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truckmtc.field.cost')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cost" name="cost" placeholder="@lang('truckmtc.field.cost')" value="{{ old('cost') }}" data-parsley-required="true" data-parsley-type="number">
                        <span class="help-block">{{ $errors->has('cost') ? $errors->first('cost') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('odometer') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truckmtc.field.odometer')</label>
                    <div class="col-sm-10">
                        <input id="odometer" name="odometer" type="text" class="form-control" placeholder="@lang('truckmtc.field.odometer')" value="{{ old('odometer') }}" data-parsley-required="true" data-parsley-type="number">
                        <span class="help-block">{{ $errors->has('odometer') ? $errors->first('odometer') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truckmtc.field.remarks')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="@lang('truckmtc.field.remarks')" value="{{ old('remarks') }}">
                        <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.truck.maintenance') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            $('#inputMaintenanceDate').datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment().toDate(),
                showTodayButton: true,
                showClose: true
            });
        });
    </script>
@endsection