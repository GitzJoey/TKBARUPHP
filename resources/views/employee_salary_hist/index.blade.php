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
                        <th class="text-center">@lang('employee_salary.index.table.header.last_payment')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employeelist as $key => $employee)
                        @php($lastPayment=$employee->lastPayment())
                        <tr>
                            <td class="text-center">{{ $employee->name }}</td>
                            <td class="text-center">{{ $employee->address }}</td>
                            <td class="text-center">{{ $employee->ic_number }}</td>
                            <td class="text-center">{{ date(Config::get('const.DATETIME_FORMAT.PHP_DATE'), strtotime($employee->start_date)) }}</td>
                            <td class="text-center">
                                @if($employee->freelace)
                                    <i class="fa fa-check-square-o fa-fw"></i>
                                @else
                                    <i class="fa fa-square-o fa-fw"></i>
                                @endif
                            </td>
                            <td class="text-center">{{ $lastPayment != null ? $lastPayment->created_at->format('M Y') : '-' }}</td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.employee.employee_salary.show', Hashids::encode($employee->employee_id)) }}"><span class="fa fa-info fa-fw"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            @if (Auth::user()->can('employee.employee_salary-generate'))
                <a class="btn btn-success" id="calculate" href="{{ route('db.employee.employee_salary.calculate_salary') }}"><span class="fa fa-money fa-fw"></span>&nbsp;@lang('buttons.calculate_salary') ({{ date('M').' '.date('Y') }})</a>
            @endif
            <a class="btn btn-success" href="{{ route('db.employee.employee_salary.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $employeelist->render() !!}
        </div>
    </div>
@endsection
@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function(){
            $('#calculate').click(function(event){
                event.preventDefault();
                swal({
                    title: "@lang('messages.alert.salary.title')",
                    text: "@lang($salaryCount?'messages.alert.salary.calculate_exists':'messages.alert.salary.calculate')",
                    type: "error",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "@lang('buttons.calculate_salary')",
                    cancelButtonText: "@lang('buttons.cancel_button')",
                    closeOnConfirm: false
                }, function (isConfirm) {
                    if(isConfirm){
                        console.log(event);
                        window.location = $('#calculate').attr('href');
                    }
                });
            });
        })
        
    </script>
@endsection