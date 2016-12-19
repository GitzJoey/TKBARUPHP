@extends('layouts.adminlte.master')

@section('title')
    @lang('store.show.title')
@endsection

@section('page_title')
    <span class="fa fa-umbrella fa-fw"></span>&nbsp;@lang('store.show.page_title')
@endsection

@section('page_title_desc')
    @lang('store.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin_store_show', $store->hId()) !!}
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('store.show.header.title') : {{ $store->name }}</h3>
        </div>
        <form class="form-horizontal">
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_store" data-toggle="tab">@lang('store.create.tab.store')&nbsp;<span id="storeDataTabError" class="parsley-asterisk hidden">*</span></a></li>
                        <li><a href="#tab_bank_account" data-toggle="tab">@lang('store.create.tab.bank_account')&nbsp;<span id="bankAccountTabError" class="parsley-asterisk hidden">*</span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_store">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">@lang('store.field.name')</label>
                                <div class="col-sm-10">
                                    <label id="inputId" class="control-label">
                                        <span class="control-label-normal">{{ $store->name }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress" class="col-sm-2 control-label">@lang('store.field.address')</label>
                                <div class="col-sm-10">
                                    <label id="inputAddress" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $store->address }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone" class="col-sm-2 control-label">@lang('store.field.phone')</label>
                                <div class="col-sm-10">
                                    <label id="inputPhone" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $store->phone_num }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFax" class="col-sm-2 control-label">@lang('store.field.fax')</label>
                                <div class="col-sm-10">
                                    <label id="inputFax" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $store->fax_num }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTaxId" class="col-sm-2 control-label">@lang('store.field.tax_id')</label>
                                <div class="col-sm-10">
                                    <label id="inputTaxId" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $store->tax_id }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputIsDefault" class="col-sm-2 control-label">@lang('store.field.default')</label>
                                <div class="col-sm-10">
                                    <label id="inputIsDefault" class="control-label control-label-normal">
                                        <span class="control-label-normal">@lang('lookup.'.$store->is_default)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFrontWeb" class="col-sm-2 control-label">@lang('store.field.frontweb')</label>
                                <div class="col-sm-10">
                                    <label id="inputFrontWeb" class="control-label control-label-normal">
                                        <span class="control-label-normal">@lang('lookup.'.$store->frontweb)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus" class="col-sm-2 control-label">@lang('store.field.status')</label>
                                <div class="col-sm-10">
                                    <label id="inputStatus" class="control-label control-label-normal">
                                        <span class="control-label-normal">@lang('lookup.'.$store->status)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRemarks" class="col-sm-2 control-label">@lang('store.field.remarks')</label>
                                <div class="col-sm-10">
                                    <label id="inputRemarks" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $store->remarks }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_bank_account">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">@lang('store.create.table_bank.header.bank')</th>
                                    <th class="text-center">@lang('store.create.table_bank.header.account_number')</th>
                                    <th class="text-center">@lang('store.create.table_bank.header.remarks')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($store->bankAccounts as $ba)
                                    <tr>
                                        <td>{{ $ba->bank()->first()->name }}</td>
                                        <td>{{ $ba->account_number }}</td>
                                        <td>{{ $ba->remarks }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.store') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </form>
    </div>
@endsection