<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')

    <table>
        <tr class="title-row">
            <td colspan="11">
                <b>@lang('report.template.supplier.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="11">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($supplierName))
                <tr>
                    <td>
                        @lang('report.template.supplier.parameter.name')
                    </td>
                    <td colspan="10">
                        {{ ': ' . $supplierName }}
                    </td>
                </tr>
            @endif
            @if(!empty($profileName))
                <tr>
                    <td>
                        @lang('report.template.supplier.parameter.profile_name')
                    </td>
                    <td colspan="10">
                        {{ ': ' . $profileName }}
                    </td>
                </tr>
            @endif
            @if(!empty($bankAccount))
                <tr>
                    <td>
                        @lang('report.template.supplier.parameter.bank_account')
                    </td>
                    <td colspan="10">
                        {{ ': ' . $bankAccount }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="11">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th width="10%">@lang('report.template.supplier.header.store')</th>
            <th width="5%">@lang('report.template.supplier.header.sign_code')</th>
            <th width="10%">@lang('report.template.supplier.header.name')</th>
            <th width="15%">@lang('report.template.supplier.header.address')</th>
            <th width="10%">@lang('report.template.supplier.header.city')</th>
            <th width="10%">@lang('report.template.supplier.header.phone_number')</th>
            <th width="10%">@lang('report.template.supplier.header.fax_num')</th>
            <th width="10%">@lang('report.template.supplier.header.tax_id')</th>
            <th width="5%">@lang('report.template.supplier.header.payment_due_day')</th>
            <th width="5%">@lang('report.template.supplier.header.status')</th>
            <th width="10%">@lang('report.template.supplier.header.remarks')</th>
        </tr>
        @foreach($suppliers as $key => $supplier)
            <tr class="data-row">
                <td>{{ $supplier->store->name }}</td>
                <td>{{ $supplier->sign_code }}</td>
                <td>{{ $supplier->name }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->city }}</td>
                <td>{{ $supplier->phone_number }}</td>
                <td>{{ $supplier->fax_num }}
                <td>{{ $supplier->tax_id }}</td>
                <td class="text-center">{{ $supplier->payment_due_day }}</td>
                <td class="text-center">{{ $statusDDL[$supplier->status] }}</td>
                <td>{{ $supplier->remarks }}</td>
            </tr>
        @endforeach
        <tr class="footer-row">
            <td colspan="11">
                @lang('report.template.supplier.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>