<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/21/2016
 * Time: 4:35 PM
 */
namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Lookup;
use App\Warehouse;

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
        $warehouse = Warehouse::find($id);
        return view('warehouse.show')->with('warehouse', $warehouse);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('warehouse.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $this->validate($data,[
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_num' => 'required|string|max:255',
            'status' => 'required',
        ]);

        Warehouse::create([
            'name'          => $data['name'],
            'address'       => $data['address'],
            'phone_num'     => $data['phone_num'],
            'status'        => $data['status'],
            'remarks'       => $data['remarks']
        ]);

        return redirect(route('db.master.warehouse'));
    }

    public function edit($id)
    {
        $warehouse = Warehouse::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('warehouse.edit', compact('warehouse', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        Warehouse::find($id)->update($req->all());
        return redirect(route('db.master.warehouse'));
    }

    public function delete($id)
    {
        Warehouse::find($id)->delete();
        return redirect(route('db.master.warehouse'));
    }
}