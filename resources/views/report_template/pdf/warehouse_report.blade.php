<!DOCTYPE html>
<html>
    @include('report_template.pdf.style')

    <table>
        <tr class="title-row">
            <td colspan="{{ count($report['headers']) }}">
                <span id="title"><b>@lang('report.template.warehouse.report_name')</b></span>
            </td>
        </tr>
        @foreach($report['titles'] as $key => $title)
           <tr class="subtitle-row">
               <td colspan="{{ count($report['headers']) }}">
                   <b>{{ $title }}</b>
               </td>
           </tr>
        @endforeach
        @if(count($report['parameters']))
            <tr>
                <td colspan="{{ count($report['headers']) }}"></td>
            </tr>
            @foreach($report['parameters'] as $key => $parameter)
                <tr class="parameter-row">
                    <td colspan="{{ count($report['headers']) }}">
                        {{ Lang::get('report.template.warehouse.parameter.' . $parameter['label']) . " : " . $parameter['value'] }}
                    </td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td colspan="{{ count($report['headers']) }}"></td>
        </tr>
        <tr class="header-row">
            @foreach($report['headers'] as $key => $header)
                <th width={{ $header['width'] }}>{{ $header['label'] }}</th>
            @endforeach
        </tr>
        <tr class="data-row">
            @foreach($report['data'] as $key => $data)
                <td>{{ $data }}</td>
            @endforeach
        </tr>
        <tr>
            <td colspan="{{ count($report['headers']) }}"></td>
        </tr>
        <tr class="footer-row">
            <td colspan="{{ count($report['headers']) }}">
                @lang('report.template.warehouse.footer', ['user' => $report['user'], 'date' => $report['date']])
            </td>
        </tr>
    </table>
</html>