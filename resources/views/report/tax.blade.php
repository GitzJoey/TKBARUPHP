@extends('layouts.adminlte.master')

@section('title')
    @lang('report.tax.title')
@endsection

@section('page_title')
    <span class="fa fa-institution fa-fw"></span>&nbsp;@lang('report.tax.page_title')
@endsection

@section('page_title_desc')
    @lang('report.tax.page_title_desc')
@endsection

@section('content')
    <div id="taxReport">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('report.tax.header.title')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_tax_masukan" data-toggle="tab">
                                        @lang('report.tax.nav_tabs.invoice_input')
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_tax_keluaran_summary" data-toggle="tab">
                                        @lang('report.tax.nav_tabs.invoice_output_summary')
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_tax_keluaran_detail" data-toggle="tab">
                                        @lang('report.tax.nav_tabs.invoice_output_detail')
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_tax_arus" data-toggle="tab">
                                        @lang('report.tax.nav_tabs.flow')
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab_tax" >
                                <div class="tab-pane active" id="tab_tax_masukan">
                                    @include('report.tax_components.faktur_masukan')
                                </div>
                                <div class="tab-pane" id="tab_tax_keluaran_summary">
                                    @include('report.tax_components.faktur_keluaran_summary')
                                </div>
                                <div class="tab-pane" id="tab_tax_keluaran_detail">
                                    @include('report.tax_components.faktur_keluaran_detail')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-center">
                            <ul class="pagination pagination-sm no-margin">
                                <li><a v-bind:href="'{{ route('db.report.tax', [ 'year' => $year - 1, 'month' => 12 ]) }}' + openedNavTab">{{ $year - 1 }}</a></li>
                                @foreach ($months as $key => $value)
                                    <li class="{{ $month == $key ? 'active' : '' }}">
                                        @if ($loop->first)
                                            <a v-bind:href="'{{ route('db.report.tax', [ 'year' => $year, 'month' => $key ]) }}' + openedNavTab">{{ $year }} - {{ str_pad($key, 2, '0', STR_PAD_LEFT) }}</a>
                                        @else
                                            <a v-bind:href="'{{ route('db.report.tax', [ 'year' => $year, 'month' => $key ]) }}' + openedNavTab">{{ str_pad($key, 2, '0', STR_PAD_LEFT) }}</a>
                                        @endif
                                    </li>
                                @endforeach
                                <li><a v-bind:href="'{{ route('db.report.tax', [ 'year' => $year + 1, 'month' => 1 ]) }}' + openedNavTab">{{ $year + 1 }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = new Vue({
            el: '#taxReport',
            data: {
                openedNavTab: window.location.hash,
                taxesInput: [],
                taxesOutput: [],
                report: {
                    month: new Date().getMonth() + 1,
                    year: new Date().getFullYear()
                }
            },
            computed: {
                totalGstInput: function () {
                    return _.sumBy(this.taxesInput, 'gst');
                },
                grandTotalInput: function () {
                    return _.sumBy(this.taxesInput, function (taxInput) {
                        return taxInput.taxBase + taxInput.gst + taxInput.luxuryTax;
                    });
                },
                invoiceDatesOutput: function () {
                    return _.sortedUniq(_.map(this.taxesOutput, function (taxOutput) {
                        return taxOutput.invoiceDate;
                    }));
                },
                transactionNamesOutput: function () {
                    return _.map(_.uniqBy(_.flatMap(this.taxesOutput, function (taxOutput) {
                        return taxOutput.transactions;
                    }), function (transaction) {
                        return transaction.name;
                    }), function (transaction) {
                        return transaction.name;
                    });
                },
                taxesOutputPerInvoiceDate: function () {
                    var taxesOutput = {};
                    for (var i = 0; i < this.invoiceDatesOutput.length; i++) {
                        taxesOutput[this.invoiceDatesOutput[i]] =
                            _.filter(this.taxesOutput, function (taxOutput) {
                                return taxOutput.invoiceDate == this.invoiceDatesOutput[i];
                            }.bind(this)) || [];
                    }
                    return taxesOutput;
                },
                totalPriceOutputPerInvoiceDateAndName: function () {
                    var totalPriceOutput = {};
                    for (var i = 0; i < this.invoiceDatesOutput.length; i++) {
                        totalPriceOutput[this.invoiceDatesOutput[i]] = {};
                        for (var j = 0; j < this.transactionNamesOutput.length; j++) {
                            totalPriceOutput[this.invoiceDatesOutput[i]][this.transactionNamesOutput[j]] =
                                this.totalQtyOutputPerInvoiceDateAndName[this.invoiceDatesOutput[i]][this.transactionNamesOutput[j]] *
                                this.getPriceByInvoiceDateAndName(this.invoiceDatesOutput[i], this.transactionNamesOutput[j]) / 1.1;
                        }
                    }
                    return totalPriceOutput;
                },
                totalQtyOutputPerInvoiceDateAndName: function () {
                    var totalQtyOutput = {};
                    for (var i = 0; i < this.invoiceDatesOutput.length; i++) {
                        totalQtyOutput[this.invoiceDatesOutput[i]] = {};
                        for (var j = 0; j < this.transactionNamesOutput.length; j++) {
                            totalQtyOutput[this.invoiceDatesOutput[i]][this.transactionNamesOutput[j]] =
                                _.sumBy(_.flatMap(this.taxesOutputPerInvoiceDate[this.invoiceDatesOutput[i]], function (taxOutput) {
                                    return _.filter(taxOutput.transactions, function (transaction) {
                                        return transaction.name == this.transactionNamesOutput[j];
                                    }.bind(this));
                                }.bind(this)), 'qty');
                        }
                    }
                    return totalQtyOutput;
                }
            },
            mounted: function() {
                this.taxesInput = this.camelCasingKey({!! json_encode($taxes_input) !!});
                this.taxesOutput = this.camelCasingKey({!! json_encode($taxes_output) !!});

                $('a[href="' + this.openedNavTab + '"]').click();
                $('a[data-toggle=tab]').on('show.bs.tab', function (e) {
                    console.log(e.target.hash);
                    this.openedNavTab = e.target.hash;
                }.bind(this));
            },
            methods: {
                getTransactionsByInvoiceDate: function(invoiceDate) {
                    return _.flatMap(this.taxesOutputPerInvoiceDate[invoiceDate], function (taxOutput) {
                        return taxOutput.transactions;
                    }) || [];
                },
                getTransactionFromTaxOutputByName: function(taxOutput, name) {
                    return _.find(taxOutput.transactions, function (transaction) {
                        return transaction.name == name;
                    }) || {};
                },
                getPriceByInvoiceDateAndName: function (invoiceDate, name) {
                    return (_.find(this.getTransactionsByInvoiceDate(invoiceDate), function (transaction) {
                        return transaction.name == name;
                    }) || {}).price || 0;
                },
                generateReport: function() {
                    $('#loader-container').fadeIn('fast');
                    axios.get('{{ route('api.report.tax') }}', { params: { month: this.report.month, year: this.report.year } })
                        .then(function(response) {
                            $('#tbody').empty();
                            var html = '';
                            html += '<tr class="text-center"><td rowspan="2" style="vertical-align:middle"><b>Tanggal</b></td>';
                            response.data.items.forEach(function (item) {
                                html += '<td colspan="2"><b>'+item+'</b></td>';
                            });
                            response.data.items.forEach(function (item) {
                                html += '<td colspan="3"><b>'+item+'</b></td>';
                            });
                            $('#tbody').append(html);

                            html = '';
                            html += '<tr class="text-center">';
                            response.data.items.forEach(function (item) {
                                html += '<td><b>Qty</b></td><td><b>Harga Satuan</b></td>';
                            });
                            response.data.items.forEach(function (item) {
                                html += '<td><b>DPP-Jual</b></td><td><b>PPN-PK</b></td><td><b>Total</b></td>';
                            });
                            $('#tbody').append(html);

                            $.each(response.data.data, function (k,v) {
                                html = '';
                                html += '<tr><td class="text-center">'+k+'</td>';

                                v.forEach(function (i) {
                                    if (i.length === 0) {
                                        html += '<td>0</td><td>0</td>'
                                    } else {
                                        html += '<td>'+i.qty+'</td><td>'+i.price+'</td>';
                                    }
                                });

                                v.forEach(function (i) {
                                    if (i.length === 0) {
                                        html += '<td>0</td><td>0</td><td>0</td>'
                                    } else {
                                        html += '<td>'+i.dpp+'</td><td>'+i.ppn+'</td><td>'+i.total+'</td>';
                                    }
                                });

                                $('#tbody').append(html);
                            });

                            $('#loader-container').fadeOut('fast');
                        });
                }
            }
        });
    </script>
@endsection
