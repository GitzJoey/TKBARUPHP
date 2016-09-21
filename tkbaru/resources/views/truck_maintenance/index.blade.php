@extends('layouts.adminlte.master')

@section('title', 'truck Management')

@section('page_title')
    <span class="fa fa-truck fa-fw"></span>&nbsp;Truck
@endsection
@section('page_title_desc', '')

@section('custom_css')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('adminlte/css/select2.min.css') }}">
@endsection

@section('custom_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(".select2").select2();
    </script>
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('truck_maintenance.index.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.truck.maintenance.create') }}" method="post">
        {{ csrf_field() }}
        <div class="box-body">
            {{-- <div class="col-md-10"> --}}
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('truck.plate_number')</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="truck_id" style="width: 100%;" onchange="this.form.submit()">
                            <option>- @lang('truck_maintenance.select.option.default') -</option>
                            @foreach ($trucklist as $key => $truck)
                                @if(isset($idtruck))
                                <option value="{{ $truck->id }}" {{($idtruck->id==$truck->id)?'selected':''}}>{{ $truck->plate_number }}</option>
                                @else
                                <option value="{{ $truck->id }}">{{ $truck->plate_number }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                @if($idtruck)
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('truck_maintenance.maintenance_type')</label>
                    <div class="col-sm-10">
                        <input id="maintenance_type" name="maintenance_type" type="text" class="form-control" placeholder="maintenance_type">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">@lang('truck_maintenance.cost')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="cost" name="cost" placeholder="cost">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">@lang('truck_maintenance.odometer')</label>
                    <div class="col-sm-10">
                        <input id="odometer" name="odometer" type="text" class="form-control" placeholder="odometer">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">@lang('truck_maintenance.remarks')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="remarks">
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        {{-- <a href="{{ route('db.master.truck') }}" class="btn btn-default">Cancel</a> --}}
                        <button class="btn btn-default" type="submit">Submit</button>
                    </div>
                </div>
        </div>
        </form>
{{--         <div class="box-footer clearfix">
            <a class="btn btn-success" href="{{ route('db.master.truck.create') }}"><span class="fa fa-plus fa-fw"></span>&nbsp;@lang('truck.index.button.new_truck')</a>
        </div> --}}
    </div>
@endsection