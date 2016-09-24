@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.index.title')
@endsection

@section('page_title')
    <span class="fa fa-wrench fa-fw"></span>&nbsp;@lang('warehouse.index.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('warehouse.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('warehouse.index.table.header.name')</th>
                    <th class="text-center">@lang('warehouse.index.table.header.address')</th>
                    <th class="text-center">@lang('warehouse.index.table.header.phone_num')</th>
                    <th class="text-center">@lang('warehouse.index.table.header.status')</th>
                    <th class="text-center">@lang('warehouse.index.table.header.remarks')</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($warehouse as $key => $w)
                    <tr>
                        <td>{{ $w->name }}</td>
                        <td>{{ $w->address }}</td>
                        <td class="text-center">{{ $w->phone_num }}</td>
                        <td class="text-center">@lang('lookup.' . $w->status)</td>
                        <td>{{ $w->remarks }}</td>
                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.master.warehouse.show', $w->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.master.warehouse.edit', $w->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.warehouse.delete', $w->hId()], 'style'=>'display:inline'])  !!}
                                <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.warehouse.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $warehouse->render() !!}
        </div>
    </div>
@endsection
