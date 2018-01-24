<!DOCTYPE html>
<html>
    @include('report_template.excel.style')

    <table>
        <tr class="title-row">
            <td colspan="2">
                <b>@lang('report.template.user.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($userName))
                <tr>
                    <td>
                        @lang('report.template.user.parameter.name')
                    </td>
                    <td>
                        {{ ': ' . $userName }}
                    </td>
                </tr>
            @endif
            @if(!empty($email))
                <tr>
                    <td>
                        @lang('report.template.user.parameter.email')
                    </td>
                    <td>
                        {{ ': ' . $email }}
                    </td>
                </tr>
            @endif
            @if(!empty($roleName))
                <tr>
                    <td>
                        @lang('report.template.user.parameter.role')
                    </td>
                    <td>
                        {{ ': ' . $roleName }}
                    </td>
                </tr>
            @endif
            @if(!empty($profileName))
                <tr>
                    <td>
                        @lang('report.template.user.parameter.name')
                    </td>
                    <td>
                        {{ ': ' . $profileName }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.user.header.name')</th>
            <th>@lang('report.template.user.header.email')</th>
        </tr>
        @foreach($users as $key => $user)
            <tr class="data-row">
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
        <tr class="footer-row">
            <td colspan="2">
                @lang('report.template.user.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>