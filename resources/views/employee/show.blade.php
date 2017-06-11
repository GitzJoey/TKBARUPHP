@extends('layouts.adminlte.master')

@section('title')
    @lang('employee.show.title')
@endsection

@section('page_title')
    <span class="fa fa-odnoklassniki fa-fw"></span>&nbsp;@lang('employee.show.page_title')
@endsection

@section('page_title_desc')
    @lang('employee.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('employee.employee_show', $employee->hId()) !!}
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('employee.show.header.title') : {{ $employee->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">@lang('employee.field.name')</label>
                        <div class="col-sm-10">
                            <label id="inputName" class="control-label">
                                <span class="control-label-normal">{{ $employee->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress" class="col-sm-2 control-label">@lang('employee.field.address')</label>
                        <div class="col-sm-10">
                            <label id="inputAddress" class="control-label">
                                <span class="control-label-normal">{{ $employee->address }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputIcNumber"
                               class="col-sm-2 control-label">@lang('employee.field.ic_number')</label>
                        <div class="col-sm-10">
                            <label id="inputIcNumber" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $employee->ic_number }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputStartDate" class="col-sm-2 control-label">@lang('employee.field.start_date')</label>
                        <div class="col-sm-5">
                            <label id="inputStartDate" class="control-label">
                                <span class="control-label-normal">{{ $employee->start_date }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFreelance" class="col-sm-2 control-label">@lang('employee.field.freelance')</label>
                        <div class="col-sm-5">
                            <span class="control-label-normal">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="freelance" class="is_icheck" disabled>&nbsp;
                                    </label>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputBaseSalary" class="col-sm-2 control-label">@lang('employee.field.base_salary')</label>
                        <div class="col-sm-5">
                            <input id="inputBaseSalary" name="base_salary" type="text" class="form-control"
                                   placeholder="@lang('employee.field.base_salary')" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputImagePath"
                               class="col-sm-2 control-label">@lang('employee.field.image_path')</label>
                        <div class="col-sm-10">
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
                    <div class="form-group">
                        <label for="inputStatus" class="col-sm-2 control-label">@lang('employee.field.status')</label>
                        <div class="col-sm-5">
                            <label id="inputStatus" class="control-label control-label-normal">
                                <span class="control-label-normal">@lang('lookup.'.$employee->status)</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.employee.employee') }}"
                               class="btn btn-default">@lang('buttons.back_button')</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </form>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="text/javascript">
        $(function () {
            $('input.is_icheck').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
@endsection