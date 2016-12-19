@extends('layouts.frontweb.master')

@section('title')
    Front Web
@endsection

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-wallpaper">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="pull-right text-right">
                        <strong></strong>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="pull-right text-right">
                    </h4>
                </div>
            </div>
        </div>
        @for ($i = 0; $i < 50; $i++)
            <br/>
        @endfor
    </div>
@endsection