<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/21/2016
 * Time: 4:35 PM
 */

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Model\Unit;
use App\Model\Lookup;
use App\Model\Warehouse;
use App\Model\WarehouseSection;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $warehouse = Warehouse::paginate(10);
        return view('warehouse.index', compact('warehouse'));
    }

    public function show($id)
    {
        $warehouse = Warehouse::with('sections.capacityUnit')->find($id);

        return view('warehouse.show')->with('warehouse', $warehouse);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $unitDDL = Unit::whereStatus('STATUS.ACTIVE')->get()->pluck('unit_name', 'id');

        return view('warehouse.create', compact('statusDDL', 'unitDDL'));
    }

    public function store(Request $data)
    {
        $this->validate($data, [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_num' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $warehouse = new Warehouse();

        $warehouse->store_id = Auth::user()->store->id;
        $warehouse->name = $data['name'];
        $warehouse->address = $data['address'];
        $warehouse->phone_num = $data['phone_num'];
        $warehouse->status = $data['status'];
        $warehouse->remarks = $data['remarks'];
        $warehouse->save();

        for ($i = 0; $i < count($data['section_name']); $i++) {
            $ws = new WarehouseSection();

            $ws->store_id = Auth::user()->store->id;
            $ws->name = $data['section_name'][$i];
            $ws->position = $data['section_position'][$i];
            $ws->capacity = $data['section_capacity'][$i];
            $ws->capacity_unit_id = $data['section_capacity_unit'][$i];
            $ws->remarks = empty($data['section_remarks'][$i]) ? '' : $data['section_remarks'][$i];

            $warehouse->sections()->save($ws);
        }

        return redirect(route('db.master.warehouse'));
    }

    public function edit($id)
    {
        $warehouse = Warehouse::with('sections')->find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $unitDDL = Unit::whereStatus('STATUS.ACTIVE')->get()->pluck('unit_name', 'id');

        return view('warehouse.edit', compact('warehouse', 'statusDDL', 'unitDDL'));
    }

    public function update($id, Request $data)
    {
        $warehouse = Warehouse::find($id);

        $warehouse->sections()->delete();

        for ($i = 0; $i < count($data['section_name']); $i++) {
            $ws = new WarehouseSection();

            $ws->store_id = Auth::user()->store->id;
            $ws->name = $data['section_name'][$i];
            $ws->position = $data['section_position'][$i];
            $ws->capacity = $data['section_capacity'][$i];
            $ws->capacity_unit_id = $data['section_capacity_unit'][$i];
            $ws->remarks = empty($data['section_remarks'][$i]) ? '' : $data['section_remarks'][$i];

            $warehouse->sections()->save($ws);
        }

        $warehouse->store_id = Auth::user()->store->id;
        $warehouse->name = $data['name'];
        $warehouse->address = $data['address'];
        $warehouse->phone_num = $data['phone_num'];
        $warehouse->status = $data['status'];
        $warehouse->remarks = $data['remarks'];

        $warehouse->save();

        return redirect(route('db.master.warehouse'));
    }

    public function delete($id)
    {
        $warehouse = Warehouse::find($id);
        $warehouse->sections()->delete();
        $warehouse->delete();

        return redirect(route('db.master.warehouse'));
    }
}