@extends('layouts.adminlte.master')

@section('title')
    @lang('store.create.title')
@endsection

@section('page_title')
    <span class="fa fa-umbrella fa-fw"></span>&nbsp;@lang('store.create.page_title')
@endsection
@section('page_title_desc')
    @lang('store.create.page_title_desc')
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('store.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.admin.store.create') }}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputStoreName" class="col-sm-2 control-label">@lang('store.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputStoreName" name="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="Name">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('image_path') ? 'has-error' : '' }}">
                    <label for="inputStoreImage" class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-10">
                        <input id="inputStoreImage" name="image_path" type="file" class="form-control">
                        <span class="help-block">{{ $errors->has('image_path') ? $errors->first('image_path') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="inputAddress" class="col-sm-2 control-label">@lang('store.field.address')</label>
                    <div class="col-sm-10">
                        <textarea id="inputAddress" class="form-control" rows="5" name="address">{{ old('address') }}</textarea>
                        <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('phone_num') ? 'has-error' : '' }}">
                    <label for="inputPhone" class="col-sm-2 control-label">@lang('store.field.phone')</label>
                    <div class="col-sm-10">
                        <input id="inputPhone" name="phone_num" type="text" class="form-control" value="{{ old('phone_num') }}" placeholder="Phone">
                        <span class="help-block">{{ $errors->has('phone_num') ? $errors->first('phone_num') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputFax" class="col-sm-2 control-label">@lang('store.field.fax')</label>
                    <div class="col-sm-10">
                        <input id="inputFax" name="fax_num" type="text" class="form-control" value="{{ old('fax_num') }}" placeholder="Fax">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTax" class="col-sm-2 control-label">@lang('store.field.tax_id')</label>
                    <div class="col-sm-10">
                        <input id="inputTax" name="tax_id" type="text" class="form-control" value="{{ old('tax_id') }}" placeholder="Tax ID">
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('store.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('is_default') ? 'has-error' : '' }}">
                    <label for="inputIsDefault" class="col-sm-2 control-label">@lang('store.field.default')</label>
                    <div class="col-sm-10">
                        {{ Form::select('is_default', $yesnoDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('is_default') ? $errors->first('is_default') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('store.field.remarks')</label>
                    <div class="col-sm-10">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ old('remarks') }}" placeholder="Remarks">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.store') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection