<div style="overflow-x:auto;white-space:nowrap">
    <table class="table table-bordered" v-for="(taxesOutput, invoiceDate) in taxesOutputPerInvoiceDate">
        <thead>
            <tr>
                <th class="text-center" style="vertical-align:middle" rowspan="4">@lang('report.tax.output.table.header.date')</th>
                <th class="text-center" style="vertical-align:middle" rowspan="4">@lang('report.tax.output.table.header.name')</th>
                <th class="text-center" style="vertical-align:middle" rowspan="4">@lang('report.tax.output.table.header.address')</th>
                <th class="text-center" style="vertical-align:middle" colspan="2" v-for="transactionNameOutput in transactionNamesOutput">@{{ transactionNameOutput }}</th>
            </tr>
            <tr>
                <template v-for="transactionNameOutput in transactionNamesOutput">
                    <th class="text-center" style="vertical-align:middle">@lang('report.tax.output.table.header.unit_price')</th>
                    <th class="text-center" style="vertical-align:middle" rowspan="3">@lang('report.tax.output.table.header.qty')</th>
                </template>
            </tr>
            <tr>
                <th class="text-right" style="vertical-align:middle" v-for="name in transactionNamesOutput">
                    @{{ numbro(getPriceByInvoiceDateAndName(invoiceDate, name)).format() }}
                </th>
            </tr>
            <tr>
                <th class="text-right" style="vertical-align:middle" v-for="name in transactionNamesOutput">
                    @{{ numbro((getPriceByInvoiceDateAndName(invoiceDate, name)) / 1.1).format() }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(taxOutput, index) in taxesOutput" v-cloak>
                <td class="text-center" v-if="index == 0">@{{ taxOutput.invoiceDate }}</td>
                <td class="text-center" v-else></td>
                <td class="text-left">@{{ taxOutput.opponentName }}</td>
                <td class="text-left">@{{ taxOutput.opponentAddress }}</td>
                <template v-for="transactionNameOutput in transactionNamesOutput">
                    <td class="text-right">
                        @{{ numbro(
                          (getTransactionFromTaxOutputByName(taxOutput, transactionNameOutput).price || 0) *
                          (getTransactionFromTaxOutputByName(taxOutput, transactionNameOutput).qty || 0) / 1.1).format() }}
                    </td>
                    <td class="text-right">@{{ numbro(getTransactionFromTaxOutputByName(taxOutput, transactionNameOutput).qty).format() }}</td>
                </template>
            </tr>
        </tbody>
        <tfoot v-cloak>
            <tr>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <template v-for="transactionNameOutput in transactionNamesOutput">
                    <td class="text-right">@{{ numbro(totalPriceOutputPerInvoiceDateAndName[invoiceDate][transactionNameOutput]).format() }}</td>
                    <td class="text-right">@{{ numbro(totalQtyOutputPerInvoiceDateAndName[invoiceDate][transactionNameOutput]).format() }}</td>
                </template>
            </tr>
        </tfoot>
    </table>
    <table class="table table-bordered" v-if="!taxesOutput.length">
        <thead>
            <tr>
                <th class="text-center" style="vertical-align:middle" rowspan="2">@lang('report.tax.output.table.header.date')</th>
                <th class="text-center" style="vertical-align:middle" rowspan="2">@lang('report.tax.output.table.header.name')</th>
                <th class="text-center" style="vertical-align:middle" rowspan="2">@lang('report.tax.output.table.header.address')</th>
                <th class="text-center" style="vertical-align:middle" colspan="2">@lang('report.tax.output.table.header.product')</th>
            </tr>
            <tr>
                <th class="text-center" style="vertical-align:middle">@lang('report.tax.output.table.header.unit_price')</th>
                <th class="text-center" style="vertical-align:middle">@lang('report.tax.output.table.header.qty')</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="!taxesOutput.length">
                <td class="text-center" colspan="5">@lang('labels.DATA_NOT_FOUND')</td>
            </tr>
        </tbody>
    </table>
</div>
