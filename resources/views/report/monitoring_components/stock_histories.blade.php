<div class="row">
    <div class="col-md-3">&nbsp;</div>
    <div class="col-md-9">
        <div class="text-right">
            <a id="btnPreview" href="{{ route('db.report.monitoring.stocks.download') }}" class="btn btn-xs btn-default">@lang('buttons.print_preview_button')</a>
            <a id="btnPreviewXLS" href="{{ route('db.report.monitoring.stocks.download') }}?f=xls" class="btn btn-xs btn-default">@lang('buttons.download_excel_button')</a>
            <a id="btnPreviewPDF" href="{{ route('db.report.monitoring.stocks.download') }}?f=pdf" class="btn btn-xs btn-default">@lang('buttons.download_pdf_button')</a>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-12">
        <div class="text-center" v-if="stock_histories.error" id="tab_mon_1_error_msg">
            <p><span>@lang('stock_history.error_data')</span><br/>
                <a class="btn btn-primary text-center" v-on:click="fetchStockHistories()"><span class="glyphicon glyphicon-refresh"></span> @lang('stock_history.try_to_reload')</a>
            </p>
        </div>
        <table class="table table-bordered" v-if="!stock_histories.error">
            <tbody>
                <template v-for="(prodtype, prodtypeIndex) in stock_histories.data">
                    <tr class="accordion-toggle" v-on:click="toggle('#row', prodtype.id)">
                        <td width="5%" class="text-center valign-middle"><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                        <td width="95%" class="text-left">@{{ prodtype.name }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="hiddenRow" style="padding-left: 15px; padding-top: 15px;">
                            <div class="accordian-body collapse" v-bind:id="'row'+prodtype.id ">
                                <strong>@lang('stock_history.stock_history')</strong> <br/>
                                <p v-if="!prodtype.stocks.length ">@lang('stock_history.theres_no_data')</p>
                                <template v-if=" prodtype.stocks.length " v-for="(stock, stockIndex) in prodtype.stocks">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>&nbsp;</th>
                                                <th class="text-center">@lang('stock_history.table.header.code')</th>
                                                <th class="text-center">@lang('stock_history.table.header.name')</th>
                                                <th class="text-center">@lang('stock_history.table.header.short_code')</th>
                                                <th class="text-center">@lang('stock_history.table.header.description')</th>
                                                <th class="text-center">@lang('stock_history.table.header.qty')</th>
                                                <th class="text-center">@lang('stock_history.table.header.current_qty')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-on:click="toggle('#rowstock', stock.id)" >
                                                <td width="5%" class="valign-middle text-center"><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></td>
                                                <td width="10%">@{{ stock.purchase_order.code }}</td>
                                                <td width="15%">@{{ stock.product.name }}</td>
                                                <td width="10%" class="text-center">@{{ stock.product.short_code }}</td>
                                                <td width="20%">@{{ stock.product.description }}</td>
                                                <td width="12%">@{{ formatDecimal(stock.quantity) }}</td>
                                                <td width="13%">@{{ formatDecimal(stock.current_quantity) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="8" class="hiddenRow" style="padding-left: 15px; padding-top: 15px;">
                                                    <div class="accordian-body collapse" v-bind:id="'rowstock'+ stock.id">
                                                        <strong>@lang('stock_history.sales_history')</strong> <br/>
                                                        <p v-if="!stock.so_items.length">@lang('stock_history.theres_no_data')</p>
                                                        <table v-if="stock.so_items.length" class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th class="text-center">@lang('stock_history.table.header.date')</th>
                                                                <th class="text-center">@lang('stock_history.table.header.so_code')</th>
                                                                <th class="text-center">@lang('stock_history.table.header.customer')</th>
                                                                <th class="text-center">@lang('stock_history.table.header.qty')</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(so_item, soItemIndex) in stock.so_items">
                                                                    <td width="30%" class="text-center">@{{ so_item.itemable.so_created }}</td>
                                                                    <td width="25%">@{{ so_item.itemable.code }}</td>
                                                                    <td width="25%">@{{ so_item.itemable.customer_type == 'CUSTOMERTYPE.R' ? so_item.itemable.customer.name : so_item.itemable.walk_in_cust }}</td>
                                                                    <td width="20%">@{{ formatDecimal(so_item.quantity) }} @{{ so_item.selected_unit.unit.name }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </template>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>