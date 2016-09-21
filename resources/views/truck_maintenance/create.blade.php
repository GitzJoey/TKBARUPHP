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
            <h3 class="box-title">@lang('truckmtc.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.truck.maintenance.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('plate_number') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truckmtc.field.plate_number')</label>
                    <div class="col-sm-10">
                        {{ Form::select('plate_number', $trucklist, old('plate_number'), array('class' => 'form-control', 'placeholder' => trans('lookup.PLEASE_SELECT'))) }}
                        <span class="help-block">{{ $errors->has('plate_number') ? $errors->first('plate_number') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('maintenance_type') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truckmtc.field.maintenance_type')</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="maintenance_type">
                            <option value>@lang('lookup.PLEASE_SELECT')</option>
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
                        <input type="text" class="form-control" id="cost" name="cost" placeholder="@lang('truckmtc.field.cost')" value="{{ old('cost') }}">
                        <span class="help-block">{{ $errors->has('cost') ? $errors->first('cost') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('odometer') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truckmtc.field.odometer')</label>
                    <div class="col-sm-10">
                        <input id="odometer" name="odometer" type="text" class="form-control" placeholder="@lang('truckmtc.field.odometer')" value="{{ old('odometer') }}">
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
        </form>
    </div>
@endsection