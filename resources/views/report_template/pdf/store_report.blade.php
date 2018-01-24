<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')

    <table>
        <tr class="title-row">
            <td colspan="7">
                <b>@lang('report.template.store.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($storeName))
                <tr>
                    <td>
                        @lang('report.template.store.parameter.name')
                    </td>
                    <td colspan="6">
                        {{ ': ' . $storeName }}
                    </td>
                </tr>
            @endif
            @if(!empty($taxId))
                <tr>
                    <td colspan="6">
                        @lang('report.template.store.parameter.tax_id')
                    </td>
                    <td>
                        {{ ': ' . $taxId }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.store.header.name')</th>
            <th>@lang('report.template.store.header.address')</th>
            <th>@lang('report.template.store.header.phone_num')</th>
            <th>@lang('report.template.store.header.fax_num')</th>
            <th>@lang('report.template.store.header.tax_id')</th>
            <th>@lang('report.template.store.header.status')</th>
            <th>@lang('report.template.store.header.remarks')</th>
        </tr>
        @foreach($stores as $key => $store)
            <tr class="data-row">
                <td>{{ $store->name }}</td>
                <td>{{ $store->address }}</td>
                <td>{{ $store->phone_num }}</td>
                <td>{{ $store->fax_num }}</td>
                <td>{{ $store->tax_id }}</td>
                <td>{{ $statusDDL[$store->status] . ($store->is_default === 'YESNOSELECT.YES' ? ' (Default)' : '') }}</td>
                <td>{{ $store->remarks }}</td>
            </tr>
        @endforeach
        <tr class="footer-row">
            <td colspan="7">
                @lang('report.template.store.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>