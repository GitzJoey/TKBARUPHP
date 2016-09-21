@extends('layouts.adminlte.master')

@section('title', 'User Management')

@section('custom_css')
    <style type="text/css">
        .control-label-normal {
            font-weight: 400;
            display:inline-block;
        }
    </style>
@endsection

@section('page_title')
    <span class="fa fa-user fa-fw"></span>&nbsp;User
@endsection
@section('page_title_desc', '')

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $user->name }}</h3>
        </div>
        <div class="box-body">
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputId" class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10">
                            <label id="inputId" class="control-label">
                                <span class="control-label-normal">{{ $user->id }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <label id="inputId" class="control-label">
                                <span class="control-label-normal">{{ $user->name }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <label id="inputEmail" class="control-label control-label-normal">
                                <span class="control-label-normal">{{ $user->email }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRoles" class="col-sm-2 control-label">Roles</label>
                        <div class="col-sm-10">
                            <label id="inputEmail" class="control-label control-label-normal">
                                <span class="control-label-normal"></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputButton" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <a href="{{ route('db.admin.user') }}" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                </div>
            </form>
        </div>
    </div>
@endsection