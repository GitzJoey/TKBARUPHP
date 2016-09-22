@extends('layouts.adminlte.master')

@section('title')
    @lang('price_level.index.title')
@endsection

@section('page_title')
    <span class="fa fa-table fa-fw"></span>&nbsp;@lang('price_level.index.page_title')
@endsection
@section('page_title_desc')
    @lang('price_level.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('price_level.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('price_level.index.table.header.type')</th>
                        <th class="text-center">@lang('price_level.index.table.header.weight')</th>
                        <th class="text-center">@lang('price_level.index.table.header.name')</th>
                        <th class="text-center">@lang('price_level.index.table.header.description')</th>
                        <th class="text-center">@lang('price_level.index.table.header.value')</th>
                        <th class="text-center">@lang('price_level.index.table.header.status')</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pricelevel as $key => $item)
                        <tr>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->weight}}</td>
                            <td>{{ $item->name}}</td>
                            <td>{{ $item->description}}</td>
                            <td></td>
                            <td class="text-center">@lang('lookup.' . $item->status)</td>
                            <td class="text-center" width="20%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.price.price_level.show', $item->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.price.price_level.edit', $item->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.price.price_level.delete', $item->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.price.price_level.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $pricelevel->render() !!}
        </div>
    </div>
@endsection