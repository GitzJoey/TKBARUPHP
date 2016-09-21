<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/22/2016
 * Time: 3:29 AM
 */

namespace App\Http\Controllers;

use App\Lookup;
use App\VendorTrucking;

use Illuminate\Http\Request;

class VendorTruckingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vt = VendorTrucking::paginate(10);
        return view('vendor_trucking.index', compact('vt'));
    }

    public function show($id)
    {
        $vt = VendorTrucking::find($id);
        return view('vendor_trucking.show')->with('vt', $vt);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('vendor_trucking.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $this->validate($data,[
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'tax_id' => 'required|string|max:255',
            'status' => 'required',
        ]);

        VendorTrucking::create([
            'name'          => $data['name'],
            'address'       => $data['address'],
            'tax_id'        => $data['tax_id'],
            'status'        => $data['status'],
            'remarks'       => $data['remarks']
        ]);

        return redirect(route('db.master.vendor.trucking'));
    }

    public function edit($id)
    {
        $vt = VendorTrucking::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('vendor_trucking.edit', compact('vt', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        VendorTrucking::find($id)->update($req->all());
        return redirect(route('db.master.vendor.trucking'));
    }

    public function delete($id)
    {
        VendorTrucking::find($id)->delete();
        return redirect(route('db.master.vendor.trucking'));
    }
}