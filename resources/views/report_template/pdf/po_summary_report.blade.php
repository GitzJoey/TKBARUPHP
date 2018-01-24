<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')
    <table>
        <tr class="title-row">
            <td colspan="5">
                <b>@lang('report.template.po_summary.report_name')</b>
            </td>
        </tr>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr class="header-row">
            <th>@lang('report.template.po_summary.header.code')</th>
            <th>@lang('report.template.po_summary.header.po_date')</th>
            <th>@lang('report.template.po_summary.header.supplier')</th>
            <th>@lang('report.template.po_summary.header.amount')</th>
            <th>@lang('report.template.po_summary.header.status')</th>
        </tr>
        @foreach($poData as $key => $p)
            <tr>
                <td>{{ $p->code }}</td>
                <td>{{ $p->po_created }}</td>
                <td>{{ $p->supplier_type == config('lookups.SUPPLIER_TYPE.WALK_IN') ? $p->walk_in_supplier:$p->supplier->name }}</td>
                <td></td>
                <td>@lang('lookup.'.$p->status)</td>
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