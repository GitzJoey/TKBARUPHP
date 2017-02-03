@extends('layouts.adminlte.master')

@section('title')
    @lang('settings.index.title')
@endsection

@section('page_title')
    <span class="fa fa-minus-square fa-fw"></span>&nbsp;@lang('settings.index.page_title')
@endsection
@section('page_title_desc')
    @lang('settings.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('settings.index.header.title')</h3>
        </div>
        <div class="box-body">
            <div id="settingsVue">
                <form id="settingsForm" class="form-horizontal" action="{{ route('db.admin.settings.update') }}" method="post" data-parsley-validate="parsley">
                    <div class="form-group">
                        <label for="inputForUserEmail" class="col-sm-3 control-label">@lang('settings.field.for_user_email')</label>
                        <div class="col-sm-9">
                            <select name="usr_id" class="form-control" v-model="selectedUserId">
                                <option v-for="user in userDDL" v-bind:value="user.id">@{{ user.name }} @{{ user.email }}</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box-footer clearfix">
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            var app = new Vue({
                el: '#settingsVue',
                data: {
                    userDDL: JSON.parse('{!! htmlspecialchars_decode($userDDL) !!}'),
                    selectedUserId: ''
                },
                methods: {
                    loadSettings: function(userId) {

                    }
                }
            });
        });
    </script>
@endsection