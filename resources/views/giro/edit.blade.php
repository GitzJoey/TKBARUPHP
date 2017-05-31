@extends('layouts.adminlte.master')

@section('title')
    @lang('giro.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-book fa-fw"></span>&nbsp;@lang('giro.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('giro.edit.page_title_desc')
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
            <h3 class="box-title">@lang('giro.edit.header.title')</h3>
        </div>
        {!! Form::model($giro, ['method' => 'PATCH', 'route' => ['db.bank.giro.edit', $giro->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->has('plate_number') ? 'has-error' : '' }}">
                    <label for="inputBank" class="col-sm-2 control-label">@lang('giro.field.bank')</label>
                    <div class="col-sm-10">
                        {{ Form::select('bank', $bankDDL, $giro->bank->id, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('plate_number') ? $errors->first('plate_number') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('serial_number') ? 'has-error' : '' }}">
                    <label for="inputSerialNumber" class="col-sm-2 control-label">@lang('giro.field.serial_number')</label>
                    <div class="col-sm-10">
                        <input id="inputSerialNumber" name="serial_number" type="text" value="{{ $giro->serial_number }}"class="form-control" placeholder="@lang('giro.field.serial_number')">
                        <span class="help-block">{{ $errors->has('serial_number') ? $errors->first('serial_number') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('effective_date') ? 'has-error' : '' }}">
                    <label for="inputEffectiveDate" class="col-sm-2 control-label">@lang('giro.field.effective_date')</label>
                    <div class="col-sm-10">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" id="inputEffectiveDate" name="effective_date" data-parsley-required="true" value="{{ date('d-m-Y', strtotime($giro->effective_date)) }}">
                        </div>
                        <span class="help-block">{{ $errors->has('effective_date') ? $errors->first('effective_date') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                    <label for="inputAmount" class="col-sm-2 control-label">@lang('giro.field.amount')</label>
                    <div class="col-sm-10">
                        <input id="inputAmount" name="amount" type="text" class="form-control" value="{{ $giro->amount }}" placeholder="@lang('giro.field.amount')"
                               data-parsley-required="true"
                               data-parsley-pattern="/^\d+(,\d+)*$/"
                               autonumeric data-a-sep="," data-a-dec=".">
                        <span class="help-block">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('printed_name') ? 'has-error' : '' }}">
                    <label for="inputPrintedName" class="col-sm-2 control-label">@lang('giro.field.printed_name')</label>
                    <div class="col-sm-10">
                        <input id="inputPrintedName" name="printed_name" type="text" class="form-control" value={{ $giro->printed_name }} placeholder="@lang('giro.field.printed_name')">
                        <span class="help-block">{{ $errors->has('printed_name') ? $errors->first('printed_name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('giro.field.status')</label>
                    <div class="col-sm-10">
                        <input id="inputStatus" name="status" type="text" class="form-control" value="@lang('lookup.' . $giro->status)" readonly>
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('giro.field.remarks')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputRemarks" name="remarks" value="{{ $giro->remarks }}" placeholder="@lang('giro.field.remarks')">
                        <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.bank.giro') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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
        $(document).ready(function() {
            $('#inputEffectiveDate').datetimepicker({
                format: 'DD-MM-YYYY',
                defaultDate: moment().toDate(),
                showTodayButton: true,
                showClose: true
            });
        });
    </script>
@endsection