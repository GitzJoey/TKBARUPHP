@extends('layouts.adminlte.master')

@section('title')
    @lang('report.master.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-cog"></span>&nbsp;@lang('report.master.page_title')
@endsection

@section('page_title_desc')
    @lang('report.master.page_title_desc')
@endsection

@section('content')
    <div class="well">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.master.header.customer')</h3>
                    </div>
                    <form action="" method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputCustomer_Name" class="col-sm-3 control-label">@lang('report.master.field.name')</label>
                                <div class="col-sm-9">
                                    <input id="inputCustomer_Name" type="text" class="form-control" placeholder="@lang('report.master.field.name')">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCustomer_ProfileName" class="col-sm-3 control-label">@lang('report.master.field.profile_name')</label>
                                <div class="col-sm-9">
                                    <input id="inputCustomer_ProfileName" type="text" class="form-control" placeholder="@lang('report.master.field.profile_name')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCustomer_BankAccount" class="col-sm-3 control-label">@lang('report.master.field.bank_account')</label>
                                <div class="col-sm-9">
                                    <input id="inputCustomer_BankAccount" type="text" class="form-control" placeholder="@lang('report.master.field.bank_account')">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </form>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.master.header.supplier')</h3>
                    </div>
                    <form action="" method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSupplier_Name" class="col-sm-3 control-label">@lang('report.master.field.name')</label>
                                <div class="col-sm-9">
                                    <input id="inputSupplier_Name" type="text" class="form-control" placeholder="@lang('report.master.field.name')">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSupplier_ProfileName" class="col-sm-3 control-label">@lang('report.master.field.profile_name')</label>
                                <div class="col-sm-9">
                                    <input id="inputSupplier_ProfileName" type="text" class="form-control" placeholder="@lang('report.master.field.profile_name')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSupplier_BankAccount" class="col-sm-3 control-label">@lang('report.master.field.bank_account')</label>
                                <div class="col-sm-9">
                                    <input id="inputSupplier_BankAccount" type="text" class="form-control" placeholder="@lang('report.master.field.bank_account')">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </form>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.master.header.product')</h3>
                    </div>
                    <form action="" method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputProduct_Name" class="col-sm-3 control-label">@lang('report.master.field.name')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputProduct_Name" placeholder="@lang('report.master.field.name')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputProduct_ShortCode" class="col-sm-3 control-label">@lang('report.master.field.short_code')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputProduct_ShortCode" placeholder="@lang('report.master.field.short_code')">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </form>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.master.header.product_type')</h3>
                    </div>
                    <form action="" method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputProductUnit_Name" class="col-sm-3 control-label">@lang('report.master.field.name')</label>
                                <div class="col-sm-9">
                                    <input id="inputProductUnit_Name" type="text" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputProductUnit_ShortCode" class="col-sm-3 control-label">@lang('report.master.field.short_code')</label>
                                <div class="col-sm-9">
                                    <input id="inputShortCode" name="short_code" type="text" class="form-control" value="{{ old('short_code') }}" placeholder="Short Code">
                                    <span class="help-block">{{ $errors->has('short_code') ? $errors->first('short_code') : '' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.master.header.bank')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="inputBank_Name" class="col-sm-3 control-label">@lang('report.master.field.name')</label>
                                <div class="col-sm-9">
                                    <input id="inputBank_Name" type="text" class="form-control" placeholder="@lang('report.master.field.name')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputBank_ShortName" class="col-sm-3 control-label">@lang('report.master.field.short_name')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputBank_ShortName" placeholder="@lang('report.master.field.short_name')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputBank_Branch" class="col-sm-3 control-label">@lang('report.master.field.branch')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputBank_Branch" placeholder="@lang('report.master.field.branch')">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputBank_BranchCode" class="col-sm-3 control-label">@lang('report.master.field.branch_code')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputBank_BranchCode" placeholder="@lang('report.master.field.branch_code')">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                    </div>
                </div>
                <form action="{{ route('db.report.master.warehouse') }}" method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('report.master.header.warehouse')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputWarehouse_Name" class="col-sm-3 control-label">@lang('report.master.field.name')</label>
                                <div class="col-sm-9">
                                    <input id="inputWarehouse_Name" type="text" name="name" class="form-control" placeholder="@lang('report.master.field.name')">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                        </div>
                    </div>
                </form>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.master.header.truck')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="inputTruck_PlateNumber" class="col-sm-3 control-label">@lang('report.master.field.plate_number')</label>
                                <div class="col-sm-9">
                                    <input id="inputTruck_PlateNumber" type="text" class="form-control" placeholder="@lang('report.master.field.plate_number')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.master.header.truck_maintenance')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">@lang('report.master.field.plate_number')</label>
                                <div class="col-sm-9">
                                    {{ Form::select('plate_number', $trucklist, null, array('class' => 'form-control', 'placeholder' => trans('labels.PLEASE_SELECT'), 'id' => 'inputTruckMaintenance_PlateNumber')) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('report.master.header.vendor_trucking')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="inputVendorTrucking_Name" class="col-sm-3 control-label">@lang('report.master.field.name')</label>
                                <div class="col-sm-9">
                                    <input id="inputVendorTrucking_Name" type="text" class="form-control" placeholder="Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">@lang('buttons.print_preview_button')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection