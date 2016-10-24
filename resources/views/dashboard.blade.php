@extends('layouts.adminlte.master')

@section('title')
    @lang('dashboard.title')
@endsection

@section('page_title')
    <span class="fa fa-dashboard fa-fw"></span>&nbsp;@lang('dashboard.page_title')
@endsection
@section('page_title_desc')
    @lang('dashboard.page_title_desc')
@endsection

@section('content')
    @for ($i = 0; $i < 1000; $i++)
        <br/>
    @endfor
@endsection