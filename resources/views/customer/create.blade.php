@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.create.title')
@endsection

@section('page_title')
    <span class="fa fa-smile-o fa-fw"></span>&nbsp;@lang('customer.create.page_title')
@endsection
@section('page_title_desc')
    @lang('customer.create.page_title_desc')
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('customer.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.customer.create') }}" method="post">
            {{ csrf_field() }}
            <div ng-app="customerModule" ng-controller="customerController">
            </div>
        </form>
    </div>
@endsection