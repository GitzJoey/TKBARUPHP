@extends('layouts.adminlte.master')

@section('title', 'truck Management')

@section('page_title')
    <span class="fa fa-truck fa-fw"></span>&nbsp;User
@endsection
@section('page_title_desc', '')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Truck Lists</h3>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">truck_id</th>
                        <th class="text-center">plate_number</th>
                        <th class="text-center">kir_date</th>
                        <th class="text-center">driver</th>
                        <th class="text-center">remarks</th>
                        <th class="text-center">created_by</th>
                        <th class="text-center">created_date</th>
                        <th class="text-center">updated_by</th>
                        <th class="text-center">updated_date</th>
                        <th class="text-center">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($truck as $key => $truck)
                        <tr>
                            <td class="text-center">{{ $truck->truck_id }}</td>
                            <td class="text-center">{{ $truck->plate_number }}</td>
                            <td>{{ $truck->kir_date }}</td>
                            <td>{{ $truck->driver }}</td>
                            <td>{{ $truck->remarks }}</td>
                            <td>{{ $truck->created_by }}</td>
                            <td>{{ $truck->created_date }}</td>
                            <td>{{ $truck->remarks }}</td>
                            <td>{{ $truck->updated_by }}</td>

                            <td class="text-center" width="20%">
                                <a class="btn btn-xs btn-info" href="{{ route('db.master.truck.show', $truck->id) }}"><span class="fa fa-info fa-fw"></span></a>
                                <a class="btn btn-xs btn-primary" href="{{ route('db.master.truck.edit', $truck->id) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.truck.delete', $truck->id], 'style'=>'display:inline'])  !!}
                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.truck.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;New truck</a>
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>
    </div>
@endsection