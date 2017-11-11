<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 11/12/2016
 * Time: 1:37 PM
 */

namespace App\Http\Controllers;

use Auth;
use Config;
use Validator;
use Illuminate\Http\Request;

use App\Model\Bank;
use App\Model\Giro;

use App\Services\GiroService;

class GiroController extends Controller
{
    private $giroService;

    public function __construct(GiroService $giroService)
    {
        $this->middleware('auth', ['except' => ['getDueGiro']]);
        $this->giroService = $giroService;
    }

    public function index()
    {
        $girolist = Giro::paginate(Config::get('const.PAGINATION'));

        return view('bank.giro.index', compact('girolist'));
    }

    public function show($id)
    {
        $giro = Giro::find($id);
        return view('bank.giro.show')->with('giro', $giro);
    }

    public function create()
    {
        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->pluck('name', 'id');

        return view('bank.giro.create', compact('bankDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'bank' => 'required|string|max:255',
            'effective_date' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255',
        ])->validate();

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

        return response()->json();
    }

    public function edit($id)
    {
        $giro = Giro::find($id);

        $bankDDL = Bank::whereStatus('STATUS.ACTIVE')->pluck('name', 'id');

        return view('bank.giro.edit', compact('giro', 'bankDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'serial_number' => 'required|string|max:255',
            'effective_date' => 'required|string|max:255',
        ])->validate();

        $giro = Giro::find($id);

        $giro->bank_id = $req['bank'];
        $giro->serial_number = $req['serial_number'];
        $giro->effective_date = date('Y-m-d', strtotime($req['effective_date']));
        $giro->amount = floatval(str_replace(',', '', $req['amount']));
        $giro->remarks = $req['remarks'];

        $giro->save();

        return response()->json();
    }

    public function delete($id)
    {
        Giro::find($id)->delete();

        return redirect(route('db.bank.giro'));
    }

    public function overrideConfirm($id)
    {

        return redirect(route('db.bank.giro'));
    }

    public function getDueGiro()
    {
        return $this->giroService->getDueGiro();
    }
}
