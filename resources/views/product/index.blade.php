@extends('layouts.adminlte.master')

@section('title')
    @lang('product.index.title')
@endsection

@section('page_title')
    <span class="fa fa-cubes fa-fw"></span>&nbsp;@lang('product.index.page_title')
@endsection

@section('page_title_desc')
    @lang('product.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('master_product') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('product.index.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <input id="inputSearch" type="text" class="form-control" placeholder="Search" value="{{ Request::query('p') }}">
                </div>
                <div class="col-md-8">
                    <button id="btnSearch" class="btn btn-default"><span class="fa fa-search-plus fa-fw"></span></button>
                </div>
            </div>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('product.index.table.header.type')</th>
                        <th class="text-center">@lang('product.index.table.header.name')</th>
                        <th class="text-center">@lang('product.index.table.header.short_code')</th>
                        <th class="text-center">@lang('product.index.table.header.description')</th>
                        <th class="text-center">@lang('product.index.table.header.status')</th>
                        <th class="text-center">@lang('product.index.table.header.remarks')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productlist as $key => $product)
                        <tr>
                            <td width="10%">{{ empty($product->type) ? '':$product->type->name }}</td>
                            <td width="20%">{{ $product->name }}</td>
                            <td width="10%" class="text-center">{{ $product->short_code }}</td>
                            <td width="20%">{{ $product->description }}</td>
                            <td width="10%" class="text-center">@lang('lookup.'.$product->status)</td>
                            <td width="15%">{{ $product->remarks }}</td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.master.product.show', $product->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.master.product.edit', $product->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.product.delete', $product->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.product.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $productlist->render() !!}
       </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function () {
            $('#btnSearch').click(function() {
                window.location.href = '{{ route('db.master.product') }}' + '?p=' + $('#inputSearch').val();
            });

            $('#inputSearch').focus(function() {
                $(this).select();
            }).keyup(function(e) {
                if (e.keyCode == 13) {
                    $('#btnSearch').click();
                }
            })
        });
    </script>
@endsection