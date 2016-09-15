@extends('layouts.adminlte.master')

@section('title')
    @lang('role.index.title')
@endsection

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;@lang('role.index.page_title')
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


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->display_name }}</td>
                <td>{{ $role->description }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                    @permission('role-edit')
                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                    @endpermission
                    @permission('role-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endpermission
                </td>
            </tr>
        @endforeach
    </table>
    {!! $roles->render() !!}
@endsection