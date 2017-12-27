@extends('layouts.adminlte.master')

@section('title')
    @lang('tax.invoice.output.create.title')
@endsection

@section('page_title')
    <span class="fa fa-sign-out"></span>&nbsp;@lang('tax.invoice.output.create.page_title')
@endsection

@section('page_title_desc')
    @lang('tax.invoice.output.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('create_tax_invoice_output') !!}
@endsection

@section('content')
    <div id="taxVue">

        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="taxForm" v-on:submit.prevent="validateBeforeSubmit('submit')">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Informasi Transaksi PPN</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="gst_transaction_type" v-model="taxOutput.GSTTransactionType">
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
                                    <select id="inputTransDoc" name="transaction_doc" class="form-control">
                                        <option v-bind:value="defaultTranDoc.code">@lang('labels.PLEASE_SELECT')</option>
                                        <option v-for="td of tranDocDDL" v-bind:value="td.code">@{{ td.description }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputTranDet" class="control-label">Detail Transaksi PPN</label>
                                    <select id="inputTranDet" name="transaction_detail" class="form-control">
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
                                        <vue-datetimepicker id="inputDateOfTaxDoc" name="tax_doc_date" format="DD-MM-YYYY" @change="changeTaxPeriod"></vue-datetimepicker>
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
                                    <input id="inputInvoiceNo" name="invoice_no" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputReference" class="control-label">Referensi</label>
                                    <textarea id="inputReference" name="reference" class="form-control" rows="5"></textarea>
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
                                    <input id="inputOpponentTaxIDNo" name="opponent_tax_id_no" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputOpponentName" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input id="inputOpponentName" name="opponent_name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputOpponentAddress" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea id="inputOpponentAddress" name="opponent_address" class="form-control" rows="6"></textarea>
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
                            <button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal" v-on:click="insertTran()"><span class="fa fa-plus fa-fw"/></button>
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
                                            <th >&nbsp</th>
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
                                            <td class="text-center">
                                                <input type="hidden" name="tran_name[]" v-bind:value="tran.name">
                                                <input type="hidden" name="tran_is_gst_included[]" v-bind:value="tran.isGSTIncluded">
                                                <input type="hidden" name="tran_price[]" v-bind:value="tran.price">
                                                <input type="hidden" name="tran_discount[]" v-bind:value="tran.discount">
                                                <input type="hidden" name="tran_qty[]" v-bind:value="tran.qty">
                                                <input type="hidden" name="tran_gst[]" v-bind:value="tran.gst">
                                                <input type="hidden" name="tran_luxury_tax[]" v-bind:value="tran.luxuryTax">
                                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal" v-on:click="editTran(tran, tranIndex)"><span class="fa fa-pencil"></span></button>
                                                <button type="button" class="btn btn-danger btn-md" v-on:click="removeTran(tranIndex)"><span class="fa fa-minus"></span></button>
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
                                                    <input name="tax_base" type="hidden" v-bind:value="taxOutput.totalTaxBase"/>
                                                    <span class="control-label-normal">@{{ taxOutput.totalTaxBaseText }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">PPN = 10% x Dasar Pengenaan Pajak</td>
                                                <td class="text-right">
                                                    <input name="gst" type="hidden" v-bind:value="taxOutput.totalGST"/>
                                                    <span class="control-label-normal">@{{ taxOutput.totalGSTText }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-left">Total PPnBM (Pajak Penjualan Barang Mewah)</td>
                                                <td class="text-right">
                                                    <input name="luxury_tax" type="hidden" v-bind:value="taxOutput.totalLuxuryTax"/>
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
                <div class="col-md-7 col-offset-md-5">
                    <div class="btn-toolbar">
                        <button id="submitButton" type="button" class="btn btn-default pull-right" v-on:click="validateBeforeSubmit('submit')">@lang('buttons.submit_button')</button>
                        <a id="cancelButton" class="btn btn-default pull-right" href="{{ route('db.tax.invoice.output.index') }}">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>

        </form>

        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Detail Penyerahan Barang / Jasa</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="modalName">Name:</label>
                                    <select class="form-control" name="modalName" v-model="newTran.name">
                                        @foreach (App\Model\Product::orderBy('name')->get() as $key => $product)
                                        <option value="{{ $product->name }}" v-bind:selected="newTran.name == '{{ $product->name }}'">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="isGSTIncluded" type="checkbox" v-model="newTran.isGSTIncluded" v-on:change="calcOnModalGST"> Termasuk PPN
                                    </label>
                                </div>
                                <p style="margin:20px 0 20px">Harga Sebelum PPN = @{{ newTran.beforeGSTPriceText }}, Harga Sesudah PPN = @{{ newTran.afterGSTPriceText }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="modalPrice">Harga Satuan (Rp):</label>
                                    <input type="text" class="form-control" name="modalPrice" v-model="newTran.price" v-on:blur="calcOnModalGST">
                                </div>
                                <div class="form-group">
                                    <label for="modalQty">Jumlah Barang:</label>
                                    <input type="text" class="form-control" name="modalQty" v-model="newTran.qty" v-on:blur="calcOnModalGST">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="modalTotalPrice">Harga Total (Rp):</label>
                                    <input type="text" class="form-control" name="modalTotalPrice" v-model="newTran.totalPrice" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="modalDiscount">Diskon (Rp):</label>
                                    <input type="text" class="form-control" name="modalDiscount" v-model="newTran.discount" v-on:blur="calcOnModalGST">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="modalTaxBase">Dasar Pengenaan Pajak (DPP):</label>
                                    <input type="text" class="form-control" name="modalTaxBase" v-model="newTran.taxBase" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="modalGST">Pajak Pertambahan Nilai (PPN):</label>
                                    <input type="text" class="form-control" name="modalGST" v-model="newTran.gst" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="modalPercentageLuxuryTax">Tarif PPnBM:</label>
                                    <input type="text" class="form-control" name="modalPercentageLuxuryTax" v-model="newTran.luxuryTaxPercentage" v-on:blur="calcOnModalBlurLuxuryTaxPercentage">
                                </div>
                                <div class="form-group">
                                    <label for="modalLuxuryTax">Pajak Penjualan Atas Barang Mewah (PPnBM):</label>
                                    <input type="text" class="form-control" name="modalLuxuryTax" v-model="newTran.luxuryTax" v-on:blur="calcOnModalBlurLuxuryTax">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" v-on:click="saveTran()">@lang('buttons.ok_button')</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" type="button">@lang('buttons.cancel_button')</button>
                    </div>
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
                this.calcTax();
            },
            methods: {
                validateBeforeSubmit: function(type) {
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.tax.invoice.output.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#taxForm')[0]))
                            .then(function(response) {
                                window.location.href = '{{ route('db.tax.invoice.output.index') }}';
                            });
                    }).catch(function() {

                    });
                },
                changeTaxPeriod: function(e) {
                    this.taxPeriod = moment(e).format('MM/YYYY');
                },
                insertTran: function() {
                    this.newTran = {
                        index: -1,
                        name: '',
                        isGSTIncluded: false,
                        qty: 0,
                        price: 0,
                        totalPrice: 0,
                        gst: 0,
                        discount: 0,
                        taxBase: 0,
                        luxuryTaxPercentage: 0,
                        luxuryTax: 0,
                    };
                },
                saveTran: function() {
                    this.newTran.formattedQty = numbro(this.newTran.qty).format();
                    this.newTran.formattedTaxBase = numbro(this.newTran.taxBase).format();
                    this.newTran.formattedGST = numbro(this.newTran.gst).format();
                    this.newTran.formattedLuxuryTax = numbro(this.newTran.luxuryTax).format();
                    if(this.newTran.index == -1)
                        this.taxOutput.transactions.push(this.newTran);
                    else
                        this.$set(this.taxOutput.transactions, this.newTran.index, _.clone(this.newTran));
                    this.calcTax();
                },
                editTran: function(tran, index) {
                    this.$set(this, 'newTran', _.clone(tran));
                    this.newTran.index = index;
                    this.calcTax();
                },
                removeTran: function (index) {
                    var vm = this;
                    vm.taxOutput.transactions.splice(index, 1);
                    this.calcTax();
                },
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
                calcOnModalGST: function() {

                    this.newTran.totalPrice = this.newTran.qty * this.newTran.price;

                    if(this.newTran.isGSTIncluded) {
                        this.newTran.taxBase = 90 / 100 * this.newTran.totalPrice - (this.newTran.qty * this.newTran.discount);
                        this.newTran.beforeGSTPriceText = numbro(90 / 100 * this.newTran.price).format();
                        this.newTran.afterGSTPriceText = numbro(this.newTran.price).format();
                    }
                    else {
                        this.newTran.taxBase = this.newTran.totalPrice - (this.newTran.qty * this.newTran.discount);
                        this.newTran.beforeGSTPriceText = numbro(this.newTran.price).format();
                        this.newTran.afterGSTPriceText = numbro(110 / 100 * this.newTran.price).format();
                    }
                    this.newTran.gst = 10 / 100 * this.newTran.taxBase;

                },
                calcOnModalBlurLuxuryTaxPercentage: function() {
                    this.newTran.luxuryTax =  this.newTran.luxuryTaxPercentage / 100 * this.newTran.taxBase;
                },
                calcOnModalBlurLuxuryTax: function() {
                    this.newTran.luxuryTaxPercentage =  this.newTran.luxuryTax / this.newTran.taxBase * 100;
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
