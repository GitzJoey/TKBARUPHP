<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/22/2016
 * Time: 5:04 PM
 */

namespace App\Http\Controllers;

use App\Model\PriceLevel;

use App\Repos\LookupRepo;

use Auth;
use Config;
use Validator;
use Illuminate\Http\Request;

class PriceLevelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pricelevel = PriceLevel::paginate(Config::get('const.PAGINATION'));
        return view('price_level.index')->with('pricelevel', $pricelevel);
    }

    public function show($id)
    {
        $pricelevel = PriceLevel::find($id);
        return view('price_level.show')->with('pricelevel', $pricelevel);
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $plTypeDDL = LookupRepo::findByCategory('PRICELEVELTYPE')->pluck('i18nDescription', 'code');

        return view('price_level.create', compact('statusDDL', 'plTypeDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'type' => 'required|string|max:255',
            'weight' => 'required',
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ])->validate();

        PriceLevel::create([
            'store_id' => Auth::user()->store->id,
            'type' => $data['type'],
            'weight' => $data['weight'],
            'name' => $data['name'],
            'description' => $data['description'],
            'increment_value' => $data['increment_value'],
            'percentage_value' => $data['percentage_value'],
            'status' => $data['status'],
        ]);

        return response()->json();
    }

    public function edit($id)
    {
        $pricelevel = PriceLevel::find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $plTypeDDL = LookupRepo::findByCategory('PRICELEVELTYPE')->pluck('i18nDescription', 'code');

        return view('price_level.edit', compact('pricelevel', 'plTypeDDL', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        PriceLevel::find($id)->update($req->all());
        return response()->json();
    }

    public function delete($id)
    {
        PriceLevel::find($id)->delete();
        return redirect(route('db.price.price_level'));
    }
}
