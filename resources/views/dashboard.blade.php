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
    <div id="unfinishedSettingsNotice">

    </div>
    @for ($i = 0; $i < 100; $i++)
        <br/>
    @endfor
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            checkUnfinish();

            function checkUnfinish() {
                $.ajax({
                    url: '{{ route('api.get.unfinish.store') }}',
                    type: "GET",
                    success: function (response) {
                        $('#unfinishedSettingsNotice').noty({
                            text: 'Unfinish Store Detected',
                            type: 'warning',
                            timeout: 30000,
                            progressBar: true
                        });
                    }
                });
                $.ajax({
                    url: '{{ route('api.get.unfinish.warehouse') }}',
                    type: "GET",
                    success: function (response) {
                        $('#unfinishedSettingsNotice').noty({
                            text: 'Unfinish Warehouse Detected',
                            type: 'warning',
                            timeout: 30000,
                            progressBar: true
                        });
                    }
                });
            }
        });
    </script>
@endsection