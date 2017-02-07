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
        $this->middleware('auth', [ 'except' => [ 'getDuePO', 'getUnreceivedPO' ] ]);
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

        $this->validate($request, [
            'code' => 'required|string|max:255',
            'po_type' => 'required|string|max:255',
            'po_created' => 'required|string|max:255',
            'shipping_date' => 'required|string|max:255',
            'supplier_type' => 'required|string|max:255',
        ]);

        $this->purchaseOrderService->createPO($request);

        if (!empty($request->input('submitcreate'))) {
            return redirect()->action('PurchaseOrderController@create');
        } else {
            return redirect(route('db'));
        }
    }

    public function index()
    {
        Log::info('[PurchaseOrderController@index]');

        $purchaseOrders = PurchaseOrder::with('supplier')->whereIn('status', ['POSTATUS.WA', 'POSTATUS.WP'])
            ->paginate(10);
        $poStatusDDL = LookupRepo::findByCategory('POSTATUS')->pluck('description', 'code');

        return view('purchase_order.index', compact('purchaseOrders', 'poStatusDDL'));
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
        $this->purchaseOrderService->revisePO($request, $id);

        return redirect(route('db.po.revise.index'));
    }

    public function delete(Request $request, $id)
    {
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
}
