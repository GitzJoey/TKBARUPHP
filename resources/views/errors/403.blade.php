@extends('layouts.adminlte.master')

@section('title')
    Not Authorized
@endsection

@section('page_title')

@endsection

@section('page_title_desc')

@endsection

@section('content')
    <div class="error-page">
        <h2 class="headline text-yellow"> 403</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! You Are Not Authorized.</h3>

            <p>
                <br>
                You are not authorized to view this page.
                <br>
                Meanwhile, you may <a href="/dashboard">return to dashboard</a> or try using the sidebar on the left.
                <br>
                Click here to <a href="#">Contact Support</a>
            </p>
        </div>
    </div>
@endsection