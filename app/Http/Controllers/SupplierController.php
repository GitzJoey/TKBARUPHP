<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:34 AM
 */

namespace App\Http\Controllers;

use DB;
use Auth;
use Config;
use Illuminate\Http\Request;

use App\Model\Bank;
use App\Model\Product;
use App\Model\Profile;
use App\Model\Supplier;
use App\Model\BankAccount;
use App\Model\PhoneNumber;
use App\Model\PhoneProvider;
use App\Model\ExpenseTemplate;
use App\Model\SupplierSetting;
use App\Repos\LookupRepo;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [ 'searchSuppliers' ]
        ]);
    }

    public function index()
    {
        $supplier = Supplier::paginate(Config::get('const.PAGINATION'));
        return view('supplier.index', compact('supplier'));
    }

    public function show($id)
    {
        $supplier = Supplier::with('profiles.phoneNumbers.provider', 'bankAccounts.bank',
            'expenseTemplates')->find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $productList = Product::whereStatus('STATUS.ACTIVE')->get();

        return view('supplier.show',
            compact('supplier', 'products', 'pics', 'phone_provider', 'banks', 'bank_account', 'statusDDL',
                'productList'));
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $productList = Product::with('type')->where('status', '=', 'STATUS.ACTIVE')->get();
        $expenseTemplates = ExpenseTemplate::all();
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE')->pluck('i18nDescription', 'code');

        return view('supplier.create',
            compact('bankDDL', 'statusDDL', 'providerDDL', 'productList', 'expenseTemplates', 'expenseTypes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

        DB::transaction(function() use($request) {
            $suppliers = [
                'store_id' => Auth::user()->store->id,
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'phone_number' => $request->input('phone_number'),
                'fax_num' => $request->input('fax_num'),
                'tax_id' => $request->input('tax_id'),
                'status' => $request->input('status'),
                'remarks' => $request->input('remarks'),
                'payment_due_day' => empty($request->input('payment_due_day')) ? 0 : $request->input('payment_due_day'),
            ];

            $supplier = Supplier::create($suppliers);

            for ($i = 0; $i < count($request['bank']); $i++) {
                $ba = new BankAccount();
                $ba->bank_id = $request["bank"][$i];
                $ba->account_name = $request["account_name"][$i];
                $ba->account_number = $request["account_number"][$i];
                $ba->remarks = $request["bank_remarks"][$i];

                $supplier->bankAccounts()->save($ba);
            }

            for ($i = 0; $i < count($request['first_name']); $i++) {
                $pa = new Profile();
                $pa->first_name = $request["first_name"][$i];
                $pa->last_name = $request["last_name"][$i];
                $pa->address = $request["profile_address"][$i];
                $pa->ic_num = $request["ic_num"][$i];

                $supplier->profiles()->save($pa);

                for ($j = 0; $j < count($request['profile_' . $i . '_phone_provider']); $j++) {
                    $ph = new PhoneNumber();
                    $ph->phone_provider_id = $request['profile_' . $i . '_phone_provider'][$j];
                    $ph->number = $request['profile_' . $i . '_phone_number'][$j];
                    $ph->remarks = $request['profile_' . $i . '_remarks'][$j];

                    $pa->phoneNumbers()->save($ph);
                }
            }

            for ($i = 0; $i < count($request['productSelected']); $i++) {
                $pr = Product::whereId($request['productSelected'][$i])->first();
                $supplier->products()->save($pr);
            }

            if (count($request->input('expense_template_id')) > 0) {
                $supplier->expenseTemplates()->sync($request->input('expense_template_id'));
            }
        });

        return response()->json();
    }

    public function edit($id)
    {
        $supplier = Supplier::with('profiles.phoneNumbers.provider', 'bankAccounts.bank', 'products',
            'expenseTemplates')->find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $productList = Product::with('type')->where('status', '=', 'STATUS.ACTIVE')->get();
        $productSelected = array_fill_keys($supplier->products()->pluck('products.id')->toArray(), true);
        $expenseTemplates = ExpenseTemplate::all();
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE')->pluck('i18nDescription', 'code');

        return view('supplier.edit',
            compact('supplier', 'bankDDL', 'statusDDL', 'providerDDL', 'productList', 'productSelected',
                'expenseTemplates', 'expenseTypes'));
    }

    public function update($id, Request $request)
    {
        DB::transaction(function() use($id, $request) {
            $supplier = Supplier::with('bankAccounts', 'profiles')->findOrFail($id);

            if (!$supplier) {
                return redirect(route('db.master.supplier'));
            }

            $supplierBankAccountIds = $supplier->bankAccounts->map(function ($bankAccount) {
                return $bankAccount->id;
            })->all();

            $inputtedBankAccountId = $request->input('bank_account_id');

            $supplierBankAccountsToBeDeleted = array_diff($supplierBankAccountIds, isset($inputtedBankAccountId) ?
                $inputtedBankAccountId : []);

            BankAccount::destroy($supplierBankAccountsToBeDeleted);

            for ($i = 0; $i < count($request['bank']); $i++) {
                $ba = BankAccount::findOrNew($request['bank_account_id'][$i]);
                $ba->bank_id = $request["bank"][$i];
                $ba->account_name= $request["account_name"][$i];
                $ba->account_number = $request["account_number"][$i];
                $ba->remarks = $request["bank_remarks"][$i];

                $supplier->bankAccounts()->save($ba);
            }

            $supplierProfileIds = $supplier->profiles->map(function ($profile) {
                return $profile->id;
            })->all();

            $inputtedProfileId = $request->input('profile_id');

            $supplierProfilesToBeDeleted = array_diff($supplierProfileIds, isset($inputtedProfileId) ?
                $inputtedProfileId : []);

            Profile::destroy($supplierProfilesToBeDeleted);

            for ($i = 0; $i < count($request['first_name']); $i++) {
                $pa = Profile::with('phoneNumbers')->findOrNew($request['profile_id'][$i]);
                $pa->first_name = $request["first_name"][$i];
                $pa->last_name = $request["last_name"][$i];
                $pa->address = $request["profile_address"][$i];
                $pa->ic_num = $request["ic_num"][$i];

                $supplier->profiles()->save($pa);

                $profilePhoneNumberIds = $pa->phoneNumbers->map(function ($phoneNumber) {
                    return $phoneNumber->id;
                })->all();

                $inputtedPhoneNumberId = $request->input('profile_' . $i . '_phone_number_id');

                $profilePhoneNumbersToBeDeleted = array_diff($profilePhoneNumberIds,
                    isset($inputtedPhoneNumberId) ? $inputtedPhoneNumberId : []);

                PhoneNumber::destroy($profilePhoneNumbersToBeDeleted);

                for ($j = 0; $j < count($request['profile_' . $i . '_phone_provider']); $j++) {
                    $ph = PhoneNumber::findOrNew($request['profile_' . $i . '_phone_number_id'][$j]);
                    $ph->phone_provider_id = $request['profile_' . $i . '_phone_provider'][$j];
                    error_log($request['profile_' . $i . '_phone_provider'][$j]);
                    $ph->number = $request['profile_' . $i . '_phone_number'][$j];
                    $ph->remarks = $request['profile_' . $i . '_remarks'][$j];

                    $pa->phoneNumbers()->save($ph);
                }
            }

            $supplier->products()->detach();

            for ($i = 0; $i < count($request['productSelected']); $i++) {
                $pr = Product::whereId($request['productSelected'][$i])->first();
                $supplier->products()->save($pr);
            }

            $supplier->name = $request->input('name');
            $supplier->address = $request->input('address');
            $supplier->city = $request->input('city');
            $supplier->phone_number = $request->input('phone_number');
            $supplier->fax_num = $request->input('fax_num');
            $supplier->tax_id = $request->input('tax_id');
            $supplier->status = $request->input('status');
            $supplier->remarks = $request->input('remarks');
            $supplier->payment_due_day = empty($request->input('payment_due_day')) ? 0 : $request->input('payment_due_day');

            $supplier->save();

            if (count($request->input('expense_template_id')) > 0) {
                $supplier->expenseTemplates()->sync($request->input('expense_template_id'));
            }
        });

        return response()->json();
    }

    public function delete($id)
    {
        $supplier = Supplier::findOrFail($id);

        foreach ($supplier->profiles as $p) {
            foreach ($p->phoneNumbers as $ph) {
                $ph->delete();
            }
            $p->delete();
        }

        foreach ($supplier->bankAccounts as $ba) {
            $ba->delete();
        }

        $supplier->expenseTemplates()->detach();
        $supplier->products()->detach();

        $supplier->delete();

        return redirect(route('db.master.supplier'));
    }

    public function searchSuppliers(Request $request)
    {
        Log::info("SupplierController@searchSuppliers");

        $param = $request->query('q');

        if(empty($param))
            return collect([]);

        $suppliers = Supplier::with('profiles.phoneNumbers.provider', 'expenseTemplates', 'bankAccounts.bank')
            ->where('name', 'like', "%$param%")
            ->orWhere('tax_id', 'like', "%$param%")
            ->orWhereHas('profiles', function ($query) use ($param){
                $query->where('first_name', 'like', "%$param%")
                      ->orWhere('last_name', 'like', "%$param%");
            })->get();

        return $suppliers;
    }
}
