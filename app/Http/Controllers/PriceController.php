<?php

namespace App\Http\Controllers;

use App\Model\Price;
use App\Model\Stock;
use App\Model\PriceLevel;
use App\Model\ProductType;

use DB;
use File;
use Hashids;
use Exception;
use Validator;
use Carbon\Carbon;
use LaravelLocalization;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use App\Services\ReportService;

class PriceController extends Controller
{
    private $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
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

        foreach($stocks as $stock ) {
            $sInputDate = date('Y-m-d H:i:s', strtotime($request['inputed_date']));

            if(count($stock->latestPrices()) != 0) {
                if (Carbon::parse($sInputDate)->diffInSeconds($stock->latestPrices()->first()->input_date) < 60) {
                    $rules = ['inputDateSameDateTime' => 'required'];
                    $messages = ['inputDateSameDateTime.required' =>
                        LaravelLocalization::getCurrentLocale() == "en" ?
                            "Please Wait 60 Seconds To Update The Price":
                            "Harap Tunggu 60 Detik Untuk Mengupdate Harga"];
                    Validator::make($request->all(), $rules, $messages)->validate();
                }
            }

            for ($i = 0; $i < count($request['price_level_id']); $i++) {
                $prices->push([
                    'store_id'          => Auth::user()->store_id,
                    'stock_id'          => $stock->id,
                    'price_level_id'    => $request['price_level_id'][$i],
                    'input_date'        => $sInputDate,
                    'market_price'      => floatval(str_replace(',', '', $request['inputed_market_price'])),
                    'price'             => floatval(str_replace(',', '', $request['price'][$i])),
                ]);
            }
        }

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

        for ($i = 0; $i < count($request['stock_id']); $i++) {
            $sId = $request['stock_id'][$i];
            $sInputDate = date('Y-m-d H:i:s', strtotime($request['input_date'][$i]));

            if (count(Stock::whereId($sId)->first()->latestPrices()) != 0) {
                if (Carbon::parse($sInputDate)
                        ->diffInDays(Stock::whereId($sId)->first()->latestPrices()->
                        first()->input_date) < 60) {
                    $rules = ['inputDateSameDateTime' => 'required'];
                    $messages = ['inputDateSameDateTime.required' =>
                        LaravelLocalization::getCurrentLocale() == "en" ?
                            "Please Wait 60 Seconds To Update The Price" :
                            "Harap Tunggu 60 Detik Untuk Mengupdate Harga"];
                    Validator::make($request->all(), $rules, $messages)->validate();
                }
            }
        }

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

        return empty(Price::orderBy('input_date', 'desc')->first()) ? '': Price::orderBy('input_date', 'desc')->first()->input_date;
    }

    public function download(Request $request, PDF $pdf)
    {
        Log::info("[PriceController@download]");

        $this->reportService->doReportHousekeeping();

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $selectedPriceLevel = HashIds::decode($request->query('pl'))[0];

        $reportType = strtoupper($request->query('f'));

        $productCategories = ProductType::with(
            [
                'stocks' => function($query){
                    $query->where('current_quantity', '>', 0);
                }
            ]
        )->whereHas('stocks', function ($query){
            $query->where('current_quantity', '>', 0);
        })->get();

        $priceLevels = PriceLevel::all(['id', 'name'])->where('id', $selectedPriceLevel);

        $todayPriceReport = $this->reportService->getTodayPriceList(
            $productCategories, $priceLevels, $selectedPriceLevel, null);

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Today_Price_" . $reportDate->format('Ymd');

        $pdf->loadView('report_template.today_price_report',
            compact('todayPriceReport', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($todayPriceReport, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($todayPriceReport, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.today_price_report',
                    compact('todayPriceReport', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        if ($reportType == 'PDF') {
            return response()->download(storage_path("app/public/reports/").$fileName.'.pdf', $fileName.'.pdf', [ 'Content-Type' => 'application/pdf' ]);
        } else if ($reportType == 'XLS') {
            return response()->download(storage_path('app/public/reports/').$fileName.'.xlsx',$fileName.'.xlsx', [ 'Content-Type' => 'application/octet-stream' ]);
        } else {
            return redirect()->action('ReportController@view', ['fileName' => $fileName]);
        }
    }
}
