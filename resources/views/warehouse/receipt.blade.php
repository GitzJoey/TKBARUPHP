@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.inflow.receipt.title')
@endsection

@section('page_title')
    <span class="fa fa-mail-forward fa-rotate-90 fa-fw"></span>&nbsp;@lang('warehouse.inflow.receipt.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.inflow.receipt.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('receipt', $po->hId(), $po->warehouse_id) !!}
@endsection

@section('content')
    <div id="receiptVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="receiptForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('warehouse.inflow.receipt.box.receipt')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputWarehouse" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.warehouse')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $po->warehouse->name }}">
                                    <input type="hidden" name="warehouse_id" value="{{ $po->warehouse->id }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPOCode" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.po_code')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $po->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputShippingDate" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.shipping_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputShippingDate" name="shipping_date" v-model="PO.po_created" format="YYYY-MM-DD hh:mm A" readonly="true"></vue-datetimepicker>
                                    </div>
                                </div>
                            </div>
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('receipt_date') }">
                                <label for="inputReceiptDate" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.receipt_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputReceiptDate" name="receipt_date" v-model="receipt_date" v-validate="'required'" format="YYYY-MM-DD hh:mm A"></vue-datetimepicker>
                                    </div>
                                    <span v-show="errors.has('receipt_date')" class="help-block" v-cloak>@{{ errors.first('receipt_date') }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputVendorTrucking" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.vendor_trucking')</label>
                                <div class="col-sm-8">
                                    @if (empty($po->vendorTrucking))
                                        <input type="text" class="form-control" readonly value="" >
                                    @else
                                        <input type="text" class="form-control" readonly value="{{ $po->vendorTrucking->name }}" >
                                    @endif
                                </div>
                            </div>
                            <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('license_plate') }">
                                <label for="inputLicensePlate" class="col-sm-2 control-label">@lang('warehouse.inflow.receipt.field.license_plate')</label>
                                <div class="col-sm-8">
                                    <input type="text" id="inputLicensePlate" name="license_plate" class="form-control" v-validate="'required'" data-vv-as="{{ trans('warehouse.inflow.receipt.field.license_plate') }}">
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
                            <h3 class="box-title">@lang('warehouse.inflow.receipt.box.items')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50%" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.product_name')</th>
                                                <th width="15%" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.unit')</th>
                                                <th width="10%" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.brutto')</th>
                                                <th width="10%" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.netto')</th>
                                                <th width="10%" class="text-center">@lang('warehouse.inflow.receipt.table.item.header.tare')</th>
                                                <th width="5%">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(receipt, receiptIdx) in inflow.receipts" v-cloak>
                                                <input type="hidden" name="item_id[]" v-bind:value="receipt.item.id">
                                                <input type="hidden" name="product_id[]" v-bind:value="receipt.item.product_id">
                                                <input type="hidden" name="base_unit_id[]" v-bind:value="receipt.item.base_unit_id">
                                                <td class="valign-middle">
                                                    <span v-bind:title="receipt.item.quantity">@{{ receipt.item.product.name }}</span>
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('unit_' + receiptIdx) }">
                                                    <select name="selected_unit_id[]"
                                                            class="form-control"
                                                            v-model="receipt.selected_unit"
                                                            v-validate="'required'"
                                                            v-bind:data-vv-as="'{{ trans('warehouse.inflow.receipt.table.item.header.unit') }} ' + (receiptIdx + 1)"
                                                            v-bind:data-vv-name="'unit_' + receiptIdx">
                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="product_unit in receipt.item.product.product_units" v-bind:value="product_unit.unit.id">@{{ product_unit.unit.name }} (@{{ product_unit.unit.symbol }})</option>
                                                    </select>
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('brutto_' + receiptIdx) }">
                                                    <input v-bind:id="'brutto_' + receipt.item.id" type="text" class="form-control text-right" name="brutto[]"
                                                           v-model="receipt.brutto" v-validate="'required|numeric'" v-bind:data-vv-as="'{{ trans('warehouse.inflow.receipt.table.item.header.brutto') }} ' + (receiptIdx + 1)"
                                                           v-bind:data-vv-name="'brutto_' + receiptIdx">
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('netto_' + receiptIdx) }">
                                                    <input v-bind:id="'netto_' + receipt.item.id" type="text" class="form-control text-right" name="netto[]"
                                                           v-model="receipt.netto" v-validate="'required|numeric|checkequal:' + receiptIdx" v-bind:data-vv-as="'{{ trans('warehouse.inflow.receipt.table.item.header.netto') }} ' + (receiptIdx + 1)"
                                                           v-bind:data-vv-name="'netto_' + receiptIdx">
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('tare_' + receiptIdx) }">
                                                    <input v-bind:id="'tare_' + receipt.item.id" type="text" class="form-control text-right" name="tare[]"
                                                           v-model="receipt.tare" v-validate="'required|numeric|checkequal:' + receiptIdx" v-bind:data-vv-as="'{{ trans('warehouse.inflow.receipt.table.item.header.tare') }} ' + (receiptIdx + 1)"
                                                           v-bind:data-vv-name="'tare_' + receiptIdx">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-md" v-on:click="removeReceipt(receiptIdx)" disabled><span class="fa fa-minus"/></button>
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
                        <a id="cancelButton" class="btn btn-primary pull-right" href="{{ route('db.warehouse.inflow.index', array('w' => $po->warehouse->id)) }}" >@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        Vue.use(VeeValidate, { locale: '{!! LaravelLocalization::getCurrentLocale() !!}' });

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

        var app = new Vue({
            el: '#receiptVue',
            data: {
                PO: JSON.parse('{!! htmlspecialchars_decode($po) !!}'),
                inflow: {
                    receipts : []
                },
                receipt_date: ''
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.warehouse.inflow.receipt', $po->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#receiptForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.warehouse.inflow.index', array('w' => $po->warehouse->id)) }}';
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
                createReceipt: function() {
                    for(var i = 0; i < this.PO.items.length; i++){
                        this.inflow.receipts.push({
                            item: this.PO.items[i],
                            selected_unit: '',
                            brutto: '',
                            netto: '',
                            tare: ''
                        });
                    }
                },
                removeReceipt: function (index) {
                    this.inflow.receipts.splice(index, 1);
                }
            },
            mounted: function() {
                this.$validator.extend('checkequal', {
                    messages: {
                        en: function(field, args) { return 'Netto and Tare value not equal with Bruto' },
                        id: function(field, args) { return 'Nilai bersih dan Tara tidak sama dengan Nilai Kotor' }
                    },
                    validate: function(value, args) {
                        var result = false;
                        var itemIdx = args[0];

                        console.log(Number(app.inflow.receipts[itemIdx].netto) + Number(app.inflow.receipts[itemIdx].tare));
                        if (Number(app.inflow.receipts[itemIdx].brutto) ==
                            Number(app.inflow.receipts[itemIdx].netto) + Number(app.inflow.receipts[itemIdx].tare)) {
                            result = true;
                        }

                        return result;
                    }
                });
                this.createReceipt();
            }
        });
    </script>
@endsection