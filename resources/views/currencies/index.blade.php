@extends('layouts.adminlte.master')

@section('title')
    @lang('currencies.index.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-usd"></span>&nbsp;@lang('currencies.index.page_title')
@endsection

@section('page_title_desc')
    @lang('currencies.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin_currencies') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('currencies.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('currencies.index.table.header.name')</th>
                        <th class="text-center">@lang('currencies.index.table.header.symbol')</th>
                        <th class="text-center">@lang('currencies.index.table.header.status')</th>
                        <th class="text-center">@lang('currencies.index.table.header.remarks')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($currencieslist as $item)
                        <tr>
                            <td>{{ $item->name }}</td>     
                            <td>{{ $item->symbol }}</td>     
                            <td>@lang('lookup.'.$item->status)</td>     
                            <td>{{ $item->remarks }}</td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.admin.currencies.show', $item->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.admin.currencies.edit', $item->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.admin.currencies.delete', $item->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>     
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.admin.currencies.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $currencieslist->render() !!}
        </div>
    </div>
@endsection