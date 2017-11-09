@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.cost.create.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.cost.create.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.cost.create.page_title_desc')
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
            <h3 class="box-title">@lang('accounting.cost.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.acc.cost.create') }}" method="post" data-parsley-validate="parsley">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                    <label for="inputDate" class="col-sm-2 control-label">@lang('accounting.cost.field.date')</label>
                    <div class="col-sm-10">
                        <input id="inputDate" name="name" type="text" class="form-control" placeholder="@lang('accounting.cost.field.name')" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('date') ? $errors->first('date') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('source_account') ? 'has-error' : '' }}">
                    <label for="inputSourceAccount" class="col-sm-2 control-label">@lang('accounting.cost.field.source_account')</label>
                    <div class="col-sm-10">
                        {{ Form::select('source_account', $accountDDL, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'),'data-parsley-required' => 'true' )) }}
                        <span class="help-block">{{ $errors->has('source_account') ? $errors->first('source_account') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                    <label for="inputCategory" class="col-sm-2 control-label">@lang('accounting.cost.field.category')</label>
                    <div class="col-sm-5">
                        {{ Form::select('category', $costGroup, null, array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'),'data-parsley-required' => 'true' )) }}
                        <span class="help-block">{{ $errors->has('category') ? $errors->first('category') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                    <label for="inputAmount" class="col-sm-2 control-label">@lang('accounting.cost.field.amount')</label>
                    <div class="col-sm-5">
                        <input id="inputAmount" name="amount" type="text" class="form-control" placeholder="@lang('accounting.cost.field.amount')" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('accounting.cost.field.remarks')</label>
                    <div class="col-sm-5">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="@lang('accounting.cost.field.remarks')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.acc.cost') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.create_new_button')</button>
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
                format: "DD-MM-YYYY",
                defaultDate: moment()
            });
        });
    </script>
@endsection