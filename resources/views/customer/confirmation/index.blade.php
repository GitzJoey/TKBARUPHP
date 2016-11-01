@extends('layouts.adminlte.master')

@section('title')
    @lang('customer.confirmation.index.title')
@endsection

@section('page_title')
    <span class="fa fa-smile-o fa-fw"></span>&nbsp;@lang('customer.confirmation.index.page_title')
@endsection
@section('page_title_desc')
    @lang('customer.confirmation.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('customer.confirmation.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('customer.confirmation.index.table.header.so_code')</th>
                        <th class="text-center">@lang('customer.confirmation.index.table.header.so_date')</th>
                        <th class="text-center">@lang('customer.confirmation.index.table.header.shipping_date')</th>
                        <th class="text-center">@lang('customer.confirmation.index.table.header.deliver_date')</th>
                        <th class="text-center">@lang('customer.confirmation.index.table.header.status')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($solist as $key => $so)
                    <tr>
                        <td class="text-center">{{ $so->code }}</td>
                        <td class="text-center">{{ $so->so_date }}</td>
                        <td class="text-center">{{ $so->shipping_date }}</td>
                        <td class="text-center"></td>
                        <td class="text-center">{{ $so->status }}</td>
                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.master.customer.show', $so->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.master.customer.edit', $so->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            {{ $solist->render() }}
        </div>
    </div>
@endsection
