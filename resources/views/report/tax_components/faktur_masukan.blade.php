<div style="overflow-x:auto;white-space:nowrap">
  <table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="vertical-align:middle">@lang('report.tax.input.table.header.invoice_date')</th>
            <th class="text-center" style="vertical-align:middle">@lang('report.tax.input.table.header.invoice_no')</th>
            <th class="text-center" style="vertical-align:middle">@lang('report.tax.input.table.header.detail')</th>
            <th class="text-center" style="vertical-align:middle">@lang('report.tax.input.table.header.qty')</th>
            <th class="text-center" style="vertical-align:middle">@lang('report.tax.input.table.header.unit_price')</th>
            <th class="text-center" style="vertical-align:middle">@lang('report.tax.input.table.header.tax_base')</th>
            <th class="text-center" style="vertical-align:middle">@lang('report.tax.input.table.header.gst')</th>
            <th class="text-center" style="vertical-align:middle">@lang('report.tax.input.table.header.grand_total')</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="taxInput in taxesInput" v-cloak>
            <td class="text-center">@{{ taxInput.invoiceDate }}</td>
            <td class="text-center">@{{ taxInput.invoiceNo }}</td>
            <td class="text-center">@{{ taxInput.detail }}</td>
            <td class="text-center">@{{ numbro(taxInput.qty).format() }}</td>
            <td class="text-right">@{{ numbro(taxInput.unitPrice).format() }}</td>
            <td class="text-right">@{{ numbro(taxInput.taxBase).format() }}</td>
            <td class="text-right">@{{ numbro(taxInput.gst).format() }}</td>
            <td class="text-right">@{{ numbro(taxInput.taxBase + taxInput.gst + taxInput.luxuryTax).format() }}</td>
        </tr>
        <tr v-if="!taxesInput.length">
            <td class="text-center" colspan="8">@lang('labels.DATA_NOT_FOUND')</td>
        </tr>
    </tbody>
    <tfoot v-cloak>
        <tr v-if="taxesInput.length">
            <td class="text-right" colspan="6">Total</td>
            <td class="text-right">@{{ numbro(totalGstInput).format() }}</td>
            <td class="text-right">@{{ numbro(grandTotalInput).format() }}</td>
        </tr>
    </tfoot>
  </table>
</div>
