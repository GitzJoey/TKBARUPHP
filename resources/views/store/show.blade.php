@extends('layouts.adminlte.master')

@section('title')
    @lang('store.show.title')
@endsection

@section('page_title')
    <span class="fa fa-umbrella fa-fw"></span>&nbsp;@lang('store.show.page_title')
@endsection

@section('page_title_desc')
    @lang('store.show.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin_store_show', $store->hId()) !!}
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('store.show.header.title') : {{ $store->name }}</h3>
        </div>
        <form class="form-horizontal">
            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_store" data-toggle="tab">@lang('store.create.tab.store')&nbsp;<span id="storeDataTabError" class="red-asterisk hidden">*</span></a></li>
                        <li><a href="#tab_bank_account" data-toggle="tab">@lang('store.create.tab.bank_account')&nbsp;<span id="bankAccountTabError" class="red-asterisk hidden">*</span></a></li>
                        <li><a href="#tab_currencies" data-toggle="tab">@lang('store.create.tab.currencies')&nbsp;<span id="currenciesTabError" class="red-asterisk hidden">*</span></a></li>
                        <li><a href="#tab_settings" data-toggle="tab">@lang('store.create.tab.settings')&nbsp;<span id="settingsTabError" class="red-asterisk hidden">*</span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_store">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <img src="{{  asset('images/' . $store->image_filename) }}" class="img-rounded" width="150px" height="150px">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">@lang('store.field.name')</label>
                                <div class="col-sm-10">
                                    <label id="inputId" class="control-label">
                                        <span class="control-label-normal">{{ $store->name }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress" class="col-sm-2 control-label">@lang('store.field.address')</label>
                                <div class="col-sm-10">
                                    <label id="inputAddress" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $store->address }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone" class="col-sm-2 control-label">@lang('store.field.phone')</label>
                                <div class="col-sm-10">
                                    <label id="inputPhone" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $store->phone_num }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFax" class="col-sm-2 control-label">@lang('store.field.fax')</label>
                                <div class="col-sm-10">
                                    <label id="inputFax" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $store->fax_num }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTaxId" class="col-sm-2 control-label">@lang('store.field.tax_id')</label>
                                <div class="col-sm-10">
                                    <label id="inputTaxId" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $store->tax_id }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputIsDefault" class="col-sm-2 control-label">@lang('store.field.default')</label>
                                <div class="col-sm-10">
                                    <label id="inputIsDefault" class="control-label control-label-normal">
                                        <span class="control-label-normal">@lang('lookup.'.$store->is_default)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFrontWeb" class="col-sm-2 control-label">@lang('store.field.frontweb')</label>
                                <div class="col-sm-10">
                                    <label id="inputFrontWeb" class="control-label control-label-normal">
                                        <span class="control-label-normal">@lang('lookup.'.$store->frontweb)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus" class="col-sm-2 control-label">@lang('store.field.status')</label>
                                <div class="col-sm-10">
                                    <label id="inputStatus" class="control-label control-label-normal">
                                        <span class="control-label-normal">@lang('lookup.'.$store->status)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRemarks" class="col-sm-2 control-label">@lang('store.field.remarks')</label>
                                <div class="col-sm-10">
                                    <label id="inputRemarks" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $store->remarks }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_bank_account">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">@lang('store.create.table_bank.header.bank')</th>
                                    <th class="text-center">@lang('store.create.table_bank.header.account_number')</th>
                                    <th class="text-center">@lang('store.create.table_bank.header.remarks')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($store->bankAccounts as $ba)
                                    <tr>
                                        <td>{{ $ba->bank()->first()->name }}</td>
                                        <td>{{ $ba->account_number }}</td>
                                        <td>{{ $ba->remarks }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_currencies">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">@lang('store.create.table_currencies.header.currencies')</th>
                                        <th class="text-center">@lang('store.create.table_currencies.header.base_currencies')</th>
                                        <th class="text-center">@lang('store.create.table_currencies.header.conversion_value')</th>
                                        <th class="text-center">@lang('store.create.table_currencies.header.remarks')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($store->currenciesConversions as $curConv)
                                        <tr>
                                            <td>{{ $curConv->currencies()->first()->name }}</td>
                                            <td>{{ $curConv->is_base ? trans('lookup.YESNOSELECT.YES'):trans('lookup.YESNOSELECT.NO') }}</td>
                                            <td>{{ $curConv->conversion_value }}</td>
                                            <td>{{ $curConv->remarks }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>                          
                        </div>
                        <div class="tab-pane" id="tab_settings">
                            <div class="form-group {{ $errors->has('date_format') ? 'has-error' : '' }}">
                                <label for="inputDateFormat" class="col-sm-2 control-label">@lang('store.field.date_format')</label>
                                <div class="col-sm-10">
                                    <select name="date_format" class="form-control" disabled>
                                        <option value="d/m/Y" {{ $store->date_format == 'd/m/Y' ? 'selected':'' }}>dd/MM/yyyy - {{ date('d/m/Y') }} (default)</option>
                                        <option value="d m Y" {{ $store->date_format == 'd m Y' ? 'selected':'' }}>dd MM yyyy - {{ date('d m Y') }}</option>
                                        <option value="d M Y" {{ $store->date_format == 'd M Y' ? 'selected':'' }}>dd MMM yyyy - {{ date('d M Y') }}</option>
                                        <option value="m/d/Y" {{ $store->date_format == 'm/d/Y' ? 'selected':'' }}>MM/dd/yyyy - {{ date('m/d/Y') }}</option>
                                    </select>
                                    <span class="help-block">{{ $errors->has('date_format') ? $errors->first('date_format') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('time_format') ? 'has-error' : '' }}">
                                <label for="inputTimeFormat" class="col-sm-2 control-label">@lang('store.field.time_format')</label>
                                <div class="col-sm-4">
                                    <div class="checkbox icheck">
                                        <input type="radio" name="time_format" value="H:i:s" {{ $store->time_format == 'H:i:s' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;{{ date('H:i:s') }}</label>
                                    </div>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="time_format" value="h:i A" {{ $store->time_format == 'h:i A' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;{{ date('h:i A') }}</label>
                                    </div>
                                </div>
                                <span class="help-block">{{ $errors->has('time_format') ? $errors->first('time_format') : '' }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('thousand_separator') ? 'has-error' : '' }}">
                                <label for="inputThousandSeparator" class="col-sm-2 control-label">@lang('store.field.thousand_separator')</label>
                                <div class="col-sm-10">
                                    <select name="thousand_separator" class="form-control" disabled>
                                        <option value="," {{ $store->thousand_separator == ',' ? 'selected':'' }}>@lang('store.field.comma')&nbsp;-&nbsp;1,000,000</option>
                                        <option value="." {{ $store->thousand_separator == '.' ? 'selected':'' }}>@lang('store.field.dot')&nbsp;-&nbsp;1.000.000</option>
                                        <option value=" " {{ $store->thousand_separator == ' ' ? 'selected':'' }}>@lang('store.field.space')&nbsp;-&nbsp;1 000 000</option>
                                    </select>
                                    <span class="help-block">{{ $errors->has('thousand_separator') ? $errors->first('thousand_separator') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDecimalSeparator" class="col-sm-2 control-label">@lang('store.field.decimal_separator')</label>
                                <div class="col-sm-10">
                                    <select name="decimal_separator" class="form-control" disabled>
                                        <option value="," {{ $store->decimal_separator == ',' ? 'selected':'' }}>@lang('store.field.comma')&nbsp;-&nbsp;0,00</option>
                                        <option value="." {{ $store->decimal_separator == '.' ? 'selected':'' }}>@lang('store.field.dot')&nbsp;-&nbsp;0.00</option>
                                        <option value=" " {{ $store->decimal_separator == ' ' ? 'selected':'' }}>@lang('store.field.space')&nbsp;-&nbsp;0 00</option>
                                    </select>
                                    <span class="help-block">{{ $errors->has('decimal_separator') ? $errors->first('decimal_separator') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDecimalDigit" class="col-sm-2 control-label">@lang('store.field.decimal_digit')</label>
                                <div class="col-sm-10">
                                    <input id="inputDecimalDigit" name="decimal_digit" type="text" class="form-control" value="{{ $store->decimal_digit }}" placeholder="Decimal Digit" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRibbon" class="col-sm-2 control-label">@lang('store.field.ribbon')</label>
                                <div class="col-sm-3">
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-none" {{ $store->ribbon == 'store-ribbon-none' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.none')</label>
                                    </div>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-blue" {{ $store->ribbon == 'store-ribbon-blue' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.blue')</label>
                                    </div>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-black" {{ $store->ribbon == 'store-ribbon-black' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.black')</label>
                                    </div>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-red" {{ $store->ribbon == 'store-ribbon-red' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.red')</label>
                                    </div>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-yellow" {{ $store->ribbon == 'store-ribbon-yellow' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.yellow')</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-purple" {{ $store->ribbon == 'store-ribbon-purple' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.purple')</label>
                                    </div>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-green"  {{ $store->ribbon == 'store-ribbon-green' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.green')</label>
                                    </div>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-blue-light" {{ $store->ribbon == 'store-ribbon-blue-light' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.blue-light')</label>
                                    </div>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-black-light" {{ $store->ribbon == 'store-ribbon-black-light' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.black-light')</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-red-light" {{ $store->ribbon == 'store-ribbon-red-light' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.red-light')</label>
                                    </div>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-yellow-light" {{ $store->ribbon == 'store-ribbon-yellow-light' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.yellow-light')</label>
                                    </div>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-purple-light" {{ $store->ribbon == 'store-ribbon-purple-light' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.purple-light')</label>
                                    </div>
                                    <div class="checkbox icheck">
                                        <input type="radio" name="ribbon" value="store-ribbon-green-light" {{ $store->ribbon == 'store-ribbon-green-light' ? 'checked':'' }} disabled class="is_icheck">
                                        <label>&nbsp;@lang('store.field.green-light')</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.admin.store') }}" class="btn btn-default">@lang('buttons.back_button')</a>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            $('input.is_icheck').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
@endsection