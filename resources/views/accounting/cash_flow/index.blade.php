@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.cash_flow.index.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.cash_flow.index.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.cash_flow.index.page_title_desc')
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
            <h3 class="box-title">@lang('accounting.cash_flow.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="20%">@lang('accounting.cash_flow.index.table.header.date')</th>
                        <th class="text-center" width="20%">@lang('accounting.cash_flow.index.table.header.source_account')</th>
                        <th class="text-center" width="20%">@lang('accounting.cash_flow.index.table.header.destination_account')</th>
                        <th class="text-center" width="10%">@lang('accounting.cash_flow.index.table.header.amount')</th>
                        <th class="text-center" width="20%">@lang('accounting.cash_flow.index.table.header.status')</th>
                        <th class="text-center" width="20%">@lang('accounting.cash_flow.index.table.header.remarks')</th>
                        <th class="text-center" width="10%">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cashflow as $key => $cf)
                        <tr>
                            <td>{{ $cf->date }}</td>
                            <td>{{ $cf->source_account }}</td>
                            <td>{{ $ac->destination_account }}</td>
                            <td class="text-center">{{ $cf->amount }}</td>
                            <td>@lang('lookup.' . $ac->status)</td>
                            <td>{{ $cf->remarks }}</td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-info" href="{{ route('db.acc.cash_flow.show', $cf->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.acc.cash_flow.edit', $cf->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.acc.cash_flow.delete', $cf->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.acc.cash_flow.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $cashflow->render() !!}
        </div>
    </div>
@endsection