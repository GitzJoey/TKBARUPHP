<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Config;
use Exception;
use Validator;
use App\Http\Requests;
use LaravelLocalization;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use App\Model\Unit;
use App\Model\Product;
use App\Model\ProductType;
use App\Model\ProductUnit;
use App\Model\ProductCategory;

use App\Repos\LookupRepo;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $req)
    {
        $product = [];
        if (!empty($req->query('p'))) {
            $param = $req->query('p');
            $product = Product::where('name', 'like', "%$param%")
                ->paginate(Config::get('const.PAGINATION'));
        } else {
            $product = Product::paginate(Config::get('const.PAGINATION'));
        }

        return view('product.index')->with('productlist', $product);
    }

    public function show($id)
    {
        $product = Product::find($id);

        return view('product.show')->with('product', $product);
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $prodtypeDdL = ProductType::get()->pluck('name', 'id');
        $unitDDL = Unit::whereStatus('STATUS.ACTIVE')->get()->pluck('unit_name', 'id');

        return view('product.create', compact('statusDDL', 'prodtypeDdL', 'unitDDL'));
    }

    public function store(Request $data)
    {
        Validator::make($data->all(), [
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ])->validate();

        if (count($data['unit_id']) == 0) {
            $rules = ['unit' => 'required'];
            $messages = ['unit.required' =>
                LaravelLocalization::getCurrentLocale() == "en" ?
                    "Please provide at least 1 unit.":
                    "Harap isi paling tidak 1 satuan"];
            Validator::make($data->all(), $rules, $messages)->validate();
        }

        $imageName = '';

        if (!empty($data['image_path'])) {
            $imageName = time() . '.' . $data['image_path']->getClientOriginalExtension();
            $path = public_path('images') . '/' . $imageName;

            Image::make($data->image_path->getRealPath())->resize(160, 160)->save($path);
        }

        DB::beginTransaction();
        try {
            $product = new Product;
            $product->store_id = Auth::user()->store->id;
            $product->product_type_id = $data['type'];
            $product->name = $data['name'];
            $product->image_path = $imageName;
            $product->short_code = $data['short_code'];
            $product->barcode = $data['barcode'];
            $product->minimal_in_stock = $data['minimal_in_stock'];
            $product->description = $data['description'];
            $product->status = $data['status'];
            $product->remarks = $data['remarks'];

            $product->save();

            for ($i = 0; $i < count($data['unit_id']); $i++) {
                $punit = new ProductUnit();
                $punit->unit_id = $data['unit_id'][$i];
                $punit->is_base = $data['is_base'][$i] === 'true' ? true : false;
                $punit->conversion_value = $data['conversion_value'][$i];
                $punit->remarks = empty($data['unit_remarks'][$i]) ? '' : $data['unit_remarks'][$i];

                $product->productUnits()->save($punit);
            }

            for ($j = 0; $j < count($data['cat_level']); $j++) {
                $pcat = new ProductCategory();
                $pcat->store_id = Auth::user()->store->id;
                $pcat->code = $data['cat_code'][$j];
                $pcat->name = $data['cat_name'][$j];
                $pcat->description = $data['cat_description'][$j];
                $pcat->level = $data['cat_level'][$j];

                $product->productCategories()->save($pcat);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return response()->json();
    }

    public function edit($id)
    {
        $product = Product::find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $prodtypeDdL = ProductType::get()->pluck('name', 'id');
        $unitDDL = Unit::whereStatus('STATUS.ACTIVE')->get()->pluck('unit_name', 'id');

        $selected = $product->type->id;

        return view('product.edit', compact('product', 'statusDDL', 'prodtypeDdL', 'selected', 'unitDDL'));
    }

    public function update($id, Request $data)
    {
        $validator = Validator::make($data->all(), [
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if (count($data['unit_id']) == 0) {
            $validator->getMessageBag()->add('unit', LaravelLocalization::getCurrentLocale() == "en" ? "Please provide at least 1 unit.":"Harap isi paling tidak 1 satuan");
            return redirect(route('db.master.product.create'))->withInput()->withErrors($validator);
        }

        if ($validator->fails()) {
            return redirect(route('db.master.product.create'))->withInput()->withErrors($validator);
        }

        DB::beginTransaction();

        try {
            $product = Product::find($id);

            if (!empty($product->image_path)) {
                if (!empty($data['image_path'])) {
                    $imageName = time() . '.' . $data['image_path']->getClientOriginalExtension();
                    $path = public_path('images') . '/' . $imageName;

                    Image::make($data['image_path']->getRealPath())->resize(160, 160)->save($path);
                } else {
                    $imageName = $product['image_path'];
                }
            } else {
                if (!empty($data['image_path'])) {
                    $imageName = time() . '.' . $data['image_path']->getClientOriginalExtension();
                    $path = public_path('images') . '/' . $imageName;

                    Image::make($data['image_path']->getRealPath())->resize(160, 160)->save($path);
                } else {
                    $imageName = '';
                }
            }

            $product->productUnits->each(function($pu) { $pu->delete(); });

            $pu = array();
            for ($i = 0; $i < count($data['unit_id']); $i++) {
                $punit = new ProductUnit();
                $punit->unit_id = $data['unit_id'][$i];
                $punit->is_base = $data['is_base'][$i] === 'true' ? true:false;
                $punit->conversion_value = $data['conversion_value'][$i];
                $punit->remarks = empty($data['unit_remarks'][$i]) ? '' : $data['unit_remarks'][$i];

                array_push($pu, $punit);
            }

            $product->productUnits()->saveMany($pu);

            $product->productCategories->each(function($pc) { $pc->delete(); });

            $pclist = array();
            for ($j = 0; $j  < count($data['cat_level']); $j++) {
                $pcat = new ProductCategory();
                $pcat->store_id = Auth::user()->store->id;
                $pcat->code = $data['cat_code'][$j];
                $pcat->name = $data['cat_name'][$j];
                $pcat->description = $data['cat_description'][$j];
                $pcat->level = $data['cat_level'][$j];

                array_push($pclist, $pcat);
            }

            $product->productCategories()->saveMany($pclist);

            $product->update([
                'product_type_id' => $data['type'],
                'name' => $data['name'],
                'short_code' => $data['short_code'],
                'description' => $data['description'],
                'image_path' => $imageName,
                'status' => $data['status'],
                'remarks' => $data['remarks'],
                'barcode' => $data['barcode'],
                'minimal_in_stock' => $data['minimal_in_stock'],
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return response()->json();
    }

    public function delete($id)
    {
        $product = Product::find($id);

        $product->productUnits->each(function($pu) { $pu->delete(); });
        $product->productCategories->each(function($pc) { $pc->delete(); });
        $product->delete();

        return redirect(route('db.master.product'));
    }
}
