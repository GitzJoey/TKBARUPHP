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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [ 'except' => [ 'getLastUpdate' ] ]);
    }

    public function index()
    {
        Log::info("[PriceController@index]");

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
        Log::info("[PriceController@index]");

        $currentProductType = ProductType::find($id);
        $priceLevels = PriceLevel::all();
        $stocks = Stock::whereHas('product', function ($query) use ($id) {
            $query->where('product_type_id', '=', $id);
        })->where('current_quantity', '>', 0)->get();

        return view('price.category', compact('currentProductType', 'priceLevels', 'stocks'));
    }

    public function updateCategoryPrice(Request $request, $id)
    {
        Log::info("[PriceController@updateCategoryPrice]");

        $stocks = Stock::whereHas('product', function ($query) use ($id){
            $query->where('product_type_id', '=', $id);
        })->where('current_quantity', '>', 0)->get();

        $prices = collect([]);

        $stocks->each(function ($stock) use($prices, $request) {
            for ($i = 0; $i < count($request['price_level_id']); $i++) {
                $prices->push([
                    'store_id'          => Auth::user()->store_id,
                    'stock_id'          => $stock->id,
                    'price_level_id'    => $request['price_level_id'][$i],
                    'input_date'        => date('Y-m-d H:i:s', strtotime($request['inputed_date'])),
                    'market_price'      => floatval(str_replace(',', '', $request['inputed_market_price'])),
                    'price'             => floatval(str_replace(',', '', $request['price'][$i])),
                ]);
            }
        });

        Price::saveAll($prices);

        return redirect(route('db.price.today'));
    }

    public function editStockPrice($id)
    {
        Log::info("[PriceController@editStockPrice]");

        $currentStock = Stock::find($id);
        $priceLevels = PriceLevel::all();

        return view('price.stock', compact('currentStock', 'priceLevels'));
    }

    public function updateStockPrice(Request $request, $id)
    {
        Log::info("[PriceController@updateStockPrice]");

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

    public function getLastUpdate()
    {
        Log::info("[PriceController@getLastUpdate]");

        return Price::orderBy('input_date', 'desc')->first()->input_date;
    }
}
