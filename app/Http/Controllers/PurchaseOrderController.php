<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 2:17 PM
 */

namespace App\Http\Controllers;

use App\Model\Lookup;
use App\Model\Warehouse;
use App\Model\PurchaseOrder;
use App\Model\VendorTrucking;
use App\Model\Product;

use App\Repos\LookupRepo;

use App\Services\SupplierService;
use App\Services\PurchaseOrderService;

use App\Util\POCodeGenerator;

use Config;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseOrderController extends Controller
{
    private $purchaseOrderService;
    private $supplierService;

    public function __construct(PurchaseOrderService $purchaseOrderService, SupplierService $supplierService)
    {
        $this->purchaseOrderService = $purchaseOrderService;
        $this->supplierService = $supplierService;
        $this->middleware('auth', [ 'except' => [ 'getPOByDate', 'getDuePO', 'getUnreceivedPO', 'getListPODates' ] ]);
    }

    public function create()
    {
        Log::info('[PurchaseOrderController@create] ');

        $supplierDDL = $this->supplierService->getSuppliersForCreatePO();
        $warehouseDDL = Warehouse::where('status', '=', 'STATUS.ACTIVE')->get(['id', 'name']);
        $vendorTruckingDDL = VendorTrucking::where('status', '=', 'STATUS.ACTIVE')->get(['id', 'name']);
        $poTypeDDL = LookupRepo::findByCategory('POTYPE');
        $productDDL = Product::with('productUnits.unit')->get();
        $supplierTypeDDL = LookupRepo::findByCategory('SUPPLIERTYPE');
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');
        $poStatusDraft = Lookup::where('code', '=', 'POSTATUS.D')->get(['description', 'code']);
        $poCode = POCodeGenerator::generateCode();

        return view('purchase_order.create', compact('supplierDDL', 'warehouseDDL', 'vendorTruckingDDL',
            'supplierTypeDDL', 'poTypeDDL', 'unitDDL', 'poStatusDraft', 'poCode', 'expenseTypes', 'productDDL'));
    }

    public function store(Request $request)
    {
        Log::info('[PurchaseOrderController@store]');

        Validator::make($request->all(), [
            'code'                      => 'required|string|max:255',
            'po_type'                   => 'required|string|max:255',
            'po_created'                => 'required|string|max:255',
            'shipping_date'             => 'required|string|max:255',
            'supplier_type'             => 'required|string|max:255',
            'item_product_id'           => 'required',
            'item_selected_unit_id.*'   => 'required|numeric',
            'item_quantity.*'           => 'required|numeric',
            'item_price.*'              => 'required|numeric',
            'supplier_id'               => 'required_if:supplier_type,SUPPLIERTYPE.R|numeric',
            'walk_in_supplier'          => 'required_if:supplier_type,SUPPLIERTYPE.WI|string|max:255',
            'warehouse_id'              => 'required|numeric',
            'item_disc_percent.*.*'     => 'numeric',
            'item_disc_value.*.*'       => 'numeric',
            'disc_total_percent'        => 'numeric',
            'disc_total_value'          => 'numeric',
        ])->validate();

        if (is_null($this->purchaseOrderService->createPO($request))) {
            $rules = ['po' => 'required'];
            $messages = ['po.required' =>
                LaravelLocalization::getCurrentLocale() == "en" ?
                    "Create PO Failed":
                    "Penbelian Gagal"];
            Validator::make($request->all(), $rules, $messages)->validate();
        };

        return response()->json();
    }

    public function index()
    {
        Log::info('[PurchaseOrderController@index]');

        $purchaseOrders = PurchaseOrder::with('supplier')->whereIn('status', ['POSTATUS.WA', 'POSTATUS.WP'])
            ->paginate(Config::get('const.PAGINATION'));

        return view('purchase_order.index', compact('purchaseOrders'));
    }

    public function revise($id)
    {
        Log::info('[PurchaseOrderController@revise]');

        $currentPo = $this->purchaseOrderService->getPOForRevise($id);
        $warehouseDDL = Warehouse::all();
        $vendorTruckingDDL = VendorTrucking::all();
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');
        $productDDL = Product::with('productUnits.unit')->get();

        return view('purchase_order.revise', compact('currentPo', 'warehouseDDL', 'vendorTruckingDDL', 'expenseTypes', 'productDDL'));
    }

    public function saveRevision(Request $request, $id)
    {
        Log::info('[PurchaseOrderController@saveRevision]');

        $this->purchaseOrderService->revisePO($request, $id);

        return response()->json();
    }

    public function delete(Request $request, $id)
    {
        Log::info('[PurchaseOrderController@delete]');

        $this->purchaseOrderService->rejectPO($request, $id);

        return redirect(route('db.po.revise.index'));
    }

    public function getDuePO(Request $request)
    {
        if(!empty($request->query('dod')) && is_numeric($request->query('dod'))){
            return $this->purchaseOrderService->getDuePO($request->query('dod'));
        } else {
            return $this->purchaseOrderService->getDuePO();
        }
    }

    public function getUnreceivedPO()
    {
        return $this->purchaseOrderService->getUnreceivedPO();
    }

    public function getPOByDate(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date'
        ]);
        return $this->purchaseOrderService->searchPOByDate($request->query('date'));
    }

    public function getListPODates(Request $request)
    {
        return $this->purchaseOrderService->getLastPODates();
    }
}
