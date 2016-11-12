@extends('layouts.adminlte.master')

@section('title')
    @lang('giro.index.title')
@endsection

@section('page_title')
    <span class="fa fa-giro fa-fw"></span>&nbsp;@lang('giro.index.page_title')
@endsection
@section('page_title_desc')
    @lang('giro.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('giro.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('giro.index.table.header.bank')</th>
                    <th class="text-center">@lang('giro.index.table.header.serial_number')</th>
                    <th class="text-center">@lang('giro.index.table.header.effective_date')</th>
                    <th class="text-center">@lang('giro.index.table.header.amount')</th>
                    <th class="text-center">@lang('giro.index.table.header.printed_name')</th>
                    <th class="text-center">@lang('giro.index.table.header.status')</th>
                    <th class="text-center">@lang('giro.index.table.header.remarks')</th>
                    <th class="text-center">@lang('labels.ACTION')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($girolist as $key => $giro)
                    <tr>
                        <td class="text-center">{{ $giro->bank->name }}</td>
                        <td class="text-center">{{ $giro->serial_number }}</td>
                        <td>{{ $giro->amount }}</td>
                        <td>{{ $giro->printed_name }}</td>
                        <td>@lang('lookup.' . $giro->status)</td>
                        <td>{{ $truck->remarks }}</td>
                        <td class="text-center" width="10%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.bank.giro.show', $giro->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.bank.giro.edit', $giro->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.bank.giro.delete', $giro->hId()], 'style'=>'display:inline'])  !!}
                                <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.truck.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $girolist->render() !!}
        </div>
    </div>
@endsection