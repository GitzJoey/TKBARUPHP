<div style="overflow-x:auto;white-space:nowrap">
  <table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_products.table.header.ob')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_products.table.header.object_code')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_products.table.header.name')</th>
            <th class="text-left" style="vertical-align:middle">@lang('tax.generate.import_products.table.header.unit_price')</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="product in products" v-cloak>
            <td class="text-left">OB</td>
            <td class="text-left">-</td>
            <td class="text-left">@{{ product.name }}</td>
            <td class="text-right">@{{ numeral(product.price).format() }}</td>
        </tr>
        <tr v-if="!products.length">
            <td class="text-center" colspan="8">@lang('labels.DATA_NOT_FOUND')</td>
        </tr>
    </tbody>
  </table>
</div>
<div class="row">
  <div class="col-xs-12 text-center">
    <a href="{{ route('db.tax.generate.import_products.excel', [ 'xlsx' ]) }}" class="btn btn-primary">@lang('buttons.download_excel_button')</a>
  </div>
</div>
