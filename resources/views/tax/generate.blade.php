@extends('layouts.adminlte.master')

@section('title')
    @lang('tax.generate.title')
@endsection

@section('page_title')
    <span class="fa fa-magic"></span>&nbsp;@lang('tax.generate.page_title')
@endsection

@section('page_title_desc')
    @lang('tax.generate.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('tax_generate') !!}
@endsection

@section('content')
<div id="taxGenerate">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('tax.generate.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_import_pm" data-toggle="tab">
                                    @lang('tax.generate.nav_tabs.import_pm')
                                </a>
                            </li>
                            <li>
                                <a href="#tab_import_pk" data-toggle="tab">
                                    @lang('tax.generate.nav_tabs.import_pk')
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab_tax" >
                            <div class="tab-pane" id="tab_import_pk">
                                @include('tax.generate_components.import_pk')
                            </div>
                            <div class="tab-pane active" id="tab_import_pm">
                                @include('tax.generate_components.import_pm')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-xs-12">
            <div class="text-center">
                <ul class="pagination pagination-sm no-margin">
                    <li><a v-bind:href="'{{ route('db.tax.generate', [ 'year' => $year - 1, 'month' => 12 ]) }}' + openedNavTab">{{ $year - 1 }}</a></li>
                    @foreach ($months as $key => $value)
                    <li class="{{ $month == $key ? 'active' : '' }}">
                        @if ($loop->first)
                        <a v-bind:href="'{{ route('db.tax.generate', [ 'year' => $year, 'month' => $key ]) }}' + openedNavTab">{{ $year }} - {{ str_pad($key, 2, '0', STR_PAD_LEFT) }}</a>
                        @else
                        <a v-bind:href="'{{ route('db.tax.generate', [ 'year' => $year, 'month' => $key ]) }}' + openedNavTab">{{ str_pad($key, 2, '0', STR_PAD_LEFT) }}</a>
                        @endif
                    </li>
                    @endforeach
                    <li><a v-bind:href="'{{ route('db.tax.generate', [ 'year' => $year + 1, 'month' => 1 ]) }}' + openedNavTab">{{ $year + 1 }}</a></li>
                </ul>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-body table-responsive">
                    <table class="table">
                        <tbody id="tbody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
</div>
@endsection

@section('custom_js')
    <script type="application/javascript">

        var app = new Vue({
            el: '#taxGenerate',
            data:{
                taxesInput: [],
                taxesOutput: [],
                productsDDL: [],
                gstTranTypeDDL: []
            },
            computed: {
            },
            mounted: function () {
                var gstTranTypeDDL = this.camelCasingKey({!! json_encode($gstTranTypeDDL) !!});
                var productsDDL = this.camelCasingKey({!! json_encode($productsDDL) !!});
                var taxesInput = this.camelCasingKey({!! json_encode($taxes_input) !!});
                var taxesOutput = this.camelCasingKey({!! json_encode($taxes_output) !!});
                taxesOutput.forEach(function (taxOutput) {
                    taxOutput.gstTransactionTypeDescription = (_.find(gstTranTypeDDL, function (gstTranType) {
                        return gstTranType.code == taxOutput.gstTransactionType;
                    }) || {}).description;
                });

                this.gstTranTypeDDL = gstTranTypeDDL;
                this.productsDDL = productsDDL;
                this.taxesInput = taxesInput;
                this.taxesOutput = taxesOutput;
            },
            methods: {
                getProductCode: function (product) {
                    return (_.find(this.productsDDL, function (productDDL) {
                        return productDDL.name == product;
                    }) || {}).shortCode;
                }
            },
        });
    </script>
@endsection
