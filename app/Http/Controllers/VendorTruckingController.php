<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/22/2016
 * Time: 3:29 AM
 */

namespace App\Http\Controllers;

use Auth;
use Config;
use Illuminate\Http\Request;

use App\Model\VendorTrucking;

use App\Repos\LookupRepo;

class VendorTruckingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vt = VendorTrucking::paginate(Config::get('const.PAGINATION'));
        return view('vendor_trucking.index', compact('vt'));
    }

    public function show($id)
    {
        $vt = VendorTrucking::find($id);
        return view('vendor_trucking.show')->with('vt', $vt);
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        return view('vendor_trucking.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $validator = $this->validate($data, [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'tax_id' => 'required|string|max:255',
            'status' => 'required',
        ]);

        VendorTrucking::create([
            'store_id' => Auth::user()->store->id,
            'name' => $data['name'],
            'address' => $data['address'],
            'tax_id' => $data['tax_id'],
            'status' => $data['status'],
            'remarks' => $data['remarks']
        ]);

        return response()->json();
    }

    public function edit($id)
    {
        $vt = VendorTrucking::find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        return view('vendor_trucking.edit', compact('vt', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = $this->validate($req, [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'tax_id' => 'required|string|max:255',
            'status' => 'required',
        ]);

        VendorTrucking::find($id)->update($req->all());

        return response()->json();
    }

    public function delete($id)
    {
        VendorTrucking::find($id)->delete();
        return redirect(route('db.master.vendor.trucking'));
    }
}
