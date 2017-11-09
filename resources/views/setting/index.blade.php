@extends('layouts.adminlte.master')

@section('title')
    @lang('settings.index.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-th"></span>&nbsp;@lang('settings.index.page_title')
@endsection

@section('page_title_desc')
    @lang('settings.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('admin_settings') !!}
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
                <form id="settingsForm" class="form-horizontal" action="{{ route('db.admin.settings.update') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="inputForUserEmail" class="col-sm-3 control-label">@lang('settings.field.for_user_email')</label>
                        <div class="col-sm-9">
                            <select name="usr_id" class="form-control">
                                @foreach($userDDL as $key => $user)
                                    <option value="{{ $user->id }}">{{ $user->name.' - '.$user->email }}</option>
                                @endforeach
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="inputPagination" class="col-sm-3 control-label">@lang('settings.field.pagination')</label>
                        <div class="col-sm-2">
                            <input id="inputPagination" name="pagination" type="text" class="form-control" placeholder="@lang('settings.field.pagination')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFavPOWarehouse" class="col-sm-3 control-label">@lang('settings.field.fav_po_warehouse')</label>
                        <div class="col-sm-9">
                            <select name="po_warehouse" class="form-control" v-model="user.fav.po_warehouse_id">
                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFavSOWarehouse" class="col-sm-3 control-label">@lang('settings.field.fav_so_warehouse')</label>
                        <div class="col-sm-9">
                            <select name="so_warehouse" class="form-control" v-model="user.fav.so_warehouse_id">
                                <option value="">@lang('labels.PLEASE_SELECT')</option>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-1 control-label sr-only">&nbsp;</label>
                        <div class="col-sm-12">
                            <button class="btn btn-block btn-default" type="submit">@lang('buttons.update_button')</button>
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

        });
    </script>
@endsection
