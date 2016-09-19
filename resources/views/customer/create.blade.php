@extends('layouts.adminlte.master')

@section('title', 'Customer Management')

@section('page_title')
    <span class="fa fa-@lang('customer.icon') fa-fw"></span>&nbsp;@lang('customer.create.title')
@endsection
@section('page_title_desc', '')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Create New Customer</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.customer.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">@lang('customer.name')</label>
                    <div class="col-sm-10">
                        <input id="name" name="name" type="text" class="form-control" placeholder="@lang('customer.name')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">@lang('customer.address')</label>
                    <div class="col-sm-10">
                       <textarea name="address" id="address" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city" class="col-sm-2 control-label">@lang('customer.city')</label>
                    <div class="col-sm-10">
                        <input id="city" name="city" type="text" class="form-control" placeholder="@lang('customer.city')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-2 control-label">@lang('customer.phone')</label>
                    <div class="col-sm-10">
                        <input id="phone" name="phone" type="tel" class="form-control" placeholder="@lang('customer.phone')">
                    </div>
                </div>
                <div class="form-group">
                    <label for="remarks" class="col-sm-2 control-label">@lang('customer.remarks')</label>
                    <div class="col-sm-10">
                        <input id="remarks" name="remarks" type="text" class="form-control" placeholder="@lang('customer.remarks')">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="tax_id" class="col-sm-2 control-label">@lang('customer.tax_id')</label>
                    <div class="col-sm-10">
                        <input id="tax_id" name="tax_id" type="text" class="form-control" placeholder="@lang('customer.tax_id')">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="payment_due_date" class="col-sm-2 control-label">@lang('customer.payment_due_date')</label>
                    <div class="col-sm-10">
                        <input id="payment_due_date" name="payment_due_date" type="text" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.customer') }}" class="btn btn-default">Cancel</a>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
