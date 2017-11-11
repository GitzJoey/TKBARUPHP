<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:33 AM
 */

namespace App\Http\Controllers;

use App\Model\Bank;
use App\Model\BankUpload;
use App\Model\BankBCACSVRecord;

use App\Repos\LookupRepo;

use Auth;
use Config;
use Storage;
use Validator;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BankController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getLastBankUpload']]);
    }

    public function index()
    {
        $bank = Bank::paginate(Config::get('const.PAGINATION'));
        return view('bank.index')->with('banks', $bank);
    }

    public function show($id)
    {
        $bank = Bank::find($id);
        return view('bank.show')->with('bank', $bank);
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        return view('bank.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'branch_code' => 'required|string|max:255',
            'status' => 'required',
            'remarks' => 'required|string|max:255',

        ])->validate();

         Bank::create([
            'store_id' => Auth::user()->store->id,
            'name' => $data['name'],
            'short_name' => $data['short_name'],
            'branch' => $data['branch'],
            'branch_code' => $data['branch_code'],
            'status' => $data['status'],
            'remarks' => $data['remarks']
        ]);
        
         return response()->json();
    }

    public function edit($id)
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $bank = Bank::find($id);

        return view('bank.edit', compact('bank', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:255',
            'branch' => 'required|string|max:255',
            'branch_code' => 'required|string|max:255',
            'status' => 'required',
            'remarks' => 'required|string|max:255',

        ])->validate();

        Bank::find($id)->update($req->all());

        return response()->json();
    }

    public function delete($id)
    {
        Bank::find($id)->delete();
        return redirect(route('db.master.bank'));
    }

    public function upload()
    {
        $bankDDL = LookupRepo::findByCategory('BANKUPLOAD')->pluck('description', 'code');
        $bankUploads = BankUpload::all();

        return view('bank.upload', compact('bankDDL', 'bankUploads'));
    }

    public function storeUpload(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'bank' => 'required|string|max:255',
            'file_path' => 'required|mimes:csv,txt|size:max:999',
        ]);

        $path = Storage::disk('file_upload')->put($data->file('file_path')->getClientOriginalName(), $data->file('file_path'));
        $bankUpload = BankUpload::create(['bank' => $data->input('bank'), 'filename' => $data->file('file_path')->getClientOriginalName()]);

        Excel::load(storage_path('app/file_upload/' . $path), function ($reader) use ($data, $bankUpload){
            if($data->input('bank') == 'BANKUPLOAD.BCA'){
                Config::set('excel.import.startRow', 5);

                $dataRows = $reader->get();

                $dataRows->each(function ($item, $key) use ($bankUpload){
                    //Check if it already reached the footer
                    if($item['tanggal'] == 'Saldo Awal'){
                        return false;
                    }

                    $date = str_replace("'", "", $item['tanggal']);
                    $date = explode('/', $date);
                    $date = Carbon::create(null, $date[1], $date[0]);
                    $branch = str_replace("'", "", $item['cabang']);
                    $remarks = $item['keterangan'];
                    $amount = floatval($item['jumlah']);
                    $db_cr = $item[''];
                    $balance = floatval($item['saldo']);

                    BankBCACSVRecord::create([
                        'date' => $date,
                        'branch' => $branch,
                        'remarks' => $remarks,
                        'amount' => $amount,
                        'db_cr' => $db_cr,
                        'balance' => $balance,
                        'bank_upload_id' => $bankUpload->id
                    ]);
                });
            }
        });

        $data->session()->flash('success', 'Upload success.');
        return redirect()->action('BankController@upload');
    }

    public function getLastBankUpload()
    {
        return BankUpload::orderBy('created_at', 'desc')->take(1)->get();
    }
}
