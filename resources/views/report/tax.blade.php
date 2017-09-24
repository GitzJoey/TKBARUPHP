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
                                    Faktur Masukan
                                </a>
                            </li>
                            <li>
                                <a href="#tab_tax_keluaran_summary" data-toggle="tab">
                                    Faktur Keluaran Summary
                                </a>
                            </li>
                            <li>
                                <a href="#tab_tax_keluaran_detail" data-toggle="tab">
                                    Faktur Keluaran Detail
                                </a>
                            </li>
                            <li>
                                <a href="#tab_tax_arus" data-toggle="tab">
                                    Arus
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
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body table-responsive">
                    <table class="table">
                        <tbody id="tbody"></tbody>
                    </table>
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
            report: {
                month: new Date().getMonth() + 1,
                year: new Date().getFullYear()
            }
        },
        mounted: function() {
        },
        methods: {
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
