@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.revise.index.title')
@endsection

@section('page_title')
    <span class="fa fa-code-fork fa-rotate-180 fa-fw"></span>&nbsp;@lang('sales_order.revise.index.page_title')
@endsection
@section('page_title_desc')
    @lang('sales_order.revise.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('sales_order.revise.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('sales_order.revise.index.table.header.code')</th>
                    <th class="text-center">@lang('sales_order.revise.index.table.header.so_date')</th>
                    <th class="text-center">@lang('sales_order.revise.index.table.header.customer')</th>
                    <th class="text-center">@lang('sales_order.revise.index.table.header.shipping_date')</th>
                    <th class="text-center">@lang('sales_order.revise.index.table.header.status')</th>
                    <th class="text-center">@lang('labels.ACTION')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($salesorder as $key => $po)
                    <tr>
                        <td class="text-center">{{ $so->code }}</td>
                        <td class="text-center">{{ $so->po_created }}</td>
                        <td class="text-center">{{ $so->customer->name }}</td>
                        <td class="text-center">{{ $so->shipping_date }}</td>
                        <td class="text-center">{{ $soStatusDDL[$po->status] }}</td>
                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-primary" href="{{ route('db.po.revise', $so->hId()) }}" title="revise"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.po.reject', $so->hId()], 'style'=>'display:inline'])  !!}
                                <button type="submit" class="btn btn-xs btn-danger" title="reject" id="delete_button"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('custom_js')
    <script type="application/javascript">
        $('#delete_button').on('click',function(e){
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this sales order.",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, reject it!",
                closeOnConfirm: false
            }, function(isConfirm){
                if (isConfirm) form.submit();
            });
        });
    </script>
@endsection
