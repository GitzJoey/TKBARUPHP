@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.capital.deposit.index.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.capital.deposit.index.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.capital.deposit.index.page_title_desc')
@endsection

@section('breadcrumbs')

@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('accounting.capital.deposit.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center" width="20%">@lang('accounting.capital.deposit.index.table.header.date')</th>
                    <th class="text-center" width="20%">@lang('accounting.capital.deposit.index.table.header.destination_account')</th>
                    <th class="text-center" width="10%">@lang('accounting.capital.deposit.index.table.header.amount')</th>
                    <th class="text-center" width="20%">@lang('accounting.capital.deposit.index.table.header.remarks')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($capdep as $key => $cd)
                    <tr>
                        <td>{{ $cd->date }}</td>
                        <td>{{ $cd->accountingCash->name }} ({{ $cd->accountingCash->code }})</td>
                        <td>{{ $cd->amount }}</td>
                        <td>{{ $cd->remarks }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.acc.capital.deposit.add') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $capdep->render() !!}
        </div>
    </div>
@endsection