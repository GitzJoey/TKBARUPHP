@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.index.title')
@endsection

@section('page_title')
    <span class="fa fa-umbrella fa-fw"></span>&nbsp;@lang('supplier.index.page_title')
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
            <h3 class="box-title">Create Supplier</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.supplier.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="inputSupplierName" class="col-sm-2 control-label">@lang('supplier.edit.field.name')</label>
                    <div class="col-sm-10">
                        <input id="inputSupplierName" name="name" type="text" class="form-control" value="{{ old('name') }}" placeholder="Supplier Name">
                        <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label for="inputAddress" class="col-sm-2 control-label">@lang('supplier.edit.field.address')</label>
                    <div class="col-sm-10">
                        <textarea id="inputAddress" class="form-control" rows="5" name="address">{{ old('address') }}</textarea>
                        <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                    <label for="inputCity" class="col-sm-2 control-label">@lang('supplier.edit.field.city')</label>
                    <div class="col-sm-10">
                        <textarea id="inputCity" class="form-control" rows="5" name="city">{{ old('city') }}</textarea>
                        <span class="help-block">{{ $errors->has('city') ? $errors->first('city') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                    <label for="inputPhone" class="col-sm-2 control-label">@lang('supplier.edit.field.remarks')</label>
                    <div class="col-sm-10">
                        <input id="inputPhone" name="phone_number" type="text" class="form-control" value="{{ old('phone_num') }}" placeholder="Phone Number">
                        <span class="help-block">{{ $errors->has('phone_number') ? $errors->first('phone_number') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputFax" class="col-sm-2 control-label">Fax</label>
                    <div class="col-sm-10">
                        <input id="inputFax" name="fax_num" type="text" class="form-control" value="{{ old('fax_num') }}" placeholder="Fax">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputTax" class="col-sm-2 control-label">Tax ID</label>
                    <div class="col-sm-10">
                        <input id="inputTax" name="tax_id" type="text" class="form-control" value="{{ old('tax_id') }}" placeholder="Tax ID">
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
                    <label for="inputRemarks" class="col-sm-2 control-label">Remarks</label>
                    <div class="col-sm-10">
                        <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ old('remarks') }}" placeholder="Remarks">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.supplier') }}" class="btn btn-default">Cancel</a>
                        <button class="btn btn-default" type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection