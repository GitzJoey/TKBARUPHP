@extends('layouts.adminlte.master')

@section('title')
    @lang('settings.user.title')
@endsection

@section('page_title')
    <span class="glyphicon glyphicon-th"></span>&nbsp;@lang('settings.user.page_title')
@endsection

@section('page_title_desc')
    @lang('settings.user.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('user_settings', Auth::user()->id) !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('settings.user.header.title')</h3>
        </div>
        <div class="box-body">
            <div id="settingsVue">
                <form id="userSettingsForm" class="form-horizontal" action="{{ route('db.user.settings.update') }}" method="post" data-parsley-validate="parsley">
                    <div class="form-group">
                        <label for="inputFavPOWarehouse" class="col-sm-3 control-label">@lang('settings.field.fav_po_warehouse')</label>
                        <div class="col-sm-9">
                            <select name="usr_id" class="form-control" v-model="user.fav.warehouse_id">
                                <option v-for="w in warehouseDDL" v-bind:value="w.id">@{{ w.name }} @{{ w.address }}</option>
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
                    warehouseDDL: JSON.parse('{!! htmlspecialchars_decode($warehouseDDL) !!}'),
                    user: {
                        fav: {
                            warehouse_id: ''
                        }
                    }
                },
                methods: {

                }
            });
        });
    </script>
@endsection