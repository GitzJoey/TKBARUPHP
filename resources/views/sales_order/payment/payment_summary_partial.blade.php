<div class="row">
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('sales_order.payment.summary.box.customer')</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="inputCustomerType"
                           class="col-sm-2 control-label">@lang('sales_order.payment.summary.field.customer_type')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" readonly
                               value="@lang('lookup.'.$currentSo->customer_type)">
                    </div>
                </div>
                @if($currentSo->customer_type == 'CUSTOMERTYPE.R')
                    <div class="form-group">
                        <label for="inputCustomerId"
                               class="col-sm-2 control-label">@lang('sales_order.payment.summary.field.customer_name')</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" readonly
                                   value="{{ $currentSo->customer->name }}">
                        </div>
                        <div class="col-sm-2">
                            <button id="customerDetailButton" type="button" class="btn btn-primary btn-sm"
                                    data-toggle="modal" data-target="#customerDetailModal_0"><span
                                        class="fa fa-info-circle fa-lg"></span></button>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label for="inputCustomerName"
                               class="col-sm-2 control-label">@lang('sales_order.payment.summary.field.customer_name')</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" readonly
                                   value="{{ $currentSo->walk_in_cust }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputCustomerDetails"
                               class="col-sm-2 control-label">@lang('sales_order.payment.summary.field.customer_details')</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5" readonly>{{ $currentSo->walk_in_cust_detail }}</textarea>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('sales_order.payment.summary.box.sales_order_detail')</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="inputSoCode"
                           class="col-sm-3 control-label">@lang('sales_order.payment.summary.field.so_code')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" readonly value="{{ $currentSo->code }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSoType"
                           class="col-sm-3 control-label">@lang('sales_order.payment.summary.field.so_type')</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" readonly
                               value="@lang('lookup.'.$currentSo->so_type)">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSoDate"
                           class="col-sm-3 control-label">@lang('sales_order.payment.summary.field.so_date')</label>
                    <div class="col-sm-9">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" readonly
                                   value="{{ $currentSo->so_created->format('d-m-Y H:i A') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputSoStatus"
                           class="col-sm-3 control-label">@lang('sales_order.payment.summary.field.so_status')</label>
                    <div class="col-sm-9">
                        <label class="control-label control-label-normal">@lang('lookup.'.$currentSo->status)</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('sales_order.payment.summary.box.shipping')</h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label for="inputShippingDate"
                           class="col-sm-2 control-label">@lang('sales_order.payment.summary.field.shipping_date')</label>
                    <div class="col-sm-5">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" name="shipping_date" readonly
                                   value="{{ $currentSo->shipping_date->format('d-m-Y H:i A') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputWarehouse"
                           class="col-sm-2 control-label">@lang('sales_order.payment.summary.field.warehouse')</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" readonly value="{{ $currentSo->warehouse->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputVendorTrucking"
                           class="col-sm-2 control-label">@lang('sales_order.payment.summary.field.vendor_trucking')</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" readonly
                               value="{{ empty($currentSo->vendorTrucking->name) ? '':$currentSo->vendorTrucking->name }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('sales_order.payment.summary.box.transactions')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="itemsListTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="30%">@lang('sales_order.payment.summary.table.item.header.product_name')</th>
                                    <th width="15%"
                                        class="text-center">@lang('sales_order.payment.summary.table.item.header.quantity')</th>
                                    <th width="15%"
                                        class="text-center">@lang('sales_order.payment.summary.table.item.header.unit')</th>
                                    <th width="15%"
                                        class="text-center">@lang('sales_order.payment.summary.table.item.header.price_unit')</th>
                                    <th width="5%">&nbsp;</th>
                                    <th width="20%"
                                        class="text-center">@lang('sales_order.payment.summary.table.item.header.total_price')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, itemIndex) in so.items">
                                    <td class="valign-middle">@{{ item.product.name }}</td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="quantity[]"
                                               v-model="item.quantity"  readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" readonly
                                               v-bind:value="item.selected_unit.unit.name + ' (' + item.selected_unit.unit.symbol + ')'">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control text-right" name="price[]"
                                               v-model="item.price" readonly >
                                    </td>
                                    <td class="text-center">
                                    </td>
                                    <td class="text-right valign-middle">
                                        @{{ numbro(item.selected_unit.conversion_value * item.quantity * item.price).format() }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="itemsTotalListTable" class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td width="80%"
                                        class="text-right">@lang('sales_order.payment.summary.table.total.body.total')</td>
                                    <td width="20%" class="text-right">
                                        <span class="control-label-normal">@{{ numbro(grandTotal()).format() }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('purchase_order.create.box.discount_per_item')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="discountsListTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="30%">@lang('purchase_order.create.table.item.header.product_name')</th>
                                    <th width="30%">@lang('purchase_order.create.table.item.header.total_price')</th>
                                    <th width="40%" class="text-left" colspan="3">@lang('purchase_order.create.table.item.header.total_price')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(item, itemIndex) in so.items">
                                    <tr>
                                        <td width="30%">@{{ item.product.name }}</td>
                                        <td width="30%">@{{ numbro(item.selected_unit.conversion_value * item.quantity * item.price).format() }}</td>
                                        <td colspan="3" width="40%"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" width="65%"></td>
                                            <th width="10%" class="small-header">@lang('purchase_order.create.table.item.header.discount_percent')</th>
                                            <th width="25%" class="small-header">@lang('purchase_order.create.table.item.header.discount_nominal')</th>
                                    </tr>
                                    <tr v-for="(discount, discountIndex) in item.discounts">
                                        <td colspan="2" width="60%"></td>
                                        <td class="text-center valign-middle" width="5%">
                                        </td>
                                        <td width="10%">
                                            <input type="text" class="form-control text-right" v-bind:name="'item_disc_percent['+itemIndex+'][]'" v-model="discount.disc_percent" placeholder="%" v-on:keyup="discountPercentToNominal(item, discount)" readonly/>
                                        </td>
                                        <td width="25%">
                                            <input type="text" class="form-control text-right" v-bind:name="'item_disc_value['+itemIndex+'][]'" v-model="discount.disc_value" placeholder="Nominal" v-on:keyup="discountNominalToPercent(item, discount)" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="3">@lang('purchase_order.create.table.total.body.sub_total_discount')</td>
                                        <td class="text-right" colspan="2"> @{{ numbro(discountItemSubTotal(item.discounts)).format() }}</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td width="65%"
                                    class="text-right">@lang('purchase_order.create.table.total.body.total_discount')</td>
                                <td width="35%" class="text-right">
                                    <span class="control-label-normal">@{{ numbro(discountTotal()).format() }}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><h3 class="box-title">@lang('purchase_order.create.box.discount_transaction')</h3></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="discountsListTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="30%" class="text-right">@lang('purchase_order.create.table.total.body.total')</th>
                                    <th width="30%" class="text-left">@lang('purchase_order.create.table.total.body.invoice_discount')</th>
                                    <th width="40%" class="text-right">@lang('purchase_order.create.table.total.body.total_transaction')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-right valign-middle">@{{ numbro( ( grandTotal() - discountTotal() ) + expenseTotal() ).format() }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" class="form-control text-right" name="disc_percent" v-model="so.disc_percent" readonly />
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control text-right" name="disc_value" v-model="so.disc_value" readonly />
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right valign-middle">@{{ numbro( ( grandTotal() - discountTotal() ) + expenseTotal() - so.disc_value ).format()}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('purchase_order.payment.summary.box.expenses')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="expensesListTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="22%">@lang('purchase_order.payment.summary.table.expense.header.name')</th>
                                    <th width="22%"
                                        class="text-center">@lang('purchase_order.payment.summary.table.expense.header.type')</th>
                                    <th width="22%"
                                        class="text-center">@lang('purchase_order.payment.summary.table.expense.header.amount')</th>
                                    <th width="22%"
                                        class="text-center">@lang('purchase_order.payment.summary.table.expense.header.remarks')</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(expense, expenseIndex) in so.expenses">
                                    <td>
                                        <input name="expense_name[]" type="text" class="form-control" v-model="expense.name" readonly />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" v-bind:value="expense.type.description" readonly />
                                    </td>
                                    <td>
                                        <input name="expense_amount[]" type="text" class="form-control text-right" v-model="expense.amount" readonly/>
                                    </td>
                                    <td>
                                        <input name="expense_remarks[]" type="text" class="form-control" v-model="expense.remarks" readonly />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="expensesTotalListTable" class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td width="80%"
                                        class="text-right">@lang('purchase_order.create.table.total.body.total')</td>
                                    <td width="20%" class="text-right">
                                        <span class="control-label-normal">@{{ numbro(expenseTotal()).format() }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
            </div>
            <div class="box-body">
                @for ($i = 0; $i < 40; $i++)
                    <br/>
                @endfor
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('sales_order.payment.summary.box.remarks')</h3>
            </div>
            <div class="box-body">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#tab_remarks" aria-controls="tab_remarks" role="tab" data-toggle="tab">@lang('sales_order.revise.tab.remarks')</a>
                        </li>
                        <li role="presentation">
                            <a href="#tab_internal" aria-controls="tab_internal" role="tab" data-toggle="tab">@lang('sales_order.revise.tab.internal')</a>
                        </li>
                        <li role="presentation">
                            <a href="#tab_private" aria-controls="tab_private" role="tab" data-toggle="tab">@lang('sales_order.revise.tab.private')</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="tab_remarks">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputRemarks" name="remarks" class="form-control" rows="5" readonly>{{ $currentSo->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab_internal">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputInternalRemarks" name="internal_remarks" class="form-control" rows="5" readonly>{{ $currentSo->internal_remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab_private">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputPrivateRemarks" name="private_remarks" class="form-control" rows="5" readonly>{{ $currentSo->private_remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('sales_order.payment.summary.box.payment_history')</h3>
            </div>
            @if(count($currentSo->cashPayments()) > 0)
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="cashPaymentHistoryTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="text-center">@lang('sales_order.payment.summary.table.payments.header.cash')</th>
                                    </tr>
                                    <tr>
                                        <th width="25%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.payment_date')</th>
                                        <th width="25%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.payment_status')</th>
                                        <th width="25%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.payment_amount')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currentSo->cashPayments() as $key => $payment)
                                        <tr>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($payment->payment_date)) }}</td>
                                            <td class="text-center">{{ $paymentStatusDDL[$payment->status] }}</td>
                                            <td class="text-right">{{ number_format($payment->total_amount, Auth::user()->store->decimal_digit, Auth::user()->store->decimal_separator, Auth::user()->store->thousand_separator) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            @if(count($currentSo->transferPayments()) > 0)
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="transferPaymentHistoryTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th colspan="6" class="text-center">@lang('sales_order.payment.summary.table.payments.header.transfer')</th>
                                    </tr>
                                    <tr>
                                        <th width="10%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.payment_date')</th>
                                        <th width="10%" class="text-center">@lang('sales_order.payment.summary.table.payments.header.effective_date')</th>
                                        <th width="20%" class="text-center">@lang('sales_order.payment.summary.table.payments.header.account_from')</th>
                                        <th width="20%" class="text-center">@lang('sales_order.payment.summary.table.payments.header.account_to')</th>
                                        <th width="20%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.payment_status')</th>
                                        <th width="20%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.payment_amount')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currentSo->transferPayments() as $key => $payment)
                                        <tr>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($payment->payment_date)) }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($payment->payment_detail->effective_date)) }}</td>
                                            <td class="text-center">{{ empty($payment->payment_detail->bankAccountFrom) ? '-'
                                                                               : $payment->payment_detail->bankAccountFrom->bank->short_name
                                                                               . ' - ' . $payment->payment_detail->bankAccountFrom->account_number }}</td>
                                            <td class="text-center">{{ empty($payment->payment_detail->bankAccountTo) ? '-'
                                                                               : $payment->payment_detail->bankAccountTo->bank->short_name
                                                                               . ' - ' . $payment->payment_detail->bankAccountTo->account_number }}</td>
                                            <td class="text-center">{{ $paymentStatusDDL[$payment->status] }}</td>
                                            <td class="text-right">{{ number_format($payment->total_amount, Auth::user()->store->decimal_digit, Auth::user()->store->decimal_separator, Auth::user()->store->thousand_separator) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            @if(count($currentSo->giroPayments()) > 0)
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="giroPaymentHistoryTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th colspan="7"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.giro')</th>
                                    </tr>
                                    <tr>
                                        <th width="15%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.payment_date')</th>
                                        <th width="15%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.effective_date')</th>
                                        <th width="15%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.bank')</th>
                                        <th width="15%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.serial_number')</th>
                                        <th width="15%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.printed_name')</th>
                                        <th width="10%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.payment_status')</th>
                                        <th width="15%"
                                            class="text-center">@lang('sales_order.payment.summary.table.payments.header.payment_amount')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($currentSo->giroPayments() as $key => $payment)
                                        <tr>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($payment->payment_date)) }}</td>
                                            <td class="text-center">{{ date('d-m-Y', strtotime($payment->payment_detail->giro->effective_date)) }}</td>
                                            <td class="text-center">{{ $payment->payment_detail->giro->bank->name }}</td>
                                            <td class="text-center">{{ $payment->payment_detail->giro->serial_number }}</td>
                                            <td class="text-center">{{ $payment->payment_detail->giro->printed_name }}</td>
                                            <td class="text-center">{{ $paymentStatusDDL[$payment->status] }}</td>
                                            <td class="text-right">{{ number_format($payment->total_amount, Auth::user()->store->decimal_digit, Auth::user()->store->decimal_separator, Auth::user()->store->thousand_separator) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="paymentSummaryTable" class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-right">@lang('sales_order.payment.summary.table.total.body.paid_amount')</td>
                                    <td width="25%" class="text-right">
                                        <span class="control-label-normal">{{ number_format($currentSo->totalAmountPaid(), Auth::user()->store->decimal_digit, Auth::user()->store->decimal_separator, Auth::user()->store->thousand_separator) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">@lang('sales_order.payment.summary.table.total.body.to_be_paid_amount')</td>
                                    <td width="25%" class="text-right">
                                        <span class="control-label-normal">
                                            {{ number_format($currentSo->totalAmount() - $currentSo->totalAmountPaid(), Auth::user()->store->decimal_digit, Auth::user()->store->decimal_separator, Auth::user()->store->thousand_separator) }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>