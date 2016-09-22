@extends('layouts.adminlte.master')

@section('title')
    @lang('price_level.show.title')
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
    <span class="fa fa-table fa-fw"></span>&nbsp;@lang('price_level.show.page_title')
@endsection
@section('page_title_desc')
    @lang('price_level.show.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('price_level.show.header.title') : {{ $pricelevel->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputType" class="col-sm-2 control-label">@lang('price_level.field.type')</label>
                        <div class="col-sm-10">
                            <label id="inputType" class="control-label">
                                <span class="control-label-normal">{{ $pricelevel->type }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputWeight" class="col-sm-2 control-label">@lang('price_level.field.weight')</label>
                        <div class="col-sm-10">
                            <label id="inputWeight" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $pricelevel->weight }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('price_level.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputName" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $pricelevel->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription" class="col-sm-2 control-label">@lang('price_level.field.description')</label>
                        <div class="col-sm-10">
                            <label id="inputDescription" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $pricelevel->description }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputIncVal" class="col-sm-2 control-label">@lang('price_level.field.incval')</label>
                        <div class="col-sm-10">
                            <label id="inputIncVal" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $pricelevel->incval }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPctVal" class="col-sm-2 control-label">@lang('price_level.field.pctval')</label>
                        <div class="col-sm-10">
                            <label id="inputPctVal" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $pricelevel->pctval }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('price_level.field.status')</label>
                        <div class="col-sm-10">
                            <label id="inputStatus" class="control-label control-label-normal">
                                <span class="control-label-normal">@lang('lookup.'.$pricelevel->status)</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.store') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection