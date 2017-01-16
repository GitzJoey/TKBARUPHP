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
use App\Model\SalesOrder;
use App\Model\VendorTrucking;
use App\Model\Warehouse;
use App\Services\SalesOrderService;
use App\Services\StockService;
use App\Util\SOCodeGenerator;
use App\Repos\LookupRepo;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $this->middleware('auth');
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

        $userSOs = session('userSOs', collect([]));

        return view('sales_order.create', compact('soTypeDDL', 'customerTypeDDL', 'warehouseDDL', 'productDDL',
            'stocksDDL', 'vendorTruckingDDL', 'soCode', 'soStatusDraft', 'userSOs', 'expenseTypes'));
    }

    public function store(Request $request)
    {
        Log::info('SalesOrderController@store');

        $submitIndex = $request->input('submit');
        $cancelIndex = $request->input('cancel');

        $this->salesOrderService->storeToSession($request);

        if (isset($submitIndex)) {

            $validationRules = [
                'so_code.' . $submitIndex => 'required|string|max:255',
                'sales_type.' . $submitIndex => 'required|string|max:255',
                'so_created.' . $submitIndex => 'required|string|max:255',
                'shipping_date.' . $submitIndex => 'required|string|max:255',
                'customer_type.' . $submitIndex => 'required|string|max:255'
            ];

            $validationMessages = [];

            if (App::getLocale() == 'id') {
                $validationMessages = [
                    'customer_id.' . $submitIndex . '.required' => 'Pelanggan di tab ' . ($submitIndex + 1) . ' wajib diisi.',
                    'walk_in_customer.' . $submitIndex . '.required' => 'Pelanggan di tab ' . ($submitIndex + 1) . ' wajib diisi.',
                    'walk_in_customer_details.' . $submitIndex . '.required' => 'Data pelanggan di tab ' . ($submitIndex + 1) . ' wajib diisi.'
                ];
            } else {
                $validationMessages = [
                    'customer_id.' . $submitIndex . '.required' => 'Customer on tab ' . ($submitIndex + 1) . ' is required.',
                    'walk_in_customer.' . $submitIndex . '.required' => 'Customer on tab ' . ($submitIndex + 1) . ' is required.',
                    'walk_in_customer_details.' . $submitIndex . '.required' => 'Customer Details on tab ' . ($submitIndex + 1) . ' is required.'
                ];
            }

            if ($request->input("customer_type.$submitIndex") == 'CUSTOMERTYPE.R') {
                $validationRules['customer_id.' . $submitIndex] = 'required';
            } else {
                $validationRules['walk_in_customer.' . $submitIndex] = 'required|string|max:255';
                $validationRules['walk_in_customer_details.' . $submitIndex] = 'required|string|max:255';
            }

            Validator::make($request->all(), $validationRules, $validationMessages)->validate();

            $this->salesOrderService->createSO($request, $submitIndex);
        } elseif (isset($cancelIndex)) {
            $this->salesOrderService->cancelSO($cancelIndex);
        }

        if (count($request->input('so_code')) > 1) {
            return redirect(route('db.so.create'));
        } else {
            return redirect(route('db'));
        }
    }

    public function index()
    {
        Log::info('SalesOrderController@index');

        $salesOrders = SalesOrder::with('customer')->whereIn('status', ['SOSTATUS.WD', 'SOSTATUS.WP'])
            ->paginate(10);
        $soStatusDDL = LookupRepo::findByCategory('SOSTATUS')->pluck('description', 'code');

        return view('sales_order.index', compact('salesOrders', 'soStatusDDL'));
    }

    public function revise($id)
    {
        Log::info('SalesOrderController@revise');

        $currentSo = $this->salesOrderService->getSOForRevise($id);
        $warehouseDDL = Warehouse::all(['id', 'name']);
        $vendorTruckingDDL = VendorTrucking::all(['id', 'name']);
        $productDDL = Product::with('productUnits.unit')->get();
        $stocksDDL = $this->stockService->getStocksForSO();
        $customerDDL = collect([$currentSo->customer->toArray()]);
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('sales_order.revise',
            compact('currentSo', 'productDDL', 'warehouseDDL', 'vendorTruckingDDL', 'stocksDDL', 'customerDDL',
                'expenseTypes'));
    }

    public function saveRevision(Request $request, $id)
    {
        $this->salesOrderService->reviseSO($request, $id);

        return redirect(route('db.so.revise.index'));
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
}
