<?php
namespace App\Http\Controllers;

use Config;
use Validator;
use Illuminate\Http\Request;
use App\Repos\LookupRepo;
use App\Model\Currencies;
use App\Model\CurrenciesConversion;

class CurrenciesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth',[ 
            'except' => [ 
                'conversion'
            ] 
        ]);
	}
	public function index()
	{
		$currencieslist = Currencies::paginate(Config::get('const.PAGINATION'));
        return view('currencies.index', compact('currencieslist'));
	}
	public function create()
	{
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
		return view('currencies.create' , compact('statusDDL'));
	}
	public function store(Request $req)
	{
		$validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ])->validate();

        Currencies::create([
            'name' => $req['name'],
            'symbol' => $req['symbol'],
            'status' => $req['status'],
            'remarks' => $req['remarks'],
        ]);

        return response()->json();
	}
    public function show($id)
    {
        $currencies = Currencies::find($id);
        return view('currencies.show' , compact('currencies'));
    }
    public function edit($id)
    {
        $currencies = Currencies::find($id);
        $statusDDL  = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');
        return view('currencies.edit' , compact('currencies','statusDDL'));
    }
    public function update($id , Request $req)
    {
        $validator = Validator::make($req->all() , [
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:255',
            'status' => 'required|string|max:255'
        ])->validate();
	    
        Currencies::find($id)->update($req->all());

        return response()->json();
    }
    public function delete($id)
    {
        Currencies::find($id)->delete();
        return redirect(route('db.admin.currencies'));
    }
    public function conversion(Request $req){
        $currencies_id = $req->query('currencies_id');
        $store_id = $req->query('store_id');
        $con = CurrenciesConversion::where('currencies_id',$currencies_id)->where('store_id',$store_id)->first();
        $conVal = isset($con->conversion_value) ? $con->conversion_value : 0;
        return response()->json([
            'data' => $conVal
        ], 200);
    }
}
