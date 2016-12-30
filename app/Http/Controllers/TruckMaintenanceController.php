<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

use App\Model\Truck;
use App\Model\Lookup;
use App\Model\TruckMaintenance;

class TruckMaintenanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $truck = Truck::get(['id', 'type', 'plate_number']);

        $truckId = $request->query('s');
        $trucklist = [];

        if (empty($truckId)) {
            $trucklist = TruckMaintenance::paginate(10);
        } else {
            if ($truckId != 'create') {
                $trucklist = TruckMaintenance::whereHas('truck', function($t) use($truckId) {
                    $t->whereId(Hashids::decode($truckId));
                })->paginate(10);
            }
        }

        return view('truck_maintenance.index', compact('truckId', 'truck', 'trucklist'));
    }

    public function create()
    {
        $mtctypeDDL = Lookup::where('category', '=', 'TRUCKMTCTYPE')->get()->pluck('code');
        $trucklist = Truck::get()->pluck('plate_number', 'id');

        return view('truck_maintenance.create', compact('mtctypeDDL', 'trucklist'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'plate_number' => 'required',
            'maintenance_type' => 'required',
            'cost' => 'required|numeric',
            'odometer' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.truck.maintenance.create'))->withInput()->withErrors($validator);
        } else {
            TruckMaintenance::create([
                'store_id' => Auth::user()->store->id,
                'truck_id' => $data['plate_number'],
                'maintenance_type' => $data['maintenance_type'],
                'cost' => $data['cost'],
                'odometer' => $data['odometer'],
                'remarks' => $data['remarks'],
            ]);

            return redirect(route('db.truck.maintenance'));
        }
    }

    public function edit($id)
    {
        $truckMtc = TruckMaintenance::find($id);

        $trucklist = Truck::get()->pluck('plate_number', 'id');
        $mtctypeDDL = Lookup::where('category', '=', 'TRUCKMTCTYPE')->get()->pluck('code');

        return view('truck_maintenance.edit', compact('truckMtc', 'trucklist', 'mtctypeDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'maintenance_type' => 'required',
            'cost' => 'required|numeric',
            'odometer' => 'required|numeric',
            'remarks' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect(route('db.truck.maintenance.edit', ['id' => $id]))->withInput()->withErrors($validator);
        } else {
            unset($req['plate_number']);
            TruckMaintenance::find($id)->update($req->all());
            return redirect(route('db.truck.maintenance'));
        }
    }
}
