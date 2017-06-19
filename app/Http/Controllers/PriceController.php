<?php

namespace App\Http\Controllers;

use App\Model\Price;
use App\Model\Stock;
use App\Model\PriceLevel;
use App\Model\ProductType;

use DB;
use Exception;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $productCategories = ProductType::with(
            [
                'stocks' => function($query){
                    $query->where('current_quantity', '>', 0);
                }
            ]
        )->whereHas('stocks', function ($query){
            $query->where('current_quantity', '>', 0);
        })->get();

        $priceLevels = PriceLevel::all(['id', 'name']);

        return view('price.index', compact('productCategories', 'priceLevels'));
    }

    public function editCategoryPrice($id)
    {
        $currentProductType = ProductType::find($id);
        $priceLevels = PriceLevel::all();

        return view('price.category', compact('currentProductType', 'priceLevels'));
    }

    public function updateCategoryPrice(Request $request, $id)
    {
        $stocks = Stock::whereHas('product', function ($query) use ($id){
            $query->where('product_type_id', '=', $id);
        })
        ->where('current_quantity', '>', 0)
        ->get();

        $priceLevels = PriceLevel::all(['id', 'increment_value']);

        $prices = collect([]);

        $stocks->each(function ($stock) use($prices, $priceLevels, $request){
            $priceLevels->each(function ($priceLevel, $key) use($prices, $stock, $request){
                $prices->push([
                    'store_id'          => Auth::user()->store_id,
                    'stock_id'          => $stock->id,
                    'price_level_id'    => $priceLevel->id,
                    'input_date'        => date('Y-m-d H:i', strtotime($request->input('input_date'))),
                    'market_price'      => floatval(str_replace(',', '', $request->input('market_price'))),
                    'price'             => floatval(str_replace(',', '', $request->input("price.$key"))),
                ]);
            });
        });

        Price::saveAll($prices);

        return redirect(route('db.price.today'));
    }

    public function editStockPrice($id)
    {
        $currentStock = Stock::find($id);
        $priceLevels = PriceLevel::all();

        return view('price.stock', compact('currentStock', 'priceLevels'));
    }

    public function updateStockPrice(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            for ($i = 0; $i < count($request['stock_id']); $i++) {
                $p = new Price();
                $p->store_id = Auth::user()->store_id;
                $p->stock_id = $request['stock_id'][$i];
                $p->price_level_id = $request['price_level_id'][$i];
                $p->input_date = date('Y-m-d H:i:s', strtotime($request['input_date'][$i]));
                $p->market_price = floatval(str_replace(',', '', $request['market_price'][$i]));
                $p->price = floatval(str_replace(',', '', $request['price'][$i]));

                $p->save();
            }
            DB::commit();
            return response()->json();
        } catch (Exception $e) {
            DB::rollBack();

            $rules = ['dbException' => 'required'];
            $messages = ['dbException.required' => $e->getMessage()];
            Validator::make($request->all(), $rules, $messages)->validate();
        }
    }
}
