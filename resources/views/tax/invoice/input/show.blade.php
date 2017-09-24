@extends('layouts.adminlte.master')

@section('title')
    @lang('tax.invoice.output.show.title')
@endsection

@section('page_title')
    <span class="fa fa-sign-out"></span>&nbsp;@lang('tax.invoice.output.show.page_title')
@endsection

@section('page_title_desc')
    @lang('tax.invoice.output.show.page_title_desc')
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
                        <h3 class="box-title">Lawan Transaksi</h3>
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

        <div class="row">
            <div class="col-md-6 col-offset-md-6">
                <div class="btn-toolbar">
                    <a href="{{ route('db.tax.invoice.input.index') }}" class="btn btn-default">@lang('buttons.back_button')</a>
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
                tax: JSON.parse('{!! htmlspecialchars_decode($tax->toJson()) !!}'),
                currentStore: JSON.parse('{!! htmlspecialchars_decode($currentStore->toJson()) !!}'),
                taxPeriod: moment().format('MM/YYYY'),
                taxInput: {
                    taxBase: 0,
                    gst: 0,
                    luxuryTax: 0,
                    grandTotal: 0
                }
            },
            mounted: function() {
                this.init();
                this.calcTax();
            },
            methods: {
                calcTax: function() {
                    this.taxInput.grandTotal = numeral(numeral(this.taxInput.taxBase) + numeral(this.taxInput.gst) + numeral(this.taxInput.luxuryTax)).format()
                },
                init: function() {

                    this.taxInput = {
                        invoiceDate: this.tax.invoice_date,
                        invoiceNo: this.tax.invoice_no,
                        opponentTaxIdNo: this.tax.opponent_tax_id_no,
                        opponentName: this.tax.opponent_name,
                        taxBase: numeral(this.tax.tax_base).format(),
                        gst: numeral(this.tax.gst).format(),
                        luxuryTax: numeral(this.tax.luxury_tax).format(),
                    }
                }
            }
        });

    </script>
@endsection
