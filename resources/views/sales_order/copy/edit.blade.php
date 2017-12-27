@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.copy.edit.title')
@endsection

@section('page_title')
    <span class="fa fa-copy fa-fw"></span>&nbsp;@lang('sales_order.copy.edit.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.copy.edit.page_title_desc')
@endsection

@section('breadcrumbs')
@endsection

@section('content')
    <div id="soCopyVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="soCopyForm" class="form-horizontal" @submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.copy.edit.box.customer')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputCustomerType"
                                       class="col-sm-2 control-label">@lang('sales_order.copy.edit.field.customer_type')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly
                                           value="@lang('lookup.'.$currentSOCopy->customer_type)">
                                </div>
                            </div>
                            @if($currentSOCopy->customer_type == 'CUSTOMERTYPE.R')
                                <div class="form-group">
                                    <label for="inputCustomerId"
                                           class="col-sm-2 control-label">@lang('sales_order.copy.edit.field.customer_name')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $currentSOCopy->customer->name }}">
                                    </div>
                                    <div class="col-sm-1">
                                        <button id="customerDetailButton" type="button"
                                                class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#customerDetailModal_0"><span
                                                    class="fa fa-info-circle fa-lg"></span></button>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="inputCustomerName"
                                           class="col-sm-4 control-label">@lang('sales_order.copy.edit.field.customer_name')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly value="{{ $currentSOCopy->walk_in_cust }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputCustomerDetails" class="col-sm-4 control-label">@lang('sales_order.copy.edit.field.customer_details')</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="5" readonly>{{ $currentSOCopy->walk_in_cust_detail }}</textarea>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.copy.edit.box.sales_order_detail')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSoCode"
                                       class="col-sm-3 control-label">@lang('sales_order.copy.edit.field.so_code')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $currentSOCopy->main_so_code }}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSoCopyCode" class="col-sm-3 control-label">@lang('sales_order.copy.edit.field.so_copy_code')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="code" value="{{ $currentSOCopy->code }}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSoType"
                                       class="col-sm-3 control-label">@lang('sales_order.copy.edit.field.so_type')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="@lang('lookup.'.$currentSOCopy->so_type)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSoDate"
                                       class="col-sm-3 control-label">@lang('sales_order.copy.edit.field.so_date')</label>
                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputSoDate" name="so_created" value="" v-model="so.so_created" format="DD-MM-YYYY hh:mm A" readonly="true"></vue-datetimepicker>
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
                            <h3 class="box-title">@lang('sales_order.copy.edit.box.shipping')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputShippingDate"
                                       class="col-sm-2 control-label">@lang('sales_order.copy.edit.field.shipping_date')</label>
                                <div class="col-sm-5">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputShippingDate" name="shipping_date" value="" v-model="so.shipping_date" format="DD-MM-YYYY hh:mm A" readonly="true"></vue-datetimepicker>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarehouse"
                                       class="col-sm-2 control-label">@lang('sales_order.copy.edit.field.warehouse')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly
                                           value="{{ $currentSOCopy->warehouse->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking"
                                       class="col-sm-2 control-label">@lang('sales_order.copy.edit.field.vendor_trucking')</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" readonly
                                           value="{{ empty($currentSOCopy->vendorTrucking->name) ? '':$currentSOCopy->vendorTrucking->name }}">
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
                            <h3 class="box-title">@lang('sales_order.copy.edit.box.transactions')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-11">
                                    <select id="inputProduct"
                                            class="form-control"
                                            v-model="so.product">
                                        <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                        <option v-for="product in productDDL" v-bind:value="product">@{{ product.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-primary btn-md" v-on:click="insertProduct(so.product)"><span class="fa fa-plus"/>
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30%">@lang('sales_order.copy.edit.table.item.header.product_name')</th>
                                                <th width="15%">@lang('sales_order.copy.edit.table.item.header.quantity')</th>
                                                <th width="15%"
                                                    class="text-right">@lang('sales_order.copy.edit.table.item.header.unit')</th>
                                                <th width="15%"
                                                    class="text-right">@lang('sales_order.copy.edit.table.item.header.price_unit')</th>
                                                <th width="5%">&nbsp;</th>
                                                <th width="20%"
                                                    class="text-right">@lang('sales_order.copy.edit.table.item.header.total_price')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, itemIndex) in so.items">
                                                <input type="hidden" name="item_id[]" v-bind:value="item.id">
                                                <input type="hidden" name="product_id[]" v-bind:value="item.product.id">
                                                <input type="hidden" name="base_unit_id[]"
                                                       v-bind:value="item.base_unit.unit.id">
                                                <td class="valign-middle">@{{ item.product.name }}</td>
                                                <td v-bind:class="{ 'has-error':errors.has('qty_' + itemIndex) }">
                                                    <input type="text" class="form-control text-right" name="quantity[]"
                                                           v-model="item.quantity" v-validate="'required|numeric:2'" v-bind:data-vv-name="'qty_' + itemIndex" v-bind:data-vv-as="'{{ trans('sales_order.copy.edit.table.item.header.quantity') }} ' + (itemIndex + 1)">
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('unit_' + itemIndex) }">
                                                    <input type="hidden"  v-bind:value="item.selected_unit.unit.id">
                                                    <select name="selected_unit_id[]"
                                                            class="form-control"
                                                            v-model="item.selected_unit.id"
                                                            v-validate="'required'"
                                                            v-bind:data-vv-name="'unit_' + itemIndex"
                                                            v-bind:data-vv-as="'{{ trans('sales_order.copy.create.table.item.header.unit') }} ' + (itemIndex + 1)">
                                                        <option v-bind:value="defaultProductUnit.id">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="product_unit in item.product.product_units" v-bind:value="product_unit.id">@{{ product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' }}</option>
                                                    </select>
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('price_' + itemIndex) }">
                                                    <input type="text" class="form-control text-right" name="price[]"
                                                           v-model="item.price" v-validate="'required|numeric:2'" v-bind:data-vv-name="'price_' + itemIndex" v-bind:data-vv-as="'{{ trans('sales_order.copy.edit.table.item.header.price_unit') }} ' + (itemIndex + 1)">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-md"
                                                            v-on:click="removeItem(itemIndex)"><span
                                                                class="fa fa-minus"></span>
                                                    </button>
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
                                                class="text-right">@lang('sales_order.copy.edit.table.total.body.total')</td>
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
                            <h3 class="box-title">@lang('sales_order.edit.box.transaction_summary')</h3>
                        </div>
                        <div class="box-body">
                            @for ($i = 0; $i < 23; $i++)
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
                            <h3 class="box-title">@lang('sales_order.copy.edit.box.remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputRemarks" class="form-control" rows="5"
                                                      readonly>{{ $currentSOCopy->main_so_remarks }}</textarea>
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
                            <h3 class="box-title">@lang('sales_order.copy.edit.box.so_copy_remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputSoCopyRemarks" name="remarks" class="form-control"
                                                      rows="5">{{ $currentSOCopy->remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 col-offset-md-5">
                    <div class="btn-toolbar">
                        <button id="submitButton" type="submit" class="btn btn-primary pull-right">
                            @lang('buttons.submit_button')</button>
                        &nbsp;&nbsp;&nbsp;
                        <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">
                            @lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                        <a id="cancelButton" href="{{ route('db.so.copy.index', $soCode) }}"
                           class="btn btn-primary pull-right" role="button">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        </form>

        @include('sales_order.customer_details_partial')
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var soCopyApp = new Vue({
            el: '#soCopyVue',
            data: {
                currentSo: JSON.parse('{!! htmlspecialchars_decode($currentSOCopy->toJson()) !!}'),
                productDDL: JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}'),
                so: {
                    so_created: '',
                    product: {id: ''},
                    customer: { },
                    items: [],
                },
                soIndex: 0
            },
            mounted: function() {
                var vm = this;

                vm.so.customer = _.cloneDeep(vm.currentSo.customer);
                vm.so.so_created = vm.currentSo.so_created;

                for (var i = 0; i < vm.currentSo.items.length; i++) {
                    vm.so.items.push({
                        id: vm.currentSo.items[i].id,
                        product: _.cloneDeep(vm.currentSo.items[i].product),
                        base_unit: _.cloneDeep(_.find(vm.currentSo.items[i].product.product_units, function(unit) { return unit.is_base == 1; })),
                        selected_unit: _.cloneDeep(_.find(vm.currentSo.items[i].product.product_units, function(punit) { return punit.id == vm.currentSo.items[i].selected_unit_id; })),
                        quantity: vm.currentSo.items[i].quantity % 1 != 0 ? parseFloat(vm.currentSo.items[i].quantity).toFixed(1) : parseFloat(vm.currentSo.items[i].quantity).toFixed(0),
                        price: parseFloat(vm.currentSo.items[i].price).toFixed(0)
                    });
                }
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.so.copy.edit', [$soCode, $currentSOCopy->hId()]) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#soCopyForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.so.copy.index', $soCode) }}';
                        }).catch(function(e) {
                            $('#loader-container').fadeOut('fast');
                            if (e.response.data.errors != undefined && Object.keys(e.response.data.errors).length > 0) {
                                for (var key in e.response.data.errors) {
                                    for (var i = 0; i < e.response.data.errors[key].length; i++) {
                                        vm.$validator.errors.add('', e.response.data.errors[key][i], 'server', '__global__');
                                    }
                                }
                            } else {
                                vm.$validator.errors.add('', e.response.status + ' ' + e.response.statusText, 'server', '__global__');
                                if (e.response.data.message != undefined) { console.log(e.response.data.message); }
                            }
                        });
                    });
                },
                grandTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.so.items, function (item, key) {
                        result += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });
                    return result;
                },
                insertProduct: function (product) {
                    if(product.id != ''){
                        this.so.items.push({
                            product: _.cloneDeep(product),
                            selected_unit: {
                                id: '',
                                unit: {
                                    id: ''
                                },
                                conversion_value: 1
                            },
                            base_unit: _.cloneDeep(_.find(product.product_units, isBase)),
                            quantity: 0,
                            price: 0
                        });
                    }
                },
                removeItem: function (index) {
                    this.so.items.splice(index, 1);
                }
            },
            computed: {
                defaultProductUnit: function() {
                    return {
                        id: ''
                    };
                },
                defaultProductUnit: function() {
                    return {
                        id: '',
                        unit: {
                            id: ''
                        },
                        conversion_value: 1
                    };
                }
            }
        });
    </script>
@endsection