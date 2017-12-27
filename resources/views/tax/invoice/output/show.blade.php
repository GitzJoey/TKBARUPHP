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
    {!! Breadcrumbs::render('show_tax_invoice_output', $tax) !!}
@endsection

@section('content')
    <div id="taxVue">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Informasi Transaksi PPN</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputGSTTranType" class="control-label">Jenis Transaksi PPN</label>
                                <select id="inputGSTTranType" class="form-control" disabled="true" v-model="taxOutput.GSTTransactionType">
                                    <option v-bind:value="defaultGSTTranType.code">@lang('labels.PLEASE_SELECT')</option>
                                    <option v-for="vtt of gstTranTypeDDL" v-bind:value="vtt.code">@{{ vtt.description }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputTransDoc" class="control-label">Dokumen Transaksi</label>
                                <select id="inputTransDoc" name="transaction_doc" class="form-control" v-model="taxOutput.transactionDoc" disabled="true">
                                    <option v-bind:value="defaultTranDoc.code">@lang('labels.PLEASE_SELECT')</option>
                                    <option v-for="td of tranDocDDL" v-bind:value="td.code">@{{ td.description }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputTranDet" class="control-label">Detail Transaksi PPN</label>
                                <select id="inputTranDet" name="transaction_detail" class="form-control" v-model="taxOutput.transactionDetail" disabled="true">
                                    <option v-bind:value="defaultTranDetail.code">@lang('labels.PLEASE_SELECT')</option>
                                    <option v-for="td of tranDetailDDL" v-bind:value="td.code">@{{ td.description }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDateOfTaxDoc" class="control-label">Tanggal Dokumen Pajak</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <vue-datetimepicker id="inputDateOfTaxDoc" name="tax_doc_date" format="DD-MM-YYYY" v-model="taxOutput.invoiceDate" readonly></vue-datetimepicker>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTaxPeriod" class="control-label">Masa Pajak</label>
                                <input id="inputTaxPeriod" name="tax_period" type="text" class="form-control" v-bind:value="taxPeriod" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputInvoiceNo" class="control-label">Nomor Seri Faktur Pajak</label>
                                <input id="inputInvoiceNo" name="invoice_no" type="text" class="form-control" v-model="taxOutput.invoiceNo" readonly>
                            </div>
                            <div class="form-group">
                                <label for="inputReference" class="control-label">Referensi</label>
                                <textarea id="inputReference" name="reference" class="form-control" rows="5" v-model="taxOutput.reference" readonly></textarea>
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
                        <h3 class="box-title">Pengusahan Kena Pajak</h3>
                    </div>
                    <div class="box-body form-horizontal">
                        <div class="form-group">
                            <label for="inputTaxIDNo" class="col-sm-2 control-label">NPWP</label>
                            <div class="col-sm-10">
                                <input id="inputTaxIDNo" name="tax_id_no" type="text" class="form-control" v-bind:value="currentStore.tax_id" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input id="inputName" name="name" type="text" class="form-control" v-bind:value="currentStore.name" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <textarea id="inputAddress" name="address" class="form-control" rows="6" v-bind:value="currentStore.address" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lawan Transaksi</h3>
                    </div>
                    <div class="box-body form-horizontal">
                        <div class="form-group">
                            <label for="inputOpponentTaxIDNo" class="col-sm-2 control-label">NPWP</label>
                            <div class="col-sm-10">
                                <input id="inputOpponentTaxIDNo" name="opponent_tax_id_no" type="text" class="form-control" v-model="taxOutput.opponentTaxIdNo" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputOpponentName" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-10">
                                <input id="inputOpponentName" name="opponent_name" type="text" class="form-control" v-model="taxOutput.opponentName" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputOpponentAddress" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <textarea id="inputOpponentAddress" name="opponent_address" class="form-control" rows="6" v-model="taxOutput.opponentAddress" readonly></textarea>
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
                        <h3 class="box-title">Detail Transaksi</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="detailTransactionListTable" class="table table-bordered table-hover" border="1">
                                    <thead>
                                    <tr>
                                        <th class="text-center" width="17%">Nama</th>
                                        <th class="text-center" width="17%">Jumlah Barang</th>
                                        <th class="text-center" width="17%">DPP</th>
                                        <th class="text-center" width="17%">PPN</th>
                                        <th class="text-center" width="17%">PPnBM</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(tran, tranIndex) in taxOutput.transactions">
                                        <td class="valign-middle">
                                            <span class="control-label-normal">@{{ tran.name }}</span>
                                        </td>
                                        <td class="valign-middle text-right">
                                            <span class="control-label-normal">@{{ tran.formattedQty }}</span>
                                        </td>
                                        <td class="valign-middle text-right">
                                            <span class="control-label-normal">@{{ tran.formattedTaxBase }}</span>
                                        </td>
                                        <td class="valign-middle text-right">
                                            <span class="control-label-normal">@{{ tran.formattedGST }}</span>
                                        </td>
                                        <td class="valign-middle text-right">
                                            <span class="control-label-normal">@{{ tran.formattedLuxuryTax }}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="transactionsTotalListTable" class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td class="text-left">Dasar Pengenaan Pajak</td>
                                        <td class="text-right">
                                            <span class="control-label-normal">@{{ taxOutput.totalTaxBaseText }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">PPN = 10% x Dasar Pengenaan Pajak</td>
                                        <td class="text-right">
                                            <span class="control-label-normal">@{{ taxOutput.totalGSTText }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Total PPnBM (Pajak Penjualan Barang Mewah)</td>
                                        <td class="text-right">
                                            <span class="control-label-normal">@{{ taxOutput.totalLuxuryTaxText }}</span>
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
        <div class="row">
            <div class="col-md-6 col-offset-md-6">
                <div class="btn-toolbar">
                    <a href="{{ route('db.tax.invoice.output.index') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_js')
    <script type="application/javascript">
        var poApp = new Vue({
            el: '#taxVue',
            data: {
                tax: JSON.parse('{!! htmlspecialchars_decode($tax->toJson()) !!}'),
                currentStore: JSON.parse('{!! htmlspecialchars_decode($currentStore->toJson()) !!}'),
                gstTranTypeDDL: JSON.parse('{!! htmlspecialchars_decode($gstTranTypeDDL) !!}'),
                tranDocDDL: JSON.parse('{!! htmlspecialchars_decode($tranDocDDL) !!}'),
                tranDetailDDL: JSON.parse('{!! htmlspecialchars_decode($tranDetailDDL) !!}'),
                taxPeriod: moment().format('MM/YYYY'),
                taxOutput: {
                    GSTTransactionType: 'GSTTRANSACTIONTYPEOUTPUT.5',
                    transactions: [],
                    totalSellingPrice: 0,
                    totalSellingPriceText: '',
                    totalDiscount: 0,
                    totalDiscountText: '',
                    totalTaxBase: 0,
                    totalTaxBaseText: '',
                    totalGST: 0,
                    totalGSTText: '',
                    totalLuxuryTax: 0,
                    totalLuxuryTaxText: '',
                },
                newTran: []
            },
            mounted: function() {
                this.init();
                this.calcTax();
            },
            methods: {
                calcTax: function() {

                    var totalSellingPrice = 0;
                    var totalTaxBase = 0;
                    var totalGST = 0;
                    var totalLuxuryTax = 0;

                    this.taxOutput.transactions.forEach(function(tran) {
                        totalGST += tran.gst;
                        totalTaxBase += tran.taxBase;
                        totalLuxuryTax += tran.luxuryTax;
                    });
                    this.taxOutput.totalTaxBase = totalTaxBase;
                    this.taxOutput.totalTaxBaseText = numbro(totalTaxBase).format();
                    this.taxOutput.totalGST = totalGST;
                    this.taxOutput.totalGSTText = numbro(totalGST).format();
                    this.taxOutput.totalLuxuryTax = totalLuxuryTax;
                    this.taxOutput.totalLuxuryTaxText = numbro(totalLuxuryTax).format();
                },
                init: function() {

                    this.taxOutput = {
                        GSTTransactionType: this.tax.gst_transaction_type,
                        transactionDoc: this.tax.transaction_doc,
                        transactionDetail: this.tax.transaction_detail,
                        invoiceDate: this.tax.invoice_date,
                        invoiceNo: this.tax.invoice_no,
                        reference: this.tax.reference,
                        opponentTaxIdNo: this.tax.opponent_tax_id_no,
                        opponentName: this.tax.opponent_name,
                        opponentAddress: this.tax.opponent_address,
                        totalTaxBase: this.tax.tax_base,
                        totalGST: this.tax.gst,
                        totalLuxuryTax: this.tax.luxury_tax,
                        transactions: [],
                    }

                    for (var i = 0; i < this.tax.transactions.length; i++) {

                        var tran = this.tax.transactions[i]

                        tran.totalPrice = tran.qty * tran.price;

                        if(tran.is_gst_included) {
                            tran.taxBase = 90 / 100 * tran.totalPrice - (tran.qty * tran.discount);
                            tran.beforeGSTPriceText = numbro(90 / 100 * tran.price).format();
                            tran.afterGSTPriceText = numbro(tran.price).format();
                        }
                        else {
                            tran.taxBase = tran.totalPrice - (tran.qty * tran.discount);
                            tran.beforeGSTPriceText = numbro(tran.price).format();
                            tran.afterGSTPriceText = numbro(110 / 100 * tran.price).format();
                        }
                        tran.gst = 10 / 100 * tran.taxBase;

                        tran.luxuryTax =  tran.luxury_tax;
                        tran.luxuryTaxPercentage =  tran.luxuryTax / tran.taxBase * 100;

                        this.taxOutput.transactions.push({
                            index: i,
                            id: tran.id,
                            name: tran.name,
                            isGSTIncluded: tran.is_gst_included,
                            qty: tran.qty,
                            price: tran.price,
                            discount : tran.discount,
                            gst: tran.gst,
                            luxuryTax: tran.luxury_tax,
                            formattedQty: numbro(tran.qty).format(),
                            formattedTaxBase: numbro(tran.taxBase).format(),
                            formattedGST: numbro(tran.gst).format(),
                            formattedLuxuryTax: numbro(tran.luxuryTax).format(),
                            totalPrice: tran.totalPrice,
                            taxBase: tran.taxBase,
                            luxuryTaxPercentage: tran.luxuryTaxPercentage,
                        });
                    }

                }
            },
            computed: {
                defaultGSTTranType: function(){
                    return {
                        code: ''
                    };
                },
                defaultTranDoc: function(){
                    return {
                        code: ''
                    };
                },
                defaultTranDetail: function(){
                    return {
                        code: ''
                    };
                },
            }
        });

    </script>
@endsection