<!DOCTYPE html>
<html>
    @include('report_template.excel.style')

    <table>
        <tr class="title-row">
            <td colspan="5">
                <b>@lang('report.template.phone_provider.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($phoneProviderName))
                <tr>
                    <td colspan="5">
                        @lang('report.template.phone_provider.parameter.name') {{ ': ' . $phoneProviderName }}
                    </td>
                </tr>
            @endif
                @if(!empty($shortName))
                    <tr>
                        <td colspan="5">
                            @lang('report.template.phone_provider.parameter.name') {{ ': ' . $shortName }}
                        </td>
                    </tr>
                @endif
        @endif
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.phone_provider.header.name')</th>
            <th>@lang('report.template.phone_provider.header.short_name')</th>
            <th>@lang('report.template.phone_provider.header.prefix')</th>
            <th>@lang('report.template.phone_provider.header.status')</th>
            <th>@lang('report.template.phone_provider.header.remarks')</th>
        </tr>
        @foreach($phoneProviders as $key => $phoneProvider)
            <tr class="data-row">
                <td>{{ $phoneProvider->name }}</td>
                <td>{{ $phoneProvider->short_name }}</td>
                <td>{{ $phoneProvider->prefix }}</td>
                <td class="text-center">{{ $statusDDL[$phoneProvider->status] }}</td>
                <td>{{ $phoneProvider->remarks }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr class="footer-row">
            <td colspan="5">
                @lang('report.template.phone_provider.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>