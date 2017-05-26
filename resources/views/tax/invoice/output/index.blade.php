@extends('layouts.adminlte.master')

@section('title')
    @lang('tax.invoice.output.index.title')
@endsection

@section('page_title')
    <span class="fa fa-sign-out"></span>&nbsp;@lang('tax.invoice.output.index.page_title')
@endsection

@section('page_title_desc')
    @lang('tax.invoice.output.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('tax_invoice_output') !!}
@endsection

@section('content')
    <div id="taxVue">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('tax.invoice.output.index.header.title')</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.tin')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.name')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.invoice_no')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.invoice_date')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.code_type')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.month')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.year')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.invoice_status')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.tax_base')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.vat')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.luxury_tax')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.approval_status')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.approval_date')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.description')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.signature')</th>
                            <th class="text-center">@lang('tax.invoice.output.index.table.header.reference')</th>
                            <th class="text-center">@lang('labels.ACTION')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="tax in taxes" v-cloak>
                            <td class="text-center">@{{ $tax.tin }}</td>
                            <td class="text-center">@{{ $tax.name }}</td>
                            <td class="text-center">@{{ $tax.invoice_no }}</td>
                            <td class="text-center">@{{ $tax.invoice_date }}</td>
                            <td class="text-center">@{{ $tax.code_type }}</td>
                            <td class="text-center">@{{ $tax.month }}</td>
                            <td class="text-center">@{{ $tax.year }}</td>
                            <td class="text-center">@{{ $tax.invoice_status }}</td>
                            <td class="text-center">@{{ $tax.tax_base }}</td>
                            <td class="text-center">@{{ $tax.vat }}</td>
                            <td class="text-center">@{{ $tax.luxury_tax }}</td>
                            <td class="text-center">@{{ $tax.approval_status }}</td>
                            <td class="text-center">@{{ $tax.approval_date }}</td>
                            <td class="text-center">@{{ $tax.description }}</td>
                            <td class="text-center">@{{ $tax.signature }}</td>
                            <td class="text-center">@{{ $tax.reference }}</td>
                            <td class="text-center" width="10%">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <a class="btn btn-success" href="{{ route('db.tax.invoice.output.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = new Vue({
            el: '#taxVue',
            data:{
                taxes: []
            },
            methods: {
            },
            mounted: function() {
            }
        });
    </script>
@endsection
