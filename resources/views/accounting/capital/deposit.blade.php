@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.capital.deposit.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.capital.deposit.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.capital.deposit.page_title_desc')
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
            <h3 class="box-title">@lang('accounting.capital.deposit.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.acc.capital.deposit.add') }}" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="inputDate" class="col-sm-2 control-label">@lang('accounting.capital.deposit.field.date')</label>
                    <div class="col-sm-10">
                        <input id="inputDate" name="date" type="text" class="form-control" placeholder="@lang('accounting.capital.deposit.field.date')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputDestinationAccount" class="col-sm-2 control-label">@lang('accounting.capital.deposit.field.destination_account')</label>
                    <div class="col-sm-10">
                        {{ Form::select('destination_account', $accountDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'),'data-parsley-required' => 'true' )) }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAmount" class="col-sm-2 control-label">@lang('accounting.capital.deposit.field.amount')</label>
                    <div class="col-sm-10">
                        <input id="inputAmount" name="amount" type="text" class="form-control" placeholder="@lang('accounting.capital.deposit.field.amount')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('accounting.capital.deposit.field.remarks')</label>
                    <div class="col-sm-10">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="@lang('accounting.capital.deposit.field.remarks')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.acc.capital.deposit.index') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
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