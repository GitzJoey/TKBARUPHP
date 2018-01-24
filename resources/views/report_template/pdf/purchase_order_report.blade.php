<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')

    <table>
        <tr class="title-row">
            <td colspan="6">
                <b>@lang('report.template.purchase_order.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        @if($showParameter)
            @if(!empty($poCode))
                <tr>
                    <td>
                        @lang('report.template.purchase_order.parameter.po_code')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $poCode }}
                    </td>
                </tr>
            @endif
            @if(!empty($poDate))
                <tr>
                    <td>
                        @lang('report.template.purchase_order.parameter.po_date')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $poDate }}
                    </td>
                </tr>
            @endif
            @if(!empty($shippingDate))
                <tr>
                    <td>
                        @lang('report.template.purchase_order.parameter.shipping_date')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $shippingDate }}
                    </td>
                </tr>
            @endif
            @if(!empty($receiptDate))
                <tr>
                    <td>
                        @lang('report.template.purchase_order.parameter.receipt_date')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $receiptDate }}
                    </td>
                </tr>
            @endif
            @if(!empty($supplier))
                <tr>
                    <td>
                        @lang('report.template.purchase_order.parameter.supplier')
                    </td>
                    <td colspan="5">
                        {{ ': ' . $supplier }}
                    </td>
                </tr>
            @endif
        @endif
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        @foreach($purchaseOrders as $key => $purchase_order)
            <tr class="data-row">
                <td>
                    @lang('report.template.purchase_order.header.code')
                </td>
                <td colspan="2">
                    {{ $purchase_order->code }}
                </td>
                <td>
                    @lang('report.template.purchase_order.header.supplier')
                </td>
                <td colspan="2">
                    {{ $purchase_order->supplier ? $purchase_order->supplier->name : $purchase_order->walk_in_supplier }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.purchase_order.header.po_type')
                </td>
                <td colspan="2">
                    {{ $purchase_order->po_type }}
                </td>
                <td>
                    @lang('report.template.purchase_order.header.po_created')
                </td>
                <td colspan="2">
                    {{ $purchase_order->po_created }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.purchase_order.header.status')
                </td>
                <td colspan="2">
                    {{ $purchase_order->status }}
                </td>
                <td>
                    @lang('report.template.purchase_order.header.shipping_date')
                </td>
                <td colspan="2">
                    {{ $purchase_order->shipping_date }}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.purchase_order.header.warehouse')
                </td>
                <td colspan="2">
                    {{ $purchase_order->warehouse ? $purchase_order->warehouse->name : '' }}
                </td>
                <td>
                    @lang('report.template.purchase_order.header.vendor_trucking')
                </td>
                <td colspan="2">
                    {{ $purchase_order->vendorTrucking ? $purchase_order->vendorTrucking->name : ''}}
                </td>
            </tr>
            <tr class="data-row">
                <td>
                    @lang('report.template.purchase_order.header.remarks')
                </td>
                <td colspan="2">
                    {{ $purchase_order->remarks }}
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
                <th colspan="6">@lang('report.template.purchase_order.header.items')</th>
            </tr>
            <tr class="header-row">
                <th>No</th>
                <th>@lang('report.template.purchase_order.header.product')</th>
                <th>@lang('report.template.purchase_order.header.quantity')</th>
                <th>@lang('report.template.purchase_order.header.unit')</th>
                <th>@lang('report.template.purchase_order.header.price')</th>
                <th>@lang('report.template.purchase_order.header.total_price')</th>
            </tr>
            @foreach($purchase_order->items as $itemKey => $item)
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
                @lang('report.template.purchase_order.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>