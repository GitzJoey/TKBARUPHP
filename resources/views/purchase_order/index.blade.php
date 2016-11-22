@extends('layouts.adminlte.master')

@section('title')
    @lang('purchase_order.revise.index.title')
@endsection

@section('page_title')
    <span class="fa fa-code-fork fa-rotate-180 fa-fw"></span>&nbsp;@lang('purchase_order.revise.index.page_title')
@endsection
@section('page_title_desc')
    @lang('purchase_order.revise.index.page_title_desc')
@endsection
@section('breadcrumbs')
    {!! Breadcrumbs::render('purchase_order') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('purchase_order.revise.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('purchase_order.revise.index.table.header.code')</th>
                    <th class="text-center">@lang('purchase_order.revise.index.table.header.po_date')</th>
                    <th class="text-center">@lang('purchase_order.revise.index.table.header.supplier')</th>
                    <th class="text-center">@lang('purchase_order.revise.index.table.header.shipping_date')</th>
                    <th class="text-center">@lang('purchase_order.revise.index.table.header.status')</th>
                    <th class="text-center">@lang('labels.ACTION')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($purchaseOrders as $key => $po)
                    <tr>
                        <td class="text-center">{{ $po->code }}</td>
                        <td class="text-center">{{ $po->po_created }}</td>
                        <td class="text-center">
                            @if($po->supplier_type == 'SUPPLIERTYPE.R')
                                {{ $po->supplier->name }}
                            @else
                                {{ $po->walk_in_supplier }}
                            @endif
                        </td>
                        <td class="text-center">{{ $po->shipping_date }}</td>
                        <td class="text-center">{{ $poStatusDDL[$po->status] }}</td>
                        <td class="text-center" width="10%">
                            <a class="btn btn-xs btn-primary" href="{{ route('db.po.revise', $po->hId()) }}" title="Revise"><span class="fa fa-pencil fa-fw"></span></a>
                            @if($po->status == 'POSTATUS.WA')
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.po.reject', $po->hId()], 'style'=>'display:inline'])  !!}
                                <button type="submit" class="btn btn-xs btn-danger" title="Reject" id="delete_button"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                            @else
                                <button type="submit" class="btn btn-xs btn-danger" title="Reject" id="delete_button" disabled><span class="fa fa-close fa-fw"></span></button>
                            @endif
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
                text: "You will not be able to recover this purchase order.",
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
