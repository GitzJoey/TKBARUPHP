<div style="overflow-x:auto;white-space:nowrap">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center" style="vertical-align:middle" rowspan="2">Date</th>
                <th class="text-center" style="vertical-align:middle" colspan="2" v-for="name in transactionNamesOutput">@{{ name }}</th>
                <th class="text-center" style="vertical-align:middle" colspan="3" v-for="name in transactionNamesOutput">@{{ name }}</th>
            </tr>
            <tr>
                <template v-for="name in transactionNamesOutput">
                    <th class="text-center" style="vertical-align:middle">Qty</th>
                    <th class="text-center" style="vertical-align:middle">Price</th>
                </template>
                <template v-for="name in transactionNamesOutput">
                    <th class="text-center" style="vertical-align:middle">Tax Base</th>
                    <th class="text-center" style="vertical-align:middle">PPN</th>
                    <th class="text-center" style="vertical-align:middle">Total</th>
                </template>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(taxOutput, invoiceDate) in taxesOutputPerInvoiceDate">
                <td>@{{ invoiceDate }}</td>
                <template v-for="name in transactionNamesOutput">
                    <td>@{{ numeral(totalQtyOutputPerInvoiceDateAndName[invoiceDate][name]).format() }}</td>
                    <td>@{{ numeral(getPriceByInvoiceDateAndName(invoiceDate, name)).format() }}</td>
                </template>
                <template v-for="name in transactionNamesOutput">
                    <td>@{{ numeral(totalPriceOutputPerInvoiceDateAndName[invoiceDate][name] / 1.1).format() }}</td>
                    <td>@{{ numeral(totalPriceOutputPerInvoiceDateAndName[invoiceDate][name] * 0.1).format() }}</td>
                    <td>@{{ numeral(totalPriceOutputPerInvoiceDateAndName[invoiceDate][name]).format() }}</td>
                </template>
            </tr>
        </tbody>
        <tfoot v-cloak>
        </tfoot>
    </table>
    <table class="table table-bordered" v-if="!taxesOutput.length">
        <thead>
            <tr>
                <th class="text-center" style="vertical-align:middle" rowspan="2">Date</th>
                <th class="text-center" style="vertical-align:middle" colspan="2" v-for="name in transactionNamesOutput">@{{ name }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="!taxesOutput.length">
                <td class="text-center">@lang('labels.DATA_NOT_FOUND')</td>
            </tr>
        </tbody>
    </table>
</div>
