<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 11/12/2016
 * Time: 1:37 PM
 */

namespace App\Http\Controllers;

use Vinkla\Hashids\Facades\Hashids;

use App\Model\Bank;
use App\Model\Giro;

class GiroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $girolist = Giro::paginate(10);
        return view('giro.index', compact('girolist'));
    }

    public function show($id)
    {
        $giro = Truck::find($id);
        return view('giro.show')->with('truck', $giro);
    }

    public function create()
    {
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get();
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('giro.create', compact('statusDDL', 'bankDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'bank' => 'required|string|max:255',
            'effective_date' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.bank.giro.create'))->withInput()->withErrors($validator);
        } else {
            Giro::create([
                'store_id' => Auth::user()->store->id,
                'bank_id' => 0,
                'serial_number' => $data['serial_number'],
                'effective_date' => date('Y-m-d', strtotime($data->input('effective_date '))),
                'amount' => $data['amount'],
                'printed_name' => $data['printed_name'],
                'status' => $data['status'],
                'remarks' => $data['remarks']
            ]);
            return redirect(route('db.bank.giro'));
        }
    }

    public function edit($id)
    {
        $giro = Giro::find($id);

        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->get();
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('giro.edit', compact('giro', 'statusDDL', 'bankDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'serial_number' => 'required|string|max:255',
            'effective_date' => 'required|string|max:255',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.bank.giro.edit'))->withInput()->withErrors($validator);
        } else {
            Giro::find($id)->update($req->all());

            return redirect(route('db.bank.giro'));
        }
    }

    public function delete($id)
    {
        Giro::find($id)->delete();

        return redirect(route('db.bank.giro'));
    }
}