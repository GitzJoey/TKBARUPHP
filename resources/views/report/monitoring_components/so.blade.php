<div class="row">
  <div class="col-xs-6 col-xs-offset-6 col-sm-4 col-sm-offset-8">
    <div class="form-group">
      <div class="input-group">
          <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
          </div>
          <vue-datetimepicker v-model="saleOrderDateFilter" format="YYYY-MM-DD"></vue-datetimepicker>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="text-center" width="17%">@lang('sales_order.revise.index.table.header.code')</th>
            <th class="text-center" width="17%">@lang('sales_order.revise.index.table.header.so_date')</th>
            <th class="text-center" width="27%">@lang('sales_order.revise.index.table.header.customer')</th>
            <th class="text-center" width="17%">@lang('sales_order.revise.index.table.header.shipping_date')</th>
            <th class="text-center" width="22%">@lang('sales_order.revise.index.table.header.status')</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="saleOrder in saleOrders">
            <td class="text-center">@{{ saleOrder.code }}</td>
            <td class="text-center">@{{ saleOrder.soCreatedDate }}</td>
            <td class="text-center">@{{ saleOrder.customerType == 'CUSTOMERTYPE.R' ? saleOrder.customer.name : saleOrder.walkInCustomer }}</td>
            <td class="text-center">@{{ saleOrder.shippingDate }}</td>
            <td class="text-center">@{{ lookup[saleOrder.status] }}</td>
          </tr>
          <tr v-if="!saleOrders.length">
              <td class="text-center" colspan="5">@lang('labels.DATA_NOT_FOUND')</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
