@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.edit.field.heading.bank')
@endsection

@section('page_title')
    <span class="fa fa-file-text-o fa-fw"></span>&nbsp;@lang('supplier.edit.field.heading.bank')
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
            <h3 class="box-title">@lang('supplier.edit.field.heading.bank')</h3>
        </div>
        <form class="form-horizontal" method="post" action="{{route('db.master.supplier.bank.update', array('id' => $id, 'bank_id' => $bank_account->id))}}">
        <input type="hidden" name="_method" value="patch">
        {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group {{ $errors->has('bank') ? 'has-error' : '' }}">
                <label for="inputBankName" class="col-sm-2 control-label">@lang('supplier.edit.field.bank.name')</label>
                <div class="col-sm-10">
                    <select id="inputBank" name="bank_id" class="form-control">
	                    @foreach($banks as $bank)
							<option value="{{ $bank->id }}">{{ $bank->name }}</option>
	                    @endforeach
                    </select>
                    <span class="help-block">{{ $errors->has('bank') ? $errors->first('bank') : '' }}</span>
                </div>
            </div>
            <div class="form-group {{ $errors->has('account') ? 'has-error' : '' }}">
                <label for="inputAccount" class="col-sm-2 control-label">@lang('supplier.edit.field.bank.account')</label>
                <div class="col-sm-10">
                    <input id="inputAccount" class="form-control" rows="5" name="account" value="{{ $bank_account->account_number }}">
                    <span class="help-block">{{ $errors->has('account') ? $errors->first('account') : '' }}</span>
                </div>
            </div>
			<div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                <label for="inputremarks" class="col-sm-2 control-label">@lang('supplier.edit.field.bank.remarks')</label>
                <div class="col-sm-10">
                    <input id="inputRemarks" class="form-control" rows="5" name="remarks" value="{{ $bank_account->remarks }}">
                    <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="inputstatus" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                    {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                    <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputButton" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button class="btn btn-default" type="submit">Submit</button>
                </div>
            </div>
        </div>
        </form>
	</div>
@endsection