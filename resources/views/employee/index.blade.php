@extends('layouts.adminlte.master')

@section('title')
    @lang('employee.index.title')
@endsection

@section('page_title')
    <span class="fa fa-odnoklassniki fa-flip-horizontal fa-fw"></span>&nbsp;@lang('employee.index.page_title')
@endsection

@section('page_title_desc')
    @lang('employee.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('employee.employee') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('employee.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('employee.index.table.header.name')</th>
                        <th class="text-center">@lang('employee.index.table.header.address')</th>
                        <th class="text-center">@lang('employee.index.table.header.ic_number')</th>
                        <th class="text-center">@lang('employee.index.table.header.start_date')</th>
                        <th class="text-center">@lang('employee.index.table.header.freelance')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeelist as $key => $employee)
                        <tr>
                            <td class="text-center">{{ $employee->name }}</td>
                            <td class="text-center">{{ $employee->address }}</td>
                            <td class="text-center">{{ $employee->ic_number }}</td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.employee.employee.show', $employee->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.employee.employee.edit', $employee->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.employee.employee.delete', $employee->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.employee.employee.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $employeelist->render() !!}
        </div>
    </div>
@endsection