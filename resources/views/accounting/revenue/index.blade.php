@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.revenue.index.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.revenue.index.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.revenue.index.page_title_desc')
@endsection

@section('breadcrumbs')

@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('accounting.revenue.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('accounting.revenue.index.table.header.date')</th>
                        <th class="text-center">@lang('accounting.revenue.index.table.header.destination_account')</th>
                        <th class="text-center">@lang('accounting.revenue.index.table.header.cost_category')</th>
                        <th class="text-center">@lang('accounting.revenue.index.table.header.amount')</th>
                        <th class="text-center">@lang('accounting.revenue.index.table.header.remarks')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($revlist as $key => $rev)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.acc.revenue.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $revlist->render() !!}
        </div>
    </div>
@endsection