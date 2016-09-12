<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 9:46 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $store = Store::paginate(10);
        return view('store.index')->with('store', $store);
    }

    public function show($id)
    {
        $store = Store::find($id);
        return view('store.show')->with('store', $store);
    }

    public function create()
    {
        return view('store.create');
    }

    public function store(Request $data)
    {
        Store::create([
            'store_name'    => $data['store_name'],
            'store_address' => $data['store_address'],
            'phone_num'     => $data['phone_num'],
            'fax_num'       => $data['fax_num'],
            'tax_id'        => $data['tax_id'],
            'status'        => '',//$data['status'],
            'is_default'    => 1,//$data['is_default'],
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
        return view('store.edit')->with('store', $store);
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