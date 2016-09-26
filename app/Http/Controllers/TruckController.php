<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:35 AM
 */

namespace App\Http\Controllers;

use Auth;
use DateTime;
use Validator;
use Illuminate\Http\Request;

use App\Truck;
use App\Lookup;

class TruckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $trucklist = Truck::paginate(10);
        return view('truck.index', compact('trucklist'));
    }

    public function show($id)
    {
        $truck = Truck::find($id);
        return view('truck.show')->with('truck', $truck);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('truck.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(),[
            'plate_number' => 'required|string|max:255',
            'inspection_date' => 'required|string|max:255',
            'driver' => 'required|string|max:255',
            'status' => 'required',
            'remarks' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.master.truck.create'))->withInput()->withErrors($validator);
        } else {
            $date = DateTime::createFromFormat('Y-m-d', $data['inspection_date']);
            $usableDate = $date->format('Y-m-d H:i:s');

            Truck::create([
                'store_id' => Auth::user()->store->id,
                'plate_number' => $data['plate_number'],
                'inspection_date' => $usableDate,
                'driver'     => $data['driver'],
                'status'       => $data['status'],
                'remarks'        => $data['remarks']
            ]);
            return redirect(route('db.master.truck'));
        }
    }

    public function edit($id)
    {
        $truck = Truck::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('truck.edit', compact('truck', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(),[
            'plate_number' => 'required|string|max:255',
            'inspection_date' => 'required|string|max:255',
            'driver' => 'required|string|max:255',
            'status' => 'required',
            'remarks' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.master.truck.edit'))->withInput()->withErrors($validator);
        } else {
            Truck::find($id)->update($req->all());
            return redirect(route('db.master.truck'));
        }
    }

    public function delete($id)
    {
        Truck::find($id)->delete();
        return redirect(route('db.master.truck'));
    }
}