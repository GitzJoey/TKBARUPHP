<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Model\Unit;
use App\Model\Lookup;
use App\Model\Product;
use App\Model\ProductUnit;
use App\Model\ProductType;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $product = Product::paginate(10);

        return view('product.index')->with('productlist', $product);
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('product.show')->with('product', $product);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $prodtypeDdL = ProductType::get()->pluck('name', 'id');
        $unitDDL = Unit::whereStatus('STATUS.ACTIVE')->get()->pluck('unit_name', 'id');

        return view('product.create', compact('statusDDL', 'prodtypeDdL', 'unitDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'short_code' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.master.product.create'))->withInput()->withErrors($validator);
        } else {

            $product = new Product;

            $product->store_id = Auth::user()->store->id;
            $product->product_type_id = $data['type'];
            $product->name = $data['name'];
            $product->short_code = $data['short_code'];
            $product->description = $data['description'];
            $product->status = $data['status'];
            $product->remarks = $data['remarks'];

            $product->save();

            for ($i = 0; $i < count($data['unit_id']); $i++) {
                $punit = new ProductUnit();
                $punit->unit_id = $data['unit_id'][$i];
                $punit->is_base = (bool)$data['is_base'][$i];
                $punit->conversion_value = $data['conversion_value'][$i];
                $punit->remarks = empty($data['remarks'][$i]) ? '' : $data['remarks'][$i];

                $product->productUnit()->save($punit);
            }

            return redirect(route('db.master.product'));
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $prodtypeDdL = ProductType::get()->pluck('name', 'id');
        $unitDDL = Unit::whereStatus('STATUS.ACTIVE')->get()->pluck('unit_name', 'id');

        $selected = $product->type->id;

        return view('product.edit', compact('product', 'statusDDL', 'prodtypeDdL', 'selected', 'unitDDL'));
    }

    public function update($id, Request $data)
    {
        $product = Product::find($id);

        $product->productUnit()->delete();

        $pu = array();
        for ($i = 0; $i < count($data['unit_id']); $i++) {
            $punit = new ProductUnit();
            $punit->unit_id = $data['unit_id'][$i];
            $punit->is_base = (bool)$data['is_base'][$i];
            $punit->conversion_value = $data['conversion_value'][$i];
            $punit->remarks = empty($data['remarks'][$i]) ? '' : $data['remarks'][$i];

            array_push($pu, $punit);
        }

        $product->productUnit()->saveMany($pu);

        $product->update([
            'product_type_id' => $data['type'],
            'name' => $data['name'],
            'short_code' => $data['short_code'],
            'description' => $data['description'],
            'status' => $data['status'],
            'remarks' => $data['remarks']
        ]);

        return redirect(route('db.master.product'));
    }

    public function delete($id)
    {
        $product = Product::find($id);

        $product->productUnit()->delete();
        $product->delete();

        return redirect(route('db.master.product'));
    }
}
