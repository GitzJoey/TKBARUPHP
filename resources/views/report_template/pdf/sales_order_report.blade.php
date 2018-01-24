<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')

    <table>
        <tr class="title-row">
            <td colspan="6">
                <b>@lang('report.template.sales_order.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($soCode))
                <tr>
                    <td>
                        @lang('report.template.sales_order.parameter.so_code')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $soCode }}
                    </td>
                </tr>
            @endif
            @if(!empty($soDate))
                <tr>
                    <td>
                        @lang('report.template.sales_order.parameter.po_date')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $soDate }}
                    </td>
                </tr>
            @endif
            @if(!empty($shippingDate))
                <tr>
                    <td>
                        @lang('report.template.sales_order.parameter.shipping_date')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $shippingDate }}
                    </td>
                </tr>
            @endif
            @if(!empty($deliverDate))
                <tr>
                    <td>
                        @lang('report.template.sales_order.parameter.deliver_date')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $deliverDate }}
                    </td>
                </tr>
            @endif
            @if(!empty($customer))
                <tr>
                    <td>
                        @lang('report.template.sales_order.parameter.customer')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $customer }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        @foreach($salesOrders as $key => $sales_order)
            <tr class="data-row">
                <td>
                    @lang('report.template.sales_order.header.code')
                </td>
                <td colspan="2">
                    {{ $sales_order->code }}
                </td>
                <td>
                    @lang('report.template.sales_order.header.customer')
                </td>
                <td colspan="2">
                    {{ $sales_order->customer ? $sales_order->customer->name : $sales_order->walk_in_cust }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.sales_order.header.so_type')
                </td>
                <td colspan="2">
                    {{ $sales_order->so_type }}
                </td>
                <td>
                    @lang('report.template.sales_order.header.so_created')
                </td>
                <td colspan="2">
                    {{ $sales_order->so_created }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.sales_order.header.status')
                </td>
                <td colspan="2">
                    {{ $sales_order->status }}
                </td>
                <td>
                    @lang('report.template.sales_order.header.shipping_date')
                </td>
                <td colspan="2">
                    {{ $sales_order->shipping_date }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.sales_order.header.warehouse')
                </td>
                <td colspan="2">
                    {{ $sales_order->warehouse ? $sales_order->warehouse->name : '' }}
                </td>
                <td>
                    @lang('report.template.sales_order.header.vendor_trucking')
                </td>
                <td colspan="2">
                    {{ $sales_order->vendorTrucking ? $sales_order->vendorTrucking->name : ''}}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.sales_order.header.remarks')
                </td>
                <td colspan="2">
                    {{ $sales_order->remarks }}
                </td>
                <td>
                </td>
                <td colspan="2">
                </td>
            </tr>
            <tr class="data-row">
                <td colspan="6">&nbsp;</td>
            </tr>
            <tr class="header-row">
                <th colspan="6">@lang('report.template.sales_order.header.items')</th>
            </tr>
            <tr class="header-row">
                <th>No</th>
                <th>@lang('report.template.sales_order.header.product')</th>
                <th>@lang('report.template.sales_order.header.quantity')</th>
                <th>@lang('report.template.sales_order.header.unit')</th>
                <th>@lang('report.template.sales_order.header.price')</th>
                <th>@lang('report.template.sales_order.header.total_price')</th>
            </tr>
            @foreach($sales_order->items as $itemKey => $item)
                <tr class="data-row">
                    <td class="text-center">{{ $itemKey + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->selectedUnit->unit->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->price * $item->quantity }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6">&nbsp;</td>
            </tr>
        @endforeach
        <tr class="footer-row">
            <td colspan="6">
                @lang('report.template.sales_order.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>