@extends('layouts.adminlte.master')

@section('title')
    @lang('employees.show.title')
@endsection

@section('page_title')
    <span class="fa fa-employees fa-flip-horizontal fa-fw"></span>&nbsp;@lang('employees.show.page_title')
@endsection

@section('page_title_desc')
    @lang('employees.show.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('employees.show.header.title') : {{ $employees->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('employees.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputName" class="control-label">
                                <span class="control-label-normal">{{ $employees->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">@lang('employees.field.email')</label>
                        <div class="col-sm-10">
                            <label id="inputEmail" class="control-label">
                                <span class="control-label-normal">{{ $employees->email }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputIcNumber"
                               class="col-sm-2 control-label">@lang('employees.field.ic_number')</label>
                        <div class="col-sm-10">
                            <label id="inputIcNumber" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $employees->ic_number }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputImagePath"
                               class="col-sm-2 control-label">@lang('employees.field.image_path')</label>
                        <div class="col-sm-10">
                            <label id="inputImagePath" class="control-label control-label-normal">
                                @if(!empty($employees->image_path))
                                    <img src="{{ asset('images/'.$employees->image_path) }}"
                                         class="img-responsive img-circle"
                                         style="max-width: 150px; max-height: 150px;"/>
                                @endif
                                <span class="control-label-normal">{{ $employees->image_path }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.employees.employees') }}"
                               class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </form>
        </div>
    </div>
@endsection