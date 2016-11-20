<?php

namespace App\Http\Controllers;

use App\Model\Price;
use App\Model\PriceLevel;
use App\Model\ProductType;
use App\Model\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
                'stocks.prices' => function($query){
                    $query->where('input_date', '>=', Carbon::today()->subDays(5))
                          ->orderBy('input_date', 'desc')
                          ->orderBy('price_level_id', 'asc');
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
        $priceLevels = PriceLevel::all(['id', 'name', 'increment_value']);

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

        $priceLevels->each(function ($priceLevel) use($prices, $stocks, $request){
            $stocks->each(function ($stock) use($prices, $priceLevel, $request){
                $prices->push([
                    'store_id'           => Auth::user()->store_id,
                    'stock_id'          => $stock->id,
                    'price_level_id'    => $priceLevel->id,
                    'input_date'        => $request->input('input_date'),
                    'market_price'      => $request->input('market_price'),
                    'price'             => $request->input('market_price') + $priceLevel->increment_value,
                    'status'            => 'PRICESTATUS.NEW'
                ]);
            });
        });

        Log::info($prices);
    }

    public function editStockPrice($id)
    {

    }

    public function updateStockPrice(Request $request, $id)
    {

    }
}
