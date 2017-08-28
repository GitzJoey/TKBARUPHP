@extends('layouts.adminlte.master')

@section('title')
    @lang('report.tax.title')
@endsection

@section('page_title')
    <span class="fa fa-institution fa-fw"></span>&nbsp;@lang('report.tax.page_title')
@endsection

@section('page_title_desc')
    @lang('report.tax.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('report.tax.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_tax_masukan" data-toggle="tab">
                                    Faktur Masukan
                                </a>
                            </li>
                            <li>
                                <a href="#tab_tax_keluaran_summary" data-toggle="tab">
                                    Faktur Keluaran Summary
                                </a>
                            </li>
                            <li>
                                <a href="#tab_tax_keluaran_detail" data-toggle="tab">
                                    Faktur Keluaran Detail
                                </a>
                            </li>
                            <li>
                                <a href="#tab_tax_arus" data-toggle="tab">
                                    Arus
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab_tax" >
                            <div class="tab-pane active" id="tab_tax_masukan">
                                @include('report.tax_components.faktur_masukan')
                            </div>
                            <div class="tab-pane" id="tab_tax_keluaran_summary">
                                @include('report.tax_components.faktur_keluaran_summary')
                            </div>
                            <div class="tab-pane" id="tab_tax_keluaran_detail">
                                @include('report.tax_components.faktur_keluaran_detail')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection