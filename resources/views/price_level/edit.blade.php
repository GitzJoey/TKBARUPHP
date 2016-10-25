@extends('layouts.adminlte.master')

@section('title')
    @lang('price_level.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-table fa-fw"></span>&nbsp;@lang('price_level.edit.page_title')
@endsection
@section('page_title_desc')
    @lang('price_level.edit.page_title_desc')
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
            <h3 class="box-title">@lang('price_level.edit.header.title')</h3>
        </div>
        {!! Form::model($pricelevel, ['method' => 'PATCH','route' => ['db.price.price_level.edit', $pricelevel->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            <div class="box-body">
                <div class="box-body">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="inputType" class="col-sm-2 control-label">@lang('price_level.field.type')</label>
                        <div class="col-sm-10">
                            {{ Form::select('type', $plTypeDDL, $pricelevel->type, array('id' => 'priceLevelSelect', 'class' => 'form-control', 'placeholder' => 'Please Select', 'data-parsley-required' => 'true')) }}
                            <span class="help-block">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
                        <label for="inputWeight" class="col-sm-2 control-label">@lang('price_level.field.weight')</label>
                        <div class="col-sm-10">
                            <select name="weight" class="form-control" data-parsley-required="true">
                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                                @for($x =1; $x <= 10; $x++)
                                    @if($x == 1)
                                        <option value="{{ $x }}" @if($pricelevel->weight == $x) selected="selected" @endif>{{ $x }} - Lowest</option>
                                    @elseif($x == 10)
                                        <option value="{{ $x }}" @if($pricelevel->weight == $x) selected="selected" @endif>{{ $x }} - Highest</option>
                                    @else
                                        <option value="{{ $x }}" @if($pricelevel->weight == $x) selected="selected" @endif>{{ $x }}</option>
                                    @endif
                                @endfor
                            </select>
                            <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="inputName" class="col-sm-2 control-label">@lang('price_level.field.name')</label>
                        <div class="col-sm-10">
                            <input id="inputName" name="name" type="text" class="form-control" value="{{ $pricelevel->name }}" placeholder="Name">
                            <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription" class="col-sm-2 control-label">@lang('price_level.field.description')</label>
                        <div class="col-sm-10">
                            <input id="inputDescription" name="description" type="text" class="form-control" value="{{ $pricelevel->description }}" placeholder="Description">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputIncVal" class="col-sm-2 control-label">@lang('price_level.field.incval')</label>
                        <div class="col-sm-10">
                            @if ($pricelevel->type == 'PRICELEVELTYPE.INC')
                                <input id="inputIncVal" name="incval" type="text" class="form-control" value="{{ $pricelevel->increment_value }}" placeholder="Increment Value">
                            @else
                                <input id="inputIncVal" name="incval" type="text" class="form-control" value="{{ $pricelevel->increment_value }}" placeholder="Increment Value" readonly>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPctVal" class="col-sm-2 control-label">@lang('price_level.field.pctval')</label>
                        <div class="col-sm-10">
                            @if ($pricelevel->type == 'PRICELEVELTYPE.PCT')
                                <input id="inputPctVal" name="pctva;" type="text" class="form-control" value="{{ $pricelevel->percentage_value }}" placeholder="Percentage Value">
                            @else
                                <input id="inputPctVal" name="pctva;" type="text" class="form-control" value="{{ $pricelevel->percentage_value }}" placeholder="Percentage Value" readonly>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('price_level.field.status')</label>
                        <div class="col-sm-10">
                            {{ Form::select('status', $statusDDL, $pricelevel->status, array('class' => 'form-control', 'placeholder' => 'Please Select', 'data-parsley-required' => 'true')) }}
                            <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                        </div>
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
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $('select[id="priceLevelSelect"]').change(function() {
            if ($(this).val() == 'PRICELEVELTYPE.inc') {
                $('#inputIncVal').prop('readonly', false);
                $('#inputPctVal').val('0').prop('readonly', true);
            } else {
                $('#inputIncVal').val('0').prop('readonly', true);
                $('#inputPctVal').prop('readonly', false);
            }
        });
    </script>
@endsection