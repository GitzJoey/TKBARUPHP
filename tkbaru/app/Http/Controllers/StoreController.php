<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 9:46 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use App\Store;
use App\Lookup;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $store = Store::paginate(10);
        return view('store.index', compact('store'));
    }

    public function show($id)
    {
        $store = Store::find($id);
        return view('store.show')->with('store', $store);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $yesnoDDL = Lookup::where('category', '=', 'YESNOSELECT')->get()->pluck('description', 'code');

        return view('store.create', compact('statusDDL', 'yesnoDDL'));
    }

    public function store(Request $data)
    {
        $this->validate($data,[
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_num' => 'required|string|max:255',
            'tax_id' => 'required|string|max:255',
            'status' => 'required',
            'is_default' => 'required',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$data->image_path->getClientOriginalExtension();
        $path = public_path('images') . '/' . $imageName;

        error_log($path);

        Image::make($data->image_path->getRealPath())->resize(160, 160)->save($path);

        Store::create([
            'name'          => $data['name'],
            'address'       => $data['address'],
            'phone_num'     => $data['phone_num'],
            'fax_num'       => $data['fax_num'],
            'tax_id'        => $data['tax_id'],
            'status'        => $data['status'],
            'is_default'    => $data['is_default'],
            'image_filename'=> $imageName,
            'remarks'       => $data['remarks']
        ]);

        return redirect(route('db.admin.store'));
    }

    private function changeIsDefault()
    {

    }

    public function edit($id)
    {
        $store = Store::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $yesnoDDL = Lookup::where('category', '=', 'YESNOSELECT')->get()->pluck('description', 'code');

        return view('store.edit', compact('store', 'statusDDL', 'yesnoDDL'));
    }

    public function update($id, Request $req)
    {
        Store::find($id)->update($req->all());
        return redirect(route('db.admin.store'));
    }

    public function delete($id)
    {
        Store::find($id)->delete();
        return redirect(route('db.admin.store'));
    }
}