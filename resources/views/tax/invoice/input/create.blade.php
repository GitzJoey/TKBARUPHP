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
    {!! Breadcrumbs::render('create_tax_invoice_input') !!}
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
                            <h3 class="box-title">Lawan Transaksi</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputOpponentTaxIDNo" class="control-label">NPWP</label>
                                    <input id="inputOpponentTaxIDNo" name="opponent_tax_id_no" type="text" class="form-control" v-validate="'required'" data-vv-as="{{ trans('tax.invoice.output.index.table.header.tin') }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputOpponentName" class="control-label">Nama</label>
                                    <input id="inputOpponentName" name="opponent_name" type="text" class="form-control" v-validate="'required'" data-vv-as="{{ trans('tax.invoice.output.index.table.header.name') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputInvoiceNo" class="control-label">Nomor Seri Faktur Pajak</label>
                                    <input id="inputInvoiceNo" name="invoice_no" type="text" class="form-control" v-validate="'required'" data-vv-as="{{ trans('tax.invoice.output.index.table.header.invoice_no') }}">
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
                                        <input id="inputTaxBase" name="tax_base" type="text" class="form-control" v-model="taxInput.taxBase" @input="calcTax">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputTaxGST" class="control-label">PPN = 10% x Dasar Pengenaan Pajak</label>
                                        <input id="inputTaxGST" name="gst" type="text" class="form-control" v-model="taxInput.gst" @input="calcTax">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputTaxLuxury" class="control-label">Total PPnBM (Pajak Penjualan Barang Mewah)</label>
                                        <input id="inputTaxLuxury" name="luxury_tax" type="text" class="form-control" v-model="taxInput.luxuryTax" @input="calcTax">
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
                <div class="col-md-7 col-offset-md-5">
                    <div class="btn-toolbar">
                        <button id="submitButton" type="button" class="btn btn-primary pull-right" v-on:click="validateBeforeSubmit('submit')">@lang('buttons.submit_button')</button>
                        <a id="cancelButton" class="btn btn-primary pull-right" href="{{ route('db.tax.invoice.output.index') }}">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>

        </form>

    </div>

@endsection

@section('custom_js')
    <script type="application/javascript">

        Vue.use(VeeValidate, { locale: '{!! LaravelLocalization::getCurrentLocale() !!}' });

        Vue.component('vue-datetimepicker', {
            template: "<input type='text' v-bind:id='id' v-bind:name='name' class='form-control' v-bind:format='format' v-model='value'>",
            props: ['id', 'name', 'format'],
            data: function() {
                return {
                    value: ''
                };
            },
            mounted: function() {
                var vm = this;

                if (this.format == undefined) this.format = 'DD-MM-YYYY';
                if (this.readonly == undefined) this.readonly = 'false';

                $(this.$el).datetimepicker({
                    format: this.format,
                    defaultDate: this.value == '' ? moment():moment(this.value),
                    showTodayButton: true,
                    showClose: true
                })
                .on('dp.change', function(e) {
                    vm.$emit('change', e.date);
                });

            },
            destroyed: function() {
                $(this.$el).data("DateTimePicker").destroy();
            }
        });

        var taxInputApp = new Vue({
            el: '#taxVue',
            data: {
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
                this.calcTax();
            },
            methods: {
                validateBeforeSubmit: function(type) {
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.tax.invoice.input.create') }}' + '?api_token=' + $('#secapi').val(), new FormData($('#taxForm')[0]))
                            .then(function(response) {
                                window.location.href = '{{ route('db.tax.invoice.input.index') }}';
                            });
                    }).catch(function() {

                    });
                },
                changeTaxPeriod: function(e) {
                    this.taxPeriod = moment(e).format('MM/YYYY');
                },
                calcTax: function() {
                    this.taxInput.grandTotal = numeral(numeral(this.taxInput.taxBase) + numeral(this.taxInput.gst) + numeral(this.taxInput.luxuryTax)).format()
                },
            }
        });

    </script>
@endsection
