@extends('layouts.adminlte.master')

@section('title')
    @lang('search.result.title')
@endsection

@section('page_title')
    @lang('search.result.page_title')
@endsection

@section('page_title_desc')
    @lang('search.result.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('search') !!}
@endsection

@section('content')

@endsection