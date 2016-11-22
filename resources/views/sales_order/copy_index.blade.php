@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.copy.title')
@endsection

@section('page_title')
    <span class="fa fa-copy fa-fw"></span>&nbsp;@lang('sales_order.copy.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.copy.page_title_desc')
@endsection

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('sales_order.copy.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label for="inputSOCode" class="col-sm-2 control-label">@lang('sales_order.field.so_code')</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputSoCode" placeholder="SO Code">
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('sales_order.copy.table.header.copy_code')</th>
                    <th class="text-center">@lang('sales_order.copy.table.header.remarks')</th>
                    <th class="text-center">@lang('labels.ACTION')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($copylist as $key => $c)
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-center" width="10%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.so.copy.show', $c->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.so.copy.edit', $c->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.so.copy.delete', $c->hId()], 'style'=>'display:inline'])  !!}
                                <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.so.copy.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $copylist->render() !!}
        </div>
    </div>
@endsection
