@extends('layouts.adminlte.master')

@section('title')
    @lang('unit.index.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-flash"></span>&nbsp;@lang('unit.index.page_title')
@endsection
@section('page_title_desc')
    @lang('unit.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('unit.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('unit.index.table.header.name')</th>
                        <th class="text-center">@lang('unit.index.table.header.symbol')</th>
                        <th class="text-center">@lang('unit.index.table.header.status')</th>
                        <th class="text-center">@lang('unit.index.table.header.remarks')</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unitlist as $key => $unit)
                        <tr>
                            <td>{{ $unit->name }}</td>
                            <td>{{ $unit->symbol }}</td>
                            <td>@lang('lookup.'.$unit->status)</td>
                            <td>{{ $unit->remarks }}</td>
                            <td class="text-center" width="20%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.admin.unit.show', $unit->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.admin.unit.edit', $unit->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.admin.unit.delete', $unit->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.admin.unit.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $unitlist->render() !!}
        </div>
    </div>
@endsection