@extends('layouts.adminlte.master')

@section('title', 'Purchase Order')

@section('page_title')
    <span class="fa fa-truck fa-fw"></span>&nbsp;New Purchase Order
@endsection
@section('page_title_desc', '')

@section('content')
    <form class="form-horizontal" action="{{ route('db.admin.user.create') }}" method="post">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Supplier</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputSupplierType" class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-9">
                                <div class="radio-inline">
                                    <label><input type="radio" name="optradio"><span class="control-label-normal">Registered</span></label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" name="optradio"><span class="control-label-normal">Unregistered</span></label>
                                </div>
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