@extends('layouts.adminlte.master')

@section('title')
    @lang('phone_provider.show.title')
@endsection

@section('custom_css')
    <style type="text/css">
        .control-label-normal {
            font-weight: 400;
            display:inline-block;
        }
    </style>
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-phone"></span>&nbsp;@lang('phone_provider.show.page_title')
@endsection
@section('page_title_desc')
    @lang('phone_provider.show.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('phone_provider.show.header.title') : {{ $phoneProvider->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('phone_provider.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputName" class="control-label">
                                <span class="control-label-normal">{{ $phoneProvider->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputShortName" class="col-sm-2 control-label">@lang('phone_provider.field.short_name')</label>
                        <div class="col-sm-10">
                            <label id="inputShortName" class="control-label">
                                <span class="control-label-normal">{{ $phoneProvider->short_name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPrefix" class="col-sm-2 control-label">@lang('phone_provider.field.prefix')</label>
                        <div class="col-sm-10">
                            <label id="inputPrefix" class="control-label">
                                <span class="control-label-normal">{{ $phoneProvider->prefix }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('phone_provider.field.status')</label>
                        <div class="col-sm-10">
                            <label id="inputStatus" class="control-label control-label-normal">
                                <span class="control-label-normal">@lang('lookup.'.$phoneProvider->status)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('phone_provider.field.remarks')</label>
                        <div class="col-sm-10">
                            <label id="inputRemarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $phoneProvider->remarks }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.phone_provider') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection