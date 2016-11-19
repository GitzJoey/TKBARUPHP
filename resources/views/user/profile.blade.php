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
                <div class="col-md-3">
                    <img src="{{ asset('images/blank.png') }}" class="img-rounded" alt="User Image">
                </div>
                <div class="col-md-9">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="15%">&nbsp;</th>
                                <th width="85%">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>@lang('user.profile.field.username')</td>
                                <td>{{ Auth::user()->name }}</td>
                            </tr>
                            <tr>
                                <td>@lang('user.profile.field.email')</td>
                                <td>{{ Auth::user()->email}}</td>
                            </tr>
                            <tr>
                                <td>@lang('user.profile.field.role')</td>
                                <td>{{ Auth::user()->role->name }}</td>
                            </tr>
                            <tr>
                                <td>@lang('user.profile.field.type')</td>
                                <td>@lang('lookup.'.Auth::user()->userdetail->type)</td>
                            </tr>
                            <tr>
                                <td>@lang('user.profile.field.allow_login')</td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('user.profile.field.link_profile')</td>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection