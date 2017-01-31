@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.revenue.category.show.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-flash"></span>&nbsp;@lang('accounting.revenue.category.show.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.revenue.category.show.page_title_desc')
@endsection

@section('breadcrumbs')
    
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('accounting.revenue.category.show.header.title') : {{ $rc->name }}</h3>
        </div>
        <form class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputGroup" class="col-sm-2 control-label">@lang('accounting.revenue.category.field.group')</label>
                    <div class="col-sm-10">
                        <label id="inputGroup" class="control-label control-label-normal">
                            <span class="control-label-normal">{{ $rc->group }}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('accounting.revenue.category.field.name')</label>
                    <div class="col-sm-10">
                        <label id="inputName" class="control-label">
                            <span class="control-label-normal">{{ $rc->name }}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.acc.revenue.category') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </form>
    </div>
@endsection