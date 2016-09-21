@extends('layouts.adminlte.master')

@section('title')
    @lang('truckmtc.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-flip-horizontal fa-fw"></span>&nbsp;@lang('truckmtc.edit.page_title')
@endsection
@section('page_title_desc')

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
            <h3 class="box-title">@lang('truckmtc.edit.header.title')</h3>
        </div>
        {!! Form::model($truckMtc, ['method' => 'PATCH','route' => ['db.truck.maintenance.edit', $truckMtc->hId()], 'class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->has('plate_number') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truckmtc.field.plate_number')</label>
                    <div class="col-sm-10">
                        {{ Form::select('plate_number', $trucklist, $truckMtc->truck->id, array('class' => 'form-control', 'disabled'=>'')) }}
                        <span class="help-block">{{ $errors->has('plate_number') ? $errors->first('plate_number') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('maintenance_type') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truckmtc.field.maintenance_type')</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="maintenance_type">
                            <option value>@lang('lookup.PLEASE_SELECT')</option>
                            @foreach($mtctypeDDL as $t)
                                @if(old('maintenance_type'))
                                    <option value="{{$t}}" {{(old('maintenance_type')==$t)?'selected':''}}>@lang('lookup.'.$t)</option>
                                @else
                                    <option value="{{$t}}" {{($truckMtc->maintenance_type==$t)?'selected':''}}>@lang('lookup.'.$t)</option>
                                @endif
                            @endforeach
                        </select>
                        <span class="help-block">{{ $errors->has('maintenance_type') ? $errors->first('maintenance_type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('cost') ? 'has-error' : '' }}">
                    <label for="inputCost" class="col-sm-2 control-label">@lang('truckmtc.field.cost')</label>
                    <div class="col-sm-10">
                        <input name="cost" type="text" class="form-control" value="{{ (old('cost'))?old('cost'):$truckMtc->cost }}" placeholder="@lang('truckmtc.field.cost')">
                        <span class="help-block">{{ $errors->has('cost') ? $errors->first('cost') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('odometer') ? 'has-error' : '' }}">
                    <label for="inputOdometer" class="col-sm-2 control-label">@lang('truckmtc.field.odometer')</label>
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="@lang('truckmtc.field.odometer')" name="odometer" value="{{(old('odometer'))?old('odometer'):$truckMtc->odometer }}">
                        <span class="help-block">{{ $errors->has('odometer') ? $errors->first('odometer') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                    <label class="col-sm-2 control-label">@lang('truckmtc.field.remarks')</label>
                    <div class="col-sm-10">
                        <input name="remarks" type="text" class="form-control" value="{{ (old('remarks'))?old('remarks'):$truckMtc->remarks }}" placeholder="@lang('truckmtc.field.remarks')">
                        <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.truck.maintenance') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection