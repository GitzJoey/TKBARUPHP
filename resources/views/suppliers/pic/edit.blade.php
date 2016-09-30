@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.edit.pic.title')
@endsection

@section('page_title')
    <span class="fa fa-umbrella fa-fw"></span>&nbsp;@lang('supplier.edit.pic.page_title')
@endsection
@section('page_title_desc')
    @lang('supplier.index.page_title_desc')
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
            <h3 class="box-title">@lang('supplier.edit.pic.header.title')</h3>
        </div>
        <form action="{{ route('db.master.supplier.pic.update', array('id' => $id, 'pic_id' => $pic_id)) }}" method="post" class="form-horizontal">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="patch">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('supplier.edit.field.pic.first-name')</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="first_name" class="form-control" value="{{ $pic->first_name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('supplier.edit.field.pic.last-name')</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="last_name" class="form-control" value="{{$pic->last_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('supplier.edit.field.pic.address')</label>
                        <div class="col-sm-9">
                            <textarea name="address" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.supplier.edit', $id) }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection