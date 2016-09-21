@extends('layouts.adminlte.master')

@section('title')
    @lang('store.index.title')
@endsection

@section('page_title')
    <span class="fa fa-umbrella fa-fw"></span>&nbsp;@lang('store.index.page_title')
@endsection
@section('page_title_desc')
    @lang('store.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('store.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('store.index.table.header.name')</th>
                        <th class="text-center">@lang('store.index.table.header.address')</th>
                        <th class="text-center">@lang('store.index.table.header.phone')</th>
                        <th class="text-center">@lang('store.index.table.header.tax_id')</th>
                        <th class="text-center">@lang('store.index.table.header.default')</th>
                        <th class="text-center">@lang('store.index.table.header.status')</th>
                        <th class="text-center">@lang('store.index.table.header.remarks')</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($store as $key => $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->phone_num }}</td>
                            <td>{{ $item->tax_id }}</td>
                            <td class="text-center">@lang('lookup.' . $item->is_default )</td>
                            <td class="text-center">@lang('lookup.' . $item->status)</td>
                            <td>{{ $item->remarks }}</td>
                            <td class="text-center" width="20%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.admin.store.show', $item->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.admin.store.edit', $item->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.admin.store.delete', $item->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.admin.store.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $store->render() !!}
        </div>
    </div>
@endsection