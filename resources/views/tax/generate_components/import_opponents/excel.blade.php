<html>
    <table>
        <thead>
            <tr>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.lt')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.tax_id')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.name')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.street')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.block')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.number')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.rt')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.rw')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.district')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.village')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.region')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.province')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.postal_code')</td>
                <td align="left" valign="center">@lang('tax.generate.import_opponents.table.header.phone_number')</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($taxes_output->unique('opponent_tax_id_no') as $key => $opponent)
            <tr>
                <td align="left" valign="center">LT</td>
                <td align="left" valign="center">{{ $opponent->opponent_tax_id_no }}</td>
                <td align="left" valign="center">{{ $opponent->opponent_name }}</td>
                <td align="left" valign="center">{{ $opponent->opponent_address }}</td>
                <td align="left" valign="center">.</td>
                <td align="left" valign="center">.</td>
                <td align="left" valign="center">.</td>
                <td align="left" valign="center">.</td>
                <td align="left" valign="center">.</td>
                <td align="left" valign="center">.</td>
                <td align="left" valign="center">.</td>
                <td align="left" valign="center">.</td>
                <td align="left" valign="center">.</td>
                <td align="left" valign="center">.</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</html>
