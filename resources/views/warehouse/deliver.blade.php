@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.outflow.deliver.title')
@endsection

@section('page_title')
    <span class="fa fa-mail-reply fa-rotate-90 fa-fw"></span>&nbsp;@lang('warehouse.outflow.deliver.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.outflow.deliver.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('deliver', $so->hId()) !!}
@endsection

@section('content')
    <div id="deliverVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="deliverForm" class="form-horizontal" @submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.outflow.deliver.box.deliver')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputWarehouse" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.warehouse')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $so->warehouse->name }}">
                                    <input type="hidden" name="warehouse_id" value="{{ $so->warehouse->id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSOCode" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.so_code')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $so->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputShippingDate" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.shipping_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputShippingDate" name="shipping_date" v-model="SO.so_created" format="YYYY-MM-DD hh:mm A" readonly="true"></vue-datetimepicker>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDeliverDate" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.deliver_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputDeliverDate" name="deliver_date" v-model="deliver_date" v-validate="'required'" format="YYYY-MM-DD hh:mm A"></vue-datetimepicker>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.vendor_trucking')</label>
                                <div class="col-sm-8">
                                    @if (empty($so->vendorTrucking))
                                        <input type="text" class="form-control" readonly value="" >
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $so->vendorTrucking->name }}" >
                                    @endif
                                </div>
                            </div>
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('license_plate') }">
                                <label for="inputLicensePlate" class="col-sm-2 control-label">@lang('warehouse.outflow.deliver.field.license_plate')</label>
                                <div class="col-sm-8">
                                    <input type="text" id="inputLicensePlate" name="license_plate" class="form-control" v-validate="'required'" data-vv-as="{{ trans('warehouse.outflow.deliver.field.license_plate') }}">
                                    <span v-show="errors.has('license_plate')" class="help-block" v-cloak>@{{ errors.first('license_plate') }}</span>
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
                            <h3 class="box-title">@lang('warehouse.outflow.deliver.box.items')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="65%" class="text-center">@lang('warehouse.outflow.deliver.table.item.header.product_name')</th>
                                                <th width="15%" class="text-center">@lang('warehouse.outflow.deliver.table.item.header.unit')</th>
                                                <th width="15%" class="text-center">@lang('warehouse.outflow.deliver.table.item.header.brutto')</th>
                                                <th width="5%">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(deliver, deliverIdx) in outflow.delivers">
                                                <input type="hidden" name="item_id[]" v-bind:value="deliver.item.id">
                                                <input type="hidden" name="product_id[]" v-bind:value="deliver.item.product_id">
                                                <input type="hidden" name="stock_id[]" v-bind:value="deliver.item.stock_id">
                                                <input type="hidden" name="base_unit_id[]" v-bind:value="deliver.item.base_unit_id">
                                                <td class="valign-middle">@{{ deliver.item.product.name }}</td>
                                                <td v-bind:class="{ 'has-error':errors.has('unit_' + deliverIdx) }">
                                                    <select name="selected_unit_id[]" v-validate="'required'"
                                                            class="form-control"
                                                            v-model="deliver.selected_unit.id"
                                                            v-bind:data-vv-name="'unit_' + deliverIdx"
                                                            v-bind:data-vv-as="'{{ trans('warehouse.outflow.deliver.table.item.header.unit') }} ' + (deliverIdx + 1)">
                                                        <option v-bind:value="defaultProductUnit.id">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="product_unit in deliver.item.product.product_units" v-bind:value="product_unit.id">@{{ product_unit.unit.name }}(@{{ product_unit.unit.symbol }})</option>
                                                    </select>
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('brutto_' + deliverIdx) }">
                                                    <input type="text" class="form-control text-right" name="brutto[]"
                                                           v-model="deliver.brutto" v-validate="'required|decimal:2|min_value:1'"
                                                           v-bind:data-vv-name="'brutto_' + deliverIdx" v-bind:data-vv-as="'{{ trans('warehouse.outflow.deliver.table.item.header.brutto') }}' + (deliverIdx + 1)">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-md" v-on:click="removeDeliver(deliverIdx)" disabled><span class="fa fa-minus"/></button>
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
                <div class="col-md-7 col-offset-md-5">
                    <div class="btn-toolbar">
                        <button id="submitButton" type="submit" class="btn btn-primary pull-right">@lang('buttons.submit_button')</button>&nbsp;&nbsp;&nbsp;
                        <a id="printButton" href="#" target="_blank" class="btn btn-primary pull-right">@lang('buttons.print_preview_button')</a>&nbsp;&nbsp;&nbsp;
                        <a id="cancelButton" class="btn btn-primary pull-right" href="{{ route('db.warehouse.outflow.index', array('w' => $so->warehouse->id)) }}" >@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        </form>
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

                if (this.value == undefined || this.value == NaN) this.value = '';
                if (this.format == undefined || this.format == NaN) this.format = 'DD-MM-YYYY hh:mm A';
                if (this.readonly == undefined || this.readonly == NaN) this.readonly = 'false';

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

        var app = new Vue({
            el: '#deliverVue',
            data: {
                SO: JSON.parse('{!! htmlspecialchars_decode($so) !!}'),
                outflow: {
                    delivers : []
                },
                deliver_date: ''
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.warehouse.outflow.deliver', $so->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#deliverForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.warehouse.outflow.index', array('w' => $so->warehouse->id)) }}';
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
                createDeliver: function() {
                    var vm = this;
                    for(var i = 0; i < vm.SO.items.length; i++){
                        vm.outflow.delivers.push({
                            item: vm.SO.items[i],
                            selected_unit: _.find(vm.SO.items[i].product.product_units, function (punit) { return punit.id == vm.SO.items[i].selected_unit_id; }),
                            brutto: vm.SO.items[i].quantity % 1 != 0 ? parseFloat(vm.SO.items[i].quantity).toFixed(1) : parseFloat(vm.SO.items[i].quantity).toFixed(0)
                        });
                    }
                },
                removeDeliver: function (index) {
                    this.outflow.delivers.splice(index, 1);
                }
            },
            mounted: function() {
                this.createDeliver();
            },
            computed: {
                defaultProductUnit: function(){
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