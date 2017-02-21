<?php
namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Repos\LookupRepo;
use App\Model\Currencies;

class CurrenciesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index()
	{
		$currencieslist = Currencies::paginate(10);
        return view('currencies.index', compact('currencieslist'));
	}
	public function create()
	{
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');
		return view('currencies.create' , compact('statusDDL'));
	}
	public function store(Request $req)
	{
		$validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.admin.currencies.create'))->withInput()->withErrors($validator);
        } else {
            Currencies::create([
                'name' => $req['name'],
                'symbol' => $req['symbol'],
                'status' => $req['status'],
                'remarks' => $req['remarks'],
            ]);

            return redirect(route('db.admin.currencies'));
        }
	}
}