@extends('layouts.frontweb.master')

@section('title')
    TKBARU
@endsection

@section('custom_css')
    <style type="text/css">
        .jumbotron-wallpaper {
            background-image: url('{{ asset('images/jumbotron.jpg') }}');
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-wallpaper">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="pull-right text-right">
                        <strong>@if (!empty($store->name)) {{ $store->name }} @endif</strong>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="pull-right text-right">
                        @if (!empty($store->address)) {{ $store->address }} @endif<br>
                        @if (!empty($store->phone_num)) Telp : {{ $store->phone_num }} @endif<br>
                        @if (!empty($store->fax_num)) Fax : {{ $store->fax_num }} @endif<br><br>
                        @if (!empty($store->tax_id)) NPWP : {{ $store->tax_id }} @endif<br>
                    </h4>
                </div>
            </div>
            @for ($i = 0; $i < 25; $i++)
                <br/>
            @endfor
        </div>
    </div>
@endsection