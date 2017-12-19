<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

use App\Model\Lookup;
use App\Model\Product;
use App\Model\Warehouse;
use App\Model\SalesOrder;
use App\Model\VendorTrucking;

use App\Services\StockService;
use App\Services\SalesOrderService;

use App\Util\SOCodeGenerator;

use App\Repos\LookupRepo;

use App;
use Config;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class SalesOrderController extends Controller
{
    private $salesOrderService;
    private $stockService;

    public function __construct(
        SalesOrderService $salesOrderService,
        StockService $stockService)
    {
        $this->salesOrderService = $salesOrderService;
        $this->stockService = $stockService;
        $this->middleware('auth', [
            'except' => [
                'getDueSO',
                'getUndeliveredSO',
                'getNumberOfCreatedSOPerDay',
                'getTotalSOAmountPerDay',
                'getSOByDate',
                'getTop10Customer',
                'getTop10WalkInCustomer',
            ]
        ]);
    }

    public function create()
    {
        Log::info('SalesOrderController@create');

        $stocksDDL = $this->stockService->getStocksForSO();
        $warehouseDDL = Warehouse::all(['id', 'name']);
        $vendorTruckingDDL = VendorTrucking::all(['id', 'name']);
        $productDDL = Product::with('productUnits.unit')->get();
        $soTypeDDL = LookupRepo::findByCategory('SOTYPE');
        $customerTypeDDL = LookupRepo::findByCategory('CUSTOMERTYPE');
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');
        $soStatusDraft = Lookup::where('code', '=', 'SOSTATUS.D')->get(['description', 'code']);
        $soCode = SOCodeGenerator::generateCode();

        $userSOs = session(Config::get('const.SESSION.USER_SO_LIST'), collect([]));

        return view('sales_order.create', compact('soTypeDDL', 'customerTypeDDL', 'warehouseDDL', 'productDDL',
            'stocksDDL', 'vendorTruckingDDL', 'soCode', 'soStatusDraft', 'userSOs', 'expenseTypes','customerDDL'));
    }

    public function store(Request $request)
    {
        Log::info('SalesOrderController@store');

        if ($request['customer_type']['code'] == 'CUSTOMERTYPE.R') {
            if (empty($request['customer']['id'])) {
                $rules = ['notFound' => 'required'];
                $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
                Validator::make($request->all(), $rules, $messages)->validate();
            }
        }

        try {
            $this->salesOrderService->createSO($request->json()->all());
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 500);
            }
            return back();
        }

        return response()->json();
    }

    public function saveDraft(Request $request)
    {
        Log::info('SalesOrderController@saveDraft');

        $SOs = $this->salesOrderService->storeToSession($request);

        Session::setId($request->input('sId'));
        Session::start();
        Session::put([Config::get('const.SESSION.USER_SO_LIST') => collect($SOs)]);
        Session::save();

        return response()->json();
    }

    public function index()
    {
        Log::info('[SalesOrderController@index]');

        $salesOrders = SalesOrder::with('customer')->whereIn('status', ['SOSTATUS.WD', 'SOSTATUS.WP'])
            ->paginate(Config::get('const.PAGINATION'));

        return view('sales_order.index', compact('salesOrders'));
    }

    public function revise($id)
    {
        Log::info('SalesOrderController@revise');

        $currentSo = $this->salesOrderService->getSOForRevise($id);
        $warehouseDDL = Warehouse::all();
        $vendorTruckingDDL = VendorTrucking::all();
        $productDDL = Product::with('productUnits.unit')->get();
        $stocksDDL = $this->stockService->getStocksForSO();
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('sales_order.revise',
            compact('currentSo', 'productDDL', 'warehouseDDL', 'vendorTruckingDDL', 'stocksDDL', 'customerDDL',
                'expenseTypes'));
    }

    public function saveRevision(Request $request, $id)
    {
        $this->salesOrderService->reviseSO($request, $id);

        return response()->json();
    }

    public function delete(Request $request, $id)
    {
        $this->salesOrderService->rejectSO($request, $id);

        return redirect(route('db.so.revise.index'));
    }

    public function copySO($code = null)
    {
        $copylist = [];

        if (!$code) {

        }

        return view('sales_order.copy_index', compact('copylist'));
    }

    public function getDueSO(Request $request)
    {
        if(!empty($request->query('dod')) && is_numeric($request->query('dod'))){
            return $this->salesOrderService->getDueSO($request->query('dod'));
        } else {
            return $this->salesOrderService->getDueSO();
        }
    }

    public function getUndeliveredSO()
    {
        return $this->salesOrderService->getUndeliveredSO();
    }

    public function getNumberOfCreatedSOPerDay(Request $request)
    {
        $rangeOfDay = $request->query('rod');

        //Default range of day is 3 days
        if(empty($rangeOfDay)){
            $rangeOfDay = 3;
        }

        $date = Carbon::today();
        $createdSOPerDay = collect([]);

        for($i = 0; $i <= $rangeOfDay; $i++){
            $createdSOPerDay->push(['date' => $date->copy()->toDateTimeString(), 'numberOfCreatedSO' => count($this->salesOrderService->getSOInOneDay($date))]);
            $date->addDays(-1);
        }

        return $createdSOPerDay;
    }

    public function getTotalSOAmountPerDay(Request $request)
    {
        $rangeOfDay = $request->query('rod');

        //Default range of day is 3 days
        if(empty($rangeOfDay)){
            $rangeOfDay = 3;
        }

        $date = Carbon::today();
        $totalSOAmountPerDay = collect([]);

        for($i = 0; $i <= $rangeOfDay; $i++){
            $totalSOAmountPerDay->push(['date' => $date->copy()->toDateTimeString(), 'totalSOAmount' => $this->salesOrderService->getSOTotalAmountInOneDay($date)]);
            $date->addDays(-1);
        }

        return $totalSOAmountPerDay;
    }

    public function getSOByDate(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date'
        ]);
        return $this->salesOrderService->searchSOByDate($request->query('date'));
    }

    public function getTop10Customer()
    {

    }

    public function getTop10WalkInCustomer()
    {

    }
}
