@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.index.title')
@endsection

@section('page_title')
    <span class="fa fa-building-o fa-fw"></span>&nbsp;@lang('supplier.index.page_title')
@endsection
@section('page_title_desc')
    @lang('supplier.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('supplier.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('supplier.index.table.header.name')</th>
                    <th class="text-center">@lang('supplier.index.table.header.address')</th>
                    <th class="text-center">@lang('supplier.index.table.header.tax_id')</th>
                    <th class="text-center">@lang('supplier.index.table.header.status')</th>
                    <th class="text-center">@lang('supplier.index.table.header.remarks')</th>
                    <th class="text-center">@lang('labels.ACTION')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($supplier as $key => $supp)
                    <tr>
                        <td width="15%" class="text-center">{{ $supp->name }}</td>
                        <td width="20%" class="text-center">{{ $supp->address }}</td>
                        <td width="15%" class="text-center">{{ $supp->tax_id }}</td>
                        <td witdh="10%" class="text-center">@lang('lookup.'.$supp->status)</td>
                        <td width="30%" class="text-center">{{ $supp->remarks }}</td>
                        <td width="10%" class="text-center">
                            <a class="btn btn-xs btn-info" href="{{ route('db.master.supplier.show', $supp->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.master.supplier.edit', $supp->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.supplier.delete', $supp->hId()], 'style'=>'display:inline'])  !!}
                                <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.supplier.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {{ $supplier->render() }}
        </div>
    </div>
@endsection
