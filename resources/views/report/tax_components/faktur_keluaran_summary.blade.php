<div style="overflow-x:auto;white-space:nowrap">
    <table class="table table-bordered" v-if="taxesOutput.length">
        <thead>
            <tr>
                <th class="text-center" style="vertical-align:middle" rowspan="2">@lang('report.tax.output_summary.table.header.date')</th>
                <th class="text-center" style="vertical-align:middle" colspan="2" v-for="name in transactionNamesOutput">@{{ name }}</th>
                <th class="text-center" style="vertical-align:middle" colspan="3" v-for="name in transactionNamesOutput">@{{ name }}</th>
            </tr>
            <tr>
                <template v-for="name in transactionNamesOutput">
                    <th class="text-center" style="vertical-align:middle">@lang('report.tax.output_summary.table.header.qty')</th>
                    <th class="text-center" style="vertical-align:middle">@lang('report.tax.output_summary.table.header.unit_price')</th>
                </template>
                <template v-for="name in transactionNamesOutput">
                    <th class="text-center" style="vertical-align:middle">@lang('report.tax.output_summary.table.header.tax_base')</th>
                    <th class="text-center" style="vertical-align:middle">@lang('report.tax.output_summary.table.header.gst')</th>
                    <th class="text-center" style="vertical-align:middle">@lang('report.tax.output_summary.table.header.total_price')</th>
                </template>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(taxOutput, invoiceDate) in taxesOutputPerInvoiceDate">
                <td>@{{ invoiceDate }}</td>
                <template v-for="name in transactionNamesOutput">
                    <td>@{{ numbro(totalQtyOutputPerInvoiceDateAndName[invoiceDate][name]).format() }}</td>
                    <td>@{{ numbro(getPriceByInvoiceDateAndName(invoiceDate, name)).format() }}</td>
                </template>
                <template v-for="name in transactionNamesOutput">
                    <td>@{{ numbro(totalPriceOutputPerInvoiceDateAndName[invoiceDate][name] / 1.1).format() }}</td>
                    <td>@{{ numbro(totalPriceOutputPerInvoiceDateAndName[invoiceDate][name] * 0.1).format() }}</td>
                    <td>@{{ numbro(totalPriceOutputPerInvoiceDateAndName[invoiceDate][name]).format() }}</td>
                </template>
            </tr>
        </tbody>
        <tfoot v-cloak>
        </tfoot>
    </table>
    <table class="table table-bordered" v-else>
        <thead>
            <tr>
                <th class="text-center" style="vertical-align:middle" rowspan="2">@lang('report.tax.output_summary.table.header.date')</th>
                <th class="text-center" style="vertical-align:middle" colspan="2">@lang('report.tax.output_summary.table.header.product')</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center" colspan="2">@lang('labels.DATA_NOT_FOUND')</td>
            </tr>
        </tbody>
    </table>
</div>
