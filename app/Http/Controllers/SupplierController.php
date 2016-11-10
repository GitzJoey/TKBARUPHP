<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:34 AM
 */

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Model\Bank;
use App\Model\Lookup;
use App\Model\Profile;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\BankAccount;
use App\Model\PhoneNumber;
use App\Model\PhoneProvider;
use App\Model\SupplierSetting;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $supplier = Supplier::paginate(10);
        return view('supplier.index', compact('supplier'));
    }

    public function show($id)
    {
        $supplier = Supplier::with('profiles.phoneNumbers.provider', 'bankAccounts.bank')->find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $productList = Product::whereStatus('STATUS.ACTIVE')->get();

        return view('supplier.show', compact('supplier', 'products', 'pics', 'phone_provider', 'banks', 'bank_account', 'statusDDL', 'productList'));
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $productList = Product::with('type')->where('status', '=', 'STATUS.ACTIVE')->get();

        return view('supplier.create', compact('bankDDL', 'statusDDL', 'providerDDL', 'productList'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'status' => 'required',
        ]);

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

        for($i = 0; $i < count($request['productSelected']); $i++) {
            $pr = Product::whereId($request['productSelected'][$i])->first();
            $supplier->products()->save($pr);
        }

        return redirect(route('db.master.supplier'));
    }

    public function edit($id)
    {
        $supplier = Supplier::with('profiles.phoneNumbers.provider', 'bankAccounts.bank', 'products')->find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $productList = Product::with('type')->where('status', '=', 'STATUS.ACTIVE')->get();
        $productSelected = array_fill_keys($supplier->products()->pluck('products.id')->toArray(),true);

        return view('supplier.edit', compact('supplier', 'bankDDL', 'statusDDL', 'providerDDL', 'productList', 'productSelected'));
    }

    public function update($id, Request $request)
    {
        $supplier = Supplier::findOrFail($id);

        if (!$supplier) {
            return redirect(route('db.master.supplier'));
        }

        dd($request['productSelected']);

        $supplier->bankAccouns()->detach();

        for ($i = 0; $i < count($request['bank']); $i++) {
            $ba = new BankAccount();
            $ba->bank_id = $request["bank"][$i];
            $ba->account_number = $request["account_number"][$i];
            $ba->remarks = $request["bank_remarks"][$i];

            $supplier->bankAccounts()->save($ba);
        }

        $supplier->profiles()->detach();

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
                error_log($request['profile_' . $i . '_phone_provider'][$j]);
                $ph->number = $request['profile_' . $i . '_phone_number'][$j];
                $ph->remarks = $request['profile_' . $i . '_remarks'][$j];

                $pa->phoneNumbers()->save($ph);
            }
        }

        $supplier->products()->detach();

        for($i = 0; $i < count($request['productSelected']); $i++) {
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

        return redirect(route('db.master.supplier'));
    }

    public function delete($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->bankAccounts()->detach();
        $supplier->profiles()->detach();
        $supplier->delete();

        return redirect(route('db.master.supplier'));
    }
}