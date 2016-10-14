<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:34 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Bank;
use App\Lookup;
use App\Profile;
use App\Product;
use App\Supplier;
use App\BankAccount;
use App\PhoneNumber;
use App\PhoneProvider;
use App\SupplierSetting;

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
        $supplier = Supplier::with('getProfiles.getPhoneNumber', 'getBankAccount.getBank')->find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $bankDDL = Bank::whereStatus('STATUS.active')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.active')->get(['name', 'short_name', 'id']);

        return view('supplier.show', compact('supplier','products', 'pics', 'phone_provider','banks','bank_account','statusDDL'));
	}

	public function create()
	{
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $bankDDL = Bank::whereStatus('STATUS.active')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.active')->get(['name', 'short_name', 'id']);

        return view('supplier.create', compact('bankDDL', 'statusDDL', 'providerDDL'));
	}

	public function store(Request $request)
	{
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'fax_num' => 'string|max:255',
            'tax_id' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $suppliers = [
            'supplier_name' => $request->input('name'),
            'supplier_address' => $request->input('address'),
            'supplier_city' => $request->input('city'),
            'phone_number' => $request->input('phone_number'),
            'fax_num' => $request->input('fax_num'),
            'tax_id' => $request->input('tax_id'),
            'status' => $request->input('status'),
            'remarks' => $request->input('remarks'),
        ];

        $banks = [
            'bank_id' => $request->input('bank_id'),
            'account_number' => $request->input('account'),
            'remarks' => $request->input('bank_remarks'),
            'status' => $request->input('bank_status'),
        ];

        $profiles = [
            'first_name'=> $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address' => $request->input('pic_address'),
        ];

        $supplier = Supplier::create($suppliers);
        $profile = Profile::create($profiles);
            $ic = Profile::find($profile->id);
            //To add IC num
            $ic->ic_num = $profile->id;
            $ic->update();
        $bank = BankAccount::create($banks);

        if ($request->has('due_day')) {
            $setting = Supplier::find($supplier->id);
            $setting->due_day = $request->input('due_day');
            $setting->update();
        }

        $supplier->pic()->attach($profile->id);
        $bank->supplier()->attach($supplier->id);

        return redirect(route('db.master.supplier'));
	}

	public function edit($id)
	{
        $supplier = Supplier::findOrFail($id);
        $products = $supplier->products;
        $pics = $supplier->pic;
        $phone_provider = PhoneProvider::all();
        $banks = Bank::all();
        $bank_account = $supplier->bank;
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('supplier.edit', compact('supplier', 'phone_provider','pics','products','banks','bank_account','statusDDL','phones'));
	}

	public function update(Request $request, $id)
	{
        $supplier = Supplier::findOrFail($id);

        if ($supplier) {
            $supplier->supplier_name = $request->input('name');
            $supplier->supplier_address = $request->input('address');
            $supplier->supplier_city = $request->input('city');
            $supplier->phone_number = $request->input('phone_number');
            $supplier->fax_num = $request->input('fax_num');
            $supplier->tax_id = $request->input('tax_id');
            $supplier->status = $request->input('status');
            $supplier->remarks = $request->input('remarks');
            $supplier->update();

            if ($request->has('due_day')) {
                $supplier->due_day = $request->input('due_day');
                $supplier->update();
            }

            return redirect(route('db.master.supplier'));
        }
	}

	public function delete($id)
	{
        $supplier = Supplier::findOrFail($id);
        $supplier->pic()->detach();
        $supplier->bank()->detach();
        $supplier->delete();
        
        return redirect(route('db.master.supplier'));
	}

    public function storePic(Request $request, $id)
    {
        $this->validate($request,[
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address' => $request->input('address'),
        ];

        $profile = Profile::create($data);
        $ic = Profile::find($profile->id);
                //To add IC num
                $ic->ic_num = $profile->id;
                $ic->update();
        $supplier = Supplier::find($id);
        $supplier->pic()->attach($profile->id);
        return redirect(route('db.master.supplier.edit', $id));
    }

    public function editPic($id, $pic_id)
    {
        $pic = Profile::find($pic_id);
        // return $pic;
        return view('supplier.pic.edit', compact('pic','id','pic_id'));
    }

    public function updatePic(Request $request, $id, $pic_id)
    {
        $profile = Profile::findOrFail($pic_id);

        if ($profile) {
            $profile->first_name = $request->input('first_name');
            $profile->last_name = $request->input('last_name');
            $profile->address = $request->input('address');
            $profile->update();

            return redirect(route('db.master.supplier.edit', $id));
        }
    }

    public function deletePic($id, $pic_id)
    {
        $pic = Profile::findOrFail($pic_id);
        $pic->delete();

        $supplier = Supplier::findOrFail($id);
        $supplier->pic()->detach($pic_id);

        return redirect(route('db.master.supplier.edit', $id));
    }

    public function storePhone(Request $request, $id, $pic_id)
    {
        $pics = Profile::find($pic_id);

        $this->validate($request,[
            'number' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $data = [
            'phone_provider_id' => $request->input('provider'),
            'status' => $request->input('status'),
            'remarks' => $request->input('remarks'),
            'number' => $request->input('number'),
        ];
        $phone = PhoneNumber::create($data);
        $pics->phone()->attach($phone->id);

        return redirect(route('db.master.supplier.edit', $id));
    }

    public function editPhone($id, $pic_id, $phone_id)
    {
        $phone = PhoneNumber::findOrFail($phone_id);
        $phone_provider = PhoneProvider::all();
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('supplier.phone.edit', compact('phone','phone_provider','statusDDL','id', 'pic_id', 'phone_id'));
    }

    public function updatePhone(Request $request, $id, $pic_id, $phone_id)
    {
        $phone =  PhoneNumber::findOrFail($phone_id);
        $this->validate($request,[
            'number' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        if ($phone) {
            $phone->phone_provider_id = $request->input('provider');
            $phone->number = $request->input('number');
            $phone->status =  $request->input('status');
            $phone->remarks = $request->input('remarks');
            $phone->update();

            return redirect(route('db.master.supplier.edit', $id));
        }

    }

    public function deletePhone($id, $pic_id, $phone_id)
    {
        $pics = Profile::findOrFail($pic_id);
        $phone = PhoneNumber::findOrFail($phone_id);
        $phone->delete();
        $pics->phone()->detach($phone_id);

        return redirect(route('db.master.supplier.edit', $id));
    }

    public function addBank(Request $request)
    {
        $this->validate($request,[
            'bank_id' => 'required',
            'account' => 'required|string|max:255',
            'status' => 'required',
        ]);
        $data = [
            'bank_id' => $request->input('bank_id'),
            'account_number' => $request->input('account'),
            'remarks' => $request->input('remarks'),
            'status' => $request->input('status'),
        ];

        $supplier_id = $request->input('supplier_id');
        $bank = BankAccount::create($data);
        $bank->supplier()->attach($supplier_id);
        return redirect(route('db.master.supplier.edit', $supplier_id));
    }

    public function editBank($id, $bank_id) {
        $bank_account = BankAccount::find($bank_id);
        $banks = Bank::all();
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('supplier.bank.edit', compact('bank_account', 'banks', 'statusDDL', 'id'));
    }

    public function updateBank(Request $request, $id, $bank_id) {
        $this->validate($request,[
            'bank_id' => 'required',
            'account' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $bank_account = BankAccount::findOrFail($bank_id);

        if ($bank_account) {
            $bank_account->bank_id = $request->input('bank_id');
            $bank_account->account_number = $request->input('account');
            $bank_account->remarks = $request->input('remarks');
            $bank_account->status = $request->input('status');
            $bank_account->update();
        }

        return redirect(route('db.master.supplier.edit', $id));
    }

    public function deleteBank($id, $bank_id)
    {
        $bank = BankAccount::findOrFail($bank_id);
        $bank->delete();
        $bank->supplier()->detach($id);
        return redirect(route('db.master.supplier.edit', $id));
    }
}