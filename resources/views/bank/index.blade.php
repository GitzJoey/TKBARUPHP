@extends('layouts.adminlte.master')

@section('title')
    @lang('bank.index.title')
@endsection

@section('page_title')
    <span class="fa fa-bank fa-fw"></span>&nbsp;@lang('bank.index.page_title')
@endsection

@section('page_title_desc')
    @lang('bank.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('bank.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('bank.index.table.header.name')</th>
                    <th class="text-center">@lang('bank.index.table.header.short_name')</th>
                    <th class="text-center">@lang('bank.index.table.header.branch')</th>
                    <th class="text-center">@lang('bank.index.table.header.branch_code')</th>
                    <th class="text-center">@lang('bank.index.table.header.status')</th>
                    <th class="text-center">@lang('bank.index.table.header.remarks')</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($banks as $key => $bank)
                    <tr>
                        <td>{{ $bank->name }}</td>
                        <td>{{ $bank->short_name }}</td>
                        <td class="text-center">{{ $bank->branch }}</td>
                        <td class="text-center">{{ $bank->branch_code }}</td>
                        <td class="text-center">@lang('lookup.' . $bank->status)</td>
                        <td>{{ $bank->remarks }}</td>
                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.master.bank.show', $bank->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.master.bank.edit', $bank->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.bank.delete', $bank->hId()], 'style'=>'display:inline'])  !!}
                                <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.bank.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $banks->render() !!}
        </div>
    </div>
@endsection
