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
        Auth::user()->userDetail->type == 'USERTYPE.A' ?
            $userDDL = User::where('store_id', '=', Auth::user()->store->id)->get() :
            $userDDL = User::get()->where('store_id', '=', Auth::user()->store->id)->where('id', '=', Auth::user()->id);

        $warehouseDDL = Warehouse::get();

        return view('setting.index', compact('userDDL', 'warehouseDDL'));
    }

    public function update()
    {

        return redirect(route('db.admin.settings'));
    }
}