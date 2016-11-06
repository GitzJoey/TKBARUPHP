<?php

namespace App\Http\Controllers;

use App\Model\Bank;
use App\Model\Lookup;
use App\Model\Profile;
use App\Model\Deliver;
use App\Model\Customer;
use App\Model\SalesOrder;
use App\Model\PriceLevel;
use App\Model\BankAccount;
use App\Model\PhoneNumber;
use App\Model\PhoneProvider;

use Auth;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [ 'except' => [ 'searchCustomers' ] ]);
    }

    public function index()
    {
        $customer = Customer::paginate(10);
        return view('customer.index')->with('customer', $customer);
    }

    public function show($id)
    {
        $customer = Customer::with('profiles.phoneNumbers', 'bankAccounts.bank')->find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);

        return view('customer.show', compact('customer', 'statusDDL', 'bankDDL', 'providerDDL'));
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $priceLevelDDL = PriceLevel::whereStatus('STATUS.ACTIVE')->get(['name', 'description', 'weight', 'id']);

        return view('customer.create', compact('statusDDL', 'bankDDL', 'providerDDL', 'priceLevelDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'tax_id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.master.customer.create'))->withInput()->withErrors($validator);
        } else {
            $customer = new Customer();
            $customer->store_id = Auth::user()->store->id;
            $customer->name = $data['name'];
            $customer->address = $data['address'];
            $customer->city = $data['city'];
            $customer->phone_number = $data['phone'];
            $customer->tax_id = $data['tax_id'];
            $customer->remarks = $data['remarks'];
            $customer->payment_due_day = is_int($data['payment_due_day']) ? $data['payment_due_day'] : 0;
            $customer->price_level_id = $data['price_level'];

            $customer->save();

            for ($i = 0; $i < count($data['bank']); $i++) {
                $ba = new BankAccount();
                $ba->bank_id = $data["bank"][$i];
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

            return redirect(route('db.master.customer'));
        }
    }

    public function edit($id)
    {
        $customer = Customer::with('profiles.phoneNumbers', 'bankAccounts.bank')->find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.ACTIVE')->get(['name', 'short_name', 'id']);
        $priceLevelDDL = PriceLevel::whereStatus('STATUS.ACTIVE')->get(['name', 'description', 'weight', 'id']);

        return view('customer.edit', compact('customer', 'statusDDL', 'bankDDL', 'providerDDL', 'priceLevelDDL'));
    }

    public function update($id, Request $data)
    {
        $customer = Customer::findOrFail($id);

        if (!$customer) {
            return redirect(route('db.master.customer'));
        }

        $customer->bankAccounts()->detach();

        for ($i = 0; $i < count($data['bank']); $i++) {
            $ba = new BankAccount();
            $ba->bank_id = $data["bank"][$i];
            $ba->account_number = $data["account_number"][$i];
            $ba->remarks = $data["bank_remarks"][$i];

            $customer->bankAccounts()->save($ba);
        }

        $customer->profiles()->detach();

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

        $customer->name = $data['name'];
        $customer->address = $data['address'];
        $customer->city = $data['city'];
        $customer->phone_number = $data['phone'];
        $customer->tax_id = $data['tax_id'];
        $customer->remarks = $data['remarks'];
        $customer->price_level_id = empty($data['price_level']) ? 0 : $data['price_level'];
        $customer->payment_due_day = is_int($data['payment_due_day']) ? $data['payment_due_day'] : 0;

        $customer->save();

        return redirect(route('db.master.customer'));
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer) {
            $customer->bankAccounts()->delete();

            foreach ($customer->getProfiles as $prof) {
                $prof->phoneNumber()->delete();
            }

            $customer->profiles()->delete();

            $customer->delete();
        }

        return redirect(route('db.master.customer'));
    }

    public function confirmationIndex()
    {
        $profile = Profile::with('customers')->where('user_id', '=' , Auth::user()->id)->first();

        $customerhid = Hashids::encode(0);

        if ($profile && $profile->customers()) {
            $customerhid = Hashids::encode($profile->customers()->first()->id);
        }

        return redirect(route('db.customer.confirmation.confirm.customer', $customerhid));
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
            ->paginate(10);

        return view('customer.confirmation.index', compact('solist'));
    }

    public function confirmSalesOrder($id)
    {
        $so = SalesOrder::with('customer', 'items.product.productUnits.unit')->where('id', '=', $id)->first();

        return view('customer.confirmation.confirm', compact('so'));
    }

    public function storeConfirmationSalesOrder($id, Request $request)
    {
        for ($i = 0; $i < sizeof($request->input('item_id')); $i++) {
            $conversionValue = ProductUnit::where([
                'product_id' => $request->input("product_id.$i"),
                'unit_id' => $request->input("selected_unit_id.$i")
            ])->first()->conversion_value;

            $deliver = Deliver::whereId($request->input('deliver_id'))->first();
            $deliver->netto = $request->input('netto');
            $deliver->base_netto = $conversionValue * $request->input('netto');
            $deliver->tare = $request->input('tare');
            $deliver->base_tare = $conversionValue * $request->input('tare');
            $deliver->remarks = $request->input('remarks');

            $deliver->save();
        }

        $so = SalesOrder::whereId($id)->first();
        $so->status = 'POSTATUS.WAPPV';
        $so->save();

        return redirect()->action('App\Http\Controllers\CustomerController@confirmSalesOrder', [$id]);
    }

    public function searchCustomers(Request $request)
    {
        $param = $request->input('param');

        if(empty($param))
            return collect([]);

        return Customer::with('profiles')->where('name', 'like', "%$param%")
            ->orWhereHas('profiles', function ($query) use ($param)
            {
                $query->where('first_name', 'like', "%$param%")
                      ->orWhere('last_name', 'like', "%$param%");
            })->get();
    }
}
