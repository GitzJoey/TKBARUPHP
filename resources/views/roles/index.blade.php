@extends('layouts.adminlte.master')

@section('title')
    @lang('role.index.title')
@endsection

@section('page_title')
    <span class="fa fa-key fa-fw"></span>&nbsp;@lang('role.index.page_title')
@endsection
@section('page_title_desc')
    @lang('role.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('role.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">@lang('role.index.table.header.name')</th>
                    <th class="text-center">@lang('role.index.table.header.description')</th>
                    <th class="text-center">@lang('role.index.table.header.permission')</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($rolelist as $key => $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            <select multiple class="form-control" readonly>
                                @foreach($role->permissionList as $key => $p)
                                    <option>{{ $p->display_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="text-center" width="20%">
                            <a class="btn btn-xs btn-info" href="{{ route('db.admin.roles.show', $role->hId()) }}"><span class="fa fa-info fa-fw"></span></a>
                            <a class="btn btn-xs btn-primary" href="{{ route('db.admin.roles.edit', $role->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.admin.roles.delete', $role->hId()], 'style'=>'display:inline'])  !!}
                                <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.admin.roles.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $rolelist->render() !!}
        </div>
    </div>
@endsection