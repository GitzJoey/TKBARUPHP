@extends('layouts.adminlte.master')

@section('title')
    @lang('warehouse.stockopname.index.title')
@endsection

@section('page_title')
    <span class="fa fa-database fa-fw"></span>&nbsp;@lang('warehouse.stockopname.index.page_title')
@endsection

@section('page_title_desc')
    @lang('warehouse.stockopname.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('stockopname_index') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('warehouse.stockopname.index.header.title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <select id="whSelect" class="form-control">
                        <option value="">@lang('labels.SHOW_ALL')</option>
                        @foreach ($wh as $w)
                            <option value="{{ Hashids::encode($w->id)  }}" {{ Hashids::encode($w->id) == $selectedWH ? "selected":""  }}>{{ $w->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('warehouse.stockopname.index.table.header.warehouse')</th>
                        <th class="text-center">@lang('warehouse.stockopname.index.table.header.product')</th>
                        <th class="text-center">@lang('warehouse.stockopname.index.table.header.opname_date')</th>
                        <th class="text-center">@lang('warehouse.stockopname.index.table.header.current_quantity')</th>
                        <th class="text-center">@lang('labels.ACTION')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $key => $stock)
                        <tr>
                            <td>{{ $stock->warehouse->name }}</td>
                            <td>{{ $stock->product->name }}</td>
                            <td class="text-center">
                                {{ count($stock->stockOpnames) > 0 ? date('Y-m-d H:i A', strtotime($stock->stockOpnames()->orderBy('id', 'desc')->first(['opname_date'])['opname_date'])) : '' }}
                            </td>
                            <td class="text-center">
                                {{ $stock->current_quantity }}&nbsp;{{ $stock->product->baseUnitSymbol }}
                            </td>
                            <td class="text-center" width="10%">
                                <a class="btn btn-xs btn-primary" href="{{ route('db.warehouse.stockopname.adjust', $stock->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            {!! $stocks->render() !!}
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $(document).ready(function() {
            $('#whSelect').change(function() {
                window.location.href = '{{ route('db.warehouse.stockopname.index') }}' + '?w=' + $('#whSelect').val();
            }) ;
        });
    </script>
@endsection
