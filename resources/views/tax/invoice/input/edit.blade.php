@extends('layouts.adminlte.master')

@section('title')
    @lang('tax.invoice.input.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-sign-out"></span>&nbsp;@lang('tax.invoice.input.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('tax.invoice.input.edit.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit_tax_invoice_input', $tax) !!}
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
                            <h3 class="box-title">@lang('tax.invoice.input.create.title.transaction_opponent')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="invoice_no" class="control-label">@lang('tax.invoice.input.create.field.invoice_no')</label>
                                <input id="invoice_no" name="invoice_no" type="text" class="form-control" v-model="invoiceNo" v-validate="'required'" data-vv-as="@lang('tax.invoice.input.create.field.invoice_no')">
                            </div>
                            <div class="form-group">
                                <label for="opponent_tax_id_no" class="control-label">@lang('tax.invoice.input.create.field.opponent_tax_id_no')</label>
                                <div class="input-group">
                                  <select2-supplier class="form-control" name="opponent_tax_id_no"
                                                    id="tax_id" text="tax_id" placeholder="@lang('tax.invoice.input.create.misc.tax_id_no_placeholder')"
                                                    v-bind:default-id="opponentTaxIdNo" v-bind:default-text="opponentTaxIdNo"
                                                    v-validate="'required'"
                                                    data-vv-as="@lang('tax.invoice.input.create.field.opponent_tax_id_no')"
                                                    v-model="opponentTaxIdNo"
                                                    v-on:select-option="onSelectSupplier"></select2-supplier>
                                  <span class="input-group-btn">
                                      <a href="{{ route('db.master.customer.create', [ 'redirect' => urlencode(url()->full()) ]) }}" class="btn btn-default btn-default">
                                          <i class="fa fa-plus"></i>
                                      </a>
                                  </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="opponent_name" class="control-label">@lang('tax.invoice.input.create.field.opponent_name')</label>
                                <input id="opponent_name" name="opponent_name" v-bind:value="opponentName" type="text" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="invoice_date" class="control-label">@lang('tax.invoice.input.create.field.invoice_date')</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <vue-datetimepicker id="invoice_date" name="invoice_date" format="DD/MM/YYYY" v-bind:value="invoiceDate" v-on:input="onInputInvoiceDate" v-validate="'required'" data-vv-as="@lang('tax.invoice.input.create.field.invoice_date')"></vue-datetimepicker>
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
                                            <input id="month" name="month" type="text" class="form-control" v-bind:value="month" v-validate="'required'" data-vv-as="@lang('tax.invoice.input.create.field.month')">
                                        </div>
                                        <label for="year" class="col-xs-3 control-label">@lang('tax.invoice.input.create.field.year')</label>
                                        <div class="col-xs-3">
                                            <input id="year" name="year" type="text" class="form-control" v-bind:value="year" v-validate="'required'" data-vv-as="@lang('tax.invoice.input.create.field.year')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_creditable" class="control-label">@lang('tax.invoice.input.create.field.is_creditable')</label>
                                <div class="form-group">
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="is_creditable" id="is_creditable" value="1" v-bind:checked="isCreditable == 1">
                                            @lang('tax.invoice.input.create.misc.yes')
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="is_creditable" id="is_creditable" value="0" v-bind:checked="isCreditable == 0">
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
                            <h3 class="box-title">@lang('tax.invoice.input.create.title.invoice_detail')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="detail" class="control-label">@lang('tax.invoice.input.create.field.detail')</label>
                                        <select class="form-control" name="detail" v-model="detail">
                                            @foreach (App\Model\Product::orderBy('name')->get() as $key => $product)
                                            <option value="{{ $product->name }}" v-bind:selected="detail == '{{ $product->name }}'">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="qty" class="control-label">@lang('tax.invoice.input.create.field.qty')</label>
                                        <input id="qty" name="qty" type="text" class="form-control" v-bind:value="qty" v-on:input="onInputQty" v-validate="'required|numeric'" data-vv-as="@lang('tax.invoice.input.create.field.qty')">
                                    </div>
                                    <div class="form-group">
                                        <label for="unit_price" class="control-label">@lang('tax.invoice.input.create.field.unit_price')</label>
                                        <input id="unit_price" name="unit_price" type="text" class="form-control" v-bind:value="unitPrice" v-on:input="onInputUnitPrice" v-validate="'required|numeric'" data-vv-as="@lang('tax.invoice.input.create.field.unit_price')">
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
                                        <input id="tax_base" name="tax_base" type="text" class="form-control" v-bind:value="taxBase" v-on:input="onInputTaxBase" v-validate="'required'" data-vv-as="@lang('tax.invoice.input.create.field.tax_base')">
                                    </div>
                                    <div class="form-group">
                                        <label for="gst" class="control-label">@lang('tax.invoice.input.create.field.gst')</label>
                                        <input id="gst" name="gst" type="text" class="form-control" v-model="gst" v-validate="'required'" data-vv-as="@lang('tax.invoice.input.create.field.gst')">
                                    </div>
                                    <div class="form-group">
                                        <label for="luxury_tax" class="control-label">@lang('tax.invoice.input.create.field.luxury_tax')</label>
                                        <input id="luxury_tax" name="luxury_tax" type="text" class="form-control" v-model="luxuryTax" v-validate="'required'" data-vv-as="@lang('tax.invoice.input.create.field.luxury_tax')">
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
                        <a id="cancelButton" class="btn btn-primary pull-right" href="{{ route('db.tax.invoice.input.index') }}">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>

        </form>
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
                detail: "{{ $tax->detail }}",
                qty: "{{ $tax->qty }}",
                unitPrice: "{{ $tax->unit_price }}",
                gst: "{{ $tax->gst }}",
                luxuryTax: "{{ $tax->luxury_tax }}",
            },
            methods: {
                validateBeforeSubmit: function(type) {
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.tax.invoice.input.edit', $tax->id) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#taxForm')[0]))
                            .then(function(response) {
                                window.location.href = '{{ route('db.tax.invoice.input.index') }}';
                            }).catch(function (error) {
                                $('#loader-container').fadeOut('slow');
                                new noty({
                                    layout: 'topRight',
                                    text: error.response.data.message,
                                    type: 'error',
                                    theme: 'relax',
                                    timeout: 5000,
                                    progressBar: true
                                }).show();
                            });
                    }).catch(function() {

                    });
                },
                onInputInvoiceDate: function (value) {
                    this.invoiceDate = value;
                    this.month = moment(value, 'DD/MM/YYYY').format('MM');
                    this.year = moment(value, 'DD/MM/YYYY').format('YYYY');
                },
                onInputQty: function (e) {
                    this.qty = e.target.value;
                    this.taxBase = this.qty * this.unitPrice;
                    this.gst = this.taxBase * 10 / 100;
                },
                onInputUnitPrice: function (e) {
                    this.unitPrice = e.target.value;
                    this.taxBase = this.qty * this.unitPrice;
                    this.gst = this.taxBase * 10 / 100;
                },
                onInputTaxBase: function (e) {
                    this.taxBase = e.target.value;
                    this.gst = this.taxBase * 10 / 100;
                },
                onSelectSupplier: function (supplier) {
                    this.opponentTaxIdNo = supplier.tax_id;
                    this.opponentName = supplier.name;
                }
            }
        });

    </script>
@endsection
