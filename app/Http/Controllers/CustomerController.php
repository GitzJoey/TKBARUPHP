<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\PhoneNumber;
use App\PhoneProvider;
use App\Profile;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Bank;
use App\Lookup;
use App\Customer;

class CustomerController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customer = Customer::paginate(10);
        return view('customer.index')->with('customer', $customer);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customer.show')->with('customer', $customer);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $bankDDL = Bank::whereStatus('STATUS.active')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.active')->get(['name', 'short_name', 'id']);

        return view('customer.create', compact('statusDDL', 'bankDDL', 'providerDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            /*
            'name'              => 'required|string|max:255',
            'address'           => 'required|string',
            'city'              => 'required|string|max:255',
            'phone'             => 'required|regex:/[0-9]{9}/',
            'tax_id'            => 'required|string|max:255',
            'remarks'           => 'required|string|max:255'
            */
        ]);

        if ($validator->fails()) {
            return redirect(route('db.master.customer.create'))->withInput()->withErrors($validator);
        } else {
            $customer = new Customer();
            $customer->name             = $data['name'];
            $customer->address          = $data['address'];
            $customer->city             = $data['city'];
            $customer->phone_number     = $data['phone'];
            $customer->tax_id           = $data['tax_id'];
            $customer->remarks          = $data['remarks'];
            $customer->payment_due_day  = is_int($data['payment_due_day']) ? $data['payment_due_day']:0;

            $customer->save();

            for($i=0; $i<count($data['bank']); $i++) {
                $ba = new BankAccount();
                $ba->bank_id = $data["bank"][$i];
                $ba->account_number = $data["account_number"][$i];
                $ba->remarks = $data["bank_remarks"][$i];

                $customer->getBankAccount()->save($ba);
            }

            for($i=0; $i<count($data['bank']); $i++) {
                $pa = new Profile();
                $pa->first_name = $data["first_name"][$i];
                $pa->last_name = $data["last_name"][$i];
                $pa->address = $data["profile_address"][$i];
                $pa->ic_num = $data["ic_num"][$i];

                $customer->getProfiles()->save($pa);

                for ($j=0; $j<count($data['profile_'.$i.'_phone_provider']); $j++) {
                    $ph = new PhoneNumber();
                    $ph->phone_provider_id = $data['profile_'.$i.'_phone_provider'][$j];
                    $ph->number = $data['profile_'.$i.'_phone_number'][$j];
                    $ph->remarks = $data['profile_'.$i.'_remarks'][$j];

                    $pa->getPhoneNumber()->save($ph);
                }
            }

            return redirect(route('db.master.customer'));
        }
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $bankDDL = Bank::whereStatus('STATUS.active')->get(['name', 'short_name', 'id']);
        $providerDDL = PhoneProvider::whereStatus('STATUS.active')->get(['name', 'short_name', 'id']);

        return view('customer.edit', compact('customer', 'statusDDL', 'bankDDL', 'providerDDL'));
    }

    public function update($id, Request $data)
    {
        $customer = Customer::find($id);
        /*
        $newba = array();
        for($i=0; $i<count($data['bank']); $i++) {
            $ba = new BankAccount();
            $ba->bank_id = $data["bank"][$i];
            $ba->account_number = $data["account_number"][$i];
            $ba->remarks = $data["bank_remarks"][$i];

            array_push($newba, $ba);
        }

        $customer->getBankAccount()->sync($newba);
        */
        $customer->name             = $data['name'];
        $customer->address          = $data['address'];
        $customer->city             = $data['city'];
        $customer->phone_number     = $data['phone'];
        $customer->tax_id           = $data['tax_id'];
        $customer->remarks          = $data['remarks'];
        $customer->payment_due_day  = is_int($data['payment_due_day']) ? $data['payment_due_day']:0;

        $customer->save();

        return redirect(route('db.master.customer'));
    }

    public function delete($id)
    {
        Customer::findOrFail($id)->delete();
        return redirect(route('db.master.customer'));
    }
}
