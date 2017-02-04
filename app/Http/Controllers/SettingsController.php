<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/6/2016
 * Time: 1:26 AM
 */

namespace App\Http\Controllers;

use App\User;
use App\Model\Setting;
use App\Model\Warehouse;

use Auth;
use Illuminate\Http\Request;

use App\Services\SettingService;

class SettingsController extends Controller
{
    private $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->middleware('auth');

        $this->settingService = $settingService;
    }

    public function index()
    {
        $userDDL = User::where('store_id', '=', Auth::user()->store->id)->get();
        return view('setting.index', compact('userDDL'));
    }

    public function update()
    {

        return redirect(route('db.admin.settings'));
    }

    public function userSettings()
    {
        $warehouseDDL = Warehouse::get();

        return view('setting.user', compact('warehouseDDL'));
    }

    public function userSettingsUpdate()
    {
        return view('setting.user');
    }
}