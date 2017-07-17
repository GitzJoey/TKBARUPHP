@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.copy.create.title')
@endsection

@section('page_title')
    <span class="fa fa-copy fa-rotate-180 fa-fw"></span>&nbsp;@lang('purchase_order.copy.create.page_title')
@endsection

@section('page_title_desc')
    @lang('purchase_order.copy.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('purchase_order_copy_create', $poToBeCopied->hId()) !!}
@endsection

@section('content')
    <div id="poCopyVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="poCopyForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.copy.create.box.supplier')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSupplierType"
                                       class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_type')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly
                                           value="@lang('lookup.'.$poToBeCopied->supplier_type)">
                                </div>
                            </div>
                            @if($poToBeCopied->supplier_type == 'SUPPLIERTYPE.R')
                                <div class="form-group">
                                    <label for="inputSupplierId"
                                           class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_name')</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $poToBeCopied->supplier->name }}">
                                    </div>
                                    <div class="col-sm-2">
                                        <button id="supplierDetailButton" type="button" class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#supplierDetailModal"><span
                                                    class="fa fa-info-circle fa-lg"></span></button>
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="inputSupplierName"
                                           class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_name')</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" readonly
                                               value="{{ $poToBeCopied->walk_in_supplier }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSupplierDetails"
                                           class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.supplier_details')</label>
                                    <div class="col-sm-10">
                                                <textarea class="form-control" rows="5" readonly>{{ $poToBeCopied->walk_in_supplier_detail }}
                                                </textarea>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.copy.create.box.purchase_order_detail')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPoCode"
                                       class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_code')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly value="{{ $poToBeCopied->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoCopyCode"
                                       class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_copy_code')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly name="code" value="{{ $poCopyCode }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoType"
                                       class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_type')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly
                                           value="@lang('lookup.'.$poToBeCopied->po_type)">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPoDate"
                                       class="col-sm-3 control-label">@lang('purchase_order.copy.create.field.po_date')</label>
                                <div class="col-sm-9">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputPoDate" name="createdDate" value="" v-model="po.po_created" v-validate="'required'" format="DD-MM-YYYY hh:mm A" readonly="true"></vue-datetimepicker>
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
                            <h3 class="box-title">@lang('purchase_order.copy.create.box.shipping')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputShippingDate"
                                       class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.shipping_date')</label>
                                <div class="col-sm-5">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputShippingDate" name="shipping_date" value="{{ $poToBeCopied->shipping_date->format('d-m-Y') }}" v-model="po.shipping_date" v-validate="'required'" format="DD-MM-YYYY hh:mm A" readonly="true"></vue-datetimepicker>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputWarehouse"
                                       class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.warehouse')</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" readonly
                                           value="{{ $poToBeCopied->warehouse->name }}">
                                    <input type="hidden" name="warehouse_id" value="{{ $poToBeCopied->warehouse->id }}">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="inputVendorTrucking"
                                       class="col-sm-2 control-label">@lang('purchase_order.copy.create.field.vendor_trucking')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly
                                           value="{{ empty($poToBeCopied->vendorTrucking->name) ? '':$poToBeCopied->vendorTrucking->name }}">
                                    <input type="hidden" name="vendor_trucking_id"
                                           value="{{ empty($poToBeCopied->vendorTrucking->id) ? '':$poToBeCopied->vendorTrucking->id }}">
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
                            <h3 class="box-title">@lang('purchase_order.copy.create.box.transactions')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-11">
                                    <select id="inputProduct"
                                            class="form-control"
                                            v-model="po.product">
                                        <option v-bind:value="{id: ''}">@lang('labels.PLEASE_SELECT')</option>
                                        @if($poToBeCopied->supplier_type == 'SUPPLIERTYPE.R')
                                            <option v-for="product in po.supplier.products" v-bind:value="product">@{{ product.name }}</option>
                                        @else
                                            <option v-for="product in productDDL" v-bind:value="product">@{{ product.name }}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-primary btn-md"
                                            v-on:click="insertItem(po.product)"><span class="fa fa-plus"/></button>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="30%">@lang('purchase_order.copy.create.table.item.header.product_name')</th>
                                                <th width="15%"
                                                    class="text-center">@lang('purchase_order.copy.create.table.item.header.quantity')</th>
                                                <th width="15%"
                                                    class="text-center">@lang('purchase_order.copy.create.table.item.header.unit')</th>
                                                <th width="15%"
                                                    class="text-center">@lang('purchase_order.copy.create.table.item.header.price_unit')</th>
                                                <th width="5%">&nbsp;</th>
                                                <th width="20%"
                                                    class="text-center">@lang('purchase_order.revise.table.item.header.total_price')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <template v-for="(item, itemIndex) in po.items">
                                                <tr>
                                                    <input type="hidden" name="product_id[]" v-bind:value="item.product.id">
                                                    <input type="hidden" name="base_unit_id[]" v-bind:value="item.base_unit.unit.id">
                                                    <td class="valign-middle">@{{ item.product.name }}</td>
                                                    <td>
                                                        <input type="text" class="form-control text-right" name="quantity[]" v-model="item.quantity">
                                                    </td>
                                                    <td>
                                                        <select class="form-control"
                                                                name="selected_unit_id[]"
                                                                v-validate="'required'"
                                                                data-vv-as="{{ trans('purchase_order.copy.create.table.item.header.unit') }}"
                                                                v-model="item.selected_unit.id">
                                                            <option v-bind:value="defaultProductUnit.id">@lang('labels.PLEASE_SELECT')</option>
                                                            <option v-for="product_unit in item.product.product_units" v-bind:value="product_unit.id">@{{ product_unit.unit.name + ' (' + product_unit.unit.symbol + ')' }}</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control text-right" name="price[]"
                                                               v-model="item.price" v-validate="'required|decimal:2'">
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-danger btn-md"
                                                                v-on:click="removeItem(itemIndex)"><span class="fa fa-minus"/>
                                                        </button>
                                                    </td>
                                                    <td class="text-right valign-middle">
                                                        @{{ numeral(item.selected_unit.conversion_value * item.quantity * item.price).format() }}
                                                    </td>
                                                </tr>
                                            </template>
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
                                                class="text-right">@lang('purchase_order.copy.create.table.total.body.total')</td>
                                            <td width="20%" class="text-right">
                                                <span class="control-label-normal">@{{ numeral(grandTotal()).format() }}</span>
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
                            <h3 class="box-title">@lang('purchase_order.copy.create.box.transaction_summary')</h3>
                        </div>
                        <div class="box-body">
                            @for ($i = 0; $i < 25; $i++)
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
                            <h3 class="box-title">@lang('purchase_order.copy.create.box.remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputPoRemarks" class="form-control" rows="5" readonly>{{ $poToBeCopied->remarks }}</textarea>
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
                            <h3 class="box-title">@lang('purchase_order.copy.create.box.po_copy_remarks')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <textarea id="inputPoCopyRemarks" name="remarks" class="form-control" rows="5"></textarea>
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
                        <button id="submitButton" type="submit"
                                class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>
                        &nbsp;&nbsp;&nbsp;
                        <a id="printButton" href="#" target="_blank"
                           class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>
                        <a id="cancelButton" href="{{ route('db.po.copy.index', $poCode) }}" class="btn btn-primary pull-right"
                           role="button">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        </form>

        @include('purchase_order.supplier_details_partial')
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        Vue.use(VeeValidate, { locale: '{!! LaravelLocalization::getCurrentLocale() !!}' });

        Vue.component('vue-icheck', {
            template: "<input v-bind:id='id' v-bind:name='name' type='checkbox' v-bind:disabled='disabled' v-model='value'>",
            props: ['id', 'name', 'disabled', 'value'],
            mounted: function() {
                $(this.$el).iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue'
                }).on('ifChecked', function(event) {
                    this.value = true;
                }).on('ifUnchecked', function(event) {
                    this.value = false;
                });

                if (this.value) { $(this.$el).iCheck('check'); }
                if (this.disabled == 'true') { $(this.$el).iCheck('disable'); }
            },
            destroyed: function() {
                $(this.$el).iCheck('destroy');
            }
        });

        Vue.component('vue-datetimepicker', {
            template: "<input type='text' v-bind:id='id' v-bind:name='name' class='form-control' v-bind:value='value' v-model='value' v-bind:format='format' v-bind:readonly='readonly'>",
            props: ['id', 'name', 'value', 'format', 'readonly'],
            mounted: function() {
                var vm = this;

                if (this.value == undefined) this.value = '';
                if (this.format == undefined) this.format = 'DD-MM-YYYY hh:mm A';
                if (this.readonly == undefined) this.readonly = 'false';

                $(this.$el).datetimepicker({
                    format: this.format,
                    defaultDate: this.value == '' ? moment():moment(this.value),
                    showTodayButton: true,
                    showClose: true
                }).on("dp.change", function(e) {
                    vm.$emit('input', this.value);
                });

                if (this.value == '') { vm.$emit('input', moment().format(this.format)); }
            },
            destroyed: function() {
                $(this.$el).data("DateTimePicker").destroy();
            }
        });

        var poApp = new Vue({
            el: '#poCopyVue',
            data: {
                currentPo: JSON.parse('{!! htmlspecialchars_decode($poToBeCopied->toJson()) !!}'),
                productDDL: JSON.parse('{!! htmlspecialchars_decode($productDDL) !!}'),
                po: {
                    supplier: '',
                    items: [],
                    product: {
                        id: ''
                    }
                }
            },
            mounted: function() {
                var vm = this;

                this.po.supplier = _.cloneDeep(this.currentPo.supplier);

                for (var i = 0; i < this.currentPo.items.length; i++) {
                    vm.po.items.push({
                        id: this.currentPo.items[i].id,
                        product: _.cloneDeep(this.currentPo.items[i].product),
                        base_unit: _.cloneDeep(_.find(this.currentPo.items[i].product.product_units, function(unit) { return unit.is_base == 1; })),
                        selected_unit: _.cloneDeep(_.find(this.currentPo.items[i].product.product_units, function(punit) { return punit.id == vm.currentPo.items[i].selected_unit_id; })),
                        quantity: parseFloat(this.currentPo.items[i].quantity).toFixed(0),
                        price: parseFloat(this.currentPo.items[i].price).toFixed(0)
                    });
                }
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.po.copy.create', $poCode) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#poCopyForm')[0]))
                            .then(function(response) {
                                window.location.href = '{{ route('db.po.copy.index', $poCode) }}';
                        }).catch(function(e) {
                            $('#loader-container').fadeOut('fast');
                            if (Object.keys(e.response.data).length > 0) {
                                for (var key in e.response.data) {
                                    for (var i = 0; i < e.response.data[key].length; i++) {
                                        vm.$validator.errorBag.add('', e.response.data[key][i], 'server', '__global__');
                                    }
                                }
                            } else {
                                vm.$validator.errorBag.add('', e.response.status + ' ' + e.response.statusText, 'server', '__global__');
                            }
                        });
                    });
                },
                grandTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.po.items, function (item, key) {
                        result += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });
                    return result;
                },
                insertItem: function (product) {
                    if(product.id != ''){
                        var vm = this;
                        vm.po.items.push({
                            id: null,
                            product: _.cloneDeep(product),
                            base_unit: _.cloneDeep(_.find(product.product_units, isBase)),
                            selected_unit: {
                                unit: {
                                    id: ''
                                },
                                conversion_value: 1
                            },
                            quantity: 0,
                            price: 0
                        });
                    }
                },
                removeItem: function (index) {
                    var vm = this;
                    vm.po.items.splice(index, 1);
                }
            },
            computed: {
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