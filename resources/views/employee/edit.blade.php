@extends('layouts.adminlte.master')

@section('title')
    @lang('employee.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-odnoklassniki fa-fw"></span>&nbsp;@lang('employee.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('employee.edit.page_title_desc')
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
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="inputEmail" class="col-sm-2 control-label">@lang('employee.field.email')</label>
                <div class="col-sm-10">
                    <input id="inputEmail" name="email" type="text" class="form-control"
                           value="{{ $employee->email }}" placeholder="@lang('employee.field.email')"
                           data-parsley-required="true">
                    <span class="help-block">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>&nbsp;
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

