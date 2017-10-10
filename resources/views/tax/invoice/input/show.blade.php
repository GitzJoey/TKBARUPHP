@extends('layouts.adminlte.master')

@section('title')
    @lang('tax.invoice.input.show.title')
@endsection

@section('page_title')
    <span class="fa fa-sign-out"></span>&nbsp;@lang('tax.invoice.input.show.page_title')
@endsection

@section('page_title_desc')
    @lang('tax.invoice.input.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('show_tax_invoice_input', $tax) !!}
@endsection

@section('content')
    <div id="taxVue">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('tax.invoice.input.create.title.transaction_opponent')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="invoice_no" class="control-label">@lang('tax.invoice.input.create.field.invoice_no')</label>
                            <input id="invoice_no" type="text" class="form-control" v-model="invoiceNo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="opponent_tax_id_no" class="control-label">@lang('tax.invoice.input.create.field.opponent_tax_id_no')</label>
                            <input id="opponent_tax_id_no" type="text" class="form-control" v-model="opponentTaxIdNo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="opponent_name" class="control-label">@lang('tax.invoice.input.create.field.opponent_name')</label>
                            <input id="opponent_name" type="text" class="form-control" v-bind:value="opponentName" readonly>
                        </div>
                        <div class="form-group">
                            <label for="invoice_date" class="control-label">@lang('tax.invoice.input.create.field.invoice_date')</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input id="invoice_date" type="text" class="form-control" v-bind:value="invoiceDate" readonly>
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
                        <h3 class="box-title">@lang('tax.invoice.input.create.title.spt_report')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="control-label">@lang('tax.invoice.input.create.misc.tax_invoice_reporting_period')</label>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label for="month" class="col-xs-3 control-label">@lang('tax.invoice.input.create.field.month')</label>
                                    <div class="col-xs-3">
                                        <input id="month" type="text" class="form-control" v-bind:value="month" readonly>
                                    </div>
                                    <label for="year" class="col-xs-3 control-label">@lang('tax.invoice.input.create.field.year')</label>
                                    <div class="col-xs-3">
                                        <input id="year" type="text" class="form-control" v-bind:value="year" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_creditable" class="control-label">@lang('tax.invoice.input.create.field.is_creditable')</label>
                            <div class="form-group">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="is_creditable" id="is_creditable" value="1" v-bind:checked="isCreditable == 1" disabled>
                                        @lang('tax.invoice.input.create.misc.yes')
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="is_creditable" id="is_creditable" value="0" v-bind:checked="isCreditable == 0" disabled>
                                        @lang('tax.invoice.input.create.misc.no')
                                    </label>
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
                        <h3 class="box-title">@lang('tax.invoice.input.create.title.tax_invoice_value')</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tax_base" class="control-label">@lang('tax.invoice.input.create.field.tax_base')</label>
                                    <input id="tax_base" type="text" class="form-control" v-bind:value="taxBase" v-on:input="onInputTaxBase" v-validate="'required'" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="gst" class="control-label">@lang('tax.invoice.input.create.field.gst')</label>
                                    <input id="gst" type="text" class="form-control" v-model="gst" v-validate="'required'" data-vv-as="@lang('tax.invoice.input.create.field.gst')" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="luxury_tax" class="control-label">@lang('tax.invoice.input.create.field.luxury_tax')</label>
                                    <input id="luxury_tax" type="text" class="form-control" v-model="luxuryTax" v-validate="'required'" data-vv-as="@lang('tax.invoice.input.create.field.luxury_tax')" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                    </div>
                </div>
            </div>
        </div>

{{--
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('tax.invoice.input.create.title.transaction_opponent')</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputOpponentTaxIDNo" class="control-label">NPWP</label>
                                <input id="inputOpponentTaxIDNo" name="opponent_tax_id_no" type="text" class="form-control" v-model="taxInput.opponentTaxIdNo" disabled>
                            </div>
                            <div class="form-group">
                                <label for="inputOpponentName" class="control-label">Nama</label>
                                <input id="inputOpponentName" name="opponent_name" type="text" class="form-control" v-model="taxInput.opponentName" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputInvoiceNo" class="control-label">Nomor Seri Faktur Pajak</label>
                                <input id="inputInvoiceNo" name="invoice_no" type="text" class="form-control" v-model="taxInput.invoiceNo" disabled>
                            </div>
                            <div class="form-group">
                                <label for="inputDateOfTaxDoc" class="control-label">Tanggal Dokumen Pajak</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <vue-datetimepicker id="inputDateOfTaxDoc" name="tax_doc_date" format="DD-MM-YYYY" v-model="taxInput.invoiceDate" readonly></vue-datetimepicker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pelaporan SPT</h3>
                    </div>
                    <div class="box-body form-horizontal">
                        <div class="form-group">
                            <label for="inputTaxPeriod" class="col-sm-4 control-label">Masa Pajak</label>
                            <div class="col-sm-6">
                                <input id="inputTaxPeriod" name="tax_period" type="text" class="form-control" v-bind:value="taxPeriod" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTaxCreditable" class="col-sm-4 control-label">Dapat Dikreditkan</label>
                            <div class="col-sm-6">
                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="is_creditable" id="inputTaxCreditable" value="true">
                                        Ya
                                    </label>
                                </div>

                                <div class="radio-inline">
                                    <label>
                                        <input type="radio" name="is_creditable" id="inputTaxCreditable" value="false" checked>
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Detail Transaksi</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="inputTaxBase" class="control-label">Dasar Pengenaan Pajak</label>
                                    <input id="inputTaxBase" name="tax_base" type="text" class="form-control" v-model="taxInput.taxBase" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputTaxGST" class="control-label">PPN = 10% x Dasar Pengenaan Pajak</label>
                                    <input id="inputTaxGST" name="gst" type="text" class="form-control" v-model="taxInput.gst" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="inputTaxLuxury" class="control-label">Total PPnBM (Pajak Penjualan Barang Mewah)</label>
                                    <input id="inputTaxLuxury" name="luxury_tax" type="text" class="form-control" v-model="taxInput.luxuryTax" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="grandTotal" class="control-label">Grand Total</label>
                                    <span id="grandTotal" class="form-control">@{{ taxInput.grandTotal }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                    </div>
                </div>
            </div>
        </div>

--}}

        <div class="row">
            <div class="col-md-6 col-offset-md-6">
                <div class="btn-toolbar">
                    <a href="{{ route('db.tax.invoice.input.index') }}" class="btn btn-primary pull-right">@lang('buttons.back_button')</a>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('custom_js')
    <script type="application/javascript">
        var taxInputApp = new Vue({
            el: '#taxVue',
            data: {
                invoiceNo: "{{ $tax->invoice_no }}",
                invoiceDate: "{{ $tax->invoice_date }}",
                month: "{{ $tax->month }}",
                year: "{{ $tax->year }}",
                isCreditable: "{{ $tax->is_creditable }}",
                opponentTaxIdNo: "{{ $tax->opponent_tax_id_no }}",
                opponentName: "{{ $tax->opponent_name }}",
                taxBase: "{{ $tax->tax_base }}",
                gst: "{{ $tax->gst }}",
                luxuryTax: "{{ $tax->luxury_tax }}",
            }
        });

    </script>
@endsection
