<?php

namespace App\Http\Controllers;

use App\Model\Bank;
use App\Model\Store;
use App\Model\Lookup;
use App\Model\Profile;
use App\Model\Deliver;
use App\Model\Customer;
use App\Model\SalesOrder;
use App\Model\PriceLevel;
use App\Model\ProductUnit;
use App\Model\BankAccount;
use App\Model\PhoneNumber;
use App\Model\PhoneProvider;
use App\Model\ExpenseTemplate;

use App\Repos\LookupRepo;

use App\Services\CustomerService;

use DB;
use Auth;
use Config;
use Exception;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;
use phpDocumentor\Reflection\Types\Integer;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
        $this->middleware('auth', [ 
            'except' => [ 
                'searchCustomers',
                'getPassiveCustomer',
                'getCustomer',
                'getOpenSales',
                'getLastSale',
            ]
        ]);
    }

    public function index(Request $req)
    {
        $customer = [];
        if (!empty($req->query('s'))) {
            $param = $req->query('s');
            $customer = Customer::with('profiles.phoneNumbers.provider', 'expenseTemplates', 'bankAccounts.bank', 'priceLevel')
                ->where('name', 'like', "%$param%")
                ->orWhereHas('profiles', function ($query) use ($param) {
                    $query->where('first_name', 'like', "%$param%")
                        ->orWhere('last_name', 'like', "%$param%");
                })->paginate(Config::get('const.PAGINATION'));
        } else {
            $customer = Customer::paginate(Config::get('const.PAGINATION'));
        }

        return view('customer.index')->with('customer', $customer);
    }

    public function show($id)
    {
        $customer = Customer::with('profiles.phoneNumbers', 'bankAccounts.bank', 'expenseTemplates')->find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);

        return view('customer.show', compact('customer', 'statusDDL', 'bankDDL', 'providerDDL'));
    }

    public function create()
    {
        $mapsAPIKey = env('MAPS_API_KEY');
        $store = Auth::user()->store;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $priceLevelDDL = PriceLevel::whereStatus('STATUS.ACTIVE')->get(['type', 'name', 'description', 'weight', 'id']);
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE')->pluck('i18nDescription', 'code');
        $expenseTemplates = ExpenseTemplate::all();

        return view('customer.create', compact('statusDDL', 'bankDDL', 'providerDDL', 'priceLevelDDL', 'expenseTemplates', 'mapsAPIKey', 'store', 'expenseTypes'));
    }

    public function store(Request $data)
    {
        Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required',
        ])->validate();

        DB::beginTransaction();
        try  {
            $customer = new Customer();
            $customer->store_id = Auth::user()->store->id;
            $customer->name = $data['name'];
            $customer->address = $data['address'];
            $customer->latitude = empty($data['latitude']) ? 0:$data['latitude'];
            $customer->longitude = empty($data['longitude']) ? 0:$data['longitude'];
            $customer->distance = empty($data['distance']) ? 0:$data['distance'];
            $customer->distance_text = $data['distance_text'];
            $customer->duration = empty($data['duration']) ? 0:$data['duration'];
            $customer->duration_text = $data['duration_text'];
            $customer->city = $data['city'];
            $customer->phone_number = $data['phone'];
            $customer->tax_id = $data['tax_id'];
            $customer->remarks = $data['remarks'];
            $customer->payment_due_day = empty($data->input('payment_due_day')) ? 0 : $data->input('payment_due_day');
            $customer->price_level_id = $data['price_level'];
            $customer->status = $data['status'];

            $customer->save();

            for ($i = 0; $i < count($data['bank']); $i++) {
                $ba = new BankAccount();
                $ba->bank_id = $data["bank"][$i];
                $ba->account_name = $data["account_name"][$i];
                $ba->account_number = $data["account_number"][$i];
                $ba->remarks = $data["bank_remarks"][$i];

                $customer->bankAccounts()->save($ba);
            }

            for ($i = 0; $i < count($data['first_name']); $i++) {
                $pa = new Profile();
                $pa->first_name = $data["first_name"][$i];
                $pa->last_name = $data["last_name"][$i];
                $pa->address = $data["profile_address"][$i];
                $pa->ic_num = $data["ic_num"][$i];

                $customer->profiles()->save($pa);

                for ($j = 0; $j < count($data['profile_' . $i . '_phone_provider']); $j++) {
                    $ph = new PhoneNumber();
                    $ph->phone_provider_id = $data['profile_' . $i . '_phone_provider'][$j];
                    $ph->number = $data['profile_' . $i . '_phone_number'][$j];
                    $ph->remarks = $data['profile_' . $i . '_remarks'][$j];

                    $pa->phoneNumbers()->save($ph);
                }
            }

            if (count($data->input('expense_template_id')) > 0) {
                $customer->expenseTemplates()->sync($data->input('expense_template_id'));
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return response()->json();
    }

    public function edit($id)
    {
        $mapsAPIKey = env('MAPS_API_KEY');
        $store = Auth::user()->store;
        $customer = Customer::with('profiles.phoneNumbers', 'bankAccounts.bank', 'expenseTemplates')->find($id);
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $priceLevelDDL = PriceLevel::whereStatus('STATUS.ACTIVE')->get(['type', 'name', 'description', 'weight', 'id']);
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE')->pluck('i18nDescription', 'code');
        $expenseTemplates = ExpenseTemplate::all();

        return view('customer.edit', compact('customer', 'statusDDL', 'bankDDL', 'providerDDL', 'priceLevelDDL', 'expenseTemplates', 'mapsAPIKey', 'store', 'expenseTypes'));
    }

    public function update($id, Request $data)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail($id);

            if (!$customer) {
                return redirect(route('db.master.customer'));
            }

            $customerBankAccountIds = $customer->bankAccounts->map(function ($bankAccount){
                return $bankAccount->id;
            })->all();

            $inputtedBankAccountId = $data->input('bank_account_id');

            $customerBankAccountsToBeDeleted = array_diff($customerBankAccountIds, isset($inputtedBankAccountId) ?
                $inputtedBankAccountId : []);

            BankAccount::destroy($customerBankAccountsToBeDeleted);

            for ($i = 0; $i < count($data['bank']); $i++) {
                $ba = BankAccount::findOrNew($data['bank_account_id'][$i]);
                $ba->bank_id = $data["bank"][$i];
                $ba->account_name= $data["account_name"][$i];
                $ba->account_number = $data["account_number"][$i];
                $ba->remarks = $data["bank_remarks"][$i];

                $customer->bankAccounts()->save($ba);
            }

            $customerProfileIds = $customer->profiles->map(function ($profile) {
                return $profile->id;
            })->all();

            $inputtedProfileId = $data->input('profile_id');

            $customerProfilesToBeDeleted = array_diff($customerProfileIds, isset($inputtedProfileId) ?
                $inputtedProfileId : []);

            Profile::destroy($customerProfilesToBeDeleted);

            for ($i = 0; $i < count($data['first_name']); $i++) {
                $pa = Profile::with('phoneNumbers')->findOrNew($data['profile_id'][$i]);
                $pa->first_name = $data["first_name"][$i];
                $pa->last_name = $data["last_name"][$i];
                $pa->address = $data["profile_address"][$i];
                $pa->ic_num = $data["ic_num"][$i];

                $customer->profiles()->save($pa);

                $profilePhoneNumberIds = $pa->phoneNumbers->map(function ($phoneNumber) {
                    return $phoneNumber->id;
                })->all();

                $inputtedPhoneNumberId = $data->input('profile_' . $i . '_phone_number_id');

                $profilePhoneNumbersToBeDeleted = array_diff($profilePhoneNumberIds,
                    isset($inputtedPhoneNumberId) ? $inputtedPhoneNumberId : []);

                PhoneNumber::destroy($profilePhoneNumbersToBeDeleted);

                for ($j = 0; $j < count($data['profile_' . $i . '_phone_provider']); $j++) {
                    $ph = PhoneNumber::findOrNew($data['profile_' . $i . '_phone_number_id'][$j]);
                    $ph->phone_provider_id = $data['profile_' . $i . '_phone_provider'][$j];
                    $ph->number = $data['profile_' . $i . '_phone_number'][$j];
                    $ph->remarks = $data['profile_' . $i . '_remarks'][$j];

                    $pa->phoneNumbers()->save($ph);
                }
            }

            $customer->name = $data['name'];
            $customer->address = $data['address'];
            $customer->latitude = empty($data['latitude']) ? 0:$data['latitude'];
            $customer->longitude = empty($data['longitude']) ? 0:$data['longitude'];
            $customer->distance = empty($data['distance']) ? 0:$data['distance'];
            $customer->distance_text = $data['distance_text'];
            $customer->duration = empty($data['duration']) ? 0:$data['duration'];
            $customer->duration_text = $data['duration_text'];
            $customer->city = $data['city'];
            $customer->phone_number = $data['phone'];
            $customer->tax_id = $data['tax_id'];
            $customer->remarks = $data['remarks'];
            $customer->price_level_id = empty($data['price_level']) ? 0 : $data['price_level'];
            $customer->payment_due_day = empty($data->input('payment_due_day')) ? 0 : $data->input('payment_due_day');
            $customer->status = $data['status'];

            $customer->save();

            if (count($data->input('expense_template_id')) > 0) {
                $customer->expenseTemplates()->sync($data->input('expense_template_id'));
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        };

        return redirect(route('db.master.customer'));
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer) {
            foreach ($customer->profiles as $p) {
                foreach ($p->phoneNumbers as $ph) {
                    $ph->delete();
                }
                $p->delete();
            }

            foreach ($customer->bankAccounts as $ba) {
                $ba->delete();
            }

            $customer->expenseTemplates()->detach();

            $customer->delete();
        }

        return redirect(route('db.master.customer'));
    }

    public function confirmationIndex()
    {
        $profile = Profile::with('owner')
            ->where('owner_type', '=', 'App\Model\Customer')
            ->where('user_id', '=' , Auth::user()->id)->first();

        $customerhid = Hashids::encode(0);

        if ($profile && $profile->owner()) {
            $customerhid = Hashids::encode($profile->owner()->first()->id);
        }

        return redirect(route('db.customer.confirmation.customer', $customerhid));
    }

    public function confirmationCustomer($id, Request $req)
    {
        $solist = array();

        if ($id == 0) {
            $req->session()->flash('info', 'This ID are not associated with any customer.');
            return view('customer.confirmation.index', compact('solist'));
        }

        $solist = SalesOrder::with('customer', 'items.delivers', 'items.product')
            ->where('customer_id', '=', $id)
            ->where('status', '=', 'SOSTATUS.WCC')
            ->paginate(Config::get('const.PAGINATION'));

        return view('customer.confirmation.index', compact('solist'));
    }

    public function confirmSalesOrder($id)
    {
        $so = SalesOrder::with('customer', 'items.product.productUnits.unit', 'items.delivers')->where('id', '=', $id)->first();

        return view('customer.confirmation.confirm', compact('so'));
    }

    public function storeConfirmationSalesOrder($id, Request $request)
    {
        for ($i = 0; $i < sizeof($request->input('item_id')); $i++) {
            $conversionValue = ProductUnit::whereId($request->input("selected_unit_id.$i"))->first()->conversion_value;

            $deliver = Deliver::whereId($request->input("deliver_id.$i"))->first();

            $deliver->confirm_receive_date = date('Y-m-d H:i:s', strtotime($request->input("confirm_receive_date.0")));
            $deliver->netto = $request->input("netto.$i");
            $deliver->base_netto = $conversionValue * $request->input("netto.$i");
            $deliver->tare = $request->input("tare.$i");
            $deliver->base_tare = $conversionValue * $request->input("tare.$i");
            $deliver->remarks = $request->input("remarks.$i");

            $deliver->save();
        }

        $so = SalesOrder::whereId($id)->first();
        $so->status = 'SOSTATUS.WAPPV';
        $so->save();

        return response()->json();
    }

    public function approvalIndex()
    {
        $solist = SalesOrder::with('customer', 'items.product.productUnits.unit')
            ->whereIn('status', ['SOSTATUS.WCC', 'SOSTATUS.WAPPV'])
            ->paginate(Config::get('const.PAGINATION'));

        return view('customer.confirmation.approval', compact('solist'));
    }

    public function approval($id)
    {
        $so = SalesOrder::whereId($id)->first();

        foreach ($so->items as $i) {
            foreach ($i->delivers as $d) {
                $d->netto = $d->brutto;
                $d->base_netto = $d->base_brutto;
                $d->tare - 0;
                $d->updated_by = Auth::user()->id;
                $d->remarks = 'Auto Approve By '.Auth::user()->name;
                $d->save();
            }
        }

        $so->status = 'SOSTATUS.WP';
        $so->save();

        return redirect()->route('db.customer.approval.index');
    }

    public function reject($id)
    {
        $so = SalesOrder::whereId($id)->first();

        return redirect()->route('db.customer.approval.index');
    }

    public function paymentIndex(Request $req)
    {
        $salesOrders = [];
        if(!is_null(Auth::user()->profile)) {
            $salesOrders = SalesOrder::whereCustomerId(Auth::user()->profile->owner->id)->where('status', '=', 'SOSTATUS.WP')->get();
        } else {
            $req->session()->flash('info', 'This User ID are not associated with any customer.');
        }

        return view('customer.payment.payment_index', compact('salesOrders'));
    }

    public function paymentCashCustomer($id)
    {
        $currentSo = SalesOrder::with('payments', 'items.product.productUnits.unit',
            'customer.profiles.phoneNumbers.provider', 'customer.bankAccounts.bank', 'vendorTrucking',
            'warehouse')->find($id);
        $paymentTypeDDL = LookupRepo::findByCategory('PAYMENTTYPE')->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.C';

        return view('customer.payment.cash_payment',
            compact('currentSo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType'));
    }

    public function storePaymentCashCustomer($id, Request $request)
    {

        return response()->json();
    }

    public function paymentTransferCustomer($id)
    {
        $currentStore = Store::with('bankAccounts.bank')->find(Auth::user()->store_id);
        $currentSo = SalesOrder::with('payments', 'items.product.productUnits.unit', 'items.discounts',
            'customer.profiles.phoneNumbers.provider', 'customer.bankAccounts.bank', 'vendorTrucking',
            'warehouse', 'expenses')->find($id);
        $paymentTypeDDL = LookupRepo::findByCategory('PAYMENTTYPE')->pluck('description', 'code');
        $storeBankAccounts = $currentStore->bankAccounts;
        $customerBankAccounts = empty($currentSo->customer) ? collect([]) : $currentSo->customer->bankAccounts;
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.T';

        return view('customer.payment.transfer_payment',
            compact('currentSo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType', 'storeBankAccounts',
                'customerBankAccounts'));
    }

    public function storePaymentTransferCustomer($id, Request $request)
    {
        return response()->json();
    }

    public function paymentGiroCustomer($id)
    {
        $currentSo = SalesOrder::with('payments', 'items.product.productUnits.unit',
            'customer.profiles.phoneNumbers.provider', 'customer.bankAccounts.bank',
            'vendorTrucking', 'warehouse')->find($id);
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['id', 'name']);
        $paymentTypeDDL = LookupRepo::findByCategory('PAYMENTTYPE')->pluck('description', 'code');
        $paymentStatusDDL = Lookup::whereIn('category', ['CASHPAYMENTSTATUS', 'TRFPAYMENTSTATUS', 'GIROPAYMENTSTATUS'])
            ->get()->pluck('description', 'code');
        $paymentType = 'PAYMENTTYPE.G';

        return view('customer.payment.giro_payment',
            compact('currentSo', 'paymentTypeDDL', 'paymentStatusDDL', 'paymentType', 'bankDDL'));
    }

    public function storePaymentGiroCustomer($id, Request $request)
    {
        return response()->json();
    }

    public function searchCustomers(Request $request)
    {
        Log::info("CustomerController@searchCustomers");

        $param = $request->query('q');

        if(empty($param))
            return collect([]);

        $customers = Customer::with('profiles.phoneNumbers.provider', 'expenseTemplates', 'bankAccounts.bank', 'priceLevel')->where('name', 'like', "%$param%")
            ->orWhereHas('profiles', function ($query) use ($param)
            {
                $query->where('first_name', 'like', "%$param%")
                      ->orWhere('last_name', 'like', "%$param%");
        })->get();

        $customers = collect($customers->map(function ($customer){
            return array_merge([
                'last_order' => $this->customerService->getCustomerLastOrder($customer->id),
                'unpaid_sales_order_amount' => $this->customerService->getCustomerUnpaidSalesOrderTotalAmount($customer->id)
            ], $customer->toArray());
        })->all());

        return $customers;           
    }

    public function getPassiveCustomer()
    {
        return $this->customerService->getPassiveCustomer();
    }

    public function getCustomer(Request $request)
    {
        $id = $request->id;
        $customer = Customer::with('profiles.phoneNumbers.provider', 'bankAccounts.bank', 'expenseTemplates', 'priceLevel')->find($id);

        return response()->json($customer);
    }

    public function getOpenSales(Request $request)
    {
        $id = $request->id;
        $open_sales = Customer::find($id)->sales_orders()->whereNotIn('status', [ 'SOSTATUS.RJT', 'SOSTATUS.C' ])->get();

        return response()->json($open_sales);
    }

    public function getLastSale(Request $request)
    {
        $id = $request->id;
        $last_sale = Customer::find($id)->sales_orders()->latest()->first();

        return response()->json($last_sale);
    }
}
