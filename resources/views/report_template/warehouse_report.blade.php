<!DOCTYPE html>
<html>
    @include('report_template.style')

    <table>
        <tr class="title-row">
            <td colspan="{{ count($report['headers']) }}">
                <h3><b>@lang('report.template.warehouse.report_name')</b></h3>
            </td>
        </tr>
        @foreach($report['titles'] as $key => $title)
           <tr class="title-row">
               <td colspan="{{ count($report['headers']) }}">
                   <h4><b>{{ $title }}</b></h4>
               </td>
           </tr>
        @endforeach
        @if(count($report['parameters']))
            <tr>
                <td colspan="{{ count($report['headers']) }}"></td>
            </tr>
            <tr>
                <td colspan="{{ count($report['headers']) }}"><b>Parameter</b></td>
            </tr>
            @foreach($report['parameters'] as $key => $parameter)
                <tr>
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
                <th>{{ $header }}</th>
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
                <h5>@lang('report.template.warehouse.footer', ['user' => $report['user'], 'date' => $report['date']])</h5>
            </td>
        </tr>
    </table>
</html>