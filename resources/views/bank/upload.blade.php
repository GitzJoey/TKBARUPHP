@extends('layouts.adminlte.master')

@section('title')
    @lang('bank.upload.title')
@endsection

@section('page_title')
    <span class="fa fa-bank fa-fw"></span>&nbsp;@lang('bank.upload.page_title')
@endsection

@section('page_title_desc')
    @lang('bank.upload.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('bank.upload.header.title.upload')</h3>
        </div>
        <form id="bankForm" class="form-horizontal" action="{{ route('db.bank.upload') }}" enctype="multipart/form-data" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="box-body">
                    <div class="form-group {{ $errors->has('bank') ? 'has-error' : '' }}">
                        <label for="inputBank" class="col-sm-2 control-label">@lang('bank.upload.field.name')</label>
                        <div class="col-sm-10">
                            {{ Form::select('bank', $bankDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                            <span class="help-block">{{ $errors->has('bank') ? $errors->first('bank') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('file_path') ? 'has-error' : '' }}">
                        <label for="inputFilePath" class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                            <input id="inputFilePath" name="file_path" type="file" class="form-control">
                            <span class="help-block">{{ $errors->has('file_path') ? $errors->first('file_path') : '' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.bank.upload') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('bank.upload.header.title.history')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>@lang('bank.upload.table.header.bank')</th>
                        <th>@lang('bank.upload.table.header.upload_date')</th>
                        <th>@lang('bank.upload.table.header.file_name')</th>
                        <th>@lang('bank.upload.table.header.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($uploadBankList as $key => $u)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection