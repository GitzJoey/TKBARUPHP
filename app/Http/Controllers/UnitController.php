<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 5:52 PM
 */

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

use App\Model\Unit;
use App\Repos\LookupRepo;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $unitlist = Unit::paginate(10);

        return view('unit.index')->with('unitlist', $unitlist);
    }

    public function show($id)
    {
        $unit = Unit::find($id);

        return view('unit.show', compact('unit'));
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');

        return view('unit.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        Unit::create([
            'name' => $data['name'],
            'symbol' => $data['symbol'],
            'status' => $data['status'],
            'remarks' => $data['remarks'],
        ]);

        return response()->json([
            'result' => 'success'
        ]);
    }

    public function edit($id)
    {
        $unit = Unit::find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');

        return view('unit.edit', compact('unit', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'symbol' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        Unit::find($id)->update($req->all());
        
        return response()->json([
            'result' => 'success'
        ]);
    }

    public function delete($id)
    {
        Unit::find($id)->delete();
        return redirect(route('db.admin.unit'));
    }
}
