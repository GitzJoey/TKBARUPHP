@extends('layouts.adminlte.master')

@section('title')
    @lang('sales_order.payment.broughtforward.title')
@endsection

@section('page_title')
    <span class="fa fa-arrow-circle-right fa-fw"></span>&nbsp;@lang('sales_order.payment.broughtforward.page_title')
@endsection

@section('page_title_desc')
    @lang('sales_order.payment.broughtforward.page_title_desc')
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('sales_order_payment_broughtforward', $currentSo->hId()) !!}
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>@lang('labels.GENERAL_ERROR_TITLE')</strong> @lang('labels.GENERAL_ERROR_DESC')<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="soPaymentVue">
        {!! Form::model($currentSo, ['method' => 'POST', 'route' => ['db.so.payment.bf', $currentSo->hId()], 'class' => 'form-horizontal', 'data-parsley-validate' => 'parsley']) !!}
            {{ csrf_field() }}
        {!! Form::close() !!}
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript">
    </script>
@endsection