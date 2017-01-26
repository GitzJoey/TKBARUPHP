@extends('layouts.adminlte.master')

@section('title')
    @lang('employee.show.title')
@endsection

@section('page_title')
    <span class="fa fa-odnoklassniki fa-fw"></span>&nbsp;@lang('employee.show.page_title')
@endsection

@section('page_title_desc')
    @lang('employee.show.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('employee.show.header.title') : {{ $employee->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('employee.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputName" class="control-label">
                                <span class="control-label-normal">{{ $employee->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">@lang('employee.field.email')</label>
                        <div class="col-sm-10">
                            <label id="inputEmail" class="control-label">
                                <span class="control-label-normal">{{ $employee->email }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputIcNumber"
                               class="col-sm-2 control-label">@lang('employee.field.ic_number')</label>
                        <div class="col-sm-10">
                            <label id="inputIcNumber" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $employee->ic_number }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputImagePath"
                               class="col-sm-2 control-label">@lang('employee.field.image_path')</label>
                        <div class="col-sm-10">
                            <label id="inputImagePath" class="control-label control-label-normal">
                                @if(!empty($employee->image_path))
                                    <img src="{{ asset('images/'.$employee->image_path) }}"
                                         class="img-responsive img-circle"
                                         style="max-width: 150px; max-height: 150px;"/>
                                @endif
                                <span class="control-label-normal">{{ $employee->image_path }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.employee.employee') }}"
                               class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </form>
        </div>
    </div>
@endsection