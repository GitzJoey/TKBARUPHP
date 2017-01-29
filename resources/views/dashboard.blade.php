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
    <div id="unfinishedSettingsNotice"></div>

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>150</h3>
                    <p>&nbsp;&nbsp;&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-disc"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>
                    <p>&nbsp;&nbsp;&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-stats"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>44</h3>
                    <p>&nbsp;&nbsp;&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>65</h3>
                    <p>&nbsp;&nbsp;&nbsp;</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-pie"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
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