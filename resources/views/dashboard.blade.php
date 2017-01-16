@extends('layouts.adminlte.master')

@section('title')
    @lang('dashboard.title')
@endsection

@section('page_title')
    <span class="fa fa-dashboard fa-fw"></span>&nbsp;@lang('dashboard.page_title')
@endsection
@section('page_title_desc')
    @lang('dashboard.page_title_desc')
@endsection
@section('breadcrumbs')
    {!! Breadcrumbs::render('dashboard') !!}
@endsection

@section('content')
    <div id="test">
        <template v-if="test == 'ok'">
            <p>ok</p>
        </template>
        <template v-else>
            <p>not ok</p>
        </template>
    </div>
    @for ($i = 0; $i < 1000; $i++)
        <br/>
    @endfor
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            var app = new Vue({
                el: '#test',
                data: {
                    test: 'ok1'
                },
                methods: {
                    t: function() {
                        alert('ok');
                    }
                },
                ready: function() {
                    //this.t();
                    alert('ok');
                }
            })
        });
    </script>
@endsection