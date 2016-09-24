@extends('layouts.adminlte.master')

@section('title')
    @lang('price_level.create.title')
@endsection

@section('page_title')
    <span class="fa fa-table fa-fw"></span>&nbsp;@lang('price_level.create.page_title')
@endsection
@section('page_title_desc')
    @lang('price_level.create.page_title_desc')
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
            <h3 class="box-title">@lang('price_level.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.price.price_level.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="inputType" class="col-sm-2 control-label">@lang('price_level.field.type')</label>
                    <div class="col-sm-10">
                        {{ Form::select('type', $plTypeDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
                    <label for="inputWeight" class="col-sm-2 control-label">@lang('price_level.field.weight')</label>
                    <div class="col-sm-10">
                        <select name="weight" class="form-control">
                            <option value="">@lang('lookup.PLEASE_SELECT')</option>
                            @for($x =1; $x <= 10; $x++)
                                @if($x == 1)
                                    <option value="{{ $x }}">{{ $x }} - Lowest</option>
                                @elseif($x == 10)
                                    <option value="{{ $x }}">{{ $x }} - Highest</option>
                                @else
                                    <option value="{{ $x }}">{{ $x }}</option>
                                @endif
                            @endfor
                        </select>
                        <span class="help-block">{{ $errors->has('weight') ? $errors->first('weight') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">@lang('price_level.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="Name">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescription" class="col-sm-2 control-label">@lang('price_level.field.description')</label>
                    <div class="col-sm-10">
                        <input id="inputDescription" name="description" type="text" class="form-control" value="{{ old('description') }}" placeholder="Fax">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputIncVal" class="col-sm-2 control-label">@lang('price_level.field.incval')</label>
                    <div class="col-sm-10">
                        <input id="inputIncVal" name="incval" type="text" class="form-control" value="{{ old('incval') }}" placeholder="Increment Value">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPctVal" class="col-sm-2 control-label">@lang('price_level.field.pctval')</label>
                    <div class="col-sm-10">
                        <input id="inputPctVal" name="pctva;" type="text" class="form-control" value="{{ old('pctval') }}" placeholder="Percentage Value">
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('price_level.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.price.price_level') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection