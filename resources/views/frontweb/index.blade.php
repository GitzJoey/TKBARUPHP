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
                        <strong>Toko BARU</strong>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="pull-right text-right">
                        Jln Raya Utara No 67<br>
                        Wangon
                    </h4>
                </div>
            </div>
            @for ($i = 0; $i < 25; $i++)
                <br/>
            @endfor
        </div>
    </div>
@endsection