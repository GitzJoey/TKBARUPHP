@extends('layouts.adminlte.master')

@section('title')
    @lang('expense_template.index.title')
@endsection

@section('page_title')
    <span class="fa fa-ticket fa-fw"></span>&nbsp;@lang('expense_template.index.page_title')
@endsection
@section('page_title_desc')
    @lang('expense_template.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('expense_template.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('expense_template.index.table.header.name')</th>
                    <th class="text-center">@lang('expense_template.index.table.header.type')</th>
                    <th class="text-center">@lang('expense_template.index.table.header.amount')</th>
                    <th class="text-center">@lang('expense_template.index.table.header.remarks')</th>
                    <th class="text-center">@lang('labels.ACTION')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($expenseTemplates as $key => $expenseTemplate)
                    <tr>
                        <td width="10%" class="valign-middle">{{ $expenseTemplate->name }}</td>
                        <td width="10%" class="text-center valign-middle">@lang('lookup.' . $expenseTemplate->type)</td>
                        <td width="10%" class="text-center valign-middle">{{ number_format($expenseTemplate->amount) }}</td>
                        <td width="10%" class="valign-middle">{{ $expenseTemplate->remarks }}</td>
                        <td class="text-center" width="10%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.master.expense_template.show', $expenseTemplate->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.master.expense_template.edit', $expenseTemplate->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.expense_template.delete', $expenseTemplate->hId()], 'style'=>'display:inline'])  !!}
                            <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.expense_template.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $expenseTemplates->render() !!}
        </div>
    </div>
@endsection