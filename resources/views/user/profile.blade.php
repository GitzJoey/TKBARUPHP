@extends('layouts.adminlte.master')

@section('title')
    @lang('user.profile.title')
@endsection

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;@lang('user.profile.page_title')
@endsection
@section('page_title_desc')
    @lang('user.profile.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('user.profile.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-offset-1 col-md-2">
                    <img src="{{ asset('images/blank.png') }}" class="img-rounded" alt="User Image">
                </div>
                <div class="col-md-5 col-md-offset-3">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>@lang('user.profile.field.username')</td>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection