<div class="modal fade" v-bind:id="'customerDetailModal_' + soIndex" tabindex="-1" role="dialog" v-bind:aria-labelledby="'customerDetailModalLabel_' + soIndex">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" v-bind:id="'customerDetailModalLabel_' + soIndex">@lang('sales_order.partial.customer.title')Customer Details</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_customer" data-toggle="tab">@lang('sales_order.partial.customer.tab.customer')</a>
                                    </li>
                                    <li><a href="#tab_pic" data-toggle="tab">@lang('sales_order.partial.customer.tab.pic')</a></li>
                                    <li>
                                        <a href="#tab_bank_account" data-toggle="tab">@lang('sales_order.partial.customer.tab.bank_account')</a>
                                    </li>
                                    <li>
                                        <a href="#tab_settings" data-toggle="tab">@lang('sales_order.partial.customer.tab.settings')</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_customer">
                                        <div class="row">
                                            <div class="form-group">
                                                <label for="inputName"
                                                       class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.name')</label>
                                                <div class="col-sm-8">
                                                    <input id="inputName" type="text" class="form-control" readonly v-model="so.customer.name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress"
                                                       class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.address')</label>
                                                <div class="col-sm-8">
                                                    <textarea id="inputAddress" class="form-control" readonly rows="4">@{{ so.customer.address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputCity"
                                                       class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.city')</label>
                                                <div class="col-sm-8">
                                                    <input id="inputCity" type="text" class="form-control" readonly v-model="so.customer.city">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputPhone"
                                                       class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.phone')</label>
                                                <div class="col-sm-8">
                                                    <input id="inputPhone" type="tel" class="form-control" readonly
                                                           v-model="so.customer.phone_number">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputTaxId"
                                                       class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.tax_id')</label>
                                                <div class="col-sm-8">
                                                    <input id="inputTaxId" type="text" class="form-control" readonly
                                                           v-model="so.customer.tax_id">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputRemarks"
                                                       class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.remarks')</label>
                                                <div class="col-sm-8">
                                                    <input id="inputRemarks" type="text" class="form-control" readonly
                                                           v-model="so.customer.remarks">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_pic">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div v-for="(profile, profileIndex) in so.customer.profiles">
                                                    <div class="box box-widget">
                                                        <div class="box-header with-border">
                                                            <div class="user-block">
                                                                <strong>Person In Charge @{{ profileIndex + 1 }}</strong><br/>
                                                                &nbsp;&nbsp;&nbsp;@{{ profile.first_name }}
                                                                &nbsp;@{{ profile.last_name }}
                                                            </div>
                                                            <div class="box-tools">
                                                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="inputFirstName"
                                                                       class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.first_name')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputFirstName" type="text"
                                                                           class="form-control"
                                                                           readonly
                                                                           v-model="profile.first_name">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputLastName"
                                                                       class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.last_name')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputLastName" type="text"
                                                                           class="form-control"
                                                                           readonly
                                                                           v-model="profile.last_name">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputAddress"
                                                                       class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.address')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputAddress" type="text"
                                                                           class="form-control"
                                                                           readonly
                                                                           v-model="profile.address">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputICNum"
                                                                       class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.ic_num')</label>
                                                                <div class="col-sm-10">
                                                                    <input id="inputICNum" type="text"
                                                                           class="form-control"
                                                                           readonly
                                                                           v-model="profile.ic_num">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputPhoneNumber"
                                                                       class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.phone_number')</label>
                                                                <div class="col-sm-10">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>@lang('sales_order.partial.customer.table_phone.header.provider')</th>
                                                                                <th>@lang('sales_order.partial.customer.table_phone.header.number')</th>
                                                                                <th>@lang('sales_order.partial.customer.table_phone.header.remarks')</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(phoneNumber, phoneNumberIndex) in profile.phone_numbers">
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
                                                    <th class="text-center">@lang('sales_order.partial.customer.table_bank.header.bank')</th>
                                                    <th class="text-center">@lang('sales_order.partial.customer.table_bank.header.account_number')</th>
                                                    <th class="text-center">@lang('sales_order.partial.customer.table_bank.header.remarks')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(bankAccount, bankAccountIndex) in so.customer.bank_accounts">
                                                    <td>@{{ bankAccount.bank.name }}</td>
                                                    <td>@{{ bankAccount.account_number }}</td>
                                                    <td>@{{ bankAccount.remarks }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab_settings">
                                        <div class="form-group">
                                            <label for="inputPriceLevel" class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.price_level')</label>
                                            <div class="col-sm-10">
                                                <input id="inputPriceLevel" name="price_level" type="text" class="form-control" readonly="readonly" v-model="so.customer.price_level">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPaymentDueDay" class="col-sm-2 control-label">@lang('sales_order.partial.customer.field.payment_due_day')</label>
                                            <div class="col-sm-10">
                                                <input id="inputPaymentDueDay" name="payment_due_day" type="text" class="form-control" readonly="readonly" v-model="so.customer.payment_due_day">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('buttons.close_button')</button>
                </div>
            </div>
        </div>
    </div>
</div>