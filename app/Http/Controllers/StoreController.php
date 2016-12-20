<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 9:46 AM
 */

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

use App\Model\Bank;
use App\Model\Store;
use App\Model\Lookup;
use App\Model\BankAccount;

use App\Services\StoreService;

class StoreController extends Controller
{
    private $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
        $this->middleware('auth');
    }

    public function index()
    {
        Log::info('[StoreController@index] ');

        $store = Store::paginate(10);

        return view('store.index', compact('store'));
    }

    public function show($id)
    {
        Log::info('[StoreController@show] $id: ' . $id);

        $store = Store::find($id);

        return view('store.show')->with('store', $store);
    }

    public function create()
    {
        Log::info('[StoreController@create] ');

        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $yesnoDDL = Lookup::where('category', '=', 'YESNOSELECT')->get()->pluck('description', 'code');

        return view('store.create', compact('statusDDL', 'yesnoDDL', 'bankDDL'));
    }

    public function store(Request $data)
    {
        Log::info('[StoreController@store] ');

        $this->validate($data, [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_num' => 'required|string|max:255',
            'tax_id' => 'required|string|max:255',
            'status' => 'required',
            'is_default' => 'required',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = '';

        if (!empty($data->image_path)) {
            $imageName = time() . '.' . $data->image_path->getClientOriginalExtension();
            $path = public_path('images') . '/' . $imageName;

            Image::make($data->image_path->getRealPath())->resize(160, 160)->save($path);
        }

        if ($data['is_default'] == 'YESNOSELECT.YES') {
            $this->storeService->resetIsDefault();
        }

        if ($data['frontweb'] == 'YESNOSELECT.YES') {
            $this->storeService->resetFrontWeb();
        }

        $store = Store::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'phone_num' => $data['phone_num'],
            'fax_num' => $data['fax_num'],
            'tax_id' => $data['tax_id'],
            'status' => $data['status'],
            'is_default' => $data['is_default'],
            'frontweb' => $data['frontweb'],
            'image_filename' => $imageName,
            'remarks' => empty($data['remarks']) ? '' : $data['remarks']
        ]);

        for ($i = 0; $i < count($data['bank']); $i++) {
            $ba = new BankAccount();
            $ba->bank_id = $data["bank"][$i];
            $ba->account_number = $data["account_number"][$i];
            $ba->remarks = $data["bank_remarks"][$i];

            $store->bankAccounts()->save($ba);
        }

        return redirect(route('db.admin.store'));
    }

    public function edit($id)
    {
        Log::info('[StoreController@edit] $id:' . $id);

        $store = Store::with('bankAccounts.bank')->where('id', '=' , $id)->first();

        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $yesnoDDL = Lookup::where('category', '=', 'YESNOSELECT')->get()->pluck('description', 'code');

        return view('store.edit', compact('store', 'statusDDL', 'yesnoDDL', 'bankDDL'));
    }

    public function update($id, Request $data)
    {
        Log::info('[StoreController@update] $id:' . $id);

        $store = Store::find($id);

        $imageName = '';

        if (!empty($data->image_path)) {
            $imageName = time() . '.' . $data->image_path->getClientOriginalExtension();
            $path = public_path('images') . '/' . $imageName;

            Image::make($data->image_path->getRealPath())->resize(160, 160)->save($path);
        }

        if ($store->is_default == 'YESNOSELECT.NO' && $data['is_default'] == 'YESNOSELECT.YES') {
            $this->storeService->resetIsDefault();
        }

        if ($store->frontweb == 'YESNOSELECT.NO' && $data['frontweb'] == 'YESNOSELECT.YES') {
            $this->storeService->resetFrontWeb();
        }

        $store->bankAccounts->each(function($ba) { $ba->delete(); });

        for ($i = 0; $i < count($data['bank']); $i++) {
            $ba = new BankAccount();
            $ba->bank_id = $data["bank"][$i];
            $ba->account_number = $data["account_number"][$i];
            $ba->remarks = $data["bank_remarks"][$i];

            $store->bankAccounts()->save($ba);
        }

        $store->name = $data['name'];
        $store->address = $data['address'];
        $store->phone_num = $data['phone_num'];
        $store->fax_num = $data['fax_num'];
        $store->tax_id = $data['tax_id'];
        $store->status = $data['status'];
        $store->is_default = $data['is_default'];
        $store->image_filename = $imageName;
        $store->frontweb = $data['frontweb'];
        $store->remarks = empty($data['remarks']) ? '' : $data['remarks'];
        $store->save();

        return redirect(route('db.admin.store'));
    }

    public function delete($id)
    {
        Log::info('[StoreController@delete] $id:' . $id);

        $store = Store::find($id);

        $validator = Validator::extend('isdefault', function ($field, $value, $parameters) {
            return $value == 'YESNOSELECT.YES' ? false : true;
        });

        $inputs = array(
            'is_default' => $store->is_default
        );

        $rules = array('is_default' => 'isdefault');

        $messages = array(
            'isdefault' => 'Default Store cannot be deleted'
        );

        $validator = Validator::make($inputs, $rules, $messages);

        if ($validator->fails()) {
            return redirect(route('db.admin.store'))->withErrors($validator);
        } else {
            $store->bankAccounts->each(function($ba) { $ba->delete(); });
            $store->delete();
        }

        return redirect(route('db.admin.store'));
    }
}