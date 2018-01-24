<!DOCTYPE html>
<html>
    @include('report_template.excel.style')

    <table>
        <tr class="title-row">
            <td colspan="3">
                <b>@lang('report.template.role.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($roleName))
                <tr>
                    <td colspan="3">
                        @lang('report.template.role.parameter.name') {{ ': ' . $roleName }}
                    </td>
                </tr>
            @endif
            @if(!empty($permission))
                <tr>
                    <td colspan="3">
                        @lang('report.template.role.parameter.permission') {{ ': ' . $permission }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.role.header.name')</th>
            <th>@lang('report.template.role.header.display_name')</th>
            <th>@lang('report.template.role.header.description')</th>
        </tr>
        @foreach($roles as $key => $role)
            <tr class="data-row">
                <td>{{ $role->name }}</td>
                <td>{{ $role->display_name }}</td>
                <td>{{ $role->description }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr class="footer-row">
            <td colspan="3">
                @lang('report.template.role.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>