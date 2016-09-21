@extends('layouts.adminlte.master')

@section('title')
    @lang('settings.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-minus-square fa-fw"></span>&nbsp;@lang('settings.edit.page_title')
@endsection
@section('page_title_desc')
    @lang('settings.edit.page_title_desc')
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
            <h3 class="box-title">@lang('settings.edit.header.title')</h3>
        </div>
        {!! Form::model($settings, ['method' => 'PATCH','route' => ['db.admin.settings.edit', $settings->hId()], 'class' => 'form-horizontal']) !!}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputUserId" class="col-sm-2 control-label">@lang('settings.field.user_id')</label>
                    <div class="col-sm-10">
                        @if(is_null($settings->user()))
                            <input id="inputUserId" name="user_id" type="text" class="form-control" value="Default" readonly="readonly">
                        @else
                            <input id="inputUserId" name="user_id" type="text" class="form-control" value="{{ $settings->user()->name }}" readonly="readonly">
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputCategory" class="col-sm-2 control-label">@lang('settings.field.category')</label>
                    <div class="col-sm-10">
                        <input id="inputCategory" name="category" type="text" class="form-control" value="{{ $settings->category }}" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputKey" class="col-sm-2 control-label">@lang('settings.field.skey')</label>
                    <div class="col-sm-10">
                        <input id="inputKey" name="category" type="text" class="form-control" value="{{ $settings->skey }}" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputValue" class="col-sm-2 control-label">@lang('settings.field.value')</label>
                    <div class="col-sm-10">
                        <input id="inputValue" name="category" type="text" class="form-control" value="{{ $settings->value }}" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDescription" class="col-sm-2 control-label">@lang('settings.field.description')</label>
                    <div class="col-sm-10">
                        <input id="inputDescription" name="description" type="text" class="form-control" value="{{ $settings->description }}" readonly="readonly">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.settings') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection