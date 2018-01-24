<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')

    <table>
        <tr class="title-row">
            <td colspan="8">
                <b>@lang('report.template.customer.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="8">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($customerName))
                <tr>
                    <td>
                        @lang('report.template.customer.parameter.name')
                    </td>
                    <td colspan="7">
                        {{ ': ' . $customerName }}
                    </td>
                </tr>
            @endif
            @if(!empty($profileName))
                <tr>
                    <td>
                        @lang('report.template.customer.parameter.profile_name')
                    </td>
                    <td colspan="7">
                        {{ ': ' . $profileName }}
                    </td>
                </tr>
            @endif
            @if(!empty($bankAccount))
                <tr>
                    <td>
                        @lang('report.template.customer.parameter.bank_account')
                    </td>
                    <td colspan="7">
                        {{ ': ' . $bankAccount }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="8">&nbsp;</td>
        </tr>
        @foreach($customers as $key => $customer)
            <tr class="data-row">
                <td colspan="8"><h3>{{ $customer->name }}</h3></td>
            </tr>
            <tr class="data-row">
                <td colspan="8">&nbsp;</td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.customer.header.address')
                </td>
                <td colspan="3">
                    {{ $customer->address }}
                </td>
                <td>
                    @lang('report.template.customer.header.phone_number')
                </td>
                <td colspan="3">
                    {{ $customer->phone_number }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.customer.header.city')
                </td>
                <td colspan="3">
                    {{ $customer->city }}
                </td>
                <td>
                    @lang('report.template.customer.header.tax_id')
                </td>
                <td colspan="3">
                    {{ $customer->tax_id }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.customer.header.status')
                </td>
                <td colspan="3">
                    {{ $statusDDL[$customer->status] }}
                </td>
                <td>
                    @lang('report.template.customer.header.remarks')
                </td>
                <td colspan="3">
                    {{ $customer->remarks }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.customer.header.payment_due_day')
                </td>
                <td colspan="3">
                    {{ $customer->payment_due_day }}
                </td>
                <td>
                    @lang('report.template.customer.header.price_level')
                </td>
                <td colspan="3">
                    {{ $customer->priceLevel->name }}
                </td>
            </tr>
            <tr class="data-row">
                <td colspan="8">&nbsp;</td>
            </tr>
            <tr class="header-row">
                <th colspan="8">@lang('report.template.customer.header.person_in_charge')</th>
            </tr>
            <tr class="header-row">
                <th rowspan="2">@lang('report.template.customer.header.no')</th>
                <th rowspan="2">@lang('report.template.customer.header.first_name')</th>
                <th rowspan="2">@lang('report.template.customer.header.last_name')</th>
                <th rowspan="2">@lang('report.template.customer.header.address')</th>
                <th rowspan="2">@lang('report.template.customer.header.ic_number')</th>
                <th colspan="3">@lang('report.template.customer.header.phone_numbers')</th>
            </tr>
            <tr class="header-row">
                <th>@lang('report.template.customer.header.provider')</th>
                <th>@lang('report.template.customer.header.number')</th>
                <th>@lang('report.template.customer.header.remarks')</th>
            </tr>
            @foreach($customer->profiles as $profileKey => $profile)
                @foreach($profile->phoneNumbers as $phoneNumberKey => $phoneNumber)
                    @if($phoneNumberKey == 0)
                        <tr class="data-row">
                            <td rowspan="{{ count($customer->profiles) }}" class="text-center">{{ $profileKey + 1 }}</td>
                            <td rowspan="{{ count($customer->profiles) }}">{{ $profile->first_name }}</td>
                            <td rowspan="{{ count($customer->profiles) }}">{{ $profile->last_name }}</td>
                            <td rowspan="{{ count($customer->profiles) }}">{{ $profile->address }}</td>
                            <td rowspan="{{ count($customer->profiles) }}">{{ $profile->ic_number }}</td>
                            <td>{{ $phoneNumber->provider->short_name }}</td>
                            <td>{{ $phoneNumber->number }}</td>
                            <td>{{ $phoneNumber->remarks }}</td>
                        </tr>
                    @else
                        <tr class="data-row">
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
                <th colspan="8">@lang('report.template.customer.header.bank_accounts')</th>
            </tr>
            <tr class="header-row">
                <th>No</th>
                <th colspan="2">@lang('report.template.customer.header.bank')</th>
                <th colspan="2">@lang('report.template.customer.header.account_number')</th>
                <th colspan="3">@lang('report.template.customer.header.remarks')</th>
            </tr>
            @foreach($customer->bankAccounts as $bankAccountKey => $bankAccount)
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
                @lang('report.template.customer.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>