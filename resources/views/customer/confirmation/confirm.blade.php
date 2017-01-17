@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.confirmation.confirm.title')
@endsection

@section('page_title')
    <span class="fa fa-check fa-fw"></span>&nbsp;@lang('customer.confirmation.confirm.page_title')
@endsection

@section('page_title_desc')
    @lang('customer.confirmation.confirm.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('customer_confirmation', $so->hId()) !!}
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

    <form class="form-horizontal" action="{{ route('db.customer.confirmation.confirm', $so->hId())}}" method="post" data-parsley-validate="parsley">
        {{ csrf_field() }}
        <div id="custConfirmVue">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('customer.confirmation.confirm.box.sales_order')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSOCode" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.so_code')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $so->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDeliverDate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.deliver_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" readonly value="{{ $so->items()->first()->delivers()->first()->deliver_date->format('d-m-Y') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputLicensePlate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.license_plate')</label>
                                <div class="col-sm-8">
                                    <input type="text" id="inputLicensePlate" name="license_plate" value="{{ $so->items()->first()->delivers()->first()->license_plate }}" class="form-control" data-parsley-required="true" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputConfirmReceiveDate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.confirm_receive_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" id="inputConfirmReceiveDate" name="confirm_receive_date" class="form-control" data-parsley-required="true">
                                    </div>
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
                            <h3 class="box-title">@lang('customer.confirmation.confirm.box.items')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="20%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.product_name')</th>
                                                <th width="15%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.unit')</th>
                                                <th width="10%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.brutto')</th>
                                                <th width="10%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.netto')</th>
                                                <th width="10%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.tare')</th>
                                                <th width="30%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.remarks')</th>
                                                <th width="5%">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="deliver in outflow.delivers">
                                                <td class="valign-middle">
                                                    <input type="hidden" name="deliver_id[]" value="0">
                                                    <input type="hidden" name="item_id[]" value="@{{ deliver.item.id }}">
                                                    <input type="hidden" name="product_id[]" value="@{{ deliver.item.product_id }}">
                                                    <input type="hidden" name="base_unit_id[]" value="@{{ deliver.item.base_unit_id }}">
                                                    @{{ deliver.item.product.name }}
                                                </td>
                                                <td>
                                                    <select name="selected_unit_id[]" data-parsley-required="true"
                                                            class="form-control"
                                                            v-model="deliver.selected_unit.unit_id">
                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="product_unit in deliver.item.product.product_units" v-bind:value="product_unit.unit.id">@{{ product_unit.unit.name }} (@{{ product_unit.unit.symbol }})</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input id="brutto_@{{ deliver.item.id }}" type="text" class="form-control text-right" name="brutto[]" v-model="deliver.brutto"
                                                           data-parsley-required="true"
                                                           data-parsley-type="number"
                                                           data-parsley-trigger="change"
                                                           readonly>
                                                </td>
                                                <td>
                                                    <input id="netto_@{{ deliver.item.id }}" type="text" class="form-control text-right" name="netto[]" v-model="deliver.netto"
                                                           data-parsley-required="true"
                                                           data-parsley-type="number"
                                                           data-parsley-checkequal="@{{ deliver.item.id }}"
                                                           data-parsley-trigger="change">
                                                </td>
                                                <td>
                                                    <input id="tare_@{{ deliver.item.id }}" type="text" class="form-control text-right" name="tare[]" v-model="deliver.tare"
                                                           data-parsley-required="true"
                                                           data-parsley-type="number"
                                                           data-parsley-checkequal="@{{ deliver.item.id }}"
                                                           data-parsley-trigger="change">
                                                </td>
                                                <td>
                                                    <input id="remarks_@{{ deliver.item.id }}" type="text" class="form-control text-right" name="remarks[]" v-model="deliver.remarks">
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
                    <a id="cancelButton" class="btn btn-primary pull-right" href="{{ route('db.customer.confirmation.customer', $so->customer->hId()) }}" >@lang('buttons.cancel_button')</a>
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
                el: '#custConfirmVue',
                data: {
                    SO: JSON.parse('{!! htmlspecialchars_decode($so) !!}'),
                    outflow: {
                        delivers: []
                    }
                },
                methods: {
                    removeDeliver: function (index) {
                        this.outflow.delivers.splice(index, 1);
                    },
                    createDeliver: function() {
                        for(var i = 0; i < this.SO.items.length; i++) {
                            this.outflow.delivers.push({
                                item: this.SO.items[i],
                                selected_unit: _.find(this.SO.items[i].product.product_units, getSelectedUnit(this.SO.items[i].selected_unit_id)),
                                brutto: this.SO.items[i].quantity,
                                netto: 0,
                                tare: 0,
                                remarks: ''
                            });
                        }
                    }
                },
                ready: function() {
                    this.createDeliver();
                    console.log(this.outflow.delivers);
                }
            });

            function getSelectedUnit(selectedUnitId) {
                return function (element) {
                    return element.unit_id == selectedUnitId;
                }
            }

            $("#inputConfirmReceiveDate").daterangepicker({
                locale: {
                    format: 'DD-MM-YYYY'
                },
                singleDatePicker: true,
                showDropdowns: true
            });

            window.Parsley.addValidator('checkequal', function (value, itemId) {
                var brutto = '#brutto_' + itemId;
                var netto = '#netto_' + itemId;
                var tare = '#tare_' + itemId;

                if (Number($(brutto).val()) == (Number($(netto).val()) + Number($(tare).val()))) {
                    return false;
                } else {
                    return false;
                }
            }, 32)
                .addMessage('en', 'checkequal', 'Netto and Tare value not equal with Bruto')
                .addMessage('id', 'checkequal', 'Nilai bersih dan Tara tidak sama dengan Nilai Kotor');
        });
    </script>
@endsection