<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center" width="17%">@lang('report.monitoring.components.po.table.header.code')</th>
                        <th class="text-center" width="17%">@lang('report.monitoring.components.po.table.header.po_date')</th>
                        <th class="text-center" width="27%">@lang('report.monitoring.components.po.table.header.supplier')</th>
                        <th class="text-center" width="17%">@lang('report.monitoring.components.po.table.header.shipping_date')</th>
                        <th class="text-center" width="22%">@lang('report.monitoring.components.po.table.header.status')</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(purchaseOrder, index) in purchaseOrders">
                        <tr>
                            <td class="text-center">@{{ purchaseOrder.code }}</td>
                            <td class="text-center">@{{ purchaseOrder.poCreatedDate }}</td>
                            <td class="text-center">@{{ purchaseOrder.supplierType == 'SUPPLIERTYPE.R' ? purchaseOrder.supplier.name : purchaseOrder.walkInSupplier }}</td>
                            <td class="text-center">@{{ purchaseOrder.shippingDate }}</td>
                            <td class="text-center">
                                @{{ lookup[purchaseOrder.status] }}
                                &nbsp;
                                <span v-if="purchaseOrder.receipts.length" class="btn btn-xs btn-default" data-toggle="collapse" :data-target="'#receipts_' + index" aria-expanded="false" :aria-controls="'#receipts_' + index">
                                    <i class="fa fa-chevron-down"></i>
                                </span>
                            </td>
                        </tr>
                        <tr :id="'receipts_' + index" v-if="purchaseOrder.receipts.length" class="collapse">
                            <td colspan="5" class="table-responsive">
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="40%" class="text-center">@lang('report.monitoring.components.po.table.item.header.product_name')</th>
                                            <th width="15%" class="text-center">@lang('report.monitoring.components.po.table.item.header.unit')</th>
                                            <th width="15%" class="text-center">@lang('report.monitoring.components.po.table.item.header.brutto')</th>
                                            <th width="15%" class="text-center">@lang('report.monitoring.components.po.table.item.header.netto')</th>
                                            <th width="15%" class="text-center">@lang('report.monitoring.components.po.table.item.header.tare')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="receipt in purchaseOrder.receipts">
                                            <td>@{{ receipt.item.product.name }}</td>
                                            <td>@{{ receipt.item.selectedUnit.unit.name }} (@{{ receipt.item.selectedUnit.unit.symbol }})</td>
                                            <td>@{{ receipt.brutto }}</td>
                                            <td>@{{ receipt.netto }}</td>
                                            <td>@{{ receipt.tare }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </template>
                    <tr v-if="!purchaseOrders.length">
                        <td class="text-center" colspan="5">@lang('labels.DATA_NOT_FOUND')</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
