<?php

namespace App\Http\Controllers;

use App\Model\Giro;
use App\Model\Store;
use App\Model\Lookup;
use App\Model\PurchaseOrder;

use App\Services\PaymentService;
use App\Services\PurchaseOrderService;

use App\Repos\LookupRepo;

use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PurchaseOrderPaymentController extends Controller
{

    private $purchaseOrderService;
    private $paymentService;

    public function __construct(PurchaseOrderService $purchaseOrderService, PaymentService $paymentService)
    {
        $this->purchaseOrderService = $purchaseOrderService;
        $this->paymentService = $paymentService;
        $this->middleware('auth');
    }

    public function paymentIndex(Request $request)
    {
        Log::info('[PurchaseOrderController@paymentIndex]');

        $searchCode = '';
        if(!empty($request->query('c'))){
            $purchaseOrders = PurchaseOrder::with('supplier')
                ->where('status', '=', 'POSTATUS.WP')
                ->where('code', '=', $request->query('c'))->paginate(Config::get('const.PAGINATION'));
            $searchCode = $request->query('c');
        } else {
            $purchaseOrders = PurchaseOrder::with('supplier')->where('status', '=', 'POSTATUS.WP')
                ->paginate(Config::get('const.PAGINATION'));
        }

        $poStatusDDL = LookupRepo::findByCategory('POSTATUS')->pluck('description', 'code');

        return view('purchase_order.payment.payment_index', compact('purchaseOrders', 'poStatusDDL', 'searchCode'));
    }

    public function paymentHistory($id){
        $currentPo = $this->purchaseOrderService->getPOForPayment($id);
        $paymentTypeDDL = LookupRepo::findByCategory('PAYMENTTYPE')->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('purchase_order.payment.payment_history', compact('currentPo', 'paymentTypeDDL', 'paymentStatusDDL',
            'expenseTypes'));
    }

    public function createCashPayment($id)
    {
        Log::info('[PurchaseOrderController@createCashPayment]');

        $currentPo = $this->purchaseOrderService->getPOForPayment($id);
        $paymentTypeDDL = LookupRepo::findByCategory('PAYMENTTYPE')->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.C';
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('purchase_order.payment.cash_payment',
            compact('currentPo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType', 'expenseTypes'));
    }

    public function saveCashPayment(Request $request, $id)
    {
        Log::info('[PurchaseOrderController@saveCashPayment]');

        $currentPo = $this->purchaseOrderService->getPOForPayment($id);
        $paymentDate = date('Y-m-d', strtotime($request->input('payment_date')));
        $paymentAmount = floatval(str_replace(',', '', $request->input('total_amount')));

        $this->paymentService->createCashPayment($currentPo, $paymentDate, $paymentAmount);

        $this->purchaseOrderService->updatePOStatus($currentPo, $paymentAmount);

        return response()->json();
    }

    public function createTransferPayment($id)
    {
        Log::info('[PurchaseOrderController@createTransferPayment]');

        $currentPo = $this->purchaseOrderService->getPOForPayment($id);
        $currentStore = Store::with('bankAccounts.bank')->find(Auth::user()->store_id);
        $storeBankAccounts = $currentStore->bankAccounts;
        $supplierBankAccounts = is_null($currentPo->supplier) ? collect([]) : $currentPo->supplier->bankAccounts;
        $paymentType = 'PAYMENTTYPE.T';
        $paymentTypeDDL = LookupRepo::findByCategory('PAYMENTTYPE')->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('purchase_order.payment.transfer_payment', compact('currentPo', 'paymentTypeDDL', 'paymentStatusDDL',
            'paymentType', 'storeBankAccounts', 'supplierBankAccounts', 'expenseTypes'));
    }

    public function saveTransferPayment(Request $request, $id)
    {
        Log::info('[PurchaseOrderController@saveTransferPayment]');

        $payment = $this->paymentService->createTransferPayment($request);

        $currentPo = PurchaseOrder::find($id);

        $currentPo->payments()->save($payment);

        return response()->json();
    }

    public function createGiroPayment($id)
    {
        Log::info('[PurchaseOrderController@createGiroPayment]');

        $currentPo = $this->purchaseOrderService->getPOForPayment($id);
        $availableGiros = Giro::with('bank')->where('status', '=', 'GIROSTATUS.N')->get();
        $paymentTypeDDL = LookupRepo::findByCategory('PAYMENTTYPE')->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.G';
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('purchase_order.payment.giro_payment', compact('currentPo', 'paymentTypeDDL', 'paymentStatusDDL',
            'paymentType', 'availableGiros', 'bankDDL', 'expenseTypes'));
    }

    public function saveGiroPayment(Request $request, $id)
    {
        Log::info('[PurchaseOrderController@saveGiroPayment]');

        $giroId = $request->input("giro_id");

        $giro = Giro::find($giroId);
        $giro->status = 'GIROSTATUS.UP';
        $giro->save();

        $payment = $this->paymentService->createGiroPayment($request, $giro);

        $currentPo = PurchaseOrder::find($id);

        $currentPo->payments()->save($payment);

        return response()->json();
    }
}
