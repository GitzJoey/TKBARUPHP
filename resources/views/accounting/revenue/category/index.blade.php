@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.revenue.category.index.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.revenue.category.index.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.revenue.category.index.page_title_desc')
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
            <h3 class="box-title">@lang('accounting.revenue.category.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="20%">@lang('accounting.revenue.category.index.table.header.group')</th>
                        <th class="text-center" width="20%">@lang('accounting.revenue.category.index.table.header.name')</th>
                        <th class="text-center" width="10%">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($revcat as $key => $rc)
                        <tr>
                            <td>{{ $rc->group }}</td>
                            <td>{{ $rc->name }}</td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-info" href="{{ route('db.acc.revenue.category.show', $rc->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.acc.revenue.category.edit', $rc->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.acc.revenue.category.delete', $rc->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.acc.revenue.category.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $revcat->render() !!}
        </div>
    </div>
@endsection