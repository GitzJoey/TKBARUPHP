@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.outflow.deliver.title')
@endsection

@section('page_title')
    <span class="fa fa-mail-reply fa-rotate-90 fa-fw"></span>&nbsp;@lang('warehouse.outflow.deliver.page_title')
@endsection
@section('page_title_desc')
    @lang('warehouse.outflow.deliver.page_title_desc')
@endsection
@section('breadcrumbs')
    {!! Breadcrumbs::render('deliver', $so->hId()) !!}
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

    <form class="form-horizontal" action="{{ route('db.warehouse.outflow', $so->hId())}}" method="post" data-parsley-validate="parsley">
        {{ csrf_field() }}
        <div id="deliverVue">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.outflow.deliver.box.deliver')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputWarehouse" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.warehouse')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $so->warehouse->name }}">
                                    <input type="hidden" name="warehouse_id" value="{{ $so->warehouse->id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSOCode" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.so_code')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $so->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputShippingDate" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.shipping_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" readonly value="{{ $so->shipping_date->format('d-m-Y') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDeliverDate" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.deliver_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="inputDeliverDate" name="deliver_date" class="form-control" data-parsley-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.vendor_trucking')</label>
                                <div class="col-sm-8">
                                    @if (empty($so->vendorTrucking))
                                        <input type="text" class="form-control" readonly value="" >
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $so->vendorTrucking->name }}" >
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputLicensePlate" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.license_plate')</label>
                                <div class="col-sm-8">
                                    <input type="text" id="inputLicensePlate" name="license_plate" class="form-control" data-parsley-required="true">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.outflow.deliver.box.items')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="65%" class="text-center">@lang('warehouse.outflow.deliver.table.item.header.product_name')</th>
                                                <th width="15%" class="text-center">@lang('warehouse.outflow.deliver.table.item.header.unit')</th>
                                                <th width="15%" class="text-center">@lang('warehouse.outflow.deliver.table.item.header.brutto')</th>
                                                <th width="5%">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="deliver in outflow.delivers">
                                                <input type="hidden" name="item_id[]" v-bind:value="deliver.item.id">
                                                <input type="hidden" name="product_id[]" v-bind:value="deliver.item.product_id">
                                                <input type="hidden" name="stock_id[]" v-bind:value="deliver.item.stock_id">
                                                <input type="hidden" name="base_unit_id[]" v-bind:value="deliver.item.base_unit_id">
                                                <td class="valign-middle">@{{ deliver.item.product.name }}</td>
                                                <td>
                                                    <select name="selected_unit_id[]" data-parsley-required="true"
                                                            class="form-control"
                                                            v-model="deliver.selected_unit.unit_id">
                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="product_unit in deliver.item.product.product_units" v-bind:value="product_unit.unit.id">@{{ product_unit.unit.name }}(@{{ product_unit.unit.symbol }})</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control text-right" name="brutto[]" v-model="deliver.brutto"
                                                           data-parsley-required="true"
                                                           data-parsley-type="number">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-md" v-on:click="removeDeliver($index)"><span class="fa fa-minus"/></button>
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
        <div class="row">
            <div class="col-md-7 col-offset-md-5">
                <div class="btn-toolbar">
                    <button id="submitButton" type="submit" class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>&nbsp;&nbsp;&nbsp;
                    <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                    <a id="cancelButton" class="btn btn-primary pull-right" href="{{ route('db.warehouse.outflow.index') }}" >@lang('buttons.cancel_button')</a>
                </div>
            </div>
        </div>
        </div>
    </form>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function () {
            var app = new Vue({
                el: 'deliverVue',
                data: {
                    SO: JSON.parse('{!! htmlspecialchars_decode($so) !!}'),
                    outflow: {
                        delivers : []
                    }
                },
                methods: {
                    createDeliver: function() {
                        for(var i = 0; i < this.SO.items.length; i++){
                            this.outflow.delivers.push({
                                item: SO.items[i],
                                selected_unit: _.find(SO.items[i].product.product_units, getSelectedUnit(SO.items[i].selected_unit_id)),
                                brutto: SO.items[i].quantity % 1 != 0 ? parseFloat(SO.items[i].quantity).toFixed(1) : parseFloat(SO.items[i].quantity).toFixed(0)
                            });
                        }
                    },
                    removeDeliver: function (index) {
                        this.outflow.delivers.splice(index, 1);
                    }
                },
                ready: function() {
                    this.createDeliver();
                }
            });

            function getSelectedUnit(selectedUnitId) {
                return function (element) {
                    return element.unit_id == selectedUnitId;
                }
            }

            $("#inputDeliverDate").daterangepicker(
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