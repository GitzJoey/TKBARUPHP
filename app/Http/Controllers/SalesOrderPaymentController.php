<?php

namespace App\Http\Controllers;

use App\Model\Giro;
use App\Model\Bank;
use App\Model\Store;
use App\Model\Lookup;
use App\Model\SalesOrder;
use App\Model\Expense;

use App\Repos\LookupRepo;

use App\Services\PaymentService;
use App\Services\SalesOrderService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SalesOrderPaymentController extends Controller
{
    private $paymentService;
    private $salesOrderService;

    public function __construct(PaymentService $paymentService, SalesOrderService $salesOrderService)
    {
        $this->paymentService = $paymentService;
        $this->salesOrderService = $salesOrderService;
        $this->middleware('auth');
    }

    public function paymentIndex(Request $request)
    {
        Log::info('SalesOrderPaymentController@paymentIndex');

        $salesOrders = null;

        if (!is_null($request->query('s'))) {
            $q = $request->query('s');
            $salesOrders = SalesOrder::where('status', '=', 'SOSTATUS.WP')
                            ->whereHas('customer', function($query) use ($q) {
                                $query->where('name', 'like', '%'.$q.'%');
                            })->orWhere('walk_in_cust', 'like', '%'.$q.'%')->get();
        } else {
            $salesOrders = SalesOrder::with('customer')->where('status', '=', 'SOSTATUS.WP')->get();
        }

        if(!empty($request->query('socode'))){
            $salesOrders = $salesOrders->where('code', '=', $request->query('socode'));
        }

        $soStatusDDL = LookupRepo::findByCategory('SOSTATUS')->pluck('description', 'code');

        return view('sales_order.payment.payment_index', compact('salesOrders', 'soStatusDDL'));
    }

    public function paymentHistory($id){
        $currentSo = SalesOrder::with('payments', 'items.product.productUnits.unit', 'customer.profiles.phoneNumbers.provider',
            'customer.bankAccounts.bank', 'vendorTrucking', 'warehouse', 'expenses')->find($id);
        $paymentTypeDDL = LookupRepo::findByCategory('PAYMENTTYPE')->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('sales_order.payment.payment_history', compact('currentSo', 'paymentTypeDDL', 'paymentStatusDDL', 'expenseTypes'));
    }

    public function createCashPayment($id)
    {
        Log::info('[SalesOrderPaymentController@createCashPayment]');

        $currentSo = SalesOrder::with('payments', 'items.product.productUnits.unit', 'items.discounts', 'customer.profiles.phoneNumbers.provider',
            'customer.bankAccounts.bank', 'vendorTrucking', 'warehouse', 'expenses')->find($id);
        $paymentTypeDDL = LookupRepo::findByCategory('PAYMENTTYPE')->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.C';
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('sales_order.payment.cash_payment', compact('currentSo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType',
            'expenseTypes'));
    }

    public function saveCashPayment(Request $request, $id)
    {
        Log::info('[SalesOrderPaymentController@saveCashPayment]');
 
        $currentSo = SalesOrder::find($id);
        $paymentDate = date('Y-m-d', strtotime($request->input('payment_date')));
        $paymentAmount = floatval(str_replace(',', '', $request->input('total_amount')));

        $this->paymentService->createCashPayment($currentSo, $paymentDate, $paymentAmount);

        $this->salesOrderService->updateSOStatus($currentSo, $paymentAmount);

        return response()->json();
    }

    public function createTransferPayment($id)
    {
        Log::info('[SalesOrderPaymentController@createTransferPayment]');

        $currentStore = Store::with('bankAccounts.bank')->find(Auth::user()->store_id);
        $currentSo = SalesOrder::with('payments', 'items.product.productUnits.unit', 'customer.profiles.phoneNumbers.provider',
            'customer.bankAccounts.bank', 'vendorTrucking', 'warehouse', 'expenses')->find($id);
        $paymentTypeDDL = LookupRepo::findByCategory('PAYMENTTYPE')->pluck('description', 'code');
        $storeBankAccounts = $currentStore->bankAccounts;
        $customerBankAccounts = empty($currentSo->customer) ? collect([]) : $currentSo->customer->bankAccounts;
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.T';
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('sales_order.payment.transfer_payment', compact('currentSo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType',
            'storeBankAccounts', 'customerBankAccounts', 'expenseTypes'));
    }

    public function saveTransferPayment(Request $request, $id)
    {
        Log::info('[SalesOrderPaymentController@saveTransferPayment]');

        $payment = $this->paymentService->createTransferPayment($request);

        $currentSo = SalesOrder::find($id);

        $currentSo->payments()->save($payment);

        return response()->json();
    }

    public function createGiroPayment($id)
    {
        Log::info('[SalesOrderPaymentController@createGiroPayment]');

        $currentSo = SalesOrder::with('payments', 'items.product.productUnits.unit',
            'customer.profiles.phoneNumbers.provider', 'customer.bankAccounts.bank',
            'vendorTrucking', 'warehouse', 'expenses')->find($id);
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['id', 'name']);
        $paymentTypeDDL = LookupRepo::findByCategory('PAYMENTTYPE')->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.G';
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('sales_order.payment.giro_payment', compact('currentSo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType',
            'bankDDL', 'expenseTypes'));
    }

    public function saveGiroPayment(Request $request, $id)
    {
        Log::info('[SalesOrderPaymentController@saveGiroPayment]');

        $giroParam = [
            'store_id' => Auth::user()->store_id,
            'bank_id' => $request->input('bank_id'),
            'serial_number' => $request->input('serial_number'),
            'effective_date' => date('Y-m-d', strtotime($request->input('effective_date'))),
            'amount' => floatval(str_replace(',', '', $request->input('amount'))),
            'printed_name' => $request->input('printed_name'),
            'status' => 'GIROSTATUS.N',
            'remarks' => $request->input('remarks')
        ];

        $giro = Giro::create($giroParam);

        $payment = $this->paymentService->createGiroPayment($request, $giro);

        $currentSo = SalesOrder::find($id);

        $currentSo->payments()->save($payment);

        return response()->json();
    }

    public function createBroughtForwardPayment(Request $request, $id)
    {
        Log::info('[SalesOrderPaymentController@createBroughtForwardPayment]');

        $currentSo = SalesOrder::with('payments', 'items.product', 'items.selectedUnit.unit',
            'customer.profiles.phoneNumbers.provider', 'customer.bankAccounts.bank',
            'vendorTrucking', 'warehouse', 'expenses')->find($id);

        $nextSo = SalesOrder::with('payments', 'items.product', 'items.selectedUnit.unit',
            'customer.profiles.phoneNumbers.provider', 'customer.bankAccounts.bank',
            'vendorTrucking', 'warehouse', 'expenses')->where('id', '>', $currentSo->id)->get();

        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');

        if($nextSo)
            foreach($nextSo as $next)
                $next->to_text();

        return view('sales_order.payment.broughtforward_payment', compact('currentSo','nextSo', 'paymentStatusDDL'));
    }

    public function saveBroughtForwardPayment(Request $request, $id)
    {
        Log::info('[SalesOrderPaymentController@saveBroughtForwardPayment]');

        $currentSo = SalesOrder::find($id);

        $this->validate($request, [
            'next_code'     => 'required|string|max:255',
            'next_name'     => 'required|string|max:255',
            'next_remarks'  => 'required|string|max:255',
        ]);

        $nextSo = SalesOrder::find($request->input('next_code'));
        $expense = new Expense();
        $expense->name = $request->input("next_name");
        $expense->type = 'EXPENSETYPE.ADD';
        $expense->is_internal_expense = 1;
        $expense->amount = $nextSo->totalAmount();
        $expense->remarks = $request->input("next_remarks");
        $nextSo->expenses()->save($expense);

        $currentSo->status = 'SOSTATUS.C';
        $currentSo->save();

        return response()->json();
    }
}
