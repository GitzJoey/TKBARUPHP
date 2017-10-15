@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.stockopname.adjust.title')
@endsection

@section('page_title')
    <span class="fa fa-database fa-fw"></span>&nbsp;@lang('warehouse.stockopname.adjust.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.stockopname.adjust.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('stockopname_adjust', $stock) !!}
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

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('warehouse.stockopname.adjust.header.title')</h3>
        </div>
        {!! Form::model($stock, ['method' => 'POST', 'route' => ['db.warehouse.stockopname.adjust', $stock->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            {{ csrf_field() }}
            <div id="stockOpnameVue">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputWarehouse" class="col-sm-2 control-label">@lang('warehouse.stockopname.adjust.field.warehouse')</label>
                        <div class="col-sm-8">
                            <input id="inputWarehouse" type="text" value="{{ $stock->warehouse->name }}" disabled class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputProduct" class="col-sm-2 control-label">@lang('warehouse.stockopname.adjust.field.product')</label>
                        <div class="col-sm-8">
                            <input id="inputProduct" type="text" value="{{ $stock->product->name }}" disabled class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputOpnameDate"
                               class="col-sm-2 control-label">@lang('warehouse.stockopname.adjust.field.opname_date')</label>
                        <div class="col-sm-8">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" id="inputOpnameDate"
                                       name="opname_date"
                                       data-parsley-required="true">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputIsMatch" class="col-sm-2 control-label">@lang('warehouse.stockopname.adjust.field.is_match')</label>
                        <div class="col-sm-10">
                            <div class="checkbox icheck">
                                <label>
                                    <input id="inputIsMatch" type="checkbox" name="is_match" class="is_icheck">&nbsp;
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCurrentQuantity" class="col-sm-2 control-label">@lang('warehouse.stockopname.adjust.field.current_quantity')</label>
                        <div class="col-sm-8">
                            <input id="inputCurrentQuantity" type="text" value="{{ $stock->current_quantity }}" disabled class="form-control">
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('adjusted_quantity') ? 'has-error' : '' }}">
                        <label for="inputAdjustedQuantity"
                               class="col-sm-2 control-label">@lang('warehouse.stockopname.adjust.field.adjusted_quantity')</label>
                        <div class="col-sm-8">
                            <input id="inputAdjustedQuantity" name="adjusted_quantity" type="text" class="form-control"
                                   placeholder="@lang('warehouse.stockopname.adjust.field.adjusted_quantity')"
                                   data-parsley-required="true" data-parsley-type="numeric">
                            <span class="help-block">{{ $errors->has('adjusted_quantity') ? $errors->first('adjusted_quantity') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('reason') ? 'has-error' : '' }}">
                        <label for="inputReason" class="col-sm-2 control-label">@lang('warehouse.stockopname.adjust.field.reason')</label>
                        <div class="col-sm-8">
                            <input id="inputReason" name="reason" type="text" class="form-control" placeholder="@lang('warehouse.stockopname.adjust.field.reason')"
                                   data-parsley-required="true">
                            <span class="help-block">{{ $errors->has('reason') ? $errors->first('reason') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                            <a href="{{ route('db.warehouse.stockopname.index') }}" class="btn btn-default">@lang('buttons.cancel_button')</a>
                            <button class="btn btn-default" type="submit">@lang('buttons.submit_button')</button>
                        </div>
                    </div>
                </div>
                <div class="box-footer"></div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript" src="{{ mix('adminlte/parsley/parsley.config.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/parsley.min.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/id.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/id.extra.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/en.js') }}"></script>
    <script type="application/javascript" src="{{ mix('adminlte/parsley/en.extra.js') }}"></script>

    <script type="application/javascript">
        $(document).ready(function () {
            window.Parsley.setLocale('{!! LaravelLocalization::getCurrentLocale() !!}');

            $('input.is_icheck').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            $('input.is_icheck').on('ifChanged', function(c){
                if (c.target.checked) {
                    $('#inputAdjustedQuantity').val($('#inputCurrentQuantity').val()).attr('readonly', 'readonly');
                    $('#inputReason').val('Update ' + moment().format('DD-MM-YYYY hh:mm A')).attr('readonly', 'readonly');
                } else {
                    $('#inputAdjustedQuantity').val('').removeAttr('readonly');
                    $('#inputReason').val('').removeAttr('readonly');
                }
            });

            $("#inputOpnameDate").datetimepicker({
                format: "DD-MM-YYYY hh:mm A",
                defaultDate: moment()
            });
        });
    </script>
@endsection
