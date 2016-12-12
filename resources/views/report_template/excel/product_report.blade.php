<!DOCTYPE html>
<html>
@include('report_template.excel.style')

<table>
    <tr class="title-row">
        <td colspan="7">
            <b>@lang('report.template.product.report_name')</b>
        </td>
    </tr>
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    @if($showParameter)
        @if(!empty($productName))
            <tr>
                <td colspan="7">
                    @lang('report.template.product.parameter.name') {{ ': ' . $productName }}
                </td>
            </tr>
        @endif
        @if(!empty($shortCode))
            <tr>
                <td colspan="7">
                    @lang('report.template.product.parameter.short_code') {{ ': ' . $shortCode }}
                </td>
            </tr>
        @endif
    @endif
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr class="header-row">
        <th>@lang('report.template.product.header.store')</th>
        <th>@lang('report.template.product.header.product_type')</th>
        <th>@lang('report.template.product.header.name')</th>
        <th>@lang('report.template.product.header.short_code')</th>
        <th>@lang('report.template.product.header.description')</th>
        <th>@lang('report.template.product.header.status')</th>
        <th>@lang('report.template.product.header.remarks')</th>
    </tr>
    @foreach($products as $key => $product)
        <tr class="data-row">
            <td>{{ $product->store->name }}</td>
            <td class="text-center">{{ $product->type->short_code }}</td>
            <td>{{ $product->name }}</td>
            <td class="text-center">{{ $product->short_code }}</td>
            <td>{{ $product->description }}</td>
            <td class="text-center">{{ $statusDDL[$product->status] }}</td>
            <td>{{ $product->remarks }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr class="footer-row">
        <td colspan="7">
            @lang('report.template.product.footer', ['user' => $currentUser, 'date' => $reportDate])
        </td>
    </tr>
</table>
</html>