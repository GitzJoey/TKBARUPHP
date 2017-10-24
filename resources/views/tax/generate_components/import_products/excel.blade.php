<html>
    <table>
        <thead>
            <tr>
                <td align="left" valign="center">@lang('tax.generate.import_products.table.header.ob')</td>
                <td align="left" valign="center">@lang('tax.generate.import_products.table.header.object_code')</td>
                <td align="left" valign="center">@lang('tax.generate.import_products.table.header.name')</td>
                <td align="left" valign="center">@lang('tax.generate.import_products.table.header.unit_price')</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($taxes_output->flatMap(function ($tax_output) {
                return $tax_output->transactions;
            })->unique('name') as $key => $product)
            <tr>
                <td align="left" valign="center">OB</td>
                <td align="left" valign="center">-</td>
                <td align="left" valign="center">{{ $product->name }}</td>
                <td align="right" valign="center">{{ $product->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</html>
