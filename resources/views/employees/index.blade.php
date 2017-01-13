@extends('layouts.adminlte.master')

@section('title')
    @lang('employees.index.title')
@endsection

@section('page_title')
    <span class="fa fa-employees fa-flip-horizontal fa-fw"></span>&nbsp;@lang('employees.index.page_title')
@endsection

@section('page_title_desc')
    @lang('employees.index.page_title_desc')
@endsection



@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('employees.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('employees.index.table.header.name')</th>
                    <th class="text-center">@lang('employees.index.table.header.email')</th>
                    <th class="text-center">@lang('employees.index.table.header.ic_number')</th>
                    <th class="text-center">@lang('employees.index.table.header.image_path')</th>
                    <th class="text-center">@lang('labels.ACTION')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($employeeslist as $key => $employees)
                    <tr>
                        <td class="text-center">{{ $employees->name }}</td>
                        <td class="text-center">{{ $employees->email }}</td>
                        <td class="text-center">{{ $employees->ic_number }}</td>
                        <td class="text-center">{{ $employees->image_path }}</td>
                        <td class="text-center" width="10%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.master.employees.show', $employees->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.master.employees.edit', $employees->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.employees.delete', $employees->hId()], 'style'=>'display:inline'])  !!}
                                <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.employees.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $employeeslist->render() !!}
        </div>
    </div>
@endsection