<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:35 AM
 */

namespace App\Http\Controllers;

use Auth;
use Config;
use Validator;
use Illuminate\Http\Request;

use App\Model\Truck;

use App\Repos\LookupRepo;

class TruckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $trucklist = Truck::paginate(Config::get('const.PAGINATION'));
        return view('truck.index', compact('trucklist'));
    }

    public function show($id)
    {
        $truck = Truck::find($id);
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $truckTypeDDL = LookupRepo::findByCategory('TRUCKTYPE')->pluck('i18nDescription', 'code');

        return view('truck.show', compact('statusDDL', 'truckTypeDDL'))->with('truck', $truck);
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $truckTypeDDL = LookupRepo::findByCategory('TRUCKTYPE')->pluck('i18nDescription', 'code');

        return view('truck.create', compact('statusDDL', 'truckTypeDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'plate_number' => 'required|string|max:255',
            'inspection_date' => 'required|string|max:255',
            'driver' => 'required|string|max:255',
            'status' => 'required',
        ])->validate();
        
        Truck::create([
            'store_id' => Auth::user()->store->id,
            'type' => $data['truck_type'],
            'plate_number' => $data['plate_number'],
            'inspection_date' => date('Y-m-d', strtotime($data->input('inspection_date '))),
            'driver' => $data['driver'],
            'status' => $data['status'],
            'remarks' => $data['remarks']
        ]);
        
        return response()->json();
            
    }

    public function edit($id)
    {
        $truck = Truck::find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $truckTypeDDL = LookupRepo::findByCategory('TRUCKTYPE')->pluck('i18nDescription', 'code');

        return view('truck.edit', compact('truck', 'statusDDL', 'truckTypeDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'plate_number' => 'required|string|max:255',
            'inspection_date' => 'required|string|max:255',
            'driver' => 'required|string|max:255',
            'status' => 'required',
        ])->validate();
        
        Truck::find($id)->update($req->all());

        return response()->json();
    }

    public function delete($id)
    {
        Truck::find($id)->delete();
        return redirect(route('db.master.truck'));
    }
}
