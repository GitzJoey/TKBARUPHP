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
    <link rel="stylesheet" href="{{ asset('adminlte/css/fullcalendar.print.css') }}" media="print">
@endsection

@section('content')
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
            </div>
            <div class="box-body">
                @for ($i = 0; $i < 15; $i++)
                    <br/>
                @endfor
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script src="{{ asset('adminlte/js/fullcalendar.min.js') }}"></script>

    <script type="application/javascript">
        $(function () {
            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date();
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
                //Random default events
                events: [
                    {
                        title: 'All Day Event',
                        start: new Date(y, m, 1),
                        backgroundColor: "#f56954", //red
                        borderColor: "#f56954" //red
                    },
                    {
                        title: 'Long Event',
                        start: new Date(y, m, d - 5),
                        end: new Date(y, m, d - 2),
                        backgroundColor: "#f39c12", //yellow
                        borderColor: "#f39c12" //yellow
                    },
                    {
                        title: 'Meeting',
                        start: new Date(y, m, d, 10, 30),
                        allDay: false,
                        backgroundColor: "#0073b7", //Blue
                        borderColor: "#0073b7" //Blue
                    },
                    {
                        title: 'Lunch',
                        start: new Date(y, m, d, 12, 0),
                        end: new Date(y, m, d, 14, 0),
                        allDay: false,
                        backgroundColor: "#00c0ef", //Info (aqua)
                        borderColor: "#00c0ef" //Info (aqua)
                    },
                    {
                        title: 'Birthday Party',
                        start: new Date(y, m, d + 1, 19, 0),
                        end: new Date(y, m, d + 1, 22, 30),
                        allDay: false,
                        backgroundColor: "#00a65a", //Success (green)
                        borderColor: "#00a65a" //Success (green)
                    },
                    {
                        title: 'Click for Google',
                        start: new Date(y, m, 28),
                        end: new Date(y, m, 29),
                        url: 'http://google.com/',
                        backgroundColor: "#3c8dbc", //Primary (light-blue)
                        borderColor: "#3c8dbc" //Primary (light-blue)
                    }
                ],
                editable: true,
            });
        });
    </script>
@endsection