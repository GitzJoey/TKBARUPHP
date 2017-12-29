@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.confirmation.confirm.title')
@endsection

@section('page_title')
    <span class="fa fa-check fa-fw"></span>&nbsp;@lang('customer.confirmation.confirm.page_title')
@endsection

@section('page_title_desc')
    @lang('customer.confirmation.confirm.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('customer_confirmation', $so->hId()) !!}
@endsection

@section('content')
    <div id="custConfirmVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="custConfirmForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('customer.confirmation.confirm.box.sales_order')</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputSOCode" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.so_code')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" readonly value="{{ $so->code }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDeliverDate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.deliver_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control" readonly value="{{ $so->items()->first()->delivers()->first()->deliver_date->format('d-m-Y') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputConfirmReceiveDate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.confirm_receive_date')</label>
                                <div class="col-sm-8">
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <vue-datetimepicker id="inputConfirmReceiveDate" name="confirm_receive_date[]" v-model="confirm_receive_date" format="YYYY-MM-DD hh:mm A"></vue-datetimepicker>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputLicensePlate" class="col-sm-2 control-label">@lang('customer.confirmation.confirm.field.license_plate')</label>
                                <div class="col-sm-8">
                                    <input type="text" id="inputLicensePlate" name="license_plate" value="{{ $so->items()->first()->delivers()->first()->license_plate }}" class="form-control" readonly>
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
                            <h3 class="box-title">@lang('customer.confirmation.confirm.box.items')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="itemsListTable" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="20%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.product_name')</th>
                                                <th width="15%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.unit')</th>
                                                <th width="10%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.brutto')</th>
                                                <th width="10%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.netto')</th>
                                                <th width="10%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.tare')</th>
                                                <th width="30%" class="text-center">@lang('customer.confirmation.confirm.table.item.header.remarks')</th>
                                                <th width="5%">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, itemIdx) in SO.items">
                                                <td class="valign-middle">
                                                    <input type="hidden" name="deliver_id[]" v-bind:value="item.delivers[0].id">
                                                    <input type="hidden" name="item_id[]" v-bind:value="item.id">
                                                    <input type="hidden" name="product_id[]" v-bind:value="item.product.id">
                                                    <input type="hidden" name="base_unit_id[]" v-bind:value="item.base_unit_id">
                                                    @{{ item.product.name }}
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('unit_' + itemIdx) }">
                                                    <select name="selected_unit_id[]"
                                                            class="form-control"
                                                            v-model="item.delivers[0].selected_unit_id"
                                                            v-validate="'required'"
                                                            v-bind:data-vv-as="'{{ trans('customer.confirmation.confirm.table.item.header.unit') }} ' + (itemIdx + 1)"
                                                            v-bind:data-vv-name="'unit_' + itemIdx">
                                                        <option value="">@lang('labels.PLEASE_SELECT')</option>
                                                        <option v-for="product_unit in item.product.product_units" v-bind:value="product_unit.id">@{{ product_unit.unit.name }} (@{{ product_unit.unit.symbol }})</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input v-bind:id="'brutto_' + itemIdx" type="text" class="form-control text-right" name="brutto[]" v-model="item.delivers[0].brutto" readonly>
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('netto_' + itemIdx) }">
                                                    <input v-bind:id="'netto_' + itemIdx" type="text" class="form-control text-right" name="netto[]" v-model="item.delivers[0].netto"
                                                           v-validate="'required|decimal:2|min_value:1|checkequal:' + itemIdx"
                                                           v-bind:data-vv-name="'netto_' + itemIdx" v-bind:data-vv-as="'{{ trans('customer.confirmation.confirm.table.item.header.netto') }} ' + (itemIdx + 1)">
                                                </td>
                                                <td v-bind:class="{ 'has-error':errors.has('tare_' + itemIdx) }">
                                                    <input v-bind:id="'tare_' + itemIdx" type="text" class="form-control text-right" name="tare[]" v-model="item.delivers[0].tare"
                                                           v-validate="'required|decimal:2|min_value:0|checkequal:' + itemIdx"
                                                           v-bind:data-vv-name="'tare_' + itemIdx" v-bind:data-vv-as="'{{ trans('customer.confirmation.confirm.table.item.header.tare') }} ' + (itemIdx + 1)">
                                                </td>
                                                <td>
                                                    <input v-bind:id="'remarks_' + itemIdx" type="text" class="form-control text-right" name="remarks[]" v-model="item.delivers[0].remarks">
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger btn-md" v-on:click="removeDeliver(itemIdx)" disabled="true"><span class="fa fa-minus" /></button>
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
                        <a id="cancelButton" class="btn btn-primary pull-right" href="{{ route('db.customer.confirmation.customer', $so->customer->hId()) }}" >@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var app = new Vue({
            el: '#custConfirmVue',
            data: {
                SO: JSON.parse('{!! htmlspecialchars_decode($so) !!}'),
                confirm_receive_date: ''
            },
            methods: {
                validateBeforeSubmit: function() {
                    console.log(this.$validator.validateAll());
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.customer.confirmation.confirm', $so->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#custConfirmForm')[0]))
                            .then(function(response) {
                                if (response.data.result == 'success') { window.location.href = '{{ route('db.customer.confirmation.customer', $so->hId()) }}' };
                            });
                    }).catch(function (e) {

                    });
                },
                removeDeliver: function (index) {

                }
            },
            mounted: function() {
                var vm = this;
                this.$validator.extend('checkequal', {
                    getMessage: function(field, args) {
                        return vm.$validator.locale == 'id' ?
                            'Nilai bersih dan Tara lebih tinggi dari Nilai Kotor':
                            'Netto and Tare value are higher than the Bruto value';
                    },
                    validate: function(value, args) {
                        var result = false;
                        var itemIdx = args[0];

                        if (Number(app.SO.items[itemIdx].delivers[0].brutto) <=
                            Number(app.SO.items[itemIdx].delivers[0].netto) + Number(app.SO.items[itemIdx].delivers[0].tare)) {
                            result = true;
                        }

                        return result;
                    }
                });
            }
        });
    </script>
@endsection