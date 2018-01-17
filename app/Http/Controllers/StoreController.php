<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 9:46 AM
 */

namespace App\Http\Controllers;

use DB;
use Auth;
use Config;
use Validator;
use Exception;
use LaravelLocalization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

use App\Model\Bank;
use App\Model\Store;
use App\Model\BankAccount;
use App\Model\Currencies;
use App\Model\CurrenciesConversion;

use App\Repos\LookupRepo;

use App\Util\PHP2Moment;

use App\Services\StoreService;

class StoreController extends Controller
{
    private $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
        $this->middleware('auth', ['except' => 'isUnfinishedStoreExist']);
    }

    public function index()
    {
        Log::info('[StoreController@index] ');

        $store = Store::paginate(Config::get('const.PAGINATION'));

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

        $mapsAPIKey = env('MAPS_API_KEY');

        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $yesnoDDL = LookupRepo::findByCategory('YESNOSELECT')->pluck('i18nDescription', 'code');
        $currenciesDDL = Currencies::whereStatus('STATUS.ACTIVE')->get(['id', 'name', 'symbol']);
        return view('store.create', compact('statusDDL', 'yesnoDDL', 'bankDDL', 'currenciesDDL', 'mapsAPIKey'));
    }

    public function store(Request $data)
    {
        Log::info('[StoreController@store] ');

        $this->validate($data, [
            'name' => 'required|string|max:255',
            'tax_id' => 'required|string|max:255',
            'status' => 'required',
            'is_default' => 'required',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::beginTransaction();

        try {
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
                'latitude' => empty($data['latitude']) ? 0:$data['latitude'],
                'longitude' => empty($data['longitude']) ? 0:$data['longitude'],
                'phone_num' => $data['phone_num'],
                'fax_num' => $data['fax_num'],
                'tax_id' => $data['tax_id'],
                'status' => $data['status'],
                'is_default' => $data['is_default'],
                'frontweb' => $data['frontweb'],
                'image_filename' => $imageName,
                'remarks' => empty($data['remarks']) ? '' : $data['remarks'],
                'date_format' => $data['date_format'],
                'time_format' => $data['time_format'],
                'thousand_separator' => $data['thousand_separator'],
                'decimal_separator' => $data['decimal_separator'],
                'decimal_digit' => $data['decimal_digit'],
                'ribbon' => $data['ribbon'],
            ]);

            for ($i = 0; $i < count($data['bank']); $i++) {
                $ba = new BankAccount();
                $ba->bank_id = $data["bank"][$i];
                $ba->account_name = $data["account_name"][$i];
                $ba->account_number = $data["account_number"][$i];
                $ba->remarks = $data["bank_remarks"][$i];

                $store->bankAccounts()->save($ba);
            }

            for ($i = 0; $i < count($data['currencies']); $i++) {
                $curConv = new CurrenciesConversion();
                $curConv->currencies_id = $data["currencies"][$i];
                $curConv->is_base = $data["base_currencies"][$i] == '1' ? true:false;
                $curConv->conversion_value = $data["currencies_conversion_value"][$i];
                $curConv->remarks = $data["currencies_remarks"][$i];

                $store->currenciesConversions()->save($curConv);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        };

        return response()->json();
    }

    public function edit($id)
    {
        Log::info('[StoreController@edit] $id:' . $id);

        $mapsAPIKey = env('MAPS_API_KEY');

        $store = Store::with('bankAccounts.bank')->where('id', '=' , $id)->first();

        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $yesnoDDL = LookupRepo::findByCategory('YESNOSELECT')->pluck('i18nDescription', 'code');
        $currenciesDDL = Currencies::whereStatus('STATUS.ACTIVE')->get(['id', 'name', 'symbol']);

        return view('store.edit', compact('store', 'statusDDL', 'yesnoDDL', 'bankDDL','currenciesDDL', 'mapsAPIKey'));
    }

    public function update($id, Request $data)
    {
        Log::info('[StoreController@update] $id:' . $id);

        DB::beginTransaction();

        try {
            $store = Store::find($id);

            $imageName = '';

            if (!empty($store->image_filename)) {
                if (!empty($data->image_path)) {
                    $imageName = time() . '.' . $data->image_path->getClientOriginalExtension();
                    $path = public_path('images') . '/' . $imageName;

                    Image::make($data->image_path->getRealPath())->resize(160, 160)->save($path);
                } else {
                    $imageName = $store->image_filename;
                }
            } else {
                if (!empty($data->image_path)) {
                    $imageName = time() . '.' . $data->image_path->getClientOriginalExtension();
                    $path = public_path('images') . '/' . $imageName;

                    Image::make($data->image_path->getRealPath())->resize(160, 160)->save($path);
                } else {
                    $imageName = '';
                }
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
                $ba->account_name = $data["account_name"][$i];
                $ba->account_number = $data["account_number"][$i];
                $ba->remarks = $data["bank_remarks"][$i];

                $store->bankAccounts()->save($ba);
            }

            $store->currenciesConversions->each(function($curConv) { $curConv->delete(); });
            for ($i = 0; $i < count($data['currencies']); $i++) {
                $curConv = new CurrenciesConversion();
                $curConv->currencies_id = $data["currencies"][$i];
                $curConv->is_base = $data["base_currencies"][$i] == '1'?true:false;
                $curConv->conversion_value = $data["currencies_conversion_value"][$i];
                $curConv->remarks = $data["currencies_remarks"][$i];

                $store->currenciesConversions()->save($curConv);
            }

            $store->name = $data['name'];
            $store->address = $data['address'];
            $store->latitude = empty($data['latitude']) ? 0:$data['latitude'];
            $store->longitude = empty($data['longitude']) ? 0:$data['longitude'];
            $store->phone_num = $data['phone_num'];
            $store->fax_num = $data['fax_num'];
            $store->tax_id = $data['tax_id'];
            $store->status = $data['status'];
            $store->is_default = $data['is_default'];
            $store->image_filename = $imageName;
            $store->frontweb = $data['frontweb'];
            $store->remarks = empty($data['remarks']) ? '' : $data['remarks'];

            $store->date_format = $data['date_format'];
            $store->time_format = $data['time_format'];
            $store->thousand_separator = $data['thousand_separator'];
            $store->decimal_separator = $data['decimal_separator'];
            $store->decimal_digit = $data['decimal_digit'];
            $store->ribbon = $data['ribbon'];

            $store->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        };

        return response()->json();
    }

    public function delete($id)
    {
        Log::info('[StoreController@delete] $id:' . $id);

        $store = Store::find($id);

        Validator::extend('isdefault', function ($field, $value, $parameters) {
            return $value == 'YESNOSELECT.YES' ? false : true;
        });

        $inputs = array(
            'is_default' => $store->is_default
        );

        $rules = array('is_default' => 'isdefault');

        $messages = array(
            'isdefault' => LaravelLocalization::getCurrentLocale() == 'en' ? 'Default Store cannot be deleted':'Toko Utama tidak bisa di hapus'
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

    public function applySettings(Request $req)
    {
        $store = Store::whereId(Auth::user()->store->id)->first();

        $store->date_format = PHP2Moment::convertToPHPDate($req['df']);
        $store->time_format = PHP2Moment::convertToPHPDate($req['tf']);
        $store->thousand_separator = $req['ts'];
        $store->decimal_separator = $req['ds'];
        $store->decimal_digit = $req['dd'];

        $store->save();

        return response()->json();
    }

    public function isUnfinishedStoreExist()
    {
        return response()->json([
            'return' => $this->storeService->isUnfinishedStoreExist() ? 'true':'false'
        ]);
    }
}
