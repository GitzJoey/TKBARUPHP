<!DOCTYPE html>
<html>
@include('report_template.pdf.style')

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
                <td>
                    @lang('report.template.product.parameter.name')
                </td>
                <td colspan="6">
                    {{ ': ' . $productName }}
                </td>
            </tr>
        @endif
        @if(!empty($shortCode))
            <tr>
                <td>
                    @lang('report.template.product.parameter.short_code')
                </td>
                <td colspan="6">
                    {{ ': ' . $shortCode }}
                </td>
            </tr>
        @endif
    @endif
    <tr>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr class="header-row">
        <th width="15%">@lang('report.template.product.header.store')</th>
        <th width="10%">@lang('report.template.product.header.product_type')</th>
        <th width="20%">@lang('report.template.product.header.name')</th>
        <th width="10%">@lang('report.template.product.header.short_code')</th>
        <th width="15%">@lang('report.template.product.header.description')</th>
        <th width="10%">@lang('report.template.product.header.status')</th>
        <th width="20%">@lang('report.template.product.header.remarks')</th>
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
    <tr class="footer-row">
        <td colspan="7">
            @lang('report.template.product.footer', ['user' => $currentUser, 'date' => $reportDate])
        </td>
    </tr>
</table>
</html>