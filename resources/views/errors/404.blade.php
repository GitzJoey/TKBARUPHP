@extends('layouts.adminlte.master')

@section('title')
    Page Not Found
@endsection

@section('page_title')

@endsection

@section('page_title_desc')

@endsection

@section('content')
    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

            <p>
                We could not find the page you were looking for.<br/>
                Meanwhile, you may <a href="/dashboard">return to dashboard</a> or try using the sidebar on the left.<br/>
                <br/>
                Click here to <a href="#">Contact Support</a>
            </p>
        </div>
    </div>
@endsection