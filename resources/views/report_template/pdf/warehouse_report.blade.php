<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')

    <table>
        <tr class="title-row">
            <td colspan="6">
                <b>@lang('report.template.warehouse.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($warehouseName))
                <tr>
                    <td>
                        @lang('report.template.warehouse.parameter.name')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $warehouseName }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th width="15%">@lang('report.template.warehouse.header.store')</th>
            <th width="15%">@lang('report.template.warehouse.header.name')</th>
            <th width="25%">@lang('report.template.warehouse.header.address')</th>
            <th width="10%">@lang('report.template.warehouse.header.phone_number')</th>
            <th width="10%">@lang('report.template.warehouse.header.status')</th>
            <th width="25%">@lang('report.template.warehouse.header.remarks')</th>
        </tr>
        @foreach($warehouses as $key => $warehouse)
            <tr class="data-row">
                <td>{{ $warehouse->store->name }}</td>
                <td>{{ $warehouse->name }}</td>
                <td>{{ $warehouse->address }}</td>
                <td class="text-center">{{ $warehouse->phone_num }}</td>
                <td class="text-center">{{ $statusDDL[$warehouse->status] }}</td>
                <td>{{ $warehouse->remarks }}</td>
            </tr>
        @endforeach
        <tr class="footer-row">
            <td colspan="6">
                @lang('report.template.warehouse.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>