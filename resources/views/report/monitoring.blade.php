@extends('layouts.adminlte.master')

@section('title')
    @lang('report.monitoring.title')
@endsection

@section('page_title')
    <span class="fa fa-eye fa-fw"></span>&nbsp;@lang('report.monitoring.page_title')
@endsection

@section('page_title_desc')
    @lang('report.monitoring.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('report.monitoring.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            @if(Laratrust::can('report_monitoring-stockhistory'))
                            <li class="active">
                                <a href="#tab_mon_1" data-toggle="tab">
                                    @lang('stock_history.page_title')
                                </a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="tab_monitoring" >
                            @if(Laratrust::can('report_monitoring-stockhistory'))
                                <div class="tab-pane active" id="tab_mon_1">
                                    @include('report.monitoring_components.stock_histories')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom_js')
    <script type="application/javascript">
        @if(Laratrust::can('report_monitoring-stockhistory'))
            var tabStockHistoryVue = new Vue({
                el: '#tab_monitoring',
                data: {
                    stock_histories: {
                        data : [],
                        error : false,
                    },
                },
                methods: {
                    toggle: function(prefix, index){
                        $( prefix+index ).toggleClass( 'collapse' );
                    },
                    formatDecimal: function(value){
                        value = parseFloat(value);
                        if( value % 1 !== 0 )
                            value = value.toFixed(2);
                        return value.toFixed(0);
                    },
                    fetchStockHistories: function () {
                        let vm = this;
                        axios.get('{{ route('api.report.mon.stockhistory.type.index') }}', {}).then((res) => {
                            vm.stock_histories.data = res.data;
                            vm.stock_histories.error = false;
                        }, (error) => {
                            vm.stock_histories.error = true;
                        })
                    },
                },
                mounted () {
                    let vm = this;
                    vm.fetchStockHistories()

                    //periodly repeat function
                    setInterval(function(){
                        vm.fetchStockHistories()
                    }, (15*60000) );
                }
            });
        @endif
    </script>
@endsection