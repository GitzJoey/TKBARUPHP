<?php
//PetengDedet

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;

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

        return view('customer.create');
    }

    public function store(Request $data)
    {

        $validator = Validator::make($data->all(), [
            'name'              => 'required|string|max:255',
            'address'           => 'required|string',
            'city'              => 'required|string|max:255',
            'phone'             => 'required|regex:/[0-9]{9}/',
            'tax_id'            => 'required|string|max:255',
            'remarks'           => 'required|string|max:255'

        ]);

        if ($validator->fails()) {
            return redirect(route('db.master.customer.create'))->withInput()->withErrors($validator);
        } else {

            Customer::create([
                'name'              => $data['name'],
                'address'           => $data['address'],
                'city'              => $data['city'],
                'phone'             => $data['phone'],
                'tax_id'            => $data['tax_id'],
                'remarks'           => $data['remarks'],
                'payment_due_date'  => $data['payment_due_date']
            ]);
            return redirect(route('db.master.customer'));
        }
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customer.edit', compact('customer'));
    }

    public function update($id, Request $req)
    {
        Customer::findOrFail($id)->update($req->all());
        return redirect(route('db.master.customer'));
    }

    public function delete($id)
    {
        Customer::findOrFail($id)->delete();
        return redirect(route('db.master.customer'));
    }
}
