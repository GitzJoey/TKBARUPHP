<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')

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
                    <td colspan="2">
                        @lang('report.template.user.parameter.name') {{ ': ' . $userName }}
                    </td>
                </tr>
            @endif
            @if(!empty($email))
                <tr>
                    <td colspan="2">
                        @lang('report.template.user.parameter.email') {{ ': ' . $email }}
                    </td>
                </tr>
            @endif
            @if(!empty($roleName))
                <tr>
                    <td colspan="2">
                        @lang('report.template.user.parameter.role') {{ ': ' . $roleName }}
                    </td>
                </tr>
            @endif
            @if(!empty($profileName))
                <tr>
                    <td colspan="2">
                        @lang('report.template.user.parameter.profile_name') {{ ': ' . $profileName }}
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
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr class="footer-row">
            <td colspan="2">
                @lang('report.template.user.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>