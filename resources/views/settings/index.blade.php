@extends('layouts.adminlte.master')

@section('title')
    @lang('settings.index.title')
@endsection

@section('page_title')
    <span class="fa fa-minus-square fa-fw"></span>&nbsp;@lang('settings.index.page_title')
@endsection
@section('page_title_desc')
    @lang('settings.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('settings.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('settings.index.table.header.user')</th>
                    <th class="text-center">@lang('settings.index.table.header.category')</th>
                    <th class="text-center">@lang('settings.index.table.header.skey')</th>
                    <th class="text-center">@lang('settings.index.table.header.value')</th>
                    <th class="text-center">@lang('settings.index.table.header.description')</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td>
                                @if(is_null($item->user()))
                                    Default
                                @else
                                    $item->user()->name
                                @endif
                            </td>
                            <td>{{ $item->category }}</td>
                            <td>{{ $item->skey }}</td>
                            <td>{{ $item->value }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.admin.settings.edit', $item->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            {!! $data->render() !!}
        </div>
    </div>
@endsection