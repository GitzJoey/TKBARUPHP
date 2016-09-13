<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:35 AM
 */

namespace App\Http\Controllers;

use \DateTime;
use Illuminate\Http\Request;
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

    public function store(Request $data)
    {
        $date = DateTime::createFromFormat('Y-m-d', $data['inspection_date']);
        $usableDate = $date->format('Y-m-d H:i:s');

        Truck::create([
            'plate_number' => $data['plate_number'],
            'inspection_date' => $usableDate,
            'driver'     => $data['driver'],
            'status'       => $data['status'],
            'remarks'        => $data['remarks']
        ]);
        return redirect(route('db.master.truck'));
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