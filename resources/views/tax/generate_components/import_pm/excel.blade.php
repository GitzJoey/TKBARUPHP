<html>
    <table>
        <thead>
            <tr>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.pm')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.transaction_type_code')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.fg_replacement')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.invoice_no')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.month')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.year')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.invoice_date')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.tax_id_no')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.name')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.address')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.total_tax_base')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.total_gst')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.total_luxury_tax')</td>
                <td align="left" valign="center">@lang('tax.generate.import_pm.table.header.is_creditable')</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($taxes_input as $key => $tax_input)
            <tr>
                <td align="left" valign="center">FM</td>
                <td align="left" valign="center">01</td>
                <td align="left" valign="center">0</td>
                <td align="left" valign="center">{{ $tax_input->invoice_no }}</td>
                <td align="left" valign="center">{{ $tax_input->month }}</td>
                <td align="left" valign="center">{{ $tax_input->year }}</td>
                <td align="left" valign="center">{{ $tax_input->invoice_date }}</td>
                <td align="left" valign="center">{{ $tax_input->opponent_tax_id_no }}</td>
                <td align="left" valign="center">{{ $tax_input->opponent_name }}</td>
                <td align="left" valign="center">{{ $tax_input->opponent_address }}</td>
                <td align="right" valign="center">{{ $tax_input->tax_base }}</td>
                <td align="right" valign="center">{{ $tax_input->gst }}</td>
                <td align="right" valign="center">{{ $tax_input->luxury_tax }}</td>
                <td align="center" valign="center">{{ $tax_input->is_creditable ? 1 : 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</html>
