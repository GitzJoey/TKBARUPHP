<div style="overflow-x:auto;white-space:nowrap">
  <table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_products.table.header.ob')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_products.table.header.object_code')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_products.table.header.name')</th>
            <th class="text-center" style="vertical-align:middle">@lang('tax.generate.import_products.table.header.unit_price')</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="product in products" v-cloak>
            <td class="text-center">OB</td>
            <td class="text-center">@{{ product.id }}</td>
            <td class="text-center">@{{ product.name }}</td>
            <td class="text-center">@{{ numeral(product.price).format() }}</td>
        </tr>
        <tr v-if="!products.length">
            <td class="text-center" colspan="8">@lang('labels.DATA_NOT_FOUND')</td>
        </tr>
    </tbody>
  </table>
</div>
