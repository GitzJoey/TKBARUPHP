<div style="overflow-x:auto;white-space:nowrap">
  <table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.pm')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.transaction_type_code')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.fg_replacement')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.invoice_no')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.month')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.year')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.invoice_date')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.tax_id_no')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.name')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.address')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.total_tax_base')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.total_gst')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.total_luxury_tax')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_pm.table.header.is_creditable')</th>
        </tr>
    </thead>
    <tbody>
          <tr v-for="taxInput in taxesInput" v-cloak>
            <td class="text-left">FM</td>
            <td class="text-left">01</td>
            <td class="text-left">0</td>
            <td class="text-left">@{{ taxInput.invoiceNo }}</td>
            <td class="text-left">@{{ taxInput.month }}</td>
            <td class="text-left">@{{ taxInput.year }}</td>
            <td class="text-left">@{{ taxInput.invoiceDate }}</td>
            <td class="text-left">@{{ taxInput.opponentTaxIdNo }}</td>
            <td class="text-left">@{{ taxInput.opponentName }}</td>
            <td class="text-left">@{{ taxInput.opponentAddress }}</td>
            <td class="text-right">@{{ numbro(taxInput.taxBase).format() }}</td>
            <td class="text-right">@{{ numbro(taxInput.gst).format() }}</td>
            <td class="text-right">@{{ numbro(taxInput.luxuryTax).format() }}</td>
            <td class="text-center">@{{ taxInput.isCreditable ? 1 : 0 }}</td>
        </tr>
        <tr v-if="!taxesInput.length">
            <td class="text-center" colspan="14">@lang('labels.DATA_NOT_FOUND')</td>
        </tr>
    </tbody>
  </table>
</div>
<div class="row">
  <div class="col-xs-12 text-center">
    <a href="{{ route('db.tax.generate.import_pm.excel', [ 'xlsx' ]) }}" class="btn btn-primary">@lang('buttons.download_excel_button')</a>
  </div>
</div>
