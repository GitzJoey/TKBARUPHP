@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.payment.broughtforward.title')
@endsection

@section('page_title')
    <span class="fa fa-arrow-circle-right fa-fw"></span>&nbsp;@lang('sales_order.payment.broughtforward.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.payment.broughtforward.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('sales_order_payment_broughtforward', $currentSo->hId()) !!}
@endsection

@section('content')
    <div id="soPaymentVue">
        <div v-show="errors.count() > 0" v-cloak>
            <div class="alert alert-danger">
                <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
                <ul v-for="(e, eIdx) in errors.all()">
                    <li>@{{ e }}</li>
                </ul>
            </div>
        </div>

        <form id="soPaymentForm" class="form-horizontal" v-on:submit.prevent="validateBeforeSubmit()">
            {{ csrf_field() }}

            @include('sales_order.payment.payment_summary_partial')

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('sales_order.payment.broughtforward.invoice.next')</h3>
                </div>
                <div class="box-body">
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('next_code') }">
                        <label for="inputNextSalesOrder" class="col-sm-2 control-label">
                            @lang('sales_order.payment.broughtforward.invoice.so_code')
                        </label>
                        <div class="col-sm-7">
                            <input type="hidden" name="next_code" v-model="nextSo.code">
                            <select id="inputNextSalesOrder" name="next_id" class="form-control"
                                    v-model="nextSo.id" v-validate="'required'" v-on:change="onChangeNextSalesCode(nextSo.id)"
                                    data-vv-as="{{ trans('sales_order.payment.broughtforward.invoice.so_code') }}">
                                <option v-bind:value="emptySo.id">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="n of next" v-bind:value="n.id">@{{ n.code }}</option>
                            </select>
                            <span v-show="errors.has('next_code')" class="help-block" v-cloak>@{{ errors.first('next_code') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('next_name') }">
                        <label for="inputNextName" class="col-sm-2 control-label">
                            @lang('sales_order.payment.broughtforward.invoice.name')
                        </label>
                        <div class="col-sm-5">
                            <input type="text" id="inputNextName" class="form-control" name="next_name" v-model="nextSo.name" v-validate="'required'" data-vv-as="{{ trans('sales_order.payment.broughtforward.invoice.name') }}">
                            <span v-show="errors.has('next_name')" class="help-block" v-cloak>@{{ errors.first('next_name') }}</span>
                        </div>
                    </div>
                    <div v-bind:class="{ 'form-group':true, 'has-error':errors.has('next_remarks') }">
                        <label for="inputNextRemarks" class="col-sm-2 control-label">
                            @lang('sales_order.payment.broughtforward.invoice.remarks')
                        </label>
                        <div class="col-sm-10">
                            <input type="text" id="inputNextRemarks" class="form-control" name="next_remarks" v-model="nextSo.remarks" v-validate="'required'" data-vv-as="{{ trans('sales_order.payment.broughtforward.invoice.remarks') }}">
                            <span v-show="errors.has('next_remarks')" class="help-block" v-cloak>@{{ errors.first('next_remarks') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-offset-md-5">
                            <div class="btn-toolbar">
                                <button id="submitButton" type="submit" name="submit" class="submitButton btn btn-primary pull-right">@lang('buttons.submit_button')</button>&nbsp;&nbsp;&nbsp;
                                <a id="cancelButton" class="btn btn-primary pull-right"
                                   href="{{ route('db.so.payment.index') }}">@lang('buttons.cancel_button')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @include('sales_order.customer_details_partial')
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var vm = new Vue({
            el: '#soPaymentVue',
            data: {
                so: JSON.parse('{!! htmlspecialchars_decode($currentSo) !!}'),
                next    : JSON.parse('{!! htmlspecialchars_decode($nextSo) !!}'),
                nextSo  : {
                    id: '',
                    code: '',
                    name: '',
                    remarks: '',
                },
                locale: '{!! LaravelLocalization::getCurrentLocale() !!}',
                soIndex: 0
            },
            methods: {
                validateBeforeSubmit: function() {
                    var vm = this;
                    this.$validator.validateAll().then(function(isValid) {
                        if (!isValid) return;
                        $('#loader-container').fadeIn('fast');
                        axios.post('{{ route('api.post.db.so.payment.bf', $currentSo->hId()) }}' + '?api_token=' + $('#secapi').val(), new FormData($('#soPaymentForm')[0]))
                            .then(function(response) {
                            window.location.href = '{{ route('db.so.payment.index') }}';
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
                onChangeNextSalesCode: function(salesId) {
                    var vm = this;

                    if (salesId != '') {
                        var s = _.find(vm.next, { id: salesId });

                        vm.nextSo.code = s.code;
                        vm.nextSo.name = vm.nextSo.remarks = (vm.locale === 'id' ? 'Pengalihan ':'Brought Forward From ') + s.code;
                    } else {
                        vm.nextSo.code = vm.nextSo.name = vm.nextSo.remarks = '';
                    }
                },
                grandTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.so.items, function (item, key) {
                        result += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });
                    return result;
                },
                expenseTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.so.expenses, function (expense, key) {
                        result += parseInt(expense.amount);
                    });
                    return result;
                },
                discountItemSubTotal: function (discounts) {
                    var result = 0;
                    _.forEach(discounts, function (discount) {
                        result += parseFloat(discount.disc_value);
                    });
                    if( result % 1 !== 0 )
                        result = result.toFixed(2);
                    return result;
                },
                discountTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.so.items, function (item) {
                        _.forEach(item.discounts, function (discount) {
                            result += parseFloat(discount.disc_value);
                        });
                    });
                    return result;
                }
            },
            computed : {
                emptySo: function() {
                    return {
                        id : ''
                    }
                }
            }
        });
    </script>
@endsection