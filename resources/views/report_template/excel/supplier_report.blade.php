<!DOCTYPE html>
<html>
    @include('report_template.excel.style')

    <table>
        <tr class="title-row">
            <td colspan="8">
                <h2><b>@lang('report.template.supplier.report_name')</b></h2>
            </td>
        </tr>
        <tr>
            <td colspan="8">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($supplierName))
                <tr>
                    <td colspan="8">
                        @lang('report.template.supplier.parameter.name') {{ ': ' . $supplierName }}
                    </td>
                </tr>
            @endif
            @if(!empty($profileName))
                <tr>
                    <td colspan="8">
                        @lang('report.template.supplier.parameter.profile_name') {{ ': ' . $profileName }}
                    </td>
                </tr>
            @endif
            @if(!empty($bankAccount))
                <tr>
                    <td colspan="8">
                        @lang('report.template.supplier.parameter.bank_account') {{ ': ' . $bankAccount }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="8">&nbsp;</td>
        </tr>
        @foreach($suppliers as $key => $supplier)
            <tr class="data-row">
                <td colspan="8"><h3>{{ $supplier->name }}</h3></td>
            </tr>
            <tr class="data-row">
                <td colspan="8">&nbsp;</td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.supplier.header.address')
                </td>
                <td colspan="3">
                    {{ $supplier->address }}
                </td>
                <td>
                    @lang('report.template.supplier.header.phone_number')
                </td>
                <td colspan="3">
                    {{ $supplier->phone_number }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.supplier.header.city')
                </td>
                <td colspan="3">
                    {{ $supplier->city }}
                </td>
                <td>
                    @lang('report.template.supplier.header.tax_id')
                </td>
                <td colspan="3">
                    {{ $supplier->tax_id }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.supplier.header.status')
                </td>
                <td colspan="3">
                    {{ $statusDDL[$supplier->status] }}
                </td>
                <td>
                    @lang('report.template.supplier.header.remarks')
                </td>
                <td colspan="3">
                    {{ $supplier->remarks }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.supplier.header.payment_due_day')
                </td>
                <td colspan="3">
                    {{ $supplier->payment_due_day }}
                </td>
                <td>
                    @lang('report.template.supplier.header.fax_number')
                </td>
                <td colspan="3">
                    {{ $supplier->fax_num }}
                </td>
            </tr>
            <tr class="data-row">
                <td colspan="8">&nbsp;</td>
            </tr>
            <tr class="header-row">
                <th colspan="8">@lang('report.template.supplier.header.person_in_charge')</th>
            </tr>
            <tr class="header-row">
                <th rowspan="2">@lang('report.template.supplier.header.no')</th>
                <th rowspan="2">@lang('report.template.supplier.header.first_name')</th>
                <th rowspan="2">@lang('report.template.supplier.header.last_name')</th>
                <th rowspan="2">@lang('report.template.supplier.header.address')</th>
                <th rowspan="2">@lang('report.template.supplier.header.ic_number')</th>
                <th colspan="3">@lang('report.template.supplier.header.phone_numbers')</th>
            </tr>
            <tr class="header-row">
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>@lang('report.template.supplier.header.provider')</th>
                <th>@lang('report.template.supplier.header.number')</th>
                <th>@lang('report.template.supplier.header.remarks')</th>
            </tr>
            @foreach($supplier->profiles as $profileKey => $profile)
                @foreach($profile->phoneNumbers as $phoneNumberKey => $phoneNumber)
                    @if($phoneNumberKey == 0)
                        <tr class="data-row">
                            <td rowspan="{{ count($supplier->profiles) }}" class="text-center">{{ $profileKey + 1 }}</td>
                            <td rowspan="{{ count($supplier->profiles) }}">{{ $profile->first_name }}</td>
                            <td rowspan="{{ count($supplier->profiles) }}">{{ $profile->last_name }}</td>
                            <td rowspan="{{ count($supplier->profiles) }}">{{ $profile->address }}</td>
                            <td rowspan="{{ count($supplier->profiles) }}">{{ $profile->ic_number }}</td>
                            <td>{{ $phoneNumber->provider->short_name }}</td>
                            <td>{{ $phoneNumber->number }}</td>
                            <td>{{ $phoneNumber->remarks }}</td>
                        </tr>
                    @else
                        <tr class="data-row">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $phoneNumber->provider->short_name }}</td>
                            <td>{{ $phoneNumber->number }}</td>
                            <td>{{ $phoneNumber->remarks }}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            <tr class="data-row">
                <td colspan="8">&nbsp;</td>
            </tr>
            <tr class="header-row">
                <th colspan="8">@lang('report.template.supplier.header.bank_accounts')</th>
            </tr>
            <tr class="header-row">
                <th>@lang('report.template.supplier.header.no')</th>
                <th colspan="2">@lang('report.template.supplier.header.bank')</th>
                <th colspan="2">@lang('report.template.supplier.header.account_number')</th>
                <th colspan="3">@lang('report.template.supplier.header.remarks')</th>
            </tr>
            @foreach($supplier->bankAccounts as $bankAccountKey => $bankAccount)
                <tr class="data-row">
                    <td class="text-center">{{ $bankAccountKey + 1 }}</td>
                    <td colspan="2">{{ $bankAccount->bank->short_name }}</td>
                    <td colspan="2">{{ $bankAccount->account_number }}</td>
                    <td colspan="3">{{ $bankAccount->remarks }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="8">&nbsp;</td>
            </tr>
        @endforeach
        <tr class="footer-row">
            <td colspan="8">
                @lang('report.template.supplier.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>