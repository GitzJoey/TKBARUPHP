<?php

namespace App\Http\Controllers;

use Auth;
use Config;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

use App\Model\Truck;
use App\Model\TruckMaintenance;

use App\Repos\LookupRepo;

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
            $trucklist = TruckMaintenance::paginate(Config::get('const.PAGINATION'));
        } else {
            if ($truckId != 'create') {
                $trucklist = TruckMaintenance::whereHas('truck', function($t) use($truckId) {
                    $t->whereId(Hashids::decode($truckId));
                })->paginate(Config::get('const.PAGINATION'));
            }
        }

        return view('truck_maintenance.index', compact('truckId', 'truck', 'trucklist'));
    }

    public function create()
    {
        $mtctypeDDL = LookupRepo::findByCategory('TRUCKMTCTYPE')->pluck('i18nDescription', 'code');
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
        ])->validate();

        TruckMaintenance::create([
            'store_id' => Auth::user()->store->id,
            'truck_id' => $data['plate_number'],
            'maintenance_date' => date('Y-m-d H:i:s', strtotime($data['maintenance_date'])),
            'maintenance_type' => $data['maintenance_type'],
            'cost' => $data['cost'],
            'odometer' => $data['odometer'],
            'remarks' => $data['remarks'],
        ]);

        return response()->json();
            
    }

    public function edit($id)
    {
        $truckMtc = TruckMaintenance::find($id);

        $trucklist = Truck::get()->pluck('plate_number', 'id');
        $mtctypeDDL = LookupRepo::findByCategory('TRUCKMTCTYPE')->pluck('i18nDescription', 'code');

        return view('truck_maintenance.edit', compact('truckMtc', 'trucklist', 'mtctypeDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'maintenance_type' => 'required',
            'cost' => 'required|numeric',
            'odometer' => 'required|numeric',
            'remarks' => 'required',
        ])->validate();

        unset($req['plate_number']);
        TruckMaintenance::find($id)->update($req->all());

        return response()->json();
    }
}
