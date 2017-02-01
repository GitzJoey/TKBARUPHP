@extends('layouts.adminlte.master')

@section('title')
    @lang('user.calendar.title')
@endsection

@section('page_title')
    <span class="fa fa-calendar fa-fw"></span>&nbsp;@lang('user.calendar.page_title')
@endsection

@section('page_title_desc')
    @lang('user.calendar.page_title_desc')
@endsection

@section('breadcrumbs')

@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('adminlte/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/fullcalendar.print.min.css') }}" media="print">
    <style type="text/css">
        .fc-state-highlight {
            background-color: #f8edba
        }
    </style>
@endsection

@section('content')
    <div id="calendarVue">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-info">
                    <div class="box-body no-padding">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('user.calendar.header.title')</h3>
                    </div>
                    <form action="{{ route('db.user.calendar.store') }}" method="post" data-parsley-validate="parsley">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputTitle" class="col-sm-3 control-label">@lang('user.field.title')</label>
                                <div class="col-sm-12">
                                    <input id="inputTitle" name="event_title" type="text" class="form-control" placeholder="@lang('user.field.title')" data-parsley-required="true">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputStartDate" class="col-sm-4 control-label">@lang('user.field.start_date')</label>
                                <div class="col-sm-12">
                                    <input id="inputStartDate" name="start_date" type="text" class="form-control" placeholder="@lang('user.field.start_date')" data-parsley-required="true">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEndDate" class="col-sm-4 control-label">@lang('user.field.end_date')</label>
                                <div class="col-sm-12">
                                    <input id="inputEndDate" name="end_date" type="text" class="form-control" placeholder="@lang('user.field.end_date')">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExtUrl" class="col-sm-3 control-label">@lang('user.field.ext_url')</label>
                                <div class="col-sm-12">
                                    <input id="inputExtUrl" name="ext_url" type="text" class="form-control" placeholder="@lang('user.field.ext_url')">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputButton" class="col-sm-2 control-label"></label>
                                <div class="col-sm-12">
                                    <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="{{ asset('adminlte/js/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/id.js') }}"></script>

    <script type="application/javascript">
        $(document).ready(function() {
            var app = new Vue({
                el: '#calendarVue',
                data: {
                    calendar: []
                },
                methods: {
                    loadEvents: function() {
                        $.ajax({
                            url: '{{ route('api.user.get.calendar') }}',
                            data: {
                                id: '{{ Auth::user()->id }}'
                            },
                            type: 'GET',
                            async: false,
                            success: function(response) {
                                $('#calendar').fullCalendar({
                                    header: {
                                        left: 'prev, next today',
                                        center: 'title',
                                        right: 'month, agendaWeek, agendaDay'
                                    },
                                    locale: '{!! LaravelLocalization::getCurrentLocale() !!}',
                                    events: response.userCalendar,
                                    dayClick: function(date, jsEvent, view) {
                                        $(".fc-state-highlight").removeClass("fc-state-highlight");
                                        $("td[data-date=" + date.format('YYYY-MM-DD') + "]").addClass("fc-state-highlight");
                                        $('#inputStartDate').data('DateTimePicker').date(moment(date));
                                        $('#inputEndDate').data('DateTimePicker').date(moment(date).add(1, 'd'));
                                    },
                                    eventRender: function(event, element) {
                                        $(element).tooltip({
                                            title: event.title
                                        });
                                    }
                                });
                            }
                        });
                    }
                },
                mounted: function() {
                    this.loadEvents();
                }
            });

            $("#inputStartDate, #inputEndDate").datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment()
            });
        });
    </script>
@endsection