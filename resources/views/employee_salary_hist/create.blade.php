@extends('layouts.adminlte.master')

@section('title')
    @lang('employee_salary.create.title')
@endsection

@section('page_title')
    <span class="fa fa-odnoklassniki fa-fw"></span>&nbsp;@lang('employee_salary.create.page_title')
@endsection

@section('page_title_desc')
    @lang('employee_salary.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('employee.employee_create') !!}
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
            <h3 class="box-title">@lang('employee_salary.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.employee.employee_salary.create') }}" enctype="multipart/form-data" method="post"
              data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">@lang('employee_salary.field.employee')</label>
                    <div class="col-sm-10">
                        {{ Form::select('employee_id', $employeeList, $employee_id, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'),'data-parsley-required' => 'true','id'=>'employee-form' )) }}
                        <span class="help-block">{{ $errors->has('employee_id') ? $errors->first('employee_id') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }}">
                    <label for="type" class="col-sm-2 control-label">@lang('employee_salary.field.type')</label>
                    <div class="col-sm-10">
                        {{ Form::select('type', $statusDDL, '', array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'),'data-parsley-required' => 'true','id'=>'' )) }}
                        <span class="help-block">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                    <label for="inputAddress" class="col-sm-2 control-label">@lang('employee_salary.field.amount')</label>
                    <div class="col-sm-10">
                        <input id="inputAddress" name="amount" type="text" class="form-control"
                               placeholder="@lang('employee_salary.field.amount')" data-parsley-required="true" autonumeric>
                        <span class="help-block">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="inputIcNumber" class="col-sm-2 control-label">@lang('employee_salary.field.description')</label>
                    <div class="col-sm-10">
                        <textarea class="form-control"id="inputIcNumber" name="description" type="text" class="form-control"
                               placeholder="@lang('employee_salary.field.description')"></textarea>
                        <span class="help-block">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.employee.employee_salary') }}"
                           class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.create_new_button')</button>
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
            $('#employee-form').select2();
            $('input.is_icheck').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });
             $('input.is_icheck').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            $("#inputStartDate").datetimepicker({
                format: "DD-MM-YYYY",
                defaultDate: moment()
            });
        });
    </script>
@endsection
