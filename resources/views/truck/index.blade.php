@extends('layouts.adminlte.master')

@section('title')
    @lang('truck.index.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-flip-horizontal fa-fw"></span>&nbsp;@lang('truck.index.page_title')
@endsection
@section('page_title_desc')
    @lang('truck.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('truck.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('truck.index.table.header.plate_number')</th>
                    <th class="text-center">@lang('truck.index.table.header.inspection_date')</th>
                    <th class="text-center">@lang('truck.index.table.header.driver')</th>
                    <th class="text-center">@lang('truck.index.table.header.status')</th>
                    <th class="text-center">@lang('truck.index.table.header.remarks')</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($trucklist as $key => $truck)
                    <tr>
                        <td class="text-center">{{ $truck->plate_number }}</td>
                        <td class="text-center">{{ $truck->inspection_date }}</td>
                        <td>{{ $truck->driver }}</td>
                        <td>@lang('lookup.' . $truck->status)</td>
                        <td>{{ $truck->remarks }}</td>
                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.master.truck.show', $truck->id) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.master.truck.edit', $truck->id) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.truck.delete', $truck->id], 'style'=>'display:inline'])  !!}
                                <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.truck.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $trucklist->render() !!}
        </div>
    </div>
@endsection