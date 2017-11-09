@extends('layouts.adminlte.master')

@section('title')
    @lang('daily_log.index.title')
@endsection

@section('page_title')
    <span class="fa fa-comment-o fa-fw"></span>&nbsp;@lang('daily_log.index.page_title')
@endsection

@section('page_title_desc')
    @lang('daily_log.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('daily_log') !!}
@endsection

@section('content')

@endsection