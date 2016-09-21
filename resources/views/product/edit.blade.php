@extends('layouts.adminlte.master')

@section('title', 'Truck Management')

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;Truck
@endsection
@section('page_title_desc', '')

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
            <h3 class="box-title">Edit Truck</h3>
        </div>
        {!! Form::model($product, ['method' => 'PATCH','route' => ['db.master.product.edit', $product->id], 'class' => 'form-horizontal']) !!}
        <div class="box-body">
            <div class="form-group">
                <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('product.name')</label>
                <div class="col-sm-10">
                    <input id="inputName" name="name" type="text" class="form-control" value="{{ $product->store_id }}" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputShort_name" class="col-sm-2 control-label">@lang('product.short_name')</label>
                <div class="col-sm-10">
                    <textarea id="inputShort_name" class="form-control" rows="5" name="short_name">{{ $product->product_type_id }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPrefix" class="col-sm-2 control-label">@lang('product.prefix')</label>
                <div class="col-sm-10">
                    <input id="inputPrefix" name="prefix" type="text" class="form-control" value="{{ $product->type }} "placeholder="prefix">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPrefix" class="col-sm-2 control-label">@lang('product.prefix')</label>
                <div class="col-sm-10">
                    <input id="inputPrefix" name="prefix" type="text" class="form-control" value="{{ $product->name }} "placeholder="prefix">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPrefix" class="col-sm-2 control-label">@lang('product.prefix')</label>
                <div class="col-sm-10">
                    <input id="inputPrefix" name="prefix" type="text" class="form-control" value="{{ $product->short_code }} "placeholder="prefix">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPrefix" class="col-sm-2 control-label">@lang('product.prefix')</label>
                <div class="col-sm-10">
                    <input id="inputPrefix" name="prefix" type="text" class="form-control" value="{{ $product->description }} "placeholder="prefix">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPrefix" class="col-sm-2 control-label">@lang('product.prefix')</label>
                <div class="col-sm-10">
                    <input id="inputPrefix" name="prefix" type="text" class="form-control" value="{{ $product->image_path }} "placeholder="prefix">
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="inputStatus" class="col-sm-2 control-label">@lang('product.status')</label>
                <div class="col-sm-10">
                    {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                    <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputRemarks" class="col-sm-2 control-label">@lang('product.remarks')</label>
                <div class="col-sm-10">
                    <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $product->remarks }}" placeholder="Remarks">
                </div>
            </div>
            <div class="form-group">
                <label for="inputButton" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <a href="{{ route('db.master.product') }}" class="btn btn-default">Cancel</a>
                    <button class="btn btn-default" type="submit">Submit</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection