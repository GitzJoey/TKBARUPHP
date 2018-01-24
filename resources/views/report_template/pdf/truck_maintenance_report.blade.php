<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')

    <table>
        <tr class="title-row">
            <td colspan="6">
                <b>@lang('report.template.truck_maintenance.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($plateNumber))
                <tr>
                    <td>
                        @lang('report.template.truck_maintenance.parameter.plate_number')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $plateNumber }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th width="15%">@lang('report.template.truck_maintenance.header.store')</th>
            <th width="15%">@lang('report.template.truck_maintenance.header.plate_number')</th>
            <th width="20%">@lang('report.template.truck_maintenance.header.maintenance_type')</th>
            <th width="15%">@lang('report.template.truck_maintenance.header.cost')</th>
            <th width="15%">@lang('report.template.truck_maintenance.header.odometer')</th>
            <th width="20%">@lang('report.template.truck_maintenance.header.remarks')</th>
        </tr>
        @foreach($truckMaintenances as $key => $truckMaintenance)
            <tr class="data-row">
                <td>{{ $truckMaintenance->store->name }}</td>
                <td>{{ $truckMaintenance->truck->plate_number }}</td>
                <td>{{ $truckMaintenanceTypeDDL[$truckMaintenance->maintenance_type] }}</td>
                <td class="text-right">{{ $truckMaintenance->cost }}</td>
                <td class="text-right">{{ $truckMaintenance->odometer }}</td>
                <td>{{ $truckMaintenance->remarks }}</td>
            </tr>
        @endforeach
        <tr class="footer-row">
            <td colspan="6">
                @lang('report.template.truck_maintenance.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>