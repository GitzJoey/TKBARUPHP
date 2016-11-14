<div class="modal fade" id="supplierDetailModal" tabindex="-1" role="dialog"
     aria-labelledby="supplierDetailModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="supplierDetailModalLabel">Supplier Details</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_supplier"
                                                          data-toggle="tab">@lang('supplier.create.tab.supplier')</a>
                                    </li>
                                    <li><a href="#tab_pic" data-toggle="tab">@lang('supplier.create.tab.pic')</a></li>
                                    <li><a href="#tab_bank_account"
                                           data-toggle="tab">@lang('supplier.create.tab.bank_account')</a></li>
                                    <li><a href="#tab_product"
                                           data-toggle="tab">@lang('supplier.create.tab.product')</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_supplier">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="inputName"
                                                       class="col-sm-2 control-label">@lang('supplier.field.name')</label>
                                                <div class="col-sm-8">
                                                    <input id="inputName" type="text" class="form-control" readonly
                                                           ng-model="po.supplier.name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress"
                                                       class="col-sm-2 control-label">@lang('supplier.field.address')</label>
                                                <div class="col-sm-8">
                                                            <textarea id="inputAddress" class="form-control"
                                                                      readonly rows="4">@{{ po.supplier.address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputCity"
                                                       class="col-sm-2 control-label">@lang('supplier.field.city')</label>
                                                <div class="col-sm-8">
                                                    <input id="inputCity" type="text" class="form-control" readonly
                                                           ng-model="po.supplier.city">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPhone"
                                                       class="col-sm-2 control-label">@lang('supplier.field.phone')</label>
                                                <div class="col-sm-8">
                                                    <input id="inputPhone" type="tel" class="form-control" readonly
                                                           ng-model="po.supplier.phone_number">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputTaxId"
                                                       class="col-sm-2 control-label">@lang('supplier.field.tax_id')</label>
                                                <div class="col-sm-8">
                                                    <input id="inputTaxId" type="text" class="form-control" readonly
                                                           ng-model="po.supplier.tax_id">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputRemarks"
                                                       class="col-sm-2 control-label">@lang('supplier.field.remarks')</label>
                                                <div class="col-sm-8">
                                                    <input id="inputRemarks" type="text" class="form-control" readonly
                                                           ng-model="po.supplier.remarks">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_pic">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div ng-repeat="profile in po.supplier.profiles">
                                                    <div class="box box-widget">
                                                        <div class="box-header with-border">
                                                            <div class="user-block">
                                                                <strong>Person In Charge @{{ $index + 1 }}</strong><br/>
                                                                &nbsp;&nbsp;&nbsp;@{{ profile.first_name }}
                                                                &nbsp;@{{ profile.last_name }}
                                                            </div>
                                                            <div class="box-tools">
                                                                <button type="button" class="btn btn-box-tool"
                                                                        data-widget="collapse"><i
                                                                            class="fa fa-minus"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="inputFirstName"
                                                                       class="col-sm-2 control-label">@lang('supplier.field.first_name')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputFirstName" type="text"
                                                                           class="form-control"
                                                                           readonly
                                                                           ng-model="profile.first_name">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputLastName"
                                                                       class="col-sm-2 control-label">@lang('supplier.field.last_name')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputLastName" type="text"
                                                                           class="form-control"
                                                                           readonly
                                                                           ng-model="profile.last_name">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress"
                                                                       class="col-sm-2 control-label">@lang('supplier.field.address')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputAddress" type="text"
                                                                           class="form-control"
                                                                           readonly
                                                                           ng-model="profile.address">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputICNum"
                                                                       class="col-sm-2 control-label">@lang('supplier.field.ic_num')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputICNum" type="text"
                                                                           class="form-control"
                                                                           readonly
                                                                           ng-model="profile.ic_num">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputPhoneNumber"
                                                                       class="col-sm-2 control-label">@lang('supplier.field.phone_number')</label>
                                                                <div class="col-sm-10">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>@lang('supplier.create.table_phone.header.provider')</th>
                                                                            <th>@lang('supplier.create.table_phone.header.number')</th>
                                                                            <th>@lang('supplier.create.table_phone.header.remarks')</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr ng-repeat="phoneNumber in profile.phone_numbers">
                                                                            <td>@{{ phoneNumber.provider.name }}</td>
                                                                            <td>@{{ phoneNumber.number }}</td>
                                                                            <td>@{{ phoneNumber.remarks }}</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_bank_account">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th class="text-center">@lang('supplier.create.table_bank.header.bank')</th>
                                                <th class="text-center">@lang('supplier.create.table_bank.header.account_number')</th>
                                                <th class="text-center">@lang('supplier.create.table_bank.header.remarks')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="bankAccount in po.supplier.bank_accounts">
                                                <td>@{{ bankAccount.bank.name }}</td>
                                                <td>@{{ bankAccount.account_number }}</td>
                                                <td>@{{ bankAccount.remarks }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab_product">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center">@lang('supplier.create.table_prod.header.type')</th>
                                                <th class="text-center">@lang('supplier.create.table_prod.header.name')</th>
                                                <th class="text-center">@lang('supplier.create.table_prod.header.short_code')</th>
                                                <th class="text-center">@lang('supplier.create.table_prod.header.description')</th>
                                                <th class="text-center">@lang('supplier.create.table_prod.header.remarks')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="p in po.supplier.products">
                                                <td class="text-center">
                                                    <input type="checkbox" checked disabled>
                                                </td>
                                                <td>@{{ p.type.name }}</td>
                                                <td>@{{ p.name }}</td>
                                                <td>@{{ p.short_code }}</td>
                                                <td>@{{ p.description }}</td>
                                                <td>@{{ p.remarks }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>