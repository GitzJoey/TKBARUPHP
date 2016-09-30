@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.edit.phone.title')
@endsection

@section('page_title')
    <span class="fa fa-umbrella fa-fw"></span>&nbsp;@lang('supplier.create.phone.page_title')
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
            <h3 class="box-title">@lang('supplier.edit.phone.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.supplier.pic.phone.update', array('id' => $id, 'pic_id' => $pic_id, 'phone_id' => $phone_id)) }}" method="post">
            <input type="hidden" name="_method" value="patch">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('supplier.create.field.phone.provider')</label>
                        <div class="col-sm-9"> 
                            <select name="provider" class="form-control">
                                @foreach($phone_provider as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('supplier.create.field.phone.number')</label>
                        <div class="col-sm-9"> 
                            <input type="number" name="number" class="form-control" value="{{ $phone->number }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-9"> 
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">@lang('supplier.create.field.phone.remarks')</label>
                        <div class="col-sm-9"> 
                            <input type="text" name="remarks" class="form-control" value="{{ $phone->remarks }}">
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