@extends('layouts.adminlte.master')

@section('title')
    @lang('employee.create.title')
@endsection

@section('page_title')
    <span class="fa fa-odnoklassniki fa-fw"></span>&nbsp;@lang('employee.create.page_title')
@endsection

@section('page_title_desc')
    @lang('employee.create.page_title_desc')
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
            <h3 class="box-title">@lang('employee.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.employee.employee.create') }}" enctype="multipart/form-data" method="post"
              data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">@lang('employee.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" type="text" class="form-control"
                               placeholder="@lang('employee.field.name')" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="inputEmail" class="col-sm-2 control-label">@lang('employee.field.email')</label>
                    <div class="col-sm-10">
                        <input id="inputEmail" name="email" type="text" class="form-control"
                               placeholder="@lang('employee.field.email')" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('ic_number') ? 'has-error' : '' }}">
                    <label for="inputIcNumber" class="col-sm-2 control-label">@lang('employee.field.ic_number')</label>
                    <div class="col-sm-10">
                        <input id="inputIcNumber" name="ic_number" type="text" class="form-control"
                               placeholder="@lang('employee.field.ic_number')" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('ic_number') ? $errors->first('ic_number') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('image_path') ? 'has-error' : '' }}">
                    <label for="inputFoto" class="col-sm-2 control-label">@lang('employee.field.image_path')</label>
                    <div class="col-sm-10">
                        <input id="inputImagePath" name="image_path" type="file" class="form-control"
                               placeholder="@lang('employee.field.image_path')" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('image_path') ? $errors->first('image_path') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.employee.employee') }}"
                           class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.create_new_button')</button>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </form>
    </div>
@endsection

