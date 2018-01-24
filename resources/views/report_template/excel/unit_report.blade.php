<!DOCTYPE html>
<html>
    @include('report_template.excel.style')

    <table>
        <tr class="title-row">
            <td colspan="4">
                <b>@lang('report.template.unit.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($unitName))
                <tr>
                    <td colspan="7">
                        @lang('report.template.unit.parameter.name') {{ ': ' . $unitName }}
                    </td>
                </tr>
            @endif
            @if(!empty($symbol))
                <tr>
                    <td colspan="7">
                        @lang('report.template.unit.parameter.symbol') {{ ': ' . $symbol }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.unit.header.name')</th>
            <th>@lang('report.template.unit.header.symbol')</th>
            <th>@lang('report.template.unit.header.status')</th>
            <th>@lang('report.template.unit.header.remarks')</th>
        </tr>
        @foreach($units as $key => $unit)
            <tr class="data-row">
                <td>{{ $unit->name }}</td>
                <td>{{ $unit->symbol }}</td>
                <td>{{ $statusDDL[$unit->status] }}</td>
                <td>{{ $unit->remarks }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr class="footer-row">
            <td colspan="4">
                @lang('report.template.unit.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>