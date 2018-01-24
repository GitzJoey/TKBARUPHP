<!DOCTYPE html>
<html>
    @include('report_template.excel.style')

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
                    <td colspan="6">
                        @lang('report.template.truck_maintenance.parameter.plate_number') {{ ': ' . $plateNumber }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.truck_maintenance.header.store')</th>
            <th>@lang('report.template.truck_maintenance.header.plate_number')</th>
            <th>@lang('report.template.truck_maintenance.header.maintenance_type')</th>
            <th>@lang('report.template.truck_maintenance.header.cost')</th>
            <th>@lang('report.template.truck_maintenance.header.odometer')</th>
            <th>@lang('report.template.truck_maintenance.header.remarks')</th>
        </tr>
        @foreach($truckMaintenances as $key => $truckMaintenance)
            <tr class="data-row">
                <td>{{ $truckMaintenance->store->name }}</td>
                <td>{{ $truckMaintenance->truck->plate_number }}</td>
                <td>{{ $truckMaintenanceTypeDDL[$truckMaintenance->maintenance_type] }}</td>
                <td>{{ $truckMaintenance->cost }}</td>
                <td>{{ $truckMaintenance->odometer }}</td>
                <td>{{ $truckMaintenance->remarks }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr class="footer-row">
            <td colspan="6">
                @lang('report.template.truck_maintenance.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>