<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')

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
                    <td>
                        @lang('report.template.product_type.parameter.name')
                    </td>
                    <td colspan="4">
                        {{ ': ' . $productTypeName }}
                    </td>
                </tr>
            @endif
            @if(!empty($shortCode))
                <tr>
                    <td>
                        @lang('report.template.product_type.parameter.short_code')
                    </td>
                    <td colspan="4">
                        {{ ': ' . $shortCode }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th width="15%">@lang('report.template.product_type.header.store')</th>
            <th width="15%">@lang('report.template.product_type.header.name')</th>
            <th width="10%">@lang('report.template.product_type.header.short_code')</th>
            <th width="50%">@lang('report.template.product_type.header.description')</th>
            <th width="10%">@lang('report.template.product_type.header.status')</th>
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
        <tr class="footer-row">
            <td colspan="5">
                @lang('report.template.product_type.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>