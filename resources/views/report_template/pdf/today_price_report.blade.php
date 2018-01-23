<!DOCTYPE html>
<html>
    @include('report_template.excel.style')
    <table>
        <tr class="title-row">
            <td colspan="3">
                <b>@lang('report.template.today_price.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.today_price.header.product_type')</th>
            <th>@lang('report.template.today_price.header.product_name')</th>
            <th>@lang('report.template.today_price.header.price')</th>
        </tr>
        @foreach($todayPriceReport as $key => $tPR)
            <tr>
                <td>{{ $tPR['product_category_name'] }}</td>
                <td>{{ $tPR['product_name'] }}</td>
                <td>{{ $tPR['price'] }}</td>
            </tr>
        @endforeach
    </table>
</html>