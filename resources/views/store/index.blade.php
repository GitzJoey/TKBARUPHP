@extends('layouts.adminlte.master')

@section('title', 'Store Management')

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;Store
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
            <h3 class="box-title">Store Lists</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Address</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Tax Id</th>
                        <th class="text-center">Default</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Remarks</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($store as $key => $store)
                        <tr>
                            <td class="text-center">{{ $store->id }}</td>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->address }}</td>
                            <td>{{ $store->phone_num }}</td>
                            <td>{{ $store->tax_id }}</td>
                            <td>{{ $store->is_default }}</td>
                            <td>{{ $store->status }}</td>
                            <td>{{ $store->remarks }}</td>
                            <td class="text-center" width="20%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.admin.store.show', $store->id) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.admin.store.edit', $store->id) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.admin.store.delete', $store->id], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.admin.store.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;New Store</a>
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