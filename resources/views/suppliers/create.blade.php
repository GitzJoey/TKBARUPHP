@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.create.title')
@endsection

@section('page_title')
    <span class="fa fa-file-text-o fa-fw"></span>&nbsp;@lang('supplier.index.page_title')
@endsection
@section('page_title_desc')
    @lang('supplier.index.page_title_desc')
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul> 
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('supplier.create.title')</h3>
        </div>
        <div role="tabpanel">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-1" data-toggle="tab">@lang('supplier.edit.page.tab-data')</a></li>
                <li><a href="#tab-2" data-toggle="tab">@lang('supplier.edit.page.tab-pic')</a></li>
                <li><a href="#tab-3" data-toggle="tab">@lang('supplier.edit.page.tab-account')</a></li>
                <li><a href="#tab-4" data-toggle="tab">@lang('supplier.edit.page.tab-setting')</a></li>
            </ul>
            <form action="{{ route('db.master.supplier.create') }}" method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="tab-content">
                <div class="tab-pane active" id="tab-1">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="inputSupplierName" class="col-sm-2 control-label">@lang('supplier.edit.field.name')</label>
                            <div class="col-sm-10">
                                <input id="inputSupplierName" name="name" type="text" class="form-control" placeholder="Supplier Name">
                                <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label for="inputSupplierAddress" class="col-sm-2 control-label">@lang('supplier.edit.field.address')</label>
                            <div class="col-sm-10">
                                <textarea id="inputAddress" class="form-control" rows="5" name="address"></textarea>
                                <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                            <label for="inputSupplierCity" class="col-sm-2 control-label">@lang('supplier.edit.field.city')</label>
                            <div class="col-sm-10">
                                <textarea id="inputCity" class="form-control" rows="5" name="city"></textarea>
                                <span class="help-block">{{ $errors->has('city') ? $errors->first('city') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                            <label for="inputPhone" class="col-sm-2 control-label">@lang('supplier.edit.field.phone')</label>
                            <div class="col-sm-10">
                                <input id="inputPhone" name="phone_number" type="text" class="form-control" placeholder="Phone Number">
                                <span class="help-block">{{ $errors->has('phone_number') ? $errors->first('phone_number') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputFax" class="col-sm-2 control-label">Fax</label>
                            <div class="col-sm-10">
                                <input id="inputFax" name="fax_num" type="text" class="form-control" placeholder="Fax">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTax" class="col-sm-2 control-label">@lang('supplier.edit.field.tax')</label>
                            <div class="col-sm-10">
                                <input id="inputTax" name="tax_id" type="text" class="form-control" placeholder="Tax ID">
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                            {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                                <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputRemarks" class="col-sm-2 control-label">@lang('supplier.edit.field.remarks')</label>
                            <div class="col-sm-10">
                                <input id="inputRemarks" name="remarks" type="text" class="form-control" placeholder="Remarks">
                            </div>
                        </div>
                    </div>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </div>
                <div class="tab-pane" id="tab-2">
                    <div class="tab-pane active" id="tab-1">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.field.pic.first-name')</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="first_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.field.pic.last-name')</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="last_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.field.pic.address')</label>
                                    <div class="col-sm-9">
                                        <textarea id="inputAddress" class="form-control" rows="5" name="pic_address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-3">
                    <div class="tab-pane active" id="tab-1">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.field.bank.name')</label>
                                    <div class="col-sm-9">
                                        <select name="bank_id" class="form-control">
                                            @foreach($banks as $bank)
                                            <option value="{{$bank->id}}">{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.field.bank.account')</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="account" class="form-control" placeholder="Bank Account Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.field.bank.remarks')</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bank_remarks" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-9">
                                    {{ Form::select('bank_status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                                        <span class="help-block">{{ $errors->has('bank_status') ? $errors->first('bank_status') : '' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="tab-pane" id="tab-4">
                    <div class="tab-pane active" id="tab-1">
                        <div class="panel">
                            <div class="panel-body">
                                <label for="inputDueDay" class="col-sm-2 text-right">@lang('supplier.edit.field.setting.due-day')</label>
                                <div class="col-sm-8">
                                    <input type="number" name="due_day" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="form-group" style="padding-bottom: 10px">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.supplier') }}" class="btn btn-default">Cancel</a>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection