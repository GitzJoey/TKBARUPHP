@extends('layouts.adminlte.master')

@section('title', 'phoneProvider Management')

@section('page_title')
    <span class="fa-volume-control-phone"></span>&nbsp;Phone Provider
@endsection
@section('page_title_desc', '')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('phoneProvider.index.table.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">@lang('phoneProvider.index.table.header.name')</th>
                    <th class="text-center">@lang('phoneProvider.index.table.header.short_name')</th>
                    <th class="text-center">@lang('phoneProvider.index.table.header.prefix')</th>
                    <th class="text-center">@lang('phoneProvider.index.table.header.status')</th>
                    <th class="text-center">@lang('phoneProvider.index.table.header.remarks')</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($phoneProvider as $key => $phoneProvider)
                    <tr>
                        <td class="text-center">{{ $phoneProvider->id }}</td>
                        <td class="text-center">{{ $phoneProvider->name }}</td>
                        <td class="text-center">{{ $phoneProvider->short_name }}</td>
                        <td>{{ $phoneProvider->prefix }}</td>
                        <td>{{ $phoneProvider->status }}</td>
                        <td>{{ $phoneProvider->remarks }}</td>


                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.admin.phoneProvider.show', $phoneProvider->id) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.admin.phoneProvider.edit', $phoneProvider->id) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.admin.phoneProvider.delete', $phoneProvider->id], 'style'=>'display:inline'])  !!}
                            <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.admin.phoneProvider.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('phoneProvider.index.button.new_phone_provider')</a>
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
    </div>
@endsection