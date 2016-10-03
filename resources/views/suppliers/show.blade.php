@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.index.title')
@endsection

@section('page_title')
    <span class="fa fa-file-text-o fa-fw"></span>&nbsp;@lang('supplier.index.page_title')
@endsection
@section('page_title_desc')
    @lang('supplier.index.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $supplier->supplier_name }}</h3>
        </div>
        <div class="box-body">
            <div role="tabpanel">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-1" data-toggle="tab">@lang('supplier.edit.page.tab-data')</a></li>
                <li><a href="#tab-2" data-toggle="tab">@lang('supplier.edit.page.tab-pic')</a></li>
                <li><a href="#tab-3" data-toggle="tab">@lang('supplier.edit.page.tab-account')</a></li>
                <li><a href="#tab-4" data-toggle="tab">@lang('supplier.edit.page.tab-product')</a></li>
                <li><a href="#tab-5" data-toggle="tab">@lang('supplier.edit.page.tab-setting')</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-1">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputId" class="col-sm-2 control-label">ID</label>
                                <div class="col-sm-10">
                                    <label id="inputId" class="control-label">
                                        <span class="control-label-normal">{{ $supplier->id }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">@lang('supplier.edit.field.name')</label>
                                <div class="col-sm-10">
                                    <label id="inputId" class="control-label">
                                        <span class="control-label-normal">{{ $supplier->supplier_name }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress" class="col-sm-2 control-label">@lang('supplier.edit.field.address')</label>
                                <div class="col-sm-10">
                                    <label id="inputAddress" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $supplier->supplier_address }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone" class="col-sm-2 control-label">@lang('supplier.edit.field.phone')</label>
                                <div class="col-sm-10">
                                    <label id="inputPhone" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $supplier->phone_number }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFax" class="col-sm-2 control-label">Fax</label>
                                <div class="col-sm-10">
                                    <label id="inputFax" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $supplier->fax_num }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTaxId" class="col-sm-2 control-label">@lang('supplier.edit.field.tax')</label>
                                <div class="col-sm-10">
                                    <label id="inputTaxId" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $supplier->tax_id }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <label id="inputTaxId" class="control-label control-label-normal">
                                        <span class="control-label-normal">@lang('lookup.' . $supplier->status)</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRemarks" class="col-sm-2 control-label">@lang('supplier.edit.field.remarks')</label>
                                <div class="col-sm-10">
                                    <label id="inputRemarks" class="control-label control-label-normal">
                                        <span class="control-label-normal">{{ $supplier->remarks }}</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </div>
                <div class="tab-pane" id="tab-2">
                    <div class="tab-pane active" id="tab-1">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        @foreach($pics as $key => $pic)
                                        <div class="panel-heading" role="tab" id="heading{{$pic->id}}">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$pic->id}}" aria-expanded="true" aria-controls="collapse{{$pic->id}}">
                                                    PIC {{ ++$key }} - {{$pic->first_name}} {{$pic->last_name}}
                                                </a>
                                            </h4>
                                        </div><br>
                                        <div id="collapse{{$pic->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                              <div class="panel-body">
                                                <div class="col-sm-12">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">@lang('supplier.edit.field.pic.first-name')</label>
                                                            <div class="col-sm-10">
                                                                <label id="inputId" class="control-label">
                                                                    <span class="control-label-normal">{{ $pic->first_name }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">@lang('supplier.edit.field.pic.last-name')</label>
                                                            <div class="col-sm-10">
                                                                <label id="inputId" class="control-label">
                                                                    <span class="control-label-normal">{{ $pic->last_name }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">@lang('supplier.edit.field.pic.address')</label>
                                                            <div class="col-sm-10">
                                                                <label id="inputId" class="control-label">
                                                                    <span class="control-label-normal">{{ $pic->address }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">@lang('supplier.edit.field.pic.phone-list')</label>
                                                            <div class="col-sm-10">
                                                                <table class="table datatable-basic table-striped table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Provider</th>
                                                                            <th>Number</th>
                                                                            <th>Status</th>
                                                                            <th>Remarks</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($pic->phone as $item)
                                                                            <tr>
                                                                        <th>{{ $item->provider->name }}</th>
                                                                        <th>{{ $item->number }}</th>
                                                                        <th class="text-center">@lang('lookup.' . $item->status)</th>
                                                                        <th>{{ $item->remarks }}</th>
                                                                        <tr>
                                                                        @endforeach
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                        </div>
                                        @endforeach
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
                                <table class="table datatable-basic table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Bank</th>
                                            <th>@lang('supplier.edit.field.bank.account')</th>
                                            <th>@lang('supplier.edit.field.bank.remarks')</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $bank_account as $bank)
                                        <tr>
                                            <th>{{ $bank->bank->name }}</th>
                                            <th>{{ $bank->account_number }}</th>
                                            <th>{{ $bank->remarks }}</th>
                                            <th class="text-center">@lang('lookup.' . $supplier->status)</th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="tab-pane" id="tab-4">
                    <div class="tab-pane active" id="tab-1">
                        <div class="panel">
                            <div class="panel-body">
                                <table class="table datatable-basic table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('supplier.edit.field.product.type')</th>
                                            <th>@lang('supplier.edit.field.product.code')</th>
                                            <th>@lang('supplier.edit.field.product.name')</th>
                                            <th>@lang('supplier.edit.field.product.description')</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $products as $product)
                                        <tr>
                                            <th>{{$product->type}}</th>
                                            <th>{{$product->short_code}}</th>
                                            <th>{{$product->name}}</th>
                                            <th>{{$product->description}}</th>
                                            <th class="text-center">@lang('lookup.' . $product->status)</th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="pull-right"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-5">
                    <div class="tab-pane active" id="tab-1">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="inputDueDay" class="col-sm-2 text-right">@lang('supplier.edit.field.setting.due-day')</label>
                                    <div class="col-sm-9">
                                        <span class="control-label-normal">{{ $supplier->due_day }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputButton" class="col-sm-1 control-label"></label>
                <div class="col-sm-7">
                    <a href="{{ route('db.master.supplier') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection