@extends('layouts.adminlte.master')

@section('title', 'Customer Management')

@section('page_title')
    <span class="fa fa-home fa-fw"></span>&nbsp;Customers
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
            <h3 class="box-title">@lang('customer.index.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">@lang('customer.index.table.header.name')</th>
                    <th class="text-center">@lang('customer.index.table.header.address')</th>
                    <th class="text-center">@lang('customer.index.table.header.city')</th>
                    <th class="text-center">@lang('customer.index.table.header.phone')</th>
                    <th class="text-center">@lang('customer.index.table.header.remarks')</th>
                    <th class="text-center">@lang('customer.index.table.header.taxt_id')</th>
                    <th class="text-center">@lang('customer.index.table.header.action')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($customer as $key => $customer)
                    <tr>
                        <td class="text-center">{{ $customer->id }}</td>
                        <td class="text-center">{{ $customer->name }}</td>
                        <td class="text-center">{{ $customer->address }}</td>
                        <td class="text-center">{{ $customer->city }}</td>
                        <td class="text-center">{{ $customer->phone }}</td>
                        <td class="text-center">{{ $customer->remarks }}</td>
                        <td class="text-center">{{ $customer->tax_id }}</td>
                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.master.customer.show', $customer->id) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.master.customer.edit', $customer->id) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.customer.delete', $customer->id], 'style'=>'display:inline'])  !!}
                            <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.customer.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('customer.index.button.create')</a>
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
