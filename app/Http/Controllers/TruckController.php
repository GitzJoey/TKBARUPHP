<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:35 AM
 */

namespace App\Http\Controllers;

use App\Truck;

class TruckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $truck = Truck::paginate(10);
        return view('truck.index')->with('truck', $truck);
    }

    public function show($id)
    {
        $truck = Truck::find($id);
        return view('truck.show')->with('truck', $truck);
    }

    public function create()
    {
        return view('truck.create');
    }

    public function truck($data)
    {
        Store::create([
            'truck_id'    => $data['truck_id'],
            'plate_number' => $data['plate_number'],
            'kir_date'     => $data['kir_date'],
            'driver'       => $data['driver'],
            'remarks'        => $data['remarks'],
            'created_by'        => $data['created_by'],
            'created_date'    => $data['created_date'],
            'updated_by'       => $data['updated_by'],
            'updated_date'       => $data['updated_date']
        ]);
    }

    private function changeIsDefault()
    {

    }

    public function edit($id)
    {
        $truck = Truck::find($id);
        return view('truck.edit')->with('truck', $truck);
    }

    public function update($id, Request $req)
    {
        Truck::find($id)->update($req->all());
        return redirect(route('db.master.truck'));
    }

    public function delete($id)
    {
        Truck::find($id)->delete();
        return redirect(route('db.master.truck'));
    }
}