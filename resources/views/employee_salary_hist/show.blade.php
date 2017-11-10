@extends('layouts.adminlte.master')

@section('title')
    @lang('employee_salary.show.title')
@endsection

@section('page_title')
    <span class="fa fa-money fa-fw"></span>&nbsp;@lang('employee_salary.show.page_title')
@endsection

@section('page_title_desc')
    @lang('employee_salary.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('employee_salary.employee_show', $employee->hId()) !!}
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('employee_salary.show.header.title') : {{ $employee->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">@lang('employee_salary.field.employee')</label>
                            <div class="col-sm-9">
                                <label id="inputName" class="control-label">
                                    <span class="control-label-normal">{{ $employee->name }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress" class="col-sm-3 control-label">@lang('employee.field.address')</label>
                            <div class="col-sm-9">
                                <label id="inputAddress" class="control-label">
                                    <span class="control-label-normal">{{ $employee->address }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputIcNumber"
                                   class="col-sm-3 control-label">@lang('employee.field.ic_number')</label>
                            <div class="col-sm-9">
                                <label id="inputIcNumber" class="control-label control-label-normal">
                                    <span class="control-label-normal">{{ $employee->ic_number }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputStartDate" class="col-sm-3 control-label">@lang('employee.field.start_date')</label>
                            <div class="col-sm-5">
                                <label class="control-label">
                                    <span class="control-label-normal">{{ $employee->start_date }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputFreelance" class="col-sm-3 control-label">@lang('employee.field.freelance')</label>
                            <div class="col-sm-5">
                                <label class="control-label">
                                    <span class="control-label-normal">
                                        @if($employee->freelace)
                                            <i class="fa fa-check-square-o fa-fw"></i>
                                        @else
                                            <i class="fa fa-square-o fa-fw"></i>
                                        @endif
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputBaseSalary" class="col-sm-3 control-label">@lang('employee.field.base_salary')</label>
                            <div class="col-sm-5">
                                <label class="control-label">
                                    <span class="control-label-normal">{{ number_format($employee->base_salary, Auth::user()->store->decimal_digit, Auth::user()->store->decimal_separator, Auth::user()->store->thousand_separator) }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputImagePath"
                                   class="col-sm-3 control-label">@lang('employee.field.image_path')</label>
                            <div class="col-sm-9">
                                <label id="inputImagePath" class="control-label control-label-normal">
                                    @if(!empty($employee->image_path))
                                        <img src="{{ asset('images/'.$employee->image_path) }}"
                                             class="img-responsive img-circle"
                                             style="max-width: 150px; max-height: 150px;"/>
                                    @endif
                                    <span class="control-label-normal">{{ $employee->image_path }}</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    <div class="col-sm-12">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>@lang('employee_salary.field.created_at')</th>
                                    <th>@lang('employee_salary.field.type')</th>
                                    <th>@lang('employee_salary.field.description')</th>
                                    <th>@lang('employee_salary.field.amount')</th>
                                    <th>@lang('employee_salary.field.balance')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($salaryList as $salary)
                                    <tr>
                                        <td>{{ $salary->created_at }}</td>
                                        <td>@lang('lookup.'.$salary->type)</td>
                                        <td>{{ $salary->description }}</td>
                                        <td class="text-right">{{ number_format($salary->amount, Auth::user()->store->decimal_digit, Auth::user()->store->decimal_separator, Auth::user()->store->thousand_separator) }}</td>
                                        <td class="text-right">{{ number_format($salary->balance, Auth::user()->store->decimal_digit, Auth::user()->store->decimal_separator, Auth::user()->store->thousand_separator) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <a href="{{ route('db.employee.employee_salary') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="box-footer">
                    {!! $salaryList->render() !!}
                </div>
            </form>
        </div>
    </div>
@endsection