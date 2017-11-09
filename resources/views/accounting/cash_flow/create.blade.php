@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.cash_flow.create.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.cash_flow.create.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.cash_flow.create.page_title_desc')
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
            <h3 class="box-title">@lang('accounting.cash_flow.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.acc.cash_flow.create') }}" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputDate" class="col-sm-2 control-label">@lang('accounting.cash_flow.field.date')</label>
                    <div class="col-sm-10">
                        <input id="inputDate" name="date" type="text" class="form-control" placeholder="@lang('accounting.cash_flow.field.date')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSource" class="col-sm-2 control-label">@lang('accounting.cash_flow.field.source_account')</label>
                    <div class="col-sm-10">

                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDestination" class="col-sm-2 control-label">@lang('accounting.cash_flow.field.destination_account')</label>
                    <div class="col-sm-10">

                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAmount" class="col-sm-2 control-label">@lang('accounting.cash_flow.field.amount')</label>
                    <div class="col-sm-10">
                        <input id="inputAmount" name="amount" type="text" class="form-control" placeholder="@lang('accounting.cash_flow.field.amount')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('accounting.cash_flow.field.remarks')</label>
                    <div class="col-sm-10">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="@lang('accounting.cash_flow.field.remarks')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.acc.cash') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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