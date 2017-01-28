@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.cash.index.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.cash.index.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.cash.index.page_title_desc')
@endsection

@section('breadcrumbs')

@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('accounting.cash.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="20%">@lang('accounting.cash.index.table.header.code')</th>
                        <th class="text-center" width="20%">@lang('accounting.cash.index.table.header.name')</th>
                        <th class="text-center" width="10%">@lang('accounting.cash.index.table.header.is_default')</th>
                        <th class="text-center" width="20%">@lang('accounting.cash.index.table.header.status')</th>
                        <th class="text-center" width="10%">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($acccash as $key => $ac)
                        <tr>
                            <td>{{ $ac->code }}</td>
                            <td>{{ $ac->name }}</td>
                            <td class="text-center">
                                @if ($ac->is_default)
                                    <span class="fa fa-check-square-o fa-fw"></span>
                                @else
                                    <span class="fa fa-square-o fa-fw"></span>
                                @endif
                            </td>
                            <td>@lang('lookup.' . $ac->status)</td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-info" href="{{ route('db.acc.cash.show', $ac->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.acc.cash.edit', $ac->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.acc.cash.delete', $ac->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.acc.cash.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $acccash->render() !!}
        </div>
    </div>
@endsection