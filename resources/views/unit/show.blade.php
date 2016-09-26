@extends('layouts.adminlte.master')

@section('title')
    @lang('unit.show.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-flash"></span>&nbsp;@lang('unit.show.page_title')
@endsection
@section('page_title_desc')
    @lang('unit.show.page_title_desc')
@endsection

@section('custom_css')
    <style type="text/css">
        .control-label-normal {
            font-weight: 400;
            display:inline-block;
        }
    </style>
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('unit.show.header.title') : {{ $unit->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('unit.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputName" class="control-label">
                                <span class="control-label-normal">{{ $unit->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSymbol" class="col-sm-2 control-label">@lang('unit.field.symbol')</label>
                        <div class="col-sm-10">
                            <label id="inputSymbol" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $unit->symbol }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputProductUnit" class="col-sm-2 control-label">@lang('product.field.unit')</label>
                        <div class="col-sm-10">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                <tr>
                                    <th>@lang('product.create.table.header.unit')</th>
                                    <th>@lang('product.create.table.header.is_base')</th>
                                    <th>@lang('product.create.table.header.conversion_value')</th>
                                    <th width="10%">&nbsp;</th>
                                </tr>
                                </thead>
                            </table>
                            <a class="btn btn-xs btn-default">@lang('buttons.create_new_button')</a>
                            <hr>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('unit.field.status')</label>
                        <div class="col-sm-10">
                            <label class="control-label control-label-normal">
                                <span class="control-label-normal">@lang('lookup.'.$unit->status)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('unit.field.remarks')</label>
                        <div class="col-sm-10">
                            <label id="inputRemarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $unit->remarks }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.unit') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection