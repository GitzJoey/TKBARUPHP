<!DOCTYPE html>
<html>
    @include('report_template.excel.style')

    <table>
        <tr class="title-row">
            <td colspan="6">
                <b>@lang('report.template.vendor_trucking.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($vendorTruckingName))
                <tr>
                    <td colspan="6">
                        @lang('report.template.vendor_trucking.parameter.name') {{ ': ' . $vendorTruckingName }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.vendor_trucking.header.store')</th>
            <th>@lang('report.template.vendor_trucking.header.name')</th>
            <th>@lang('report.template.vendor_trucking.header.address')</th>
            <th>@lang('report.template.vendor_trucking.header.tax_id')</th>
            <th>@lang('report.template.vendor_trucking.header.status')</th>
            <th>@lang('report.template.vendor_trucking.header.remarks')</th>
        </tr>
        @foreach($vendorTruckings as $key => $vendorTrucking)
            <tr class="data-row">
                <td>{{ $vendorTrucking->store->name }}</td>
                <td>{{ $vendorTrucking->name }}</td>
                <td>{{ $vendorTrucking->address }}</td>
                <td>{{ $vendorTrucking->tax_id }}</td>
                <td>{{ $statusDDL[$vendorTrucking->status] }}</td>
                <td>{{ $vendorTrucking->remarks }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr class="footer-row">
            <td colspan="6">
                @lang('report.template.vendor_trucking.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>