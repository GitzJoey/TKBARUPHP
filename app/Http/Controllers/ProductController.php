<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Product;
use App\Lookup;
use Validator;

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

        return view('product.create', compact('statusDDL'));
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

            Product::create([
                'store_id' => $data['store_id'],
                'product_type_id' => $data['product_type_id'],
                'type' => $data['type'],
                'name' => $data['name'],
                'short_code' => $data['short_code'],
                'description' => $data['description'],
                'image_path' => $data['image_path'],
                'status' => $data['status'],
                'remarks' => $data['remarks']
            ]);
            return redirect(route('db.master.product'));
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('product.edit', compact('product', 'statusDDL'));
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
