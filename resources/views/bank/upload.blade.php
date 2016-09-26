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
            <h3 class="box-title">@lang('bank.upload.header.title')</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">

                </div>
            </form>
        </div>
    </div>
@endsection