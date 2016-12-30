@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.copy.search.title')
@endsection

@section('page_title')
    <span class="fa fa-copy fa-rotate-180 fa-fw"></span>&nbsp;@lang('sales_order.copy.search.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.copy.search.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('sales_order_copy') !!}
@endsection

@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                <li>@lang("sales_order.copy.search.so_not_found") {{ Session::get('code') }}</li>
            </ul>
        </div>
    @endif

    <div ng-app="soCopyModule" ng-controller="soCopyController">
        <form class="form-horizontal">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('sales_order.copy.search.header.search')</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputSearchSOCode" ng-model="soCode" placeholder="Sales Order Code">
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-block btn-md btn-primary" href="{{ route('db.so.copy.index') }}/@{{ soCode }}">Search</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module('soCopyModule', []);
        app.controller('soCopyController', ['$scope', function($scope) {
            $scope.soCode = '{{ Session::get('code') }}'
        }]);
    </script>
@endsection
