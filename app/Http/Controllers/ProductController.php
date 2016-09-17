<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Product;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $prodlist = Product::paginate(10);
        return view('product.index', compact('prodlist'));
    }

    public function show($id)
    {
        $prod = Product::find($id);
        return view('product.show')->with('prod', $prod);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $prodTypeDDL = ProductType::get()->pluck('name', 'id');

        return view('product.create', compact('statusDDL', 'prodTypeDDL'));
    }
}
