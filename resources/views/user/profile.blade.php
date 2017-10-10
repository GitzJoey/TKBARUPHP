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

@section('breadcrumbs')
    {!! Breadcrumbs::render('user_profile', Auth::user()->id) !!}
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('user.profile.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3 text-center">
                    <br/>
                    <br/>
                    <br/>
                    <img src="{{ empty(Auth::user()->profile->image_filename) ? asset('images/def-user.png'):asset('images/'.Auth::user()->profile->image_filename) }}" class="img-rounded" alt="User Image">
                </div>
                <div class="col-md-7">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="25%">&nbsp;</th>
                                <th width="75%">&nbsp;</th>
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
                                <td>{{ Auth::user()->roles()->first()->display_name }}</td>
                            </tr>
                            <tr>
                                <td>@lang('user.profile.field.type')</td>
                                <td>@lang('lookup.'.Auth::user()->userdetail->type)</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;">@lang('user.profile.field.allow_login')</td>
                                <td>
                                    <div class="checkbox icheck">
                                        <label>
                                            <input id="inputAllowLogin" type="checkbox" {{ boolval(Auth::user()->userDetail->allow_login) ? 'checked':'' }} disabled>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>@lang('user.profile.field.link_profile')</td>
                                <td>
                                    @if (!empty(Auth::user()->profile->owner))
                                        {{ Auth::user()->profile->owner->name }}
                                    @else
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <a class="btn btn-default" href="{{ route('db.user.calendar.show') }}">@lang('buttons.calendar_button')</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-default">@lang('buttons.change_password_button')</button>
                    <button class="btn btn-default">@lang('buttons.reset_password_button')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="text/javascript">
        $(function () {
            $('#inputAllowLogin').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
@endsection