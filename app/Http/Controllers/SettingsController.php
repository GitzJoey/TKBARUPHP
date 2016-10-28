<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/6/2016
 * Time: 1:26 AM
 */

namespace App\Http\Controllers;

use App\Model\Setting;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = Setting::paginate(10);
        return view('setting.index')->with('data', $settings);
    }

    public function edit($id)
    {
        $settings = Setting::find($id);

        return view('setting.edit', compact('settings'));

    }

    public function update(Request $data)
    {

    }
}