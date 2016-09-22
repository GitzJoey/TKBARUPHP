<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/22/2016
 * Time: 5:04 PM
 */

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Lookup;
use App\PriceLevel;

class PriceLevelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pricelevel = PriceLevel::paginate(10);
        return view('price_level.index')->with('pricelevel', $pricelevel);
    }

    public function show($id)
    {
        $pricelevel = PriceLevel::find($id);
        return view('price_level.show')->with('pricelevel', $pricelevel);
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $plTypeDDL = Lookup::where('category', '=', 'PRICELEVELTYPE')->get()->pluck('description', 'code');

        return view('price_level.create', compact('statusDDL', 'plTypeDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'type' => 'required|string|max:255',
            'weight' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'increment_value' => 'required',
            'percentage_value' => 'required',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.price.price_level.create'))->withInput()->withErrors($validator);
        } else {

            PriceLevel::create([
                'type' => $data['type'],
                'weight' => $data['weight'],
                'name' => $data['name'],
                'description' => $data['description'],
                'increment_value' => $data['increment_value'],
                'percentage_value' => $data['[percentage_value'],
                'status' => $data['status'],
            ]);
            return redirect(route('db.price.price_level'));
        }
    }

    public function edit($id)
    {
        $pricelevel = PriceLevel::find($id);

        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');

        return view('price_level.edit', compact('product', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        PriceLevel::find($id)->update($req->all());
        return redirect(route('db.price.price_level'));
    }

    public function delete($id)
    {
        PriceLevel::find($id)->delete();
        return redirect(route('db.price.price_level'));
    }
}