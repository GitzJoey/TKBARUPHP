@extends('layouts.adminlte.master')

@section('title')
    @lang('po.create')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-fw"></span>&nbsp;@lang('po.create.page_title')New Purchase Order
@endsection
@section('page_title_desc')
    @lang('po.create.page_title_desc')
@endsection

@section('content')
    <form class="form-horizontal" action="{{ route('db.po.create') }}" method="post">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('db.po.create.box.supplier')</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputSupplierType" class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-9">
                                <select class="form-control">
                                    <option>option 1</option>
                                    <option>option 2</option>
                                    <option>option 3</option>
                                    <option>option 4</option>
                                    <option>option 5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSupplierName" class="col-sm-3 control-label">Supplier Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputSupplierName" name="name" placeholder="Supplier Name" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSupplierDetails" class="col-sm-3 control-label">Details</label>
                            <div class="col-sm-9">
                                <textarea id="inputSupplierDetails" class="form-control" rows="5" name="address"></textarea>
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label for="inputUnregisteredSupplier" class="col-sm-2 control-label">Supplier Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputUnregisteredSupplier" name="unregistered_supplier_name" placeholder="Supplier Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputUnregisteredSupplierDetails" class="col-sm-2 control-label">Details</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputUnregisteredSupplierDetails" name="unregistered_supplier_details" placeholder="Details">
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Purchase Order Detail</h3>
                    </div>
                    <div class="box-body">

                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            $('input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal'
            });
        });
    </script>
@endsection