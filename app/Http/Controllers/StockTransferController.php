<?php

namespace App\Http\Controllers;

use App\Services\StockTransferService;
use Illuminate\Http\Request;

class StockTransferController extends Controller
{
    private $stockTransferService;

    public function __construct(StockTransferService $stockTransferService)
    {
        $this->$stockTransferService = $stockTransferService;
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        Log::info('[StockTransferController@create] ');

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
}
