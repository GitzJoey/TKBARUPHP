<?php

namespace App\Http\Controllers;

use App\Model\Lookup;
use App\Model\PurchaseOrder;
use App\Model\PurchaseOrderCopy;
use App\Services\PurchaseOrderCopyService;
use App\Services\PurchaseOrderService;
use App\Util\POCopyCodeGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PurchaseOrderCopyController extends Controller
{
    private $purchaseOrderCopyService;
    private $purchaseOrderService;

    public function __construct(PurchaseOrderCopyService $purchaseOrderCopyService, PurchaseOrderService $purchaseOrderService)
    {
        $this->purchaseOrderCopyService = $purchaseOrderCopyService;
        $this->purchaseOrderService = $purchaseOrderService;
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        Log::info('PurchaseOrderCopyController@search');
        $request->session()->forget(['code', 'error']);
        return view('purchase_order.copy.search');
    }

    public function index(Request $request, $poCode = '')
    {
        Log::info('PurchaseOrderCopyController@index');
        $request->session()->forget(['code', 'error']);

        $po = PurchaseOrder::with('copies.supplier')->whereCode($poCode)->first();

        Log::info($po);

        if(is_null($po)){
            Log::info('PO not found');
            $request->session()->flash('code', $poCode);
            $request->session()->flash('error', 'po_not_found');
            return view('purchase_order.copy.search');
        }
        else{
            Log::info('PO found');
            $poCopies = $po->copies;
            return view('purchase_order.copy.index', compact('poCopies', 'poCode'));
        }

    }

    public function create(Request $request, $poCode)
    {
        Log::info('PurchaseOrderCopyController@create');

        $poToBeCopied = $this->purchaseOrderService->getPOForCopy($poCode);

        $poCopyCode = POCopyCodeGenerator::generateCode($poCode);

        return view('purchase_order.copy.create', compact('poToBeCopied', 'poCopyCode', 'poCode'));
    }

    public function store(Request $request, $poCode)
    {
        Log::info('PurchaseOrderCopyController@store');

        $poCopy = $this->purchaseOrderCopyService->createPOCopy($request, $poCode);

        return redirect(route('db.po.copy.index', $poCode));
    }

    public function edit($poCode, $id)
    {
        $currentPOCopy = $this->purchaseOrderCopyService->getPOCopyForEdit($id);

        return view('purchase_order.copy.edit', compact('poCode', 'currentPOCopy'));
    }

    public function update(Request $request, $poCode, $id)
    {
        $editedPOCopy = $this->purchaseOrderCopyService->editPOCopy($request, $id);

        return redirect(route('db.po.copy.index', $poCode));
    }

    public function delete($poCode, $id)
    {
        $poCopy = PurchaseOrderCopy::find($id);
        $poCopy->items->each(function($i) { $i->delete(); });
        $poCopy->delete();

        return redirect(route('db.po.copy.index', $poCode));
    }
}
