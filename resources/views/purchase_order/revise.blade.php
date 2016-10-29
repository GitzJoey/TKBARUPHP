@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.revise.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-fw"></span>&nbsp;@lang('purchase_order.revise.page_title')
@endsection
@section('page_title_desc')
    @lang('purchase_order.revise.page_title_desc')
@endsection
@section('breadcrumbs')
    {!! Breadcrumbs::render('revise_purchase_order', $currentPo->hId()) !!}
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

    {!! Form::model($currentPo, ['method' => 'PATCH','route' => ['db.po.revise', $currentPo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
        {{ csrf_field() }}
        <div ng-app="poModule" ng-controller="poController">
            <div class="row">
                <div class="col-md-5">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.supplier')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSupplierType" class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_type')</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly value="@lang('lookup.'.$currentPo->supplier_type)">
                                </div>
                            </div>
                            @if($currentPo->supplier_type == 'SUPPLIERTYPE.R')
                                <div class="form-group">
                                    <label for="inputSupplierId" class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_name')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="{{ $currentPo->supplier->name }}">
                                    </div>
                                    <div class="col-sm-2">
                                        <button id="supplierDetailButton" type="button" class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#supplierDetailModal"><span
                                                    class="fa fa-info-circle fa-lg"></span></button>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="inputSupplierName" class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_name')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly value="{{ $currentPo->walk_in_supplier }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSupplierDetails" class="col-sm-2 control-label">@lang('purchase_order.revise.field.supplier_details')</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="5" readonly>{{ $currentPo->walk_in_supplier_details }}
                                        </textarea>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.purchase_order_detail')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPoCode" class="col-sm-2 control-label">@lang('purchase_order.revise.po_code')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="{{ $currentPo->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoType" class="col-sm-2 control-label">@lang('purchase_order.revise.po_type')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly value="@lang('lookup.'.$currentPo->po_type)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoDate" class="col-sm-2 control-label">@lang('purchase_order.revise.po_date')</label>
                                <div class="col-sm-10">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" readonly value="{{ $currentPo->po_created->format('d-m-Y') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoStatus" class="col-sm-2 control-label">@lang('purchase_order.revise.po_status')</label>
                                <div class="col-sm-10">
                                    <label class="control-label control-label-normal">@lang('lookup.'.$currentPo->status)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-offset-1">
                    &nbsp;
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.shipping')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputShippingDate" class="col-sm-2 control-label">@lang('purchase_order.revise.field.shipping_date')</label>
                                <div class="col-sm-5">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    @if($currentPo->status == 'POSTATUS.WA')
                                        <input type="text" class="form-control" id="inputShippingDate" name="shipping_date" value="{{ $currentPo->shipping_date->format('d-m-Y') }}" data-parsley-required="true">
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $currentPo->shipping_date->format('d-m-Y') }}" data-parsley-required="true">
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarehouse" class="col-sm-2 control-label">@lang('purchase_order.revise.field.warehouse')</label>
                                <div class="col-sm-5">
                                    @if($currentPo->status == 'POSTATUS.WA')
                                    <select id="inputWarehouse" data-parsley-required="true"
                                            name="warehouse_id"
                                            class="form-control"
                                            ng-model="po.warehouse"
                                            ng-options="warehouse as warehouse.name for warehouse in warehouseDDL track by warehouse.id">
                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                    </select>
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $currentPo->warehouse->name }}">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking" class="col-sm-2 control-label">@lang('purchase_order.revise.field.vendor_trucking')</label>
                                <div class="col-sm-8">
                                    @if($currentPo->status == 'POSTATUS.WA')
                                    <select id="inputVendorTrucking"
                                            name="vendor_trucking_id"
                                            class="form-control"
                                            ng-model="po.vendorTrucking"
                                            ng-options="vendorTrucking as vendorTrucking.name for vendorTrucking in vendorTruckingDDL track by vendorTrucking.id">
                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                    </select>
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $currentPo->vendorTrucking->name }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="box box-info">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-11">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.transactions')</h3>
                        </div>
                        <div class="box-body">
                            @if($currentPo->status == 'POSTATUS.WA')
                                <div class="row">
                                    <div class="col-md-11">
                                        <select id="inputProduct"
                                                class="form-control"
                                                ng-model="po.product"
                                                ng-options="product as product.name for product in productDDL track by product.id">
                                            <option value="">@lang('labels.PLEASE_SELECT')</option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-primary btn-md" ng-click="insertItem(po.product)"><span class="fa fa-plus"/></button>
                                    </div>
                                </div>
                                <hr>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="30%">@lang('purchase_order.revise.table.item.header.product_name')</th>
                                            <th width="15%" class="text-center">@lang('purchase_order.revise.table.item.header.header.quantity')</th>
                                            <th width="15%" class="text-center">@lang('purchase_order.revise.table.item.header.unit')</th>
                                            <th width="15%" class="text-center">@lang('purchase_order.revise.table.item.header.price_unit')</th>
                                            <th width="5%">&nbsp;</th>
                                            <th width="20%" class="text-center">@lang('purchase_order.revise.table.item.header.total_price')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr ng-repeat="item in po.items">
                                            <input type="hidden" name="item_id[]" ng-value="item.id">
                                            <input type="hidden" name="product_id[]" ng-value="item.product.id">
                                            <input type="hidden" name="base_unit_id[]" ng-value="item.base_unit.unit.id">
                                            <td class="valign-middle">@{{ item.product.name }}</td>
                                            <td>
                                                <input type="text" class="form-control text-right" data-parsley-required="true" data-parsley-type="number"
                                                       name="quantity[]" ng-model="item.quantity" {{ $currentPo->status == 'POSTATUS.WA' ? '' : 'disabled' }}>
                                            </td>
                                            <td>
                                                @if($currentPo->status == 'POSTATUS.WA')
                                                <select name="selected_unit_id[]"
                                                        class="form-control"
                                                        data-parsley-required="true"
                                                        ng-model="item.selected_unit"
                                                        ng-options="product_unit as product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' for product_unit in item.product.product_units track by product_unit.unit.id">
                                                    <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                </select>
                                                @else
                                                    <input type="text" class="form-control" readonly value="@{{ item.selected_unit.unit.symbol }}">
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" class="form-control text-right" name="price[]" ng-model="item.price"
                                                       data-parsley-required="true"
                                                       data-parsley-type="number">
                                            </td>
                                            <td class="text-center">
                                                @if($currentPo->status == 'POSTATUS.WA')
                                                    <button type="button" class="btn btn-danger btn-md" ng-click="removeItem($index)"><span class="fa fa-minus"/></button>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="text" class="form-control text-right" name="total_price[]" ng-value="item.quantity * item.price" readonly>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsTotalListTable" class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td width="80%" class="text-right">@lang('purchase_order.create.table.total.body.total')</td>
                                            <td width="20%" class="text-right">
                                                <span class="control-label-normal">@{{ grandTotal() }}</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-offset-1">
                    &nbsp;
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.revise.box.remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputRemarks" name="remarks" class="form-control" rows="5">{{ $currentPo->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-offset-md-5">
                    <div class="btn-toolbar">
                        <button id="submitButton" type="submit" class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>&nbsp;&nbsp;&nbsp;
                        <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>
                        <a id="cancelButton" href="{{ route('db.po.revise.index') }}" class="btn btn-primary pull-right" role="button">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>

    {!! Form::close() !!}

    <div class="modal fade" id="supplierDetailModal" tabindex="-1" role="dialog"
         aria-labelledby="supplierDetailModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="supplierDetailModalLabel">Supplier Details</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab_supplier"
                                                              data-toggle="tab">@lang('supplier.create.tab.supplier')</a>
                                        </li>
                                        <li><a href="#tab_pic" data-toggle="tab">@lang('supplier.create.tab.pic')</a></li>
                                        <li><a href="#tab_bank_account"
                                               data-toggle="tab">@lang('supplier.create.tab.bank_account')</a></li>
                                        <li><a href="#tab_product"
                                               data-toggle="tab">@lang('supplier.create.tab.product')</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_supplier">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="inputName"
                                                           class="col-sm-2 control-label">@lang('supplier.field.name')</label>
                                                    <div class="col-sm-8">
                                                        <input id="inputName" type="text" class="form-control" readonly
                                                               ng-model="po.supplier.name">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputAddress"
                                                           class="col-sm-2 control-label">@lang('supplier.field.address')</label>
                                                    <div class="col-sm-8">
                                                            <textarea id="inputAddress" class="form-control"
                                                                      readonly rows="4">@{{ po.supplier.address }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputCity"
                                                           class="col-sm-2 control-label">@lang('supplier.field.city')</label>
                                                    <div class="col-sm-8">
                                                        <input id="inputCity" type="text" class="form-control" readonly
                                                               ng-model="po.supplier.city">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPhone"
                                                           class="col-sm-2 control-label">@lang('supplier.field.phone')</label>
                                                    <div class="col-sm-8">
                                                        <input id="inputPhone" type="tel" class="form-control" readonly
                                                               ng-model="po.supplier.phone_number">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputTaxId"
                                                           class="col-sm-2 control-label">@lang('supplier.field.tax_id')</label>
                                                    <div class="col-sm-8">
                                                        <input id="inputTaxId" type="text" class="form-control" readonly
                                                               ng-model="po.supplier.tax_id">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputRemarks"
                                                           class="col-sm-2 control-label">@lang('supplier.field.remarks')</label>
                                                    <div class="col-sm-8">
                                                        <input id="inputRemarks" type="text" class="form-control" readonly
                                                               ng-model="po.supplier.remarks">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_pic">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <div ng-repeat="profile in po.supplier.profiles">
                                                        <div class="box box-widget">
                                                            <div class="box-header with-border">
                                                                <div class="user-block">
                                                                    <strong>Person In Charge @{{ $index + 1 }}</strong><br/>
                                                                    &nbsp;&nbsp;&nbsp;@{{ profile.first_name }}
                                                                    &nbsp;@{{ profile.last_name }}
                                                                </div>
                                                                <div class="box-tools">
                                                                    <button type="button" class="btn btn-box-tool"
                                                                            data-widget="collapse"><i
                                                                                class="fa fa-minus"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    <label for="inputFirstName"
                                                                           class="col-sm-2 control-label">@lang('supplier.field.first_name')</label>
                                                                    <div class="col-sm-10">
                                                                        <input id="inputFirstName" type="text"
                                                                               class="form-control"
                                                                               readonly
                                                                               ng-model="profile.first_name">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputLastName"
                                                                           class="col-sm-2 control-label">@lang('supplier.field.last_name')</label>
                                                                    <div class="col-sm-10">
                                                                        <input id="inputLastName" type="text"
                                                                               class="form-control"
                                                                               readonly
                                                                               ng-model="profile.last_name">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputAddress"
                                                                           class="col-sm-2 control-label">@lang('supplier.field.address')</label>
                                                                    <div class="col-sm-10">
                                                                        <input id="inputAddress" type="text"
                                                                               class="form-control"
                                                                               readonly
                                                                               ng-model="profile.address">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputICNum"
                                                                           class="col-sm-2 control-label">@lang('supplier.field.ic_num')</label>
                                                                    <div class="col-sm-10">
                                                                        <input id="inputICNum" type="text"
                                                                               class="form-control"
                                                                               readonly
                                                                               ng-model="profile.ic_num">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPhoneNumber"
                                                                           class="col-sm-2 control-label">@lang('supplier.field.phone_number')</label>
                                                                    <div class="col-sm-10">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>@lang('supplier.create.table_phone.header.provider')</th>
                                                                                <th>@lang('supplier.create.table_phone.header.number')</th>
                                                                                <th>@lang('supplier.create.table_phone.header.remarks')</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <tr ng-repeat="phoneNumber in profile.phone_numbers">
                                                                                <td>
                                                                                    <input type="text" class="form-control"
                                                                                           readonly
                                                                                           ng-model="phoneNumber.provider.name">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control"
                                                                                           readonly
                                                                                           ng-model="phoneNumber.number">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control"
                                                                                           readonly
                                                                                           ng-model="phoneNumber.remarks">
                                                                                </td>
                                                                            </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_bank_account">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">@lang('supplier.create.table_bank.header.bank')</th>
                                                    <th class="text-center">@lang('supplier.create.table_bank.header.account_number')</th>
                                                    <th class="text-center">@lang('supplier.create.table_bank.header.remarks')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr ng-repeat="bankAccount in po.supplier.bank_accounts">
                                                    <td>
                                                        <input type="text" class="form-control"
                                                               readonly
                                                               ng-model="bankAccount.bank.name">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                               readonly
                                                               ng-model="bankAccount.account_number">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                               readonly
                                                               ng-model="bankAccount.remarks">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="tab_product">
                                            <div class="box-group" id="accordion_product">
                                                <div class="panel box box-default">
                                                    <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                            <a class="collapsed" aria-expanded="false"
                                                               href="#collapseProductLists" data-toggle="collapse"
                                                               data-parent="#accordion_product">
                                                                @lang('supplier.create.tab.header.bank_lists')
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div class="panel-collapse collapse" id="collapseProductLists"
                                                         aria-expanded="false">
                                                        <div class="box-body">
                                                            ...
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = angular.module('poModule', []);

        app.controller('poController', ['$scope', function($scope) {
            $scope.productDDL = JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}');
            $scope.warehouseDDL = JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}');
            $scope.vendorTruckingDDL = JSON.parse('{!! htmlspecialchars_decode($vendorTruckingDDL) !!}');

            var currentPo = JSON.parse('{!! htmlspecialchars_decode($currentPo->toJson()) !!}');

            $scope.po = {
              supplier : currentPo.supplier,
              items: [],
              warehouse: {
                  id: currentPo.warehouse.id,
                  name: currentPo.warehouse.name
              },
              vendorTrucking : {
                  id: (currentPo.vendor_trucking == null) ? '':currentPo.vendor_trucking.id,
                  name: (currentPo.vendor_trucking == null) ? '':currentPo.vendor_trucking.name
              }
            };

            for(var i = 0; i < currentPo.items.length; i++){
                $scope.po.items.push({
                    id: currentPo.items[i].id,
                    product: currentPo.items[i].product,
                    base_unit: _.find(currentPo.items[i].product.product_units, isBase),
                    selected_unit: _.find(currentPo.items[i].product.product_units, getSelectedUnit(currentPo.items[i].selected_unit_id)),
                    quantity: currentPo.items[i].quantity,
                    price: currentPo.items[i].price
                });
            }

            $scope.grandTotal = function() {
                var result = 0;
                angular.forEach($scope.po.items, function(item, key) {
                    result += (item.quantity * item.price);
                });
                return result;
            };

            $scope.insertItem = function (product){
                $scope.po.items.push({
                    id: null,
                    product: product,
                    base_unit: _.find(product.product_units, isBase),
                    selected_unit: null,
                    quantity: 0,
                    price: 0
                });
            };

            $scope.removeItem = function (index) {
                $scope.po.items.splice(index, 1);
            }

            function getSelectedUnit(selectedUnitId) {
                return function (element) {
                    return element.unit_id == selectedUnitId;
                }
            }

            function isBase(unit) {
                return unit.is_base == 1;
            }
        }]);

        $(function () {
            $('input[type="checkbox"], input[type="radio"]').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue'
            });

            $("#inputShippingDate").daterangepicker(
                    {
                        locale: {
                            format: 'DD-MM-YYYY'
                        },
                        singleDatePicker: true,
                        showDropdowns: true
                    }
            );
        });
    </script>
@endsection