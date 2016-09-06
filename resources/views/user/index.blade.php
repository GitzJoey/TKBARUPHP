@extends('layouts.adminlte.master')

@section('title', 'User Management')

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;User
@endsection
@section('page_title_desc', '')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">User Lists</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Roles</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $key => $user)
                        <tr>
                            <td class="text-center">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->roles))
                                    @foreach($user->roles as $v)
                                        <label class="label label-success">{{ $v->display_name }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td class="text-center" width="20%">
                                <a class="btn btn-sm btn-info" href="{{ route('db.admin.user.show', $user->id) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-sm btn-primary" href="{{ route('db.admin.user.edit', $user->id) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.admin.user.delete', $user->id], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-sm btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.admin.user.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;New User</a>
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
    </div>
    {{--{!! $data->render() !!}--}}
@endsection