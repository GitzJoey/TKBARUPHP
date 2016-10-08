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
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li><a href="#tab_customer" data-toggle="tab">@lang('customer.create.tab.customer')</a></li>
                                <li><a href="#tab_pic" data-toggle="tab">@lang('customer.create.tab.pic')</a></li>
                                <li><a href="#tab_bank_account" data-toggle="tab">@lang('customer.create.tab.bank_account')</a></li>
                                <li><a href="#tab_settings" data-toggle="tab">@lang('customer.create.tab.settings')</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_customer">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">@lang('customer.field.name')</label>
                                        <div class="col-sm-10">
                                            <input id="inputName" name="name" type="text" class="form-control" placeholder="@lang('customer.field.name')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                        <div class="col-sm-10">
                                            <textarea name="address" id="inputAddress" class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity" class="col-sm-2 control-label">@lang('customer.filed.city')</label>
                                        <div class="col-sm-10">
                                            <input id="inputCity" name="city" type="text" class="form-control" placeholder="@lang('customer.field.city')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-sm-2 control-label">@lang('customer.field.phone')</label>
                                        <div class="col-sm-10">
                                            <input id="inputPhone" name="phone" type="tel" class="form-control" placeholder="@lang('customer.field.phone')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('customer.field.remarks')</label>
                                        <div class="col-sm-10">
                                            <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="@lang('customer.field.remarks')">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTaxId" class="col-sm-2 control-label">@lang('customer.field.tax_id')</label>
                                        <div class="col-sm-10">
                                            <input id="inputTaxId" name="tax_id" type="text" class="form-control" placeholder="@lang('customer.field.tax_id')">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_pic">
                                    ...
                                </div>
                                <div class="tab-pane" id="tab_bank_account">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center">@lang('customer.create.table.bank.header.bank')</th>
                                            <th class="text-center">@lang('customer.create.table.bank.header.account_number')</th>
                                            <th class="text-center">@lang('customer.create.table.bank.header.status')</th>
                                            <th class="text-center">@lang('customer.create.table.bank.header.remarks')</th>
                                            <th class="text-center">@lang('labels.ACTION')</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5">
                                                    <button class="btn btn-xs btn-default" type="button">@lang('butons.create_new_button')</button>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label for="inputBank" class="col-sm-2 control-label">@lang('customer.field.bank')</label>
                                                <div class="col-sm-10">
                                                    {{ Form::select('bank', $bankDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputBankAccount" class="col-sm-2 control-label">@lang('customer.field.bank_account')</label>
                                                <div class="col-sm-10">
                                                    <input id="inputBankAccount" name="bank_account" type="text" class="form-control" placeholder="@lang('customer.field.bank_account')">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputStatus" class="col-sm-2 control-label">@lang('customer.field.status')</label>
                                                <div class="col-sm-10">
                                                    {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputRemarks" class="col-sm-2 control-label">@lang('customer.field.remarks')</label>
                                                <div class="col-sm-10">
                                                    <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="@lang('customer.field.remarks')">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputBankButtons" class="col-sm-2 control-label">&nbsp;</label>
                                                <div class="col-sm-10">
                                                    <button class="btn btn-xs btn-default" type="button">@lang('buttons.cancel_button')</button>
                                                    <button class="btn btn-xs btn-default" type="button">@lang('buttons.create_new_button')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_settings">
                                    <div class="form-group">
                                        <label for="inputPaymentDueDate" class="col-sm-2 control-label">@lang('customer.field.payment_due_date')</label>
                                        <div class="col-sm-10">
                                            <input id="inputPaymentDueDate" name="payment_due_date" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                        <a href="{{ route('db.master.customer') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
