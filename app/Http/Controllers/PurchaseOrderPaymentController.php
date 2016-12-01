<?php

namespace App\Http\Controllers;

use App\Model\CashPayment;
use App\Model\Giro;
use App\Model\GiroPayment;
use App\Model\Lookup;
use App\Model\Payment;
use App\Model\PurchaseOrder;
use App\Model\Store;
use App\Model\TransferPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PurchaseOrderPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function paymentIndex()
    {
        Log::info('[PurchaseOrderController@paymentIndex]');

        $purchaseOrders = PurchaseOrder::with('supplier')->where('status', '=', 'POSTATUS.WP')->get();
        $poStatusDDL = Lookup::where('category', '=', 'POSTATUS')->get()->pluck('description', 'code');

        return view('purchase_order.payment.payment_index', compact('purchaseOrders', 'poStatusDDL'));
    }

    public function paymentHistory($id){
        $currentPo = PurchaseOrder::with('payments', 'items.product.productUnits.unit',
            'supplier.profiles.phoneNumbers.provider', 'supplier.bankAccounts.bank', 'supplier.products',
            'supplier.products.type', 'vendorTrucking', 'warehouse', 'expenses')->find($id);
        $paymentTypeDDL = Lookup::where('category', '=', 'PAYMENTTYPE')->get()->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $expenseTypes = Lookup::where('category', '=', 'EXPENSETYPE')->get(['description', 'code']);

        return view('purchase_order.payment.payment_history', compact('currentPo', 'paymentTypeDDL', 'paymentStatusDDL',
            'expenseTypes'));
    }

    public function createCashPayment($id)
    {
        Log::info('[PurchaseOrderController@createCashPayment]');

        $currentPo = PurchaseOrder::with('payments', 'items.product.productUnits.unit',
            'supplier.profiles.phoneNumbers.provider', 'supplier.bankAccounts.bank', 'supplier.products',
            'supplier.products.type', 'vendorTrucking', 'warehouse', 'expenses')->find($id);
        $paymentTypeDDL = Lookup::where('category', '=', 'PAYMENTTYPE')->get()->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.C';
        $expenseTypes = Lookup::where('category', '=', 'EXPENSETYPE')->get(['description', 'code']);

        return view('purchase_order.payment.cash_payment',
            compact('currentPo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType', 'expenseTypes'));
    }

    public function saveCashPayment(Request $request, $id)
    {
        Log::info('[PurchaseOrderController@saveCashPayment]');

        $cashPayment = new CashPayment();
        $cashPayment->save();

        $paymentParam = [
            'payment_date' => date('Y-m-d', strtotime($request->input('payment_date'))),
            'total_amount' => floatval(str_replace(',', '', $request->input('total_amount'))),
            'status' => Lookup::whereCode('CASHPAYMENTSTATUS.C')->first()->code,
            'type' => Lookup::whereCode('PAYMENTTYPE.C')->first()->code
        ];

        $payment = Payment::create($paymentParam);

        $cashPayment->payment()->save($payment);

        $currentPo = PurchaseOrder::find($id);

        $currentPo->payments()->save($payment);

        $currentPo->updatePaymentStatus();

        return redirect(route('db.po.payment.index'));
    }

    public function createTransferPayment($id)
    {
        Log::info('[PurchaseOrderController@createTransferPayment]');

        $currentStore = Store::with('bankAccounts.bank')->find(Auth::user()->store_id);
        $currentPo = PurchaseOrder::with('payments', 'items.product.productUnits.unit',
            'supplier.profiles.phoneNumbers.provider', 'supplier.bankAccounts.bank', 'supplier.products',
            'vendorTrucking', 'warehouse', 'expenses')->find($id);
        $paymentTypeDDL = Lookup::where('category', '=', 'PAYMENTTYPE')->get()->pluck('description', 'code');
        $storeBankAccounts = $currentStore->bankAccounts;
        $supplierBankAccounts = is_null($currentPo->supplier) ? collect([]) : $currentPo->supplier->bankAccounts;
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.T';
        $expenseTypes = Lookup::where('category', '=', 'EXPENSETYPE')->get(['description', 'code']);

        return view('purchase_order.payment.transfer_payment',
            compact('currentPo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType', 'storeBankAccounts',
                'supplierBankAccounts', 'expenseTypes'));
    }

    public function saveTransferPayment(Request $request, $id)
    {
        Log::info('[PurchaseOrderController@saveTransferPayment]');

        $transferPayment = new TransferPayment();
        $transferPayment->bank_account_from_id = empty($request->input('bank_account_from')) ? 0 : $request->input('bank_account_from');
        $transferPayment->bank_account_to_id = empty($request->input('bank_account_to')) ? 0 : $request->input('bank_account_to');
        $transferPayment->effective_date = date('Y-m-d', strtotime($request->input('effective_date')));
        $transferPayment->save();

        $paymentParam = [
            'payment_date' => date('Y-m-d', strtotime($request->input('payment_date'))),
            'total_amount' => floatval(str_replace(',', '', $request->input('total_amount'))),
            'status' => Lookup::whereCode('TRFPAYMENTSTATUS.UNCONFIRMED')->first()->code,
            'type' => Lookup::whereCode('PAYMENTTYPE.T')->first()->code
        ];

        $payment = Payment::create($paymentParam);

        $transferPayment->payment()->save($payment);

        $currentPo = PurchaseOrder::find($id);

        $currentPo->payments()->save($payment);

        return redirect(route('db.po.payment.index'));
    }

    public function createGiroPayment($id)
    {
        Log::info('[PurchaseOrderController@createGiroPayment]');

        $currentPo = PurchaseOrder::with('payments', 'items.product.productUnits.unit',
            'supplier.profiles.phoneNumbers.provider', 'supplier.bankAccounts.bank', 'supplier.products',
            'vendorTrucking', 'warehouse', 'expenses')->find($id);
        $availableGiros = Giro::with('bank')->where('status', '=', 'GIROSTATUS.N')->get();
        $paymentTypeDDL = Lookup::where('category', '=', 'PAYMENTTYPE')->get()->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.G';
        $expenseTypes = Lookup::where('category', '=', 'EXPENSETYPE')->get(['description', 'code']);

        return view('purchase_order.payment.giro_payment',
            compact('currentPo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType', 'availableGiros', 'bankDDL',
                'expenseTypes'));
    }

    public function saveGiroPayment(Request $request, $id)
    {
        Log::info('[PurchaseOrderController@saveGiroPayment]');

        $giroId = $request->input("giro_id");

        $giro = Giro::find($giroId);
        $giro->status = 'GIROSTATUS.UP';
        $giro->save();

        $giroPayment = new GiroPayment();
        $giroPayment->giro_id = $giroId;
        $giroPayment->save();

        $paymentParam = [
            'payment_date' => date('Y-m-d', strtotime($request->input('payment_date'))),
            'total_amount' => floatval(str_replace(',', '', $request->input('amount'))),
            'status' => Lookup::whereCode('GIROPAYMENTSTATUS.WE')->first()->code,
            'type' => Lookup::whereCode('PAYMENTTYPE.G')->first()->code
        ];

        $payment = Payment::create($paymentParam);

        $giroPayment->payment()->save($payment);

        $currentPo = PurchaseOrder::find($id);

        $currentPo->payments()->save($payment);

        return redirect(route('db.po.payment.index'));
    }
}
