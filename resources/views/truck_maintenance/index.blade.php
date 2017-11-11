@extends('layouts.adminlte.master')

@section('title')
    @lang('truckmtc.index.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-flip-horizontal fa-fw"></span>&nbsp;@lang('truckmtc.index.page_title')
@endsection

@section('page_title_desc')
    @lang('truckmtc.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('truck_maintenance') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('truckmtc.index.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <select id="plateSelect" class="form-control">
                        <option value="">@lang('labels.SHOW_ALL')</option>
                        @foreach ($truck as $t)
                            <option value="{{ Hashids::encode($t->id)  }}" {{ Hashids::encode($t->id) == $truckId ? "selected":""  }}>{{ $t->plate_number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('truckmtc.index.table.header.plate_number')</th>
                        <th class="text-center">@lang('truckmtc.index.table.header.maintenance_date')</th>
                        <th class="text-center">@lang('truckmtc.index.table.header.maintenance_type')</th>
                        <th class="text-center">@lang('truckmtc.index.table.header.cost')</th>
                        <th class="text-center">@lang('truckmtc.index.table.header.odometer')</th>
                        <th class="text-center">@lang('truckmtc.index.table.header.remarks')</th>
                        <th class="text-center" width="10%">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trucklist as $key => $truck)
                        <tr>
                            <td class="text-center">{{ $truck->truck->plate_number }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($truck->maintenance_date)->format(Auth::user()->store->date_format) }}</td>
                            <td>@lang('lookup.'.$truck->maintenance_type)</td>
                            <td align="right">{{ number_format($truck->cost, Auth::user()->store->decimal_digit, Auth::user()->store->decimal_separator, Auth::user()->store->thousand_separator) }}</td>
                            <td class="text-center">{{ number_format($truck->odometer, 0, Auth::user()->store->decimal_separator, Auth::user()->store->thousand_separator) }}</td>
                            <td>{{ $truck->remarks }}</td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-primary" href="{{ route('db.truck.maintenance.edit', $truck->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.truck.maintenance.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $trucklist->appends(Request::query())->render() !!}
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            $('#plateSelect').change(function() {
                window.location.href = '{{ route('db.truck.maintenance') }}' + '?s=' + $('#plateSelect').val();
            }) ;
        });
    </script>
@endsection