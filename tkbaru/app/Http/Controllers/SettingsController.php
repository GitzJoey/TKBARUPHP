<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/6/2016
 * Time: 1:26 AM
 */

namespace App\Http\Controllers;

use App\Settings;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = Settings::get();
        return view('settings.index')->with('data', $settings);
    }
}