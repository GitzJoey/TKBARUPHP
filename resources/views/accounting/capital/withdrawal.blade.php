@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.capital.withdrawal.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.capital.withdrawal.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.capital.withdrawal.page_title_desc')
@endsection

@section('breadcrumbs')

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
            <h3 class="box-title">@lang('accounting.capital.withdrawal.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.acc.capital.withdrawal.add') }}" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputDate" class="col-sm-2 control-label">@lang('accounting.capital.withdrawal.field.date')</label>
                    <div class="col-sm-10">
                        <input id="inputDate" name="date" type="text" class="form-control" placeholder="@lang('accounting.capital.withdrawal.field.date')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAccount" class="col-sm-2 control-label">@lang('accounting.capital.withdrawal.field.source_account')</label>
                    <div class="col-sm-10">
                        {{ Form::select('source_account', $accountDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'),'data-parsley-required' => 'true' )) }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAmount" class="col-sm-2 control-label">@lang('accounting.capital.withdrawal.field.amount')</label>
                    <div class="col-sm-10">
                        <input id="inputAmount" name="amount" type="text" class="form-control" placeholder="@lang('accounting.capital.withdrawal.field.amount')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('accounting.capital.withdrawal.field.remarks')</label>
                    <div class="col-sm-10">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="@lang('accounting.capital.withdrawal.field.remarks')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.acc.capital.withdrawal.index') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            $("#inputDate").datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment()
            });
        });
    </script>
@endsection