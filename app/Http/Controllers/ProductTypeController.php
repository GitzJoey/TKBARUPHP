<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/22/2016
 * Time: 6:31 AM
 */

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Lookup;
use App\ProductType;

class ProductTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $prodtype = ProductType::paginate(10);
        return view('product_type.index', compact('prodtype'));
    }

    public function show($id)
    {
        $prodtype = ProductType::find($id);
        return view('product_type.show')->with('prodtype', $prodtype);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('product_type.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $this->validate($data,[
            'name' => 'required|string|max:255',
            'short_code' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required',
        ]);

        ProductType::create([
            'name'          => $data['name'],
            'short_code'    => $data['short_code'],
            'description'   => $data['description'],
            'status'        => $data['status'],
        ]);

        return redirect(route('db.master.producttype'));
    }

    public function edit($id)
    {
        $prodtype = ProductType::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('product_type.edit', compact('prodtype', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        ProductType::find($id)->update($req->all());
        return redirect(route('db.master.producttype'));
    }

    public function delete($id)
    {
        ProductType::find($id)->delete();
        return redirect(route('db.master.producttype'));
    }
}