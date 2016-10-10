@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.show.title')
@endsection

@section('page_title')
    <span class="fa fa-smile-o fa-fw"></span>&nbsp;@lang('customer.show.page_title')
@endsection
@section('page_title_desc')
    @lang('customer.show.page_title_desc')
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
            <h3 class="box-title">@lang('customer.show.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.customer.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li><a href="#tab_customer" data-toggle="tab">@lang('customer.show.tab.customer')</a></li>
                                <li><a href="#tab_pic" data-toggle="tab">@lang('customer.show.tab.pic')</a></li>
                                <li><a href="#tab_bank_account" data-toggle="tab">@lang('customer.show.tab.bank_account')</a></li>
                                <li><a href="#tab_settings" data-toggle="tab">@lang('customer.show.tab.settings')</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_customer">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">@lang('customer.field.name')</label>
                                        <div class="col-sm-10">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress" class="col-sm-2 control-label">@lang('customer.field.address')</label>
                                        <div class="col-sm-10">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity" class="col-sm-2 control-label">@lang('customer.field.city')</label>
                                        <div class="col-sm-10">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone" class="col-sm-2 control-label">@lang('customer.field.phone')</label>
                                        <div class="col-sm-10">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputRemarks" class="col-sm-2 control-label">@lang('customer.field.remarks')</label>
                                        <div class="col-sm-10">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTaxId" class="col-sm-2 control-label">@lang('customer.field.tax_id')</label>
                                        <div class="col-sm-10">

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_pic">
                                    <div ng-app="addCustomerProfileModule" ng-controller="addProfile">
                                        <div class="box-group" id="accordion">
                                            <div class="panel box box-default">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title">
                                                        <a class="collapsed" aria-expanded="false" href="#collapseOne" data-toggle="collapse" data-parent="#accordion">
                                                            @lang('customer.show.tab.header.profile_lists')
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="collapseOne" aria-expanded="false">
                                                    <div class="box-body">
                                                        <div class="row">
                                                            @foreach ($customer->getProfile as $profile)
                                                                <div class="col-md-3">
                                                                    <div class="box-body box-profile">
                                                                        <img class="profile-user-img img-responsive img-circle" alt="User profile picture" src="{{ asset('images/blank.png') }}">

                                                                        <h3 class="profile-username text-center">{{ $profile.first_name }}&nbsp;{{ $profile.last_name }}</h3>

                                                                        <p class="text-muted text-center">{{ $profile.designation }}</p>

                                                                        <ul class="list-group list-group-unbordered">
                                                                            <li class="list-group-item">
                                                                                <b>@lang('customer.field.ic_num')</b> <a class="pull-right">{{ $profile.ic_num }}</a>
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <b>@lang('customer.field.address')</b> <a class="pull-right">{{ $profile.address }}</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_bank_account">
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="text-center">@lang('customer.show.table.bank.header.bank')</th>
                                                <th class="text-center">@lang('customer.show.table.bank.header.account_number')</th>
                                                <th class="text-center">@lang('customer.show.table.bank.header.remarks')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($customer->getBankAccount as $bank)
                                                    <tr>
                                                        <td>
                                                            {{ $bank.bank_name }}
                                                            <input type="hidden" name="bank[]" value="@{{ bank.id }}">
                                                        </td>
                                                        <td>
                                                            {{ $bank.account_number }}
                                                            <input type="hidden" name="account_number[]" value="@{{ bank.account_number }}">
                                                        </td>
                                                        <td>
                                                            {{ $bank.remarks }}
                                                            <input type="hidden" name="remarks[]" value="@{{ bank.remarks }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_settings">
                                    <div class="form-group">
                                        <label for="inputPaymentDueDay" class="col-sm-2 control-label">@lang('customer.field.payment_due_day')</label>
                                        <div class="col-sm-10">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                        <a href="{{ route('db.master.customer') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection