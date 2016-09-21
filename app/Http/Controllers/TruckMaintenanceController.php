<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Truck;
use App\Lookup;
use App\TruckMaintenance;

class TruckMaintenanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
		$trucklist = TruckMaintenance::paginate(10);
        return view('truck_maintenance.index', compact('trucklist'));
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'TRUCKMTCTYPE')->get()->pluck('code');
		$trucklist = Truck::get()->pluck('plate_number', 'id');

        return view('truck_maintenance.create', compact('statusDDL','trucklist'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(),[
            'plate_number'      => 'required',
            'maintenance_type' => 'required',
            'cost'             => 'required|numeric',
            'odometer'         => 'required|numeric',
            'remarks'          => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.master.truck.maintenance.create'))->withInput()->withErrors($validator);
        } else {
            $data['truck_id'] = $data->plate_number;
            unset($data['plate_number']);
            TruckMaintenance::create($data->all());
            return redirect(route('db.master.truck.maintenance'));
        }
    }

    public function edit($id)
    {
        $truck = TruckMaintenance::find($id);
        $trucklist = Truck::get()->pluck('plate_number', 'id');

        $statusDDL = Lookup::where('category', '=', 'TRUCKMTCTYPE')->get()->pluck('code');
        return view('truck_maintenance.edit', compact('truck','trucklist', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(),[
            'maintenance_type' => 'required',
            'cost'             => 'required|numeric',
            'odometer'         => 'required|numeric',
            'remarks'          => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('db.master.truck.maintenance.edit', ['id' => $id]))->withInput()->withErrors($validator);
        } else {
            unset($req['plate_number']);
            TruckMaintenance::find($id)->update($req->all());
            return redirect(route('db.master.truck.maintenance'));
        }
    }
}
