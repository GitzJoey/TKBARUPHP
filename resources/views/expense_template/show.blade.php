@extends('layouts.adminlte.master')

@section('title')
    @lang('expense_template.show.title')
@endsection

@section('page_title')
    <span class="fa fa-ticket fa-fw"></span>&nbsp;@lang('expense_template.show.page_title')
@endsection
@section('page_title_desc')
    @lang('expense_template.show.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('expense_template.show.header.title')</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('expense_template.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputName" class="control-label">
                                <span class="control-label-normal">{{ $expenseTemplate->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputType" class="col-sm-2 control-label">@lang('expense_template.field.type')</label>
                        <div class="col-sm-10">
                            <label id="inputType" class="control-label">
                                <span class="control-label-normal">@lang('lookup.' . $expenseTemplate->type)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAmount" class="col-sm-2 control-label">@lang('expense_template.field.amount')</label>
                        <div class="col-sm-10">
                            <label id="inputAmount" class="control-label">
                                <span class="control-label-normal">{{ number_format($expenseTemplate->amount) }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('expense_template.field.remarks')</label>
                        <div class="col-sm-10">
                            <label id="inputRemarks" class="control-label">
                                <span class="control-label-normal">{{ $expenseTemplate->remarks }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputIsInternalExpense" class="col-sm-2 control-label">@lang('expense_template.field.internal_expense')</label>
                        <div class="col-sm-10">
                            <label id="inputIsInternalExpense" class="control-label">
                                <span class="control-label-normal">
                                    @if($expenseTemplate->is_internal_expense)
                                        @lang('lookup.YESNOSELECT.YES')
                                    @else
                                        @lang('lookup.YESNOSELECT.NO')
                                    @endif
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.master.expense_template') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </form>
        </div>
    </div>
@endsection