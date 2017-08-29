@extends('layouts.adminlte.master')

@section('title')
    @lang('tax.invoice.output.index.title')
@endsection

@section('page_title')
    <span class="fa fa-sign-out"></span>&nbsp;@lang('tax.invoice.output.index.page_title')
@endsection

@section('page_title_desc')
    @lang('tax.invoice.output.index.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('tax_invoice_input') !!}
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div id="taxVue">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('tax.invoice.output.index.header.title')</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">NPWP</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Nomor</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Masa</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Dapat dikreditkan</th>
                            <th class="text-center">DPP</th>
                            <th class="text-center">PPN</th>
                            <th class="text-center">PPnBM</th>
                            <th class="text-center">Grand Total</th>
                            <th class="text-center">@lang('labels.ACTION')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($taxes as $key => $tax)
                        <tr>
                            <td class="text-left">{{ $tax->opponent_tax_id_no }}</td>
                            <td class="text-left">{{ $tax->opponent_name }}</td>
                            <td class="text-center">{{ $tax->invoice_no }}</td>
                            <td class="text-center">{{ $tax->invoice_date }}</td>
                            <td class="text-right">{{ $tax->month }}</td>
                            <td class="text-right">{{ $tax->year }}</td>
                            <td class="text-right">{{ $tax->is_creditable == 0 ? 'Ya' : 'Tidak' }}</td>
                            <td class="text-right">{{ number_format($tax->tax_base) }}</td>
                            <td class="text-right">{{ number_format($tax->gst) }}</td>
                            <td class="text-right">{{ number_format($tax->luxury_tax) }}</td>
                            <td class="text-right">{{ number_format($tax->tax_base + $tax->gst + $tax->luxury_tax) }}</td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-info" href="{{ route('db.tax.invoice.input.show', $tax->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.tax.invoice.input.edit', $tax->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {{--  {!! Form::open(['method' => 'DELETE', 'route' => ['db.tax.invoice.input.delete', $tax->hId()], 'style'=>'display:inline'])  !!}  --}}
                                {{--  <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>  --}}
                                {{--  {!! Form::close() !!}  --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <a class="btn btn-success" href="{{ route('db.tax.invoice.input.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">

        var app = new Vue({
            el: '#taxVue',
            data:{
                taxes: JSON.parse('{!! htmlspecialchars_decode($taxes) !!}')
            },
            methods: {
            },
        });
    </script>
@endsection
