<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 2:17 PM
 */

namespace App\Http\Controllers;

use App\Model\Bank;
use App\Model\CashPayment;
use App\Model\Giro;
use App\Model\GiroPayment;
use App\Model\Lookup;
use App\Model\Payment;
use App\Model\PurchaseOrder;
use App\Model\Store;
use App\Model\Supplier;
use App\Model\TransferPayment;
use App\Model\VendorTrucking;
use App\Model\Warehouse;
use App\Services\PurchaseOrderService;
use App\Util\POCodeGenerator;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseOrderController extends Controller
{
    private $purchaseOrderService;

    public function __construct(PurchaseOrderService $purchaseOrderService)
    {
        $this->purchaseOrderService = $purchaseOrderService;
        $this->middleware('auth');
    }

    public function create()
    {
        Log::info('[PurchaseOrderController@create] ');

        $supplierDDL = Supplier::with('profiles.phoneNumbers.provider', 'bankAccounts.bank',
            'products.productUnits.unit', 'products.type', 'expenseTemplates')->get();
        $warehouseDDL = Warehouse::all(['id', 'name']);
        $vendorTruckingDDL = VendorTrucking::all(['id', 'name']);
        $poTypeDDL = Lookup::where('category', '=', 'POTYPE')->get(['description', 'code']);
        $supplierTypeDDL = Lookup::where('category', '=', 'SUPPLIERTYPE')->get(['description', 'code']);
        $poCode = POCodeGenerator::generatePOCode();
        $poStatusDraft = Lookup::where('code', '=', 'POSTATUS.D')->get(['description', 'code']);
        $expenseTypes = Lookup::where('category', '=', 'EXPENSETYPE')->get(['description', 'code']);

        return view('purchase_order.create', compact('supplierDDL', 'warehouseDDL', 'vendorTruckingDDL',
            'supplierTypeDDL', 'poTypeDDL', 'unitDDL', 'poStatusDraft', 'poCode', 'expenseTypes'));
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
            ->paginate(2);
        $poStatusDDL = Lookup::where('category', '=', 'POSTATUS')->get()->pluck('description', 'code');

        return view('purchase_order.index', compact('purchaseOrders', 'poStatusDDL'));
    }

    public function revise($id)
    {
        Log::info('[PurchaseOrderController@revise]');

        $currentPo = PurchaseOrder::with('items.product.productUnits.unit', 'supplier.profiles.phoneNumbers.provider',
            'supplier.bankAccounts.bank', 'supplier.products.productUnits.unit', 'supplier.products.type',
            'supplier.expenseTemplates', 'vendorTrucking', 'warehouse', 'expenses')->find($id);
        $warehouseDDL = Warehouse::all(['id', 'name']);
        $vendorTruckingDDL = VendorTrucking::all(['id', 'name']);
        $expenseTypes = Lookup::where('category', '=', 'EXPENSETYPE')->get(['description', 'code']);

        return view('purchase_order.revise', compact('currentPo', 'warehouseDDL', 'vendorTruckingDDL', 'expenseTypes'));
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
}