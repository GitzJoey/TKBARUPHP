<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 11/12/2016
 * Time: 1:37 PM
 */

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;

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
        $giro = Giro::find($id);
        return view('giro.show')->with('giro', $giro);
    }

    public function create()
    {
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->pluck('name', 'id');

        return view('giro.create', compact('bankDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'bank' => 'required|string|max:255',
            'effective_date' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.bank.giro.create'))->withInput()->withErrors($validator);
        } else {
            Giro::create([
                'store_id' => Auth::user()->store->id,
                'bank_id' => $data['bank'],
                'serial_number' => $data['serial_number'],
                'effective_date' => date('Y-m-d', strtotime($data->input('effective_date'))),
                'amount' => floatval(str_replace(',', '', $data['amount'])),
                'printed_name' => $data['printed_name'],
                'status' => 'GIROSTATUS.N',
                'remarks' => $data['remarks']
            ]);
            return redirect(route('db.bank.giro'));
        }
    }

    public function edit($id)
    {
        $giro = Giro::find($id);

        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->pluck('name', 'id');

        return view('giro.edit', compact('giro', 'bankDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'serial_number' => 'required|string|max:255',
            'effective_date' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.bank.giro.edit', $id))->withInput()->withErrors($validator);
        } else {
            $giro = Giro::find($id);

            $giro->bank_id = $req['bank'];
            $giro->serial_number = $req['serial_number'];
            $giro->effective_date = date('Y-m-d', strtotime($req['effective_date']));
            $giro->amount = floatval(str_replace(',', '', $req['amount']));
            $giro->remarks = $req['remarks'];

            $giro->save();

            return redirect(route('db.bank.giro'));
        }
    }

    public function delete($id)
    {
        Giro::find($id)->delete();

        return redirect(route('db.bank.giro'));
    }
}