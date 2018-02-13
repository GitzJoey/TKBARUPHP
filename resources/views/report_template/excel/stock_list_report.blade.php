<!DOCTYPE html>
<html>
    @include('report_template.excel.style')
    <table>
        <tr class="title-row">
            <td colspan="4">
                <b>@lang('report.template.stock_list.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.stock_list.header.warehouse')</th>
            <th>@lang('report.template.stock_list.header.product_type')</th>
            <th>@lang('report.template.stock_list.header.product_name')</th>
            <th>@lang('report.template.stock_list.header.quantity')</th>
        </tr>
        @foreach($stockList as $key => $s)
            <tr>
                <td>{{ $s['warehouse'] }}</td>
                <td>{{ $s['product_type'] }}</td>
                <td>{{ $s['product'] }}</td>
                <td>{{ $s['quantity'] }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr class="footer-row">
            <td colspan="4">
                @lang('report.template.store.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>
