@extends('layouts.adminlte.master')

@section('title', 'Unit Management')

@section('custom_css')
    <style type="text/css">
        .control-label-normal {
            font-weight: 400;
            display:inline-block;
        }
    </style>
@endsection

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;Unit
@endsection
@section('page_title_desc', '')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $unit->unit_name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputId" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10">
                            <label id="inputId" class="control-label">
                                <span class="control-label-normal">{{ $unit->id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <label id="inputId" class="control-label">
                                <span class="control-label-normal">{{ $unit->unit_name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSymbol" class="col-sm-2 control-label">Symbol</label>
                        <div class="col-sm-10">
                            <label id="inputSymbol" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $unit->symbol }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-10">
                            <label id="inputRemarks" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $unit->remarks }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.unit.store') }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </form>
        </div>
    </div>
@endsection