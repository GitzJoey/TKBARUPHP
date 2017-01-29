@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.cash.show.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.cash.show.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.cash.show.page_title_desc')
@endsection

@section('breadcrumbs')

@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('accounting.cash.show.header.title') : {{ $acccash->name }}</h3>
        </div>
        <form class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputCode" class="col-sm-2 control-label">@lang('accounting.cash.field.code')</label>
                    <div class="col-sm-10">
                        <label id="inputCode" class="control-label control-label-normal">
                            <span class="control-label-normal">{{ $acccash->code }}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('accounting.cash.field.name')</label>
                    <div class="col-sm-10">
                        <label id="inputName" class="control-label">
                            <span class="control-label-normal">{{ $acccash->name }}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputIsDefault" class="col-sm-2 control-label">@lang('accounting.cash.field.is_default')</label>
                    <div class="col-sm-10">
                        <label id="inputIsDefault" class="control-label control-label-normal">
                            <span class="control-label-normal">{{ $acccash->is_default }}</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('accounting.cash.field.status')</label>
                    <div class="col-sm-10">
                        <label class="control-label control-label-normal">
                            <span class="control-label-normal">@lang('lookup.'.$acccash->status)</span>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.acc.cash') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </form>
    </div>
@endsection