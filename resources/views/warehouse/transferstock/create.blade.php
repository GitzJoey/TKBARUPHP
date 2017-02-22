@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.transfer_stock.create.title')
@endsection

@section('page_title')
    <span class="fa fa-refresh fa-fw"></span>&nbsp;@lang('warehouse.transfer_stock.create.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.transfer_stock.create.page_title_desc')
@endsection

@section('breadcrumbs')
@endsection

@section('content')
<div id="tsVue">
  <div class="row">
    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
        </div>
        <form class="form-horizontal" action="" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="inputsource_Warehouse" class="col-sm-5 control-label">@lang('warehouse.transfer_stock.create.label.source_warehouse')</label>
              <div class="col-sm-7">
                <input type="hidden" name="source_warehouse_id" v-bind:value="ts.source_warehouse.id" >
                <select id="inputsource_Warehouse" data-parsley-required="true"
                        class="form-control"
                        v-model="ts.source_warehouse">
                  <option v-bind:value="defaultWarehouse">@lang('labels.PLEASE_SELECT')</option>
                  <option v-for="source_warehouse of warehouseDDL" v-bind:value="source_warehouse">@{{ source_warehouse.name }}</option>
                </select>
              </div>
            </div>
            <template v-if="ts.source_warehouse.id != ''">
              <div class="form-group">
                <label  for="inputdestination_warehouse" class="col-sm-5 control-label">Destination Warehouse</label>
                <div class="col-sm-7">
                  <input type="hidden" name="destination_warehouse_id" v-bind:value="ts.destination_warehouse.id" >
                  <select id="inputdestination_warehouse" data-parsley-required="true"
                          class="form-control"
                          v-model="ts.destination_warehouse">
                    <option v-if="destination_warehouse.id != ts.source_warehouse.id" v-for="destination_warehouse of warehouseDDL" v-bind:value="destination_warehouse">@{{ destination_warehouse.name }}</option>
                  </select>
                </div>
              </div>
            </template>
          </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Transaction</h3>
        </div>
        <form class="form-horizontal" action="" method="post">
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="col-sm-10">
                    <select class="form-control" name="customer_id[]" id="'customerSelect">
                    </select>
                  </div>
                  <div class="col-sm-1">
                    <button type="button" class="btn btn-primary btn-md"
                            v-on:click="insertItem(po.product)"><span class="fa fa-plus"/>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-12">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center" width="20%">PO Code</th>
                      <th class="text-center" width="20%">Product</th>
                      <th class="text-center" width="20%">Opname Date</th>
                      <th class="text-center" width="20%">Current Quantity</th>
                      <th class="text-center" width="10%">@lang('labels.ACTION')</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="box-footer"></div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('custom_js')
  <script type="application/javascript">
    $(document).ready(function() {
      var tsApp = new Vue({
          el: '#tsVue',
          data: {
            warehouseDDL: JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}'),
            ts: {
              source_warehouse: {
                id: ''
              },
              destination_warehouse: {
                id: ''
              },
            }
          },
          methods: {

          },
          computed: {
            defaultWarehouse: function(){
              return {
                id: ''
              };
            },
          },
          updated: function(){
            var vm = this;
            $("#customerSelect").select2();
          }
      });
    });
  </script>
@endsection
