@extends('layouts.adminlte.master')

@section('title')
    @lang('bank.show.title')
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
    <span class="fa fa-bank fa-fw"></span>&nbsp;@lang('bank.show.page_title')
@endsection

@section('page_title_desc')
    @lang('bank.show.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('bank.show.header.title') : {{ $bank->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('bank.field.name')</label>
                        <div class="col-sm-10">
                            <label id="name" class="control-label">
                                <span class="control-label-normal">{{ $bank->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputShortName" class="col-sm-2 control-label">@lang('bank.field.short_name')</label>
                        <div class="col-sm-10">
                            <label id="shortName" class="control-label">
                                <span class="control-label-normal">{{ $bank->short_name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputBranch" class="col-sm-2 control-label">@lang('bank.field.branch')</label>
                        <div class="col-sm-10">
                            <label id="branch" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $bank->branch }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputBranchCode" class="col-sm-2 control-label">@lang('bank.field.branch_code')</label>
                        <div class="col-sm-10">
                            <label id="branchCode" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $bank->branch_code }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('bank.field.status')</label>
                        <div class="col-sm-10">
                            <label id="status" class="control-label control-label-normal">
                                <span class="control-label-normal">@lang('lookup.'.$bank->status)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('bank.field.remarks')</label>
                        <div class="col-sm-10">
                            <label id="remarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $bank->remarks }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.bank') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection