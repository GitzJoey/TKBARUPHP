<!DOCTYPE html>
<html>
    @include('report_template.excel.style')

    <table>
        <tr class="title-row">
            <td colspan="8">
                <b>@lang('report.template.product.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="8">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($productName))
                <tr>
                    <td colspan="8">
                        @lang('report.template.product.parameter.name') {{ ': ' . $productName }}
                    </td>
                </tr>
            @endif
            @if(!empty($shortCode))
                <tr>
                    <td colspan="8">
                        @lang('report.template.product.parameter.short_code') {{ ': ' . $shortCode }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="8">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th rowspan="2">@lang('report.template.product.header.product_type')</th>
            <th rowspan="2">@lang('report.template.product.header.name')</th>
            <th rowspan="2">@lang('report.template.product.header.short_code')</th>
            <th colspan="2">@lang('report.template.product.header.product_units')</th>
            <th rowspan="2">@lang('report.template.product.header.description')</th>
            <th rowspan="2">@lang('report.template.product.header.status')</th>
            <th rowspan="2">@lang('report.template.product.header.remarks')</th>
        </tr>
        <tr class="header-row">
            <td></td>
            <td></td>
            <td></td>
            <th>
                @lang('report.template.product.header.unit')
            </th>
            <th>
                @lang('report.template.product.header.conversion_value')
            </th>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @foreach($products as $key => $product)
            @foreach($product->productUnits as $productUnitKey => $productUnit)
                @if($productUnitKey == 0)
                    <tr class="data-row">
                        <td rowspan="{{ count($product->productUnits) }}"
                            class="text-center valign-middle">{{ $product->type->short_code }}</td>
                        <td rowspan="{{ count($product->productUnits) }}" class="valign-middle">{{ $product->name }}</td>
                        <td rowspan="{{ count($product->productUnits) }}"
                            class="text-center valign-middle">{{ $product->short_code }}</td>
                        <td class="text-center">{{ $productUnit->unit->symbol . ($productUnit->is_base == 1 ? ' (Base)' : '')}}</td>
                        <td class="text-right">{{ $productUnit->conversion_value }}</td>
                        <td rowspan="{{ count($product->productUnits) }}"
                            class="valign-top">{{ $product->description }}</td>
                        <td rowspan="{{ count($product->productUnits) }}"
                            class="text-center valign-middle">{{ $statusDDL[$product->status] }}</td>
                        <td rowspan="{{ count($product->productUnits) }}" class="valign-top">{{ $product->remarks }}</td>
                    </tr>
                @else
                    <tr class="data-row">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-center">{{ $productUnit->unit->symbol . ($productUnit->is_base == 1 ? ' (Base)' : '')}}</td>
                        <td class="text-right">{{ $productUnit->conversion_value }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        <tr>
            <td colspan="8">&nbsp;</td>
        </tr>
        <tr class="footer-row">
            <td colspan="8">
                @lang('report.template.product.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>