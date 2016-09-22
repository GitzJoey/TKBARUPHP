@extends('layouts.adminlte.master')

@section('title')
    @lang('product_type.index.title')
@endsection

@section('page_title')
    <span class="fa fa-cube fa-fw"></span>&nbsp;@lang('product_type.index.page_title')
@endsection
@section('page_title_desc')
    @lang('product_type.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('product_type.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('product_type.index.table.header.name')</th>
                        <th class="text-center">@lang('product_type.index.table.header.short_code')</th>
                        <th class="text-center">@lang('product_type.index.table.header.description')</th>
                        <th class="text-center">@lang('product_type.index.table.header.status')</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prodtype as $key => $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->short_code }}</td>
                            <td>{{ $item->description }}</td>
                            <td class="text-center">@lang('lookup.' . $item->status)</td>
                            <td class="text-center" width="20%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.master.producttype.show', $item->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.master.producttype.edit', $item->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.producttype.delete', $item->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.producttype.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $prodtype->render() !!}
        </div>
    </div>
@endsection