@extends('layouts.adminlte.master')

@section('title')
    @lang('product.create.title')
@endsection

@section('page_title')
    <span class="fa fa-product fa-fw"></span>&nbsp;@lang('product.create.page_title')
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
            <h3 class="box-title">@lang('product.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.product.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputStoreId" class="col-sm-2 control-label">@lang('product.store_id')</label>
                    <div class="col-sm-10">
                        <input id="store_id" name="store_id" type="text" class="form-control" placeholder="@lang('product.store_id')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputProductTypeId" class="col-sm-2 control-label">@lang('product.product_type_id')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_type_id" name="product_type_id" placeholder="@lang('product.product_type_id')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputType" class="col-sm-2 control-label">@lang('product.type')</label>
                    <div class="col-sm-10">
                        <input id="type" name="type" type="text" class="form-control" placeholder="@lang('product.type')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('product.name')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="@lang('product.name')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputShortCode" class="col-sm-2 control-label">@lang('product.short_code')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="short_code" name="short_code" placeholder="@lang('product.short_code')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescription" class="col-sm-2 control-label">@lang('product.description')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="description" name="description" placeholder="@lang('product.description')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputImagePath" class="col-sm-2 control-label">@lang('product.image_path')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="image_path" name="image_path" placeholder="@lang('product.image_path')">
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
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="@lang('product.remarks')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
<<<<<<< HEAD
                        <a href="{{ route('db.admin.user') }}" class="btn btn-default">Cancel</a>
=======
                        <a href="{{ route('db.master.product') }}" class="btn btn-default">Cancel</a>
>>>>>>> origin/master
                        <button class="btn btn-default" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection