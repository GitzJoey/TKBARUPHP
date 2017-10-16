<html>
    <tr>
        <td align="center" valign="center">@lang('report.tax.input.table.header.invoice_date')</td>
        <td align="center" valign="center">@lang('report.tax.input.table.header.invoice_no')</td>
        <td align="center" valign="center">@lang('report.tax.input.table.header.detail')</td>
        <td align="center" valign="center">@lang('report.tax.input.table.header.qty')</td>
        <td align="center" valign="center">@lang('report.tax.input.table.header.unit_price')</td>
        <td align="center" valign="center">@lang('report.tax.input.table.header.tax_base')</td>
        <td align="center" valign="center">@lang('report.tax.input.table.header.gst')</td>
        <td align="center" valign="center">@lang('report.tax.input.table.header.grand_total')</td>
    </tr>
    @foreach ($taxes_input as $key => $tax_input)
    <tr>
        <td align="left" valign="center">{{ $tax_input->invoice_date }}</td>
        <td align="center" valign="center">{{ $tax_input->invoice_no }}</td>
        <td align="center" valign="center">{{ $tax_input->detail }}</td>
        <td align="right" valign="center">{{ $tax_input->qty }}</td>
        <td align="right" valign="center">{{ $tax_input->unit_price }}</td>
        <td align="right" valign="center">{{ $tax_input->tax_base }}</td>
        <td align="right" valign="center">{{ $tax_input->gst }}</td>
        <td align="right" valign="center">{{ $tax_input->tax_base + $tax_input->gst + $tax_input->luxury_tax }}</td>
    </tr>
    @endforeach
    <tr>
        <td colspan="6" align="right" valign="center">Total</td>
        <td align="right" valign="center">{{ $taxes_input->sum('gst') }}</td>
        <td align="right" valign="center">{{ $taxes_input->map(function ($tax_input) {
            return $tax_input->tax_base + $tax_input->gst + $tax_input->luxury_tax;
        })->sum() }}</td>
    </tr>
</html>
