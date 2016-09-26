@extends('layouts.adminlte.master')

@section('title')
    @lang('product.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-cubes fa-fw"></span>&nbsp;@lang('product.edit.page_title')
@endsection
@section('page_title_desc')
    @lang('product.edit.page_title_desc')
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
            <h3 class="box-title">@lang('product.edit.header.title')</h3>
        </div>
        {!! Form::model($product, ['method' => 'PATCH','route' => ['db.master.product.edit', $product->hId()], 'class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="inputType" class="col-sm-2 control-label">@lang('product.field.type')</label>
                    <div class="col-sm-10">
                        {{ Form::select('type', $prodtypeDdL, $selected, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">@lang('product.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputName" name="name" type="text" class="form-control" value="{{ $product->name }}" placeholder="Name">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('short_code') ? 'has-error' : '' }}">
                    <label for="inputShortCode" class="col-sm-2 control-label">@lang('product.field.short_code')</label>
                    <div class="col-sm-10">
                        <input type="text" id="inputShortCode" class="form-control" name="short_name" value="{{ $product->short_code }}" placeholder="Short Name">
                        <span class="help-block">{{ $errors->has('short_code') ? $errors->first('short_code') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescription" class="col-sm-2 control-label">@lang('product.field.description')</label>
                    <div class="col-sm-10">
                        <input id="inputDescription" name="prefix" type="text" class="form-control" value="{{ $product->description }} "placeholder="prefix">
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
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('product.field.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('product.field.remarks')</label>
                    <div class="col-sm-10">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $product->remarks }}" placeholder="Remarks">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.product') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection