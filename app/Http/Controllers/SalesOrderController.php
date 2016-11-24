<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

use App\Model\Bank;
use App\Model\CashPayment;
use App\Model\Customer;
use App\Model\Giro;
use App\Model\GiroPayment;
use App\Model\Lookup;
use App\Model\Payment;
use App\Model\Product;
use App\Model\SalesOrder;
use App\Model\Stock;
use App\Model\Store;
use App\Model\TransferPayment;
use App\Model\VendorTrucking;
use App\Model\Warehouse;
use App\Services\SalesOrderService;
use App\Services\StockService;
use App\Util\SOCodeGenerator;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $warehouseDDL = Warehouse::all(['id', 'name']);
        $vendorTruckingDDL = VendorTrucking::all(['id', 'name']);
        $productDDL = Product::with('productUnits.unit')->get();
        $stocksDDL = $this->stockService->getStocksForSO();
        $soTypeDDL = Lookup::where('category', '=', 'SOTYPE')->get(['code', 'description']);
        $customerTypeDDL = Lookup::where('category', '=', 'CUSTOMERTYPE')->get(['code', 'description']);
        $soCode = SOCodeGenerator::generateSOCode();
        $soStatusDraft = Lookup::where('code', '=', 'SOSTATUS.D')->get(['description', 'code']);

        $userSOs = session('userSOs', collect([]));

        return view('sales_order.create', compact('soTypeDDL', 'customerTypeDDL', 'warehouseDDL',
            'productDDL', 'stocksDDL', 'vendorTruckingDDL', 'soCode', 'soStatusDraft', 'userSOs'));
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

        $salesOrders = SalesOrder::with('customer')->whereIn('status', ['SOSTATUS.WD', 'SOSTATUS.WP'])->get();
        $soStatusDDL = Lookup::where('category', '=', 'SOSTATUS')->get()->pluck('description', 'code');

        return view('sales_order.index', compact('salesOrders', 'soStatusDDL'));
    }

    public function revise($id)
    {
        Log::info('SalesOrderController@revise');

        $currentSo = SalesOrder::with('items.product.productUnits.unit', 'customer.profiles.phoneNumbers.provider',
            'customer.bankAccounts.bank', 'vendorTrucking', 'warehouse')->find($id);
        $warehouseDDL = Warehouse::all(['id', 'name']);
        $vendorTruckingDDL = VendorTrucking::all(['id', 'name']);
        $productDDL = Product::with('productUnits.unit')->get();
        $stocksDDL = $this->stockService->getStocksForSO();
        $customerDDL = collect([$currentSo->customer->toArray()]);

        return view('sales_order.revise',
            compact('currentSo', 'productDDL', 'warehouseDDL', 'vendorTruckingDDL', 'stocksDDL', 'customerDDL'));
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

    public function paymentIndex()
    {
        Log::info('SalesOrderController@paymentIndex');

        $salesOrders = SalesOrder::with('customer')->where('status', '=', 'SOSTATUS.WP')->get();
        $soStatusDDL = Lookup::where('category', '=', 'SOSTATUS')->get()->pluck('description', 'code');

        return view('sales_order.payment_index', compact('salesOrders', 'soStatusDDL'));
    }

    public function createCashPayment($id)
    {
        Log::info('[SalesOrderController@createCashPayment]');

        $currentSo = SalesOrder::with('payments', 'items.product.productUnits.unit',
            'customer.profiles.phoneNumbers.provider', 'customer.bankAccounts.bank', 'vendorTrucking',
            'warehouse')->find($id);
        $paymentTypeDDL = Lookup::where('category', '=', 'PAYMENTTYPE')->get()->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.C';

        return view('sales_order.cash_payment',
            compact('currentSo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType'));
    }

    public function saveCashPayment(Request $request, $id)
    {
        Log::info('[SalesOrderController@saveCashPayment]');

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

        $currentSo = SalesOrder::find($id);

        $currentSo->payments()->save($payment);

        $currentSo->updatePaymentStatus();

        return redirect(route('db.so.payment.index'));
    }

    public function createTransferPayment($id)
    {
        Log::info('[SalesOrderController@createTransferPayment]');

        $currentStore = Store::with('bankAccounts.bank')->find(Auth::user()->store_id);
        $currentSo = SalesOrder::with('payments', 'items.product.productUnits.unit',
            'customer.profiles.phoneNumbers.provider', 'customer.bankAccounts.bank', 'vendorTrucking',
            'warehouse')->find($id);
        $paymentTypeDDL = Lookup::where('category', '=', 'PAYMENTTYPE')->get()->pluck('description', 'code');
        $storeBankAccounts = $currentStore->bankAccounts;
        $customerBankAccounts = empty($currentSo->customer) ? collect([]) : $currentSo->customer->bankAccounts;
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.T';

        return view('sales_order.transfer_payment',
            compact('currentSo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType', 'storeBankAccounts',
                'customerBankAccounts'));
    }

    public function saveTransferPayment(Request $request, $id)
    {
        Log::info('[SalesOrderController@saveTransferPayment]');

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

        $currentSo = SalesOrder::find($id);

        $currentSo->payments()->save($payment);

        return redirect(route('db.so.payment.index'));
    }

    public function createGiroPayment($id)
    {
        Log::info('[SalesOrderController@createGiroPayment]');

        $currentSo = SalesOrder::with('payments', 'items.product.productUnits.unit',
            'customer.profiles.phoneNumbers.provider', 'customer.bankAccounts.bank',
            'vendorTrucking', 'warehouse')->find($id);
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['id', 'name']);
        $paymentTypeDDL = Lookup::where('category', '=', 'PAYMENTTYPE')->get()->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.G';

        return view('sales_order.giro_payment',
            compact('currentSo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType', 'bankDDL'));
    }

    public function saveGiroPayment(Request $request, $id)
    {
        Log::info('[SalesOrderController@saveGiroPayment]');

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

        $giroPayment = new GiroPayment();
        $giroPayment->giro_id = $giro->id;
        $giroPayment->save();

        $paymentParam = [
            'payment_date' => date('Y-m-d', strtotime($request->input('payment_date'))),
            'total_amount' => floatval(str_replace(',', '', $request->input('amount'))),
            'status' => Lookup::whereCode('GIROPAYMENTSTATUS.WE')->first()->code,
            'type' => Lookup::whereCode('PAYMENTTYPE.G')->first()->code
        ];

        $payment = Payment::create($paymentParam);

        $giroPayment->payment()->save($payment);

        $currentSo = SalesOrder::find($id);

        $currentSo->payments()->save($payment);

        return redirect(route('db.so.payment.index'));
    }

    public function copySO($code = null)
    {
        $copylist = [];

        if (!$code) {

        }

        return view('sales_order.copy_index', compact('copylist'));
    }
}