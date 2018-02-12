<div class="row">
    <div class="col-xs-6 col-sm-4">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <vue-datetimepicker id="salesOrderDateFilter" v-model="salesOrderDateFilter" format="YYYY-MM-DD"></vue-datetimepicker>
            </div>
            <span v-show="loading" class="help-block"><i class="fa fa-spinner fa-spin fa-fw"></i></span>
        </div>
    </div>
    <div class="col-xs-6 col-sm 8">

    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center" width="17%">@lang('report.monitoring.components.so.table.header.code')</th>
                        <th class="text-center" width="17%">@lang('report.monitoring.components.so.table.header.so_date')</th>
                        <th class="text-center" width="27%">@lang('report.monitoring.components.so.table.header.customer')</th>
                        <th class="text-center" width="17%">@lang('report.monitoring.components.so.table.header.shipping_date')</th>
                        <th class="text-center" width="22%">@lang('report.monitoring.components.so.table.header.status')</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(salesOrder, index) in salesOrders">
                        <tr>
                            <td class="text-center">@{{ salesOrder.code }}</td>
                            <td class="text-center">@{{ salesOrder.soCreatedDate }}</td>
                            <td class="text-center">@{{ salesOrder.customerType == 'CUSTOMERTYPE.R' ? salesOrder.customer.name : salesOrder.walkInCustomer }}</td>
                            <td class="text-center">@{{ salesOrder.shippingDate }}</td>
                            <td class="text-center">
                                @{{ lookup[salesOrder.status] }}
                                &nbsp;
                                <span v-if="salesOrder.delivers.length" class="btn btn-xs btn-default" data-toggle="collapse" :data-target="'#delivers_' + index" aria-expanded="false" :aria-controls="'#delivers_' + index">
                                    <i class="fa fa-chevron-down"></i>
                                </span>
                            </td>            </tr>
                        <tr :id="'delivers_' + index" v-if="salesOrder.delivers.length" class="collapse">
                            <td colspan="5" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="40%" class="text-center">@lang('report.monitoring.components.so.table.item.header.product_name')</th>
                                            <th width="30%" class="text-center">@lang('report.monitoring.components.so.table.item.header.unit')</th>
                                            <th width="30%" class="text-center">@lang('report.monitoring.components.so.table.item.header.brutto')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="deliver in salesOrder.delivers">
                                            <td>@{{ deliver.item.product.name }}</td>
                                            <td>@{{ deliver.item.selectedUnit.unit.name }} (@{{ deliver.item.selectedUnit.unit.symbol }})</td>
                                            <td>@{{ deliver.brutto }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </template>
                    <tr v-if="!salesOrders.length">
                        <td class="text-center" colspan="5">@lang('labels.DATA_NOT_FOUND')</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
