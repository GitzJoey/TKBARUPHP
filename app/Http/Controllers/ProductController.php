<?php

namespace App\Http\Controllers;

use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Lookup;
use App\Product;
use App\ProductType;

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

        return view('product.create', compact('statusDDL', 'prodtypeDdL'));
    }

    public function store(Request $data)
    {
        if(Input::get('store')) {
            $this->dbStore($data);
        } elseif(Input::get('addunit')) {
            $this->addUnit($data);
        } elseif (Input::get('deleteunit')) {
            $this->deleteUnit($data);
        }
    }

    private function dbStore(Request $data)
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

            $product->product_type_id = $data['type'];
            $product->name = $data['name'];
            $product->short_code = $data['short_code'];
            $product->description = $data['description'];
            $product->status = $data['status'];
            $product->remarks = $data['remarks'];

            $product->save();

            return redirect(route('db.master.product'));
        }
    }

    private function addUnit(Request $data)
    {
        
    }

    private function deleteUnit(Request $data)
    {

    }

    public function edit($id)
    {
        $product = Product::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $prodtypeDdL = ProductType::get()->pluck('name', 'id');
        $selected = $product->type->id;

        return view('product.edit', compact('product', 'statusDDL', 'prodtypeDdL', 'selected'));
    }

    public function update($id, Request $req)
    {
        Product::find($id)->update($req->all());
        return redirect(route('db.master.product'));
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        return redirect(route('db.master.product'));
    }
}
