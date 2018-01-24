<!DOCTYPE html>
<html>
    @include('report_template.excel.style')
    <table>
        <tr class="title-row">
            <td colspan="3">
                <b>@lang('report.template.so_summary.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.so_summary.header.code')</th>
            <th>@lang('report.template.so_summary.header.po_date')</th>
            <th>@lang('report.template.so_summary.header.supplier')</th>
            <th>@lang('report.template.so_summary.header.amount')</th>
            <th>@lang('report.template.so_summary.header.status')</th>
        </tr>
    </table>
</html>