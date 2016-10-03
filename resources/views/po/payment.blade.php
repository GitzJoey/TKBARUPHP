@extends('layouts.adminlte.master')

@section('title')
    @lang('po.payment.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-fw"></span>&nbsp;@lang('po.payment.page_title')
@endsection
@section('page_title_desc')
    @lang('po.payment.page_title_desc')
@endsection

@section('content')
    <form class="form-horizontal" action="{{ route('db.po.payment') }}" method="post">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('po.payment.box.po_detail')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputSupplierType" class="col-sm-3 control-label">@lang('po.revise.field.supplier_type')</label>
                            <div class="col-sm-9">
                                <label class="control-label control-label-normal"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSupplierName" class="col-sm-3 control-label">@lang('po.revise.field.supplier_name')</label>
                            <div class="col-sm-9">
                                <label class="control-label control-label-normal"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSupplierDetails" class="col-sm-3 control-label">@lang('po.revise.field.supplier_details')</label>
                            <div class="col-sm-9">
                                <label class="control-label control-label-normal"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPoCode" class="col-sm-2 control-label">@lang('po.revise.po_code')</label>
                            <div class="col-sm-10">
                                <label class="control-label control-label-normal"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPoType" class="col-sm-2 control-label">@lang('po.revise.po_type')</label>
                            <div class="col-sm-10">
                                <label class="control-label control-label-normal"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPoDate" class="col-sm-2 control-label">@lang('po.revise.po_date')</label>
                            <div class="col-sm-10">
                                <label class="control-label control-label-normal"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPoStatus" class="col-sm-2 control-label">@lang('po.revise.po_status')</label>
                            <div class="col-sm-10">
                                <label class="control-label control-label-normal"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection