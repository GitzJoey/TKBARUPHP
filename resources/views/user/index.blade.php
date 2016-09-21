@extends('layouts.adminlte.master')

@section('title')
    @lang('user.index.title')
@endsection

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;@lang('user.index.page_title')
@endsection
@section('page_title_desc')
    @lang('user.index.page_title_desc')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('user.index.header.title')</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">@lang('user.index.table.header.name')</th>
                        <th class="text-center">@lang('user.index.table.header.email')</th>
                        <th class="text-center">@lang('user.index.table.header.roles')</th>
                        <th class="text-center">@lang('user.index.table.header.store')</th>
                        <th class="text-center">@lang('user.index.table.header.type')</th>
                        <th class="text-center">@lang('user.index.table.header.allow_login')</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $key => $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @if(!empty($item->roles))
                                    @foreach($item->roles as $v)
                                       {{ $v->display_name }}
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $item->store->name }}</td>
                            <td>@lang('lookup.' . $item->userDetail->type)</td>
                            <td class="text-center">
                                @if($item->userDetail->allow_login)
                                    <span class="fa fa-check-square-o fa-fw"></span>
                                @else
                                    <span class="fa fa-square-o fa-fw"></span>
                                @endif
                            </td>
                            <td class="text-center" width="20%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.admin.user.show', $item->Hid()) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.admin.user.edit', $item->hId()) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.admin.user.delete', $item->hId()], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.admin.user.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('buttons.create_new_button')</a>
            {!! $user->render() !!}
        </div>
    </div>
@endsection