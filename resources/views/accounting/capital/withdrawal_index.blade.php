@extends('layouts.adminlte.master')

@section('title')
    @lang('accounting.capital.withdrawal.index.title')
@endsection

@section('page_title')
    <span class="fa fa-circle-o fa-fw"></span>&nbsp;@lang('accounting.capital.withdrawal.index.page_title')
@endsection

@section('page_title_desc')
    @lang('accounting.capital.withdrawal.index.page_title_desc')
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
            <h3 class="box-title">@lang('accounting.capital.withdrawal.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" width="20%">@lang('accounting.capital.withdrawal.index.table.header.date')</th>
                        <th class="text-center" width="20%">@lang('accounting.capital.withdrawal.index.table.header.source_account')</th>
                        <th class="text-center" width="10%">@lang('accounting.capital.withdrawal.index.table.header.amount')</th>
                        <th class="text-center" width="20%">@lang('accounting.capital.withdrawal.index.table.header.remarks')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($capwith as $key => $cw)
                        <tr>
                            <td>{{ $cw->date }}</td>
                            <td>{{ $cw->cashAccount->codeAndName }}</td>
                            <td>{{ $cw->amount }}</td>
                            <td>{{ $cw->remarks }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.acc.capital.withdrawal.add') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $capwith->render() !!}
        </div>
    </div>
@endsection