@extends('layouts.adminlte.master')

@section('title')
    @lang('product.index.title')
@endsection

@section('page_title')
    <span class="fa fa-cubes fa-fw"></span>&nbsp;@lang('product.index.page_title')
@endsection
@section('page_title_desc')
    @lang('product.index.page_title_desc')
@endsection

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
                    <th class="text-center">@lang('product.index.table.header.type')</th>
                    <th class="text-center">@lang('product.index.table.header.name')</th>
                    <th class="text-center">@lang('product.index.table.header.short_code')</th>
                    <th class="text-center">@lang('product.index.table.header.description')</th>
                    <th class="text-center">@lang('product.index.table.header.status')</th>
                    <th class="text-center">@lang('product.index.table.header.remarks')</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($productlist as $key => $product)
                    <tr>
                        <td>{{ $product->type->name }}</td>
                        <td>{{ $product->name }}</td>
                        <td class="text-center">{{ $product->short_code }}</td>
                        <td>{{ $product->description }}</td>
                        <td class="text-center">@lang('lookup.'.$product->status)</td>
                        <td>{{ $product->remarks }}</td>
                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.master.product.show', $product->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.master.product.edit', $product->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.product.delete', $product->hId()], 'style'=>'display:inline'])  !!}
                            <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.product.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $productlist->render() !!}
       </div>
    </div>
@endsection