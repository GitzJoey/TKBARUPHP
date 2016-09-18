@extends('layouts.adminlte.master')

@section('title', 'product Management')

@section('page_title')
    <span class="fa fa-truck fa-fw"></span>&nbsp;Phone Provider
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
            <h3 class="box-title">@lang('product.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">@lang('product.index.table.header.name')</th>
                    <th class="text-center">@lang('product.index.table.header.short_name')</th>
                    <th class="text-center">@lang('product.index.table.header.prefix')</th>
                    <th class="text-center">@lang('product.index.table.header.status')</th>
                    <th class="text-center">@lang('product.index.table.header.remarks')</th>
                    <th class="text-center">@lang('product.index.table.header.prefix')</th>
                    <th class="text-center">@lang('product.index.table.header.status')</th>
                    <th class="text-center">@lang('product.index.table.header.remarks')</th>
                    <th class="text-center">@lang('product.index.table.header.status')</th>
                    <th class="text-center">@lang('product.index.table.header.action')</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($product as $key => $product)
                    <tr>
                        <td class="text-center">{{ $product->id }}</td>
                        <td class="text-center">{{ $product->store_id }}</td>
                        <td class="text-center">{{ $product->product_type_id }}</td>
                        <td class="text-center">{{ $product->type }}</td>
                        <td class="text-center">{{ $product->name }}</td>
                        <td class="text-center">{{ $product->short_code }}</td>
                        <td class="text-center">{{ $product->description }}</td>
                        <td>{{ $product->image_path }}</td>
                        <td>{{ $product->status }}</td>
                        <td>{{ $product->remarks }}</td>


                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.master.product.show', $product->id) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.master.product.edit', $product->id) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.product.delete', $product->id], 'style'=>'display:inline'])  !!}
                            <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.product.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('product.index.button.new_phone_provider')</a>
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