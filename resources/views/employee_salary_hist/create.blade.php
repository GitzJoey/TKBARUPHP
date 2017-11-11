@extends('layouts.adminlte.master')

@section('title')
    @lang('employee_salary.create.title')
@endsection

@section('page_title')
    <span class="fa fa-odnoklassniki fa-fw"></span>&nbsp;@lang('employee_salary.create.page_title')
@endsection

@section('page_title_desc')
    @lang('employee_salary.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('employee.employee_create') !!}
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="form-horizontal" action="{{ route('db.employee.employee_salary.create') }}" enctype="multipart/form-data" method="post" data-parsley-validate="parsley">
        {{ csrf_field() }}
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('employee_salary.create.header.title')</h3>
            </div>
            <div class="box-body">
                <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }}">
                    <label for="inputName" class="col-sm-2 control-label">@lang('employee_salary.field.employee')</label>
                    <div class="col-sm-10">
                        {{ Form::select('employee_id', $employeeList, \Vinkla\Hashids\Facades\Hashids::encode($employee_id), array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'),'data-parsley-required' => 'true','id'=>'employee-form' )) }}
                        <span class="help-block">{{ $errors->has('employee_id') ? $errors->first('employee_id') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="type" class="col-sm-2 control-label">@lang('employee_salary.field.type')</label>
                    <div class="col-sm-10">
                        {{ Form::select('type', $statusDDL, '', array('class' => 'form-control', 'placeholder' => Lang::get('labels.PLEASE_SELECT'),'data-parsley-required' => 'true','id'=>'' )) }}
                        <span class="help-block">{{ $errors->has('type') ? $errors->first('type') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                    <label for="inputAmount" class="col-sm-2 control-label">@lang('employee_salary.field.amount')</label>
                    <div class="col-sm-10">
                        <input id="inputAmount" name="amount" type="text" class="form-control"
                               placeholder="@lang('employee_salary.field.amount')" data-parsley-required="true">
                        <span class="help-block">{{ $errors->has('amount') ? $errors->first('amount') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label for="inputDescription" class="col-sm-2 control-label">@lang('employee_salary.field.description')</label>
                    <div class="col-sm-10">
                    <textarea class="form-control"id="inputDescription" name="description" type="text" class="form-control"
                              placeholder="@lang('employee_salary.field.description')"></textarea>
                        <span class="help-block">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.employee.employee_salary') }}"
                           class="btn btn-default">@lang('buttons.cancel_button')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.create_new_button')</button>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </div>

        @if (!empty($salaryList))
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('employee_salary.create.header.employee_transaction')</h3>
                </div>
                <div class="box-body">
                    <div class="form-horizontal">
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
                                            <span class="control-label-normal">{{ date(Config::get('const.DATETIME_FORMAT.PHP_DATE'), strtotime($employee->start_date)) }}</span>
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
                                            @if($employee->freelance)
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
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="box-footer">
                            {!! $salaryList->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
@endsection

@section('custom_js')
    <script type="application/javascript" src="{{ mix('adminlte/parsley/parsley.config.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/parsley.min.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/id.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/id.extra.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/en.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/en.extra.js') }}"></script>

    <script type="application/javascript">
        $(document).ready(function() {
            $('#employee-form').select2();
            $('#employee-form').on("change", function(e) {
                window.location.href = new URI().setQuery('e', $('#employee-form').val());
            });

             $('input.is_icheck').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            $("#inputStartDate").datetimepicker({
                format: "DD-MM-YYYY",
                defaultDate: moment()
            });
        });
    </script>
@endsection
