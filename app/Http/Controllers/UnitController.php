<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 5:52 PM
 */

namespace App\Http\Controllers;

use App\Unit;
use Validator;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $unit = Unit::paginate(10);

        return view('unit.index')->with('unit', $unit);
    }

    public function show($id) {
        $unit = Unit::find($id);

        return view('unit.show', compact('unit'));
    }

    public function create() {
        return view('unit.create');
    }

    public function store(Request $data) {
        $validator = Validator::make($data->all(), [
            'name'       => 'required|string|max:255',
            'symbol' => 'required|string|max:255',
            'status'     => 'required|string|max:255',
            'remarks'    => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.admin.unit.create'))->withInput()->withErrors($validator);
        } else {

            Unit::create([
                'name'       => $data['name'],
                'symbol' => $data['symbol'],
                'status'     => $data['status'],
                'remarks'    => $data['remarks'],
            ]);

            return redirect(route('db.admin.unit'));
        }
    }

}