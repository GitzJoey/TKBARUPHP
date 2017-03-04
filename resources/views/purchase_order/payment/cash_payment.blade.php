@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.payment.cash.title')
@endsection

@section('page_title')
    <span class="fa fa-money fa-fw"></span>&nbsp;@lang('purchase_order.payment.cash.page_title')
@endsection

@section('page_title_desc')
    @lang('purchase_order.payment.cash.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('purchase_order_payment_cash', $currentPo->hId()) !!}
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="po-payment-vue">
        {!! Form::model($currentPo, ['method' => 'POST', 'route' => ['db.po.payment.cash', $currentPo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            {{ csrf_field() }}

            @include('purchase_order.payment.payment_summary_partial')

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('purchase_order.payment.cash.box.payment')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPaymentType"
                                               class="col-sm-2 control-label">@lang('purchase_order.payment.cash.field.payment_type')</label>
                                        <div class="col-sm-8">
                                            <input id="inputPaymentType" type="text" class="form-control" readonly
                                                   value="@lang('lookup.'.$paymentType)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPaymentDate"
                                               class="col-sm-2 control-label">@lang('purchase_order.payment.cash.field.payment_date')</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control" id="inputPaymentDate"
                                                       name="payment_date" data-parsley-required="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputPaymentAmount"
                                               class="col-sm-2 control-label">@lang('purchase_order.payment.cash.field.payment_amount')</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    Rp
                                                </div>
                                                <input type="text" class="form-control" id="inputPaymentAmount"
                                                       name="total_amount" data-parsley-required="true">
                                            </div>
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
                        <a id="cancelButton" href="{{ route('db.po.payment.index') }}" class="btn btn-primary pull-right"
                           role="button">@lang('buttons.cancel_button')</a>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}

        @include('purchase_order.supplier_details_partial')
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        var currentPo = JSON.parse('{!! htmlspecialchars_decode($currentPo->toJson()) !!}');
        
        var poPaymentApp = new Vue({
            el: '#po-payment-vue',
            data: {
                expenseTypes: JSON.parse('{!! htmlspecialchars_decode($expenseTypes) !!}'),
                po: {
                    supplier: _.cloneDeep(currentPo.supplier),
                    items: [],
                    expenses: [],
                    disc_total_percent : currentPo.disc_percent % 1 !== 0 ? currentPo.disc_percent : parseFloat(currentPo.disc_percent).toFixed(0),
                    disc_total_value : currentPo.disc_value % 1 !== 0 ? currentPo.disc_value : parseFloat(currentPo.disc_value).toFixed(0),
                }
            },
            methods: {
                grandTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.po.items, function (item, key) {
                        result += (item.selected_unit.conversion_value * item.quantity * item.price);
                    });
                    return result;
                },
                expenseTotal: function () {
                    var vm = this;
                    var result = 0;
                    _.forEach(vm.po.expenses, function (expense, key) {
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
                    _.forEach(vm.po.items, function (item) {
                        _.forEach(item.discounts, function (discount) {
                            result += parseFloat(discount.disc_value);
                        });
                    });
                    return result;
                },
            }
        });

        for (var i = 0; i < currentPo.items.length; i++) {
            var itemDiscounts = [];
            if( currentPo.items[i].discounts.length ){
                for (var ix = 0; ix < currentPo.items[i].discounts.length; ix++) {
                    itemDiscounts.push({
                        id : currentPo.items[i].discounts[ix].id,
                        disc_percent : currentPo.items[i].discounts[ix].item_disc_percent % 1 !== 0 ? currentPo.items[i].discounts[ix].item_disc_percent : parseFloat(currentPo.items[i].discounts[ix].item_disc_percent).toFixed(0),
                        disc_value : currentPo.items[i].discounts[ix].item_disc_value % 1 !== 0 ? currentPo.items[i].discounts[ix].item_disc_value : parseFloat(currentPo.items[i].discounts[ix].item_disc_value).toFixed(0),
                    });
                }
            }
            poPaymentApp.po.items.push({
                id: currentPo.items[i].id,
                product: currentPo.items[i].product,
                base_unit: _.find(currentPo.items[i].product.product_units, isBase),
                selected_unit: _.find(currentPo.items[i].product.product_units, getSelectedUnit(currentPo.items[i].selected_unit_id)),
                quantity: currentPo.items[i].quantity % 1 != 0 ? parseFloat(currentPo.items[i].quantity).toFixed(2):parseFloat(currentPo.items[i].quantity).toFixed(0),
                price: currentPo.items[i].price % 1 != 0 ? parseFloat(currentPo.items[i].price).toFixed(2):parseFloat(currentPo.items[i].price).toFixed(0),
                discounts : itemDiscounts
            });
        }

        for (var i = 0; i < currentPo.expenses.length; i++) {
            var type = _.find(poPaymentApp.expenseTypes, function (type) {
                return type.code === currentPo.expenses[i].type;
            });

            poPaymentApp.po.expenses.push({
                id: currentPo.expenses[i].id,
                name: currentPo.expenses[i].name,
                type: {
                    code: currentPo.expenses[i].type,
                    description: type ? type.description : ''
                },
                is_internal_expense: currentPo.expenses[i].is_internal_expense == 1,
                amount: parseFloat(currentPo.expenses[i].amount).toFixed(0),
                remarks: currentPo.expenses[i].remarks
            });
        }

        function getSelectedUnit(selectedUnitId) {
            return function (element) {
                return element.unit_id == selectedUnitId;
            }
        }

        function isBase(unit) {
            return unit.is_base == 1;
        }

        $("#inputPaymentDate").daterangepicker({
            locale: {
                format: 'DD-MM-YYYY'
            },
            singleDatePicker: true,
            showDropdowns: true
        });
    </script>
@endsection