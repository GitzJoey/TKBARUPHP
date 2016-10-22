<?php
@extends('layouts.adminlte.master')

@section('title')
    @lang('po.revise.index.title')
@endsection

@section('page_title')
    <span class="fa fa-code-fork fa-rotate-180 fa-fw"></span>&nbsp;@lang('po.revise.index.page_title')
@endsection
@section('page_title_desc')
    @lang('po.revise.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('po.revise.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('po.revise.index.table.header.code')</th>
                    <th class="text-center">@lang('po.revise.index.table.header.po_date')</th>
                    <th class="text-center">@lang('po.revise.index.table.header.supplier')</th>
                    <th class="text-center">@lang('po.revise.index.table.header.shipping_date')</th>
                    <th class="text-center">@lang('po.revise.index.table.header.status')</th>
                    <th class="text-center">@lang('labels.ACTION')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($purchaseOrders as $key => $po)
                    <tr>
                        <td class="text-center">{{ $po->code }}</td>
                        <td class="text-center">{{ $po->po_created }}</td>
                        <td class="text-center">{{ $po->tax_id }}</td>
                        <td class="text-center">{{ $po->phone }}</td>
                        <td class="text-center">{{ $po->remarks }}</td>
                        <td class="text-center" width="20%">
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
            <a class="btn btn-success" href="{{ route('db.master.supplier.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.revise')</a>
            {{ $supplier->render() }}
        </div>
    </div>
@endsection
