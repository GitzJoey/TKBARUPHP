@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.cost.category.show.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-flash"></span>&nbsp;@lang('accounting.cost.category.show.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.cost.category.show.page_title_desc')
@endsection

@section('breadcrumbs')

@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('accounting.cost.category.show.header.title') : {{ $cc->name }}</h3>
        </div>
        <form class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputGroup" class="col-sm-2 control-label">@lang('accounting.cost.category.field.group')</label>
                    <div class="col-sm-10">
                        <label id="inputGroup" class="control-label">
                            <span class="control-label-normal">{{ $cc->group }}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('accounting.cost.category.field.name')</label>
                    <div class="col-sm-10">
                        <label id="inputName" class="control-label">
                            <span class="control-label-normal">{{ $cc->name }}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.acc.cost.category') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </form>
    </div>
@endsection