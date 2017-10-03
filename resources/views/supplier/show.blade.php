@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.show.title')
@endsection

@section('page_title')
    <span class="fa fa-building-o fa-fw"></span>&nbsp;@lang('supplier.show.page_title')
@endsection

@section('page_title_desc')
    @lang('supplier.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_supplier_show', $supplier->hId()) !!}
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('supplier.show.header.title')</h3>
        </div>
        <form class="form-horizontal">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_supplier" data-toggle="tab">@lang('supplier.show.tab.supplier')</a></li>
                        <li><a href="#tab_pic" data-toggle="tab">@lang('supplier.show.tab.pic')</a></li>
                        <li><a href="#tab_bank_account" data-toggle="tab">@lang('supplier.show.tab.bank_account')</a></li>
                        <li><a href="#tab_product" data-toggle="tab">@lang('supplier.show.tab.product')</a></li>
                        <li><a href="#tab_expenses" data-toggle="tab">@lang('supplier.show.tab.expenses')</a></li>
                        <li><a href="#tab_settings" data-toggle="tab">@lang('supplier.show.tab.settings')</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_supplier">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">@lang('supplier.field.name')</label>
                                <div class="col-sm-10">
                                    <label id="inputName" class="control-label">
                                        <span class="control-label-normal">{{ $supplier->name }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress" class="col-sm-2 control-label">@lang('supplier.field.address')</label>
                                <div class="col-sm-10">
                                    <label id="inputAddress" class="control-label">
                                        <span class="control-label-normal">{{ $supplier->address }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCity" class="col-sm-2 control-label">@lang('supplier.field.city')</label>
                                <div class="col-sm-10">
                                    <label id="inputCity" class="control-label">
                                        <span class="control-label-normal">{{ $supplier->city }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone" class="col-sm-2 control-label">@lang('supplier.field.phone')</label>
                                <div class="col-sm-10">
                                    <label id="inputPhone" class="control-label">
                                        <span class="control-label-normal">{{ $supplier->phone }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTaxId" class="col-sm-2 control-label">@lang('supplier.field.tax_id')</label>
                                <div class="col-sm-10">
                                    <label id="inputTaxId" class="control-label">
                                        <span class="control-label-normal">{{ $supplier->tax_id }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus" class="col-sm-2 control-label">@lang('supplier.field.status')</label>
                                <div class="col-sm-10">
                                    <label id="inputStatus" class="control-label">
                                        <span class="control-label-normal">@lang('lookup.'.$supplier->status)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRemarks" class="col-sm-2 control-label">@lang('supplier.field.remarks')</label>
                                <div class="col-sm-10">
                                    <label id="inputRemarks" class="control-label">
                                        <span class="control-label-normal">{{ $supplier->remarks }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_pic">
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach($supplier->profiles as $key => $profile)
                                        <div class="box box-widget">
                                            <div class="box-header with-border">
                                                <div class="user-block">
                                                    <strong>Person In Charge {{ $key + 1 }}</strong><br/>
                                                    &nbsp;&nbsp;&nbsp;{{ $profile->first_name }}&nbsp;{{ $profile->last_name }}
                                                </div>
                                                <div class="box-tools">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="inputFirstName" class="col-sm-2 control-label">@lang('supplier.field.first_name')</label>
                                                    <div class="col-sm-10">
                                                        <label id="inputFirstName" class="control-label">
                                                            <span class="control-label-normal">{{ $profile->first_name }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputLastName" class="col-sm-2 control-label">@lang('supplier.field.last_name')</label>
                                                    <div class="col-sm-10">
                                                        <label id="inputLastName" class="control-label">
                                                            <span class="control-label-normal">{{ $profile->last_name }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress" class="col-sm-2 control-label">@lang('supplier.field.address')</label>
                                                    <div class="col-sm-10">
                                                        <label id="inputAddress" class="control-label">
                                                            <span class="control-label-normal">{{ $profile->address }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputICNum" class="col-sm-2 control-label">@lang('supplier.field.ic_num')</label>
                                                    <div class="col-sm-10">
                                                        <label id="inputICNum" class="control-label">
                                                            <span class="control-label-normal">{{ $profile->ic_num }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPhoneNumber" class="col-sm-2 control-label">@lang('supplier.field.phone_number')</label>
                                                    <div class="col-sm-10">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>@lang('supplier.show.table_phone.header.provider')</th>
                                                                    <th>@lang('supplier.show.table_phone.header.number')</th>
                                                                    <th>@lang('supplier.show.table_phone.header.remarks')</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($profile->phoneNumbers as $phone)
                                                                    <tr>
                                                                        <td>{{ $phone->provider->name }}</td>
                                                                        <td>{{ $phone->number }}</td>
                                                                        <td>{{ $phone->remarks }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_bank_account">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">@lang('supplier.show.table_bank.header.bank')</th>
                                        <th class="text-center">@lang('supplier.show.table_bank.header.account_number')</th>
                                        <th class="text-center">@lang('supplier.show.table_bank.header.remarks')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($supplier->bankAccounts as $ba)
                                        <tr>
                                            <td>{{ $ba->bank->name }}&nbsp;({{ $ba->bank->name }})</td>
                                            <td>{{ $ba->account_number }}</td>
                                            <td>{{ $ba->remarks }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_expenses">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">@lang('supplier.show.table_expense.header.name')</th>
                                        <th class="text-center">@lang('supplier.show.table_expense.header.type')</th>
                                        <th class="text-center">@lang('supplier.show.table_expense.header.amount')</th>
                                        <th class="text-center">@lang('supplier.show.table_expense.header.internal_expense')</th>
                                        <th class="text-center">@lang('supplier.show.table_expense.header.remarks')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($supplier->expenseTemplates as $key => $expenseTemplate)
                                        <tr>
                                            <td class="text-center valign-middle">
                                                {{ $expenseTemplate->name }}
                                            </td>
                                            <td class="text-center valign-middle">
                                                {{ $expenseTemplate->type }}
                                            </td>
                                            <td class="text-center valign-middle">
                                                {{ number_format($expenseTemplate->amount) }}
                                            </td>
                                            <td class="text-center valign-middle">
                                                @if($expenseTemplate->is_internal_expense)
                                                    @lang('lookup.YESNOSELECT.YES')
                                                @else
                                                    @lang('lookup.YESNOSELECT.NO')
                                                @endif
                                            </td>
                                            <td class="valign-middle">
                                                {{ $expenseTemplate->remarks }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_settings">
                            <div class="form-group">
                                <label for="inputPaymentDueDay" class="col-sm-2 control-label">@lang('supplier.field.payment_due_day')</label>
                                <div class="col-sm-10">
                                    <label id="inputPaymentDueDay" class="control-label">
                                        <span class="control-label-normal">{{ $supplier->payment_due_day }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label">&nbsp;</label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.supplier') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </form>
    </div>
@endsection