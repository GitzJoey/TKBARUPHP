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

    <div id="soPaymentVue" class="row">
        <div class="col-md-6">
            <div class="form-horizontal">
                <div class="box box-info">
                    <div class="box-header with-border">
                        @lang('sales_order.payment.broughtforward.invoice.current')
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputSalesOrderCode" class="col-sm-4 control-label">
                                @lang('sales_order.payment.broughtforward.invoice.so_code')
                            </label>
                            <div class="col-sm-7">
                                <label id="inputSalesOrderCode" class="control-label">
                                    <span class="control-label-normal">{{ $currentSo->code }}</span>
                                </label>
                            </div>
                        </div>
                        <so-detail v-bind:so="current"></so-detail>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            {!! Form::model($currentSo, ['method' => 'POST', 'route' => ['db.so.payment.bf', $currentSo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            {{ csrf_field() }}
            <div class="box box-info">
                <div class="box-header with-border">
                    @lang('sales_order.payment.broughtforward.invoice.next')
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputNextSalesOrder" class="col-sm-4 control-label">
                            @lang('sales_order.payment.broughtforward.invoice.so_code')
                        </label>
                        <div class="col-sm-7">
                            <input type="hidden" name="next_code" v-bind:value="nextSo.id" >
                            <select class="form-control"
                                id="inputNextId"
                                v-model="nextSo" data-parsley-required="true">
                                <option v-bind:value="emptySo">@lang('labels.PLEASE_SELECT')</option>
                                <option v-for="nextSo of next" v-bind:value="nextSo">@{{ nextSo.code }}</option>
                            </select>
                        </div>
                    </div>
                    <so-detail v-bind:so="nextSo" v-bind:new="true"></so-detail>
                    <so-expense v-bind:so="current"></so-expense>
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
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="text/x-template" id="so-detail">
        <div v-if="so.code">
            <div class="form-group">
                <label class="col-sm-4 control-label">
                    @lang('sales_order.payment.broughtforward.invoice.customer')
                </label>
                <div class="col-sm-7">
                    <label class="control-label">
                        <span class="control-label-normal">@{{ so.customer_text }}</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">
                    @lang('sales_order.payment.broughtforward.invoice.created')
                </label>
                <div class="col-sm-7">
                    <label class="control-label">
                        <span class="control-label-normal">@{{ so.created_text }}</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">
                    @lang('sales_order.payment.broughtforward.invoice.total_amount')
                </label>
                <div class="col-sm-7">
                    <label class="control-label">
                        <span class="control-label-normal">@{{ totalAmount | number_format}}</span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('sales_order.create.box.transactions')</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="30%">@lang('sales_order.create.table.item.header.product_name')</th>
                                            <th width="15%">@lang('sales_order.create.table.item.header.quantity')</th>
                                            <th width="15%" class="text-right">@lang('sales_order.create.table.item.header.unit')</th>
                                            <th width="15%" class="text-right">@lang('sales_order.create.table.item.header.price_unit')</th>
                                            <th width="20%" class="text-right">@lang('sales_order.create.table.item.header.total_price')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(item,index) in so.items">
                                            <td>@{{index + 1}}</td>
                                            <td class="valign-middle">@{{ item.product.name }}</td>
                                            <td>@{{ item.quantity }}</td>
                                            <td>@{{ item.selected_unit.unit.symbol }}</td>
                                            <td>@{{ item.price | number_format }}</td>
                                            <td class="text-right valign-middle">@{{ item.quantity * item.price | number_format}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </script>
    <script type="text/x-template" id="so-expense">
        <div class="box box-info" v-if="so.code">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('sales_order.create.box.expenses')</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th width="20%">@lang('sales_order.create.table.expense.header.name')</th>
                                <th width="25%"
                                    class="text-center">@lang('sales_order.create.table.expense.header.remarks')</th>
                                <th width="20%"
                                    class="text-center">@lang('sales_order.create.table.expense.header.amount')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <input name="expense_name" type="text" class="form-control" data-parsley-required="true">
                                </td>
                                <td>
                                    <input name="expense_remarks" type="text" class="form-control"/>
                                </td>
                                <td>
                                    <input type="hidden" name="expense_amount" v-bind:value="totalAmount">
                                    <input type="text" class="form-control text-right" v-bind:value="so.total_amount_text" disabled/>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </script>
    <script type="application/javascript">
        Vue.config.silent = false;
        Vue.filter('number_format', function (value) {
            var val = (value/1).toFixed(0);
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        });
        var vm = new Vue({
            el: '#soPaymentVue',
            data: {
                current : JSON.parse('{!! htmlspecialchars_decode($currentSo) !!}'),
                next    : JSON.parse('{!! htmlspecialchars_decode($nextSo) !!}'),
                nextSo  : {
                    code :false
                }
            },
            computed : {
                emptySo :function(){
                    return {
                        code : false
                    }
                }
            },
            components : {
                'so-detail' : {
                    template    : '#so-detail',
                    props       : {
                        so  :false,
                        new :false
                    },
                    computed    : {
                        totalAmount   : function(){
                            var total   = 0;
                            var items   = this.so.items;
                            for(var i in items){
                                total += items[i].price * items[i].quantity;
                            }
                            if(!this.new)
                                return total;
                            return total + this.totalExpense;
                        },
                        totalExpense : function(){
                            var total   = 0;
                            if(!this.new)
                                return total;
                            items       = vm.current.items;
                            for(var i in items){
                                total += items[i].price * items[i].quantity;
                            }
                            return total;
                        }
                    }
                },
                'so-expense' : {
                    template    : '#so-expense',
                    props       : ['so'],
                    computed    : {
                        totalAmount   : function(){
                            var total   = 0;
                            var items   = this.so.items;
                            for(var i in items){
                                total += items[i].price * items[i].quantity;
                            }
                            return total;
                        },
                    }
                },
            }
        });
    </script>
@endsection