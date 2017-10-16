@extends('layouts.adminlte.master')

@section('title')
    @lang('bank.consolidate.index.title')
@endsection

@section('page_title')
    <span class="fa fa-compress fa-fw"></span>&nbsp;@lang('bank.consolidate.index.page_title')
@endsection

@section('page_title_desc')
    @lang('bank.consolidate.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('bank_consolidate') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('bank.consolidate.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>@lang('bank.consolidate.index.table.header.date')</th>
                    <th>@lang('bank.consolidate.index.table.header.remarks')</th>
                    <th>@lang('bank.consolidate.index.table.header.amount')</th>
                    <th>@lang('bank.consolidate.index.table.header.db_cr')</th>
                    <th>@lang('bank.consolidate.index.table.header.balance')</th>
                    <th>@lang('labels.ACTION')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($bankConsolidates as $key => $bankConsolidate)
                    <tr>
                        <td>{{ $bankConsolidate->date }}</td>
                        <td>{{ $bankConsolidate->remarks }}</td>
                        <td>{{ $bankConsolidate->amount }}</td>
                        <td>{{ $bankConsolidate->db_cr }}</td>
                        <td>{{ $bankConsolidate->balance }}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            {{ $bankConsolidates->links() }}
        </div>
    </div>
@endsection
