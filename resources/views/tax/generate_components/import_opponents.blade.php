<div style="overflow-x:auto;white-space:nowrap">
  <table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.lt')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.tax_id')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.name')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.street')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.block')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.number')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.rt')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.rw')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.district')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.village')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.region')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.province')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.postal_code')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_opponents.table.header.phone_number')</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="taxOutput in taxesOutput" v-cloak>
            <td class="text-center">LT</td>
            <td class="text-center">@{{ taxOutput.opponentTaxIdNo }}</td>
            <td class="text-center">@{{ taxOutput.opponentName }}</td>
            <td class="text-center">@{{ taxOutput.opponentAddress }}</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
        </tr>
        <tr v-if="!products.length">
            <td class="text-center" colspan="14">@lang('labels.DATA_NOT_FOUND')</td>
        </tr>
    </tbody>
  </table>
</div>
