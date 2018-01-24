<!DOCTYPE html>
<html>
    @include('report_template.excel.style')

    <table>
        <tr class="title-row">
            <td colspan="5">
                <b>@lang('report.template.product_type.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($productTypeName))
                <tr>
                    <td colspan="5">
                        @lang('report.template.product_type.parameter.name') {{ ': ' . $productTypeName }}
                    </td>
                </tr>
            @endif
            @if(!empty($shortCode))
                <tr>
                    <td colspan="5">
                        @lang('report.template.product_type.parameter.short_code') {{ ': ' . $shortCode }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.product_type.header.store')</th>
            <th>@lang('report.template.product_type.header.name')</th>
            <th>@lang('report.template.product_type.header.short_code')</th>
            <th>@lang('report.template.product_type.header.description')</th>
            <th>@lang('report.template.product_type.header.status')</th>
        </tr>
        @foreach($productTypes as $key => $productType)
            <tr class="data-row">
                <td>{{ $productType->store->name }}</td>
                <td>{{ $productType->name }}</td>
                <td class="text-center">{{ $productType->short_code }}</td>
                <td>{{ $productType->description }}</td>
                <td class="text-center">{{ $statusDDL[$productType->status] }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr class="footer-row">
            <td colspan="5">
                @lang('report.template.product_type.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>