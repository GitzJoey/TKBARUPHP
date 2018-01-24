<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')

    <table>
        <tr class="title-row">
            <td colspan="6">
                <b>@lang('report.template.bank.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($bankName))
                <tr>
                    <td>
                        @lang('report.template.bank.parameter.name')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $bankName }}
                    </td>
                </tr>
            @endif
            @if(!empty($shortName))
                <tr>
                    <td>
                        @lang('report.template.bank.parameter.short_name')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $shortName }}
                    </td>
                </tr>
            @endif
            @if(!empty($branch))
                <tr>
                    <td>
                        @lang('report.template.bank.parameter.branch')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $branch }}
                    </td>
                </tr>
            @endif
            @if(!empty($branchCode))
                <tr>
                    <td>
                        @lang('report.template.bank.parameter.branch_code')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $branchCode }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th width="15%">@lang('report.template.bank.header.name')</th>
            <th width="15%">@lang('report.template.bank.header.short_name')</th>
            <th width="25%">@lang('report.template.bank.header.branch')</th>
            <th width="10%">@lang('report.template.bank.header.branch_code')</th>
            <th width="10%">@lang('report.template.bank.header.status')</th>
            <th width="25%">@lang('report.template.bank.header.remarks')</th>
        </tr>
        @foreach($banks as $key => $bank)
            <tr class="data-row">
                <td>{{ $bank->name }}</td>
                <td>{{ $bank->short_name }}</td>
                <td>{{ $bank->branch }}</td>
                <td class="text-center">{{ $bank->branch_code }}</td>
                <td class="text-center">{{ $statusDDL[$bank->status] }}</td>
                <td>{{ $bank->remarks }}</td>
            </tr>
        @endforeach
        <tr class="footer-row">
            <td colspan="6">
                @lang('report.template.bank.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>