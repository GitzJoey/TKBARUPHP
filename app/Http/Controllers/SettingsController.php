<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/6/2016
 * Time: 1:26 AM
 */

namespace App\Http\Controllers;

use App\Settings;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = Settings::paginate(10);
        return view('settings.index')->with('data', $settings);
    }

    public function edit($id)
    {
        $settings = Settings::find($id);

        return view('settings.edit', compact('settings'));

    }

    public function update(Request $data)
    {

    }
}