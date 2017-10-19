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

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ mix('adminlte/fileinput/fileinput.css') }}">
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('bank_upload') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @elseif ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
        {{ Session::forget('info') }}
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('bank.upload.header.title.upload')</h3>
        </div>
        <form id="bankForm" class="form-horizontal" action="{{ route('db.bank.upload') }}" enctype="multipart/form-data" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="box-body">
                    <div class="form-group {{ $errors->has('bank') ? 'has-error' : '' }}">
                        <label for="inputBank" class="col-sm-2 control-label">@lang('bank.upload.field.bank')</label>
                        <div class="col-sm-5">
                            {{ Form::select('bank', $bankDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                            <span class="help-block">{{ $errors->has('bank') ? $errors->first('bank') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('file_path') ? 'has-error' : '' }}">
                        <label for="inputFilePath" class="col-sm-2 control-label">@lang('bank.upload.field.file')</label>
                        <div class="col-sm-5">
                            <input id="inputFilePath" name="file_path" type="file" class="file form-control" data-show-upload="false" data-allowed-file-extensions='["jpg","png"]'>
                            <span class="help-block">{{ $errors->has('file_path') ? $errors->first('file_path') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.bank.upload') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                            <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($bankUploads as $key => $bankUpload)
                        <tr>
                            <td>{{ $bankDDL[$bankUpload->bank] }}</td>
                            <td>{{ $bankUpload->created_at }}</td>
                            <td>{{ $bankUpload->filename }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript" src="{{ mix('adminlte/fileinput/fileinput.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/fileinput/id.js') }}"></script>
@endsection