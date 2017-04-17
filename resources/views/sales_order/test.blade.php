@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.create.title')
@endsection

@section('page_title')
    <span class="fa fa-cart-arrow-down fa-fw"></span>&nbsp;@lang('sales_order.create.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.create.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('create_sales_order') !!}
@endsection

@section('content')
    <div id="soVue">

    </div>

    <!-- using string template here to work around HTML <option> placement restriction -->
    <script type="text/x-template" id="demo-template">
        <div>
            <p>Selected: @{{ selected }}</p>
            <select2 :options="options" v-model="selected">
                <option disabled value="0">Select one</option>
            </select2>
        </div>
    </script>

    <script type="text/x-template" id="select2-template">
        <select class="col-md-12">
            <slot></slot>
        </select>
    </script>

@endsection

@section('custom_js')
    <script type="application/javascript">

        var selectComponent = Vue.extend({
            props: ['options', 'value'],
            template: '#select2-template',
            mounted: function () {
                var vm = this;

                $(this.$el)
                // init select2
                    .select2({
                        placeholder: 'Select a customer',
                        allowClear: false,
                        ajax: {
                            url: '{{ route('api.customer.search') }}',
                            dataType: 'json',
                            delay: 250,
                            processResults: function (data, params) {
                                return {
                                    results: $.map(data, function(item) {
                                        return {
                                            id: item.id,
                                            text: item.name
                                        }
                                    })
                                };
                            },
                            cache: true
                        }
                    })
                    .val(this.value)
                    .trigger('change')
                    .on('change', function() {
                       vm.$emit('input', this.value);
                    });
            },
            watch: {
                value: function(value) {
                    // update value
                    $(this.$el).val(value).trigger('change');
                },
                options: function(options) {
                    // update options
                    $(this.$el).select2({ data: options })
                }
            },
            destroyed: function() {
                $(this.$el).off().select2('destroy');
            }
        });

        Vue.component('select2', selectComponent);

        var soApp = new Vue({
            el: '#soVue',
            template: '#demo-template',
            data: function() {

                return {
                    selected: 2,
                    options: JSON.parse('{!! htmlspecialchars_decode($customerTypeDDL) !!}'),
                };

            },
            methods: {

            },
            updated: {
            }
        });
    </script>
@endsection