<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')
    <table>
        <tr class="title-row">
            <td colspan="5">
                <b>@lang('report.template.so_summary.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.so_summary.header.code')</th>
            <th>@lang('report.template.so_summary.header.so_date')</th>
            <th>@lang('report.template.so_summary.header.customer')</th>
            <th>@lang('report.template.so_summary.header.amount')</th>
            <th>@lang('report.template.so_summary.header.status')</th>
        </tr>
        @foreach($soData as $key => $s)
            <tr>
                <td>{{ $s->code }}</td>
                <td>{{ $s->so_created }}</td>
                <td>{{ $s->customer_type == config('lookups.CUSTOMER_TYPE.WALK_IN') ? $s->walk_in_customer:$s->customer->name }}</td>
                <td></td>
                <td>@lang('lookup.'.$s->status)</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr class="footer-row">
            <td colspan="5">
                @lang('report.template.product.footer', ['user' => $currentUser, 'date' => $reportDate])
            </td>
        </tr>
    </table>
</html>