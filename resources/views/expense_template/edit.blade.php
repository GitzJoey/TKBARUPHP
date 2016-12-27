@extends('layouts.adminlte.master')

@section('title')
    @lang('expense_template.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-ticket fa-fw"></span>&nbsp;@lang('expense_template.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('expense_template.edit.page_title_desc')
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
            <h3 class="box-title">@lang('expense_template.edit.header.title')</h3>
        </div>
        {!! Form::model($expenseTemplate, ['method' => 'PATCH', 'route' => ['db.master.expense_template.edit', $expenseTemplate->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
        <div ng-app="expenseTemplateModule" ng-controller="expenseTemplateController">
            <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">@lang('expense_template.field.name')</label>
                    <div class="col-sm-8">
                        <input id="inputName" name="name" type="text" class="form-control"
                               placeholder="@lang('expense_template.field.name')"
                               data-parsley-required="true" value="{{ $expenseTemplate->name }}">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="inputType" class="col-sm-2 control-label">@lang('expense_template.field.type')</label>
                    <div class="col-sm-8">
                        {{ Form::select('type', $expenseTypes, $expenseTemplate->type , array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'), 'data-parsley-required' => 'true')) }}
                        <span class="help-block">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                    <label for="inputAmount"
                           class="col-sm-2 control-label">@lang('expense_template.field.amount')</label>
                    <div class="col-sm-8">
                        <input id="inputAmount" name="amount" type="text" class="form-control"
                               placeholder="@lang('expense_template.field.amount')"
                               data-parsley-required="true" data-parsley-pattern="/^\d+(,\d+)*$/" ng-model="amount"
                               fcsa-number>
                        <span class="help-block">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                    <label for="inputRemarks"
                           class="col-sm-2 control-label">@lang('expense_template.field.remarks')</label>
                    <div class="col-sm-8">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control"
                               placeholder="@lang('expense_template.field.remarks')"
                               data-parsley-required="true" value="{{ $expenseTemplate->remarks }}">
                        <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputInternalExpense" class="col-sm-2 control-label">@lang('expense_template.field.internal_expense')</label>
                    <div class="col-sm-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="is_internal_expense" value="{{ $expenseTemplate->is_internal_expense }}">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                        <a href="{{ route('db.master.expense_template') }}"
                           class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(function () {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });
        });

        var app = angular.module('expenseTemplateModule', ['fcsa-number']);
        app.controller("expenseTemplateController", ['$scope', function ($scope) {
            $scope.amount = parseInt('{{ $expenseTemplate->amount }}');
        }]);
    </script>
@endsection