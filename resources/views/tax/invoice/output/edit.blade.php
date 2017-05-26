@extends('TKBARUPHP.resources.views.layouts.adminlte.master')

@section('title')
    @lang('employee.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-odnoklassniki fa-fw"></span>&nbsp;@lang('employee.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('employee.edit.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('employee.employee_edit', $employee->hId()) !!}
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
            <h3 class="box-title">@lang('employee.edit.header.title')</h3>
        </div>
        {!! Form::model($employee, ['id' => 'employeeForm', 'method' => 'PATCH', 'route' => ['db.employee.employee.edit', $employee->hId()], 'class' => 'form-horizontal',  'files' => true, 'data-parsley-validate' => 'parsley']) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">@lang('employee.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" type="text" class="form-control"
                               placeholder="@lang('employee.field.name')" value="{{ $employee->name }}"
                               data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="inputAddress" class="col-sm-2 control-label">@lang('employee.field.address')</label>
                    <div class="col-sm-10">
                        <input id="inputAddress" name="address" type="text" class="form-control"
                               placeholder="@lang('employee.field.address')" value="{{ $employee->address }}" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('ic_number') ? 'has-error' : '' }}">
                    <label for="inputIcNumber" class="col-sm-2 control-label">@lang('employee.field.ic_number')</label>
                    <div class="col-sm-10">
                        <input id="inputIcNumber" name="ic_number" type="text" class="form-control"
                               value="{{ $employee->ic_number }} " placeholder="@lang('employee.field.ic_number')">
                        <span class="help-block">{{ $errors->has('ic_number') ? $errors->first('ic_number') : '' }}</span>&nbsp;
                    </div>
                </div>
                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                    <label for="inputStartDate" class="col-sm-2 control-label">@lang('employee.field.start_date')</label>
                    <div class="col-sm-5">
                        <input id="inputStartDate" name="start_date" type="text" class="form-control"
                               placeholder="@lang('employee.field.start_date')" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('start_date') ? $errors->first('start_date') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('freelance') ? 'has-error' : '' }}">
                    <label for="inputFreelance" class="col-sm-2 control-label">@lang('employee.field.freelance')</label>
                    <div class="col-sm-5">
                        @if (boolval($employee->freelance))
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="freelance" class="is_icheck" checked>&nbsp;
                                </label>
                            </div>
                        @else
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="freelance" class="is_icheck">&nbsp;
                                </label>
                            </div>
                        @endif
                        <span class="help-block">{{ $errors->has('freelance') ? $errors->first('freelance') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('base_salary') ? 'has-error' : '' }}">
                    <label for="inputBaseSalary" class="col-sm-2 control-label">@lang('employee.field.base_salary')</label>
                    <div class="col-sm-5">
                        <input id="inputBaseSalary" name="base_salary" type="text" class="form-control"
                               placeholder="@lang('employee.field.base_salary')" data-parsley-required="true"
                               value="{{ $employee->base_salary }}" autonumeric>
                        <span class="help-block">{{ $errors->has('base_salary') ? $errors->first('base_salary') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('image_path') ? 'has-error' : '' }}">
                    <label for="inputEmployeeImage"
                           class="col-sm-2 control-label">@lang('employee.field.image_path')</label>
                    <div class="col-sm-10">
                        @if(!empty($employee->image_path))
                            <img src="{{ asset('images/'.$employee->image_path) }}" class="img-responsive img-circle"
                                 style="max-width: 150px; max-height: 150px;"/>
                        @endif
                        <input id="inputEmployeeImage" name="image_path" type="file" class="form-control"
                               value="{{ old('image_path') }}">
                        <span class="help-block">{{ $errors->has('image_path') ? $errors->first('image_path') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('employee.field.status')</label>
                    <div class="col-sm-5">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.employee.employee') }}"
                           class="btn btn-default">@lang('buttons.cancel_button')</a>
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
            $('input.is_icheck').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });

            $("#inputStartDate").datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment()
            });
        });
    </script>
@endsection