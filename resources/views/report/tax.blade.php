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
    <div v-show="errors.count() > 0" v-cloak>
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul v-for="(e, eIdx) in errors.all()">
                <li>@{{ e }}</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Report</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Bulan</label>
                                <select v-model="report.month" name="bulan" class="form-control">
                                    @foreach ($months as $k => $m)
                                    <option value="{{ $k+1 }}" {{ date('n') == $k+1 ? 'selected' : '' }}>{{ $m }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tahun</label>
                                <select v-model="report.year" name="tahun" class="form-control">
                                    @for ($i = date('Y')-5; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ date('Y') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-toolbar">
                                <button id="submitButton" type="button" class="btn btn-primary pull-right" v-on:click="generateReport()">Submit</button>
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

    Vue.use(VeeValidate, { locale: '{!! LaravelLocalization::getCurrentLocale() !!}' });

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
