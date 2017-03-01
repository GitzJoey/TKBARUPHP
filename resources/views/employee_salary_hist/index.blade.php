@extends('layouts.adminlte.master')

@section('title')
    @lang('employee_salary.index.title')
@endsection

@section('page_title')
    <span class="fa fa-money fa-fw"></span>&nbsp;@lang('employee_salary.index.page_title')
@endsection

@section('page_title_desc')
    @lang('employee_salary.index.page_title_desc')
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
            <h3 class="box-title">@lang('employee_salary.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('employee_salary.index.table.header.name')</th>
                        <th class="text-center">@lang('employee_salary.index.table.header.address')</th>
                        <th class="text-center">@lang('employee_salary.index.table.header.ic_number')</th>
                        <th class="text-center">@lang('employee_salary.index.table.header.start_date')</th>
                        <th class="text-center">@lang('employee_salary.index.table.header.freelance')</th>
                        <th class="text-center">@lang('employee_salary.index.table.header.balance')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeelist as $key => $employee)
                        <tr>
                            <td class="text-center">{{ $employee->name }}</td>
                            <td class="text-center">{{ $employee->address }}</td>
                            <td class="text-center">{{ $employee->ic_number }}</td>
                            <td class="text-center">{{ $employee->start_date}}</td>
                            <td class="text-center">{{ $employee->freelance }}</td>
                            <td class="text-center">{{ $employee->balance }}</td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.employee.employee_salary.show', $employee->employee_id) }}"><span class="fa fa-info fa-fw"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" onclick="return confirm('Apakah anda yakin?')" href="{{ route('db.employee.employee_salary.calculate_salary') }}"><span class="fa fa-money fa-fw"></span>&nbsp;@lang('buttons.calculate_salary') ({{ date('M').' '.date('Y') }})</a>
            <a class="btn btn-success" href="{{ route('db.employee.employee_salary.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $employeelist->render() !!}
        </div>
    </div>
@endsection