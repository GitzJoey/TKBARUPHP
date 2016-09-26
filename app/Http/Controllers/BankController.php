<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:33 AM
 */

namespace App\Http\Controllers;

use \DateTime;
use App\Bank;
use Illuminate\Http\Request;
use App\Lookup;
use Validator;

class BankController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bank = Bank::paginate(10);
        return view('bank.index')->with('banks', $bank);
    }

    public function show($id)
    {
        $bank = Bank::find($id);
        return view('bank.show')->with('bank', $bank);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('bank.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(),[
            'name'    		=> 'required|string|max:255',
            'short_name' 	=> 'required|string|max:255',
          	'branch' 	 	=> 'required|string|max:255',
          	'branch_code' 	=> 'required|string|max:255',
            'status'     	=> 'required',
            'remarks'    	=> 'required|string|max:255',

        ]);

        if ($validator->fails()) {
            return redirect(route('db.master.bank.create'))->withInput()->withErrors($validator);
        } else {

            Bank::create([
                'name'       	=> $data['name'],
                'short_name' 	=> $data['short_name'],
                'branch'	 	=> $data['branch'],
                'branch_code'	=> $data['branch_code'],
                'status'     	=> $data['status'],
                'remarks'    	=> $data['remarks']
            ]);
            return redirect(route('db.master.bank'));
        }
    }

    public function upload()
    {
        $bankDDL = Bank::get()->pluck('name', 'id');
        return view('bank.upload', compact('bankDDL'));
    }

    public function edit($id)
    {
        $bank= Bank::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('bank.edit', compact('bank', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        Bank::find($id)->update($req->all());
        return redirect(route('db.master.bank'));
    }

    public function delete($id)
    {
        Bank::find($id)->delete();
        return redirect(route('db.master.bank'));
    }
}