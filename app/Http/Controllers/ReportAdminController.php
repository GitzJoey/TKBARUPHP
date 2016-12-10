<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/8/2016
 * Time: 11:49 AM
 */

namespace App\Http\Controllers;

use App\Model\PhoneProvider;
use App\User;

use Carbon\Carbon;
use LaravelLocalization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generateUserReport(Request $request)
    {
        Log::info('ReportAdminController@generateUserReport');

        $showParameter = true;

        $paramUser = $request->input('inputUser_User');
        $paramEmail = $request->input('inputUser_Email');
        $paramRole = $request->input('inputUser_Role');
        $paramProfile = $request->input('inputUser_Profile');

        $currentUser = Auth::user()->name;

        $user = User::where('name', '=', $paramUser)->with('store')->first();

        //Array to hold titles
        $titleArray = collect([]);

        //Array to hold data
        $dataArray = collect([]);

        Carbon::setLocale(Lang::getLocale());
        $reportDate = Carbon::now()->toDayDateTimeString();

        //Set report title
        $titleArray->push('');

        $headerArray = [];
        if  (LaravelLocalization::getCurrentLocale() == "en") {
            $headerArray = collect(['Store', 'Name', 'Email', 'Type', 'Allow Login', 'Link Profile']);
        } else {
            $headerArray = collect(['Store', 'Name', 'Email', 'Type', 'Allow Login', 'Link Profile']);
        }

        //Record
        if(!is_null($user)){
            $dataArray = collect([
                $user->store->name,
                $user->name,
                $user->email,
                $user->type,
                $user->userDetail->allow_login,
                $user->profile->first_name
            ]);
        }

        //Array to hold overall data for report
        $report = collect([
            'titles' => $titleArray,
            'headers' => $headerArray,
            'data' => $dataArray,
            'user' => $currentUser,
            'date' => $reportDate,
            'parameters' => collect([])
        ]);

        if($showParameter){
            $report['parameters']->push([
                'label' => 'user', 'value' => $paramUser
            ]);
        }

        Excel::create("User Report - $user", function ($excel) use ($report){
            $excel->sheet('Sheet 1', function ($sheet) use ($report) {
                $sheet->loadView('report_template.user_report', compact('report'));
                $sheet->setPageMargin(0.30);
                $sheet->setAutoSize(true);
            });
        })->download('xlsx');

        return redirect(route('db.report.admin'));
    }

    public function generateRoleReport(Request $request)
    {
        Log::info('ReportAdminController@generateRoleReport');

        $showParameter = true;

        $paramName = $request->input('inputRole_Name');
        $paramPermission = $request->input('inputRole_Permission');

        $currentUser = Auth::user()->name;

        $role = Role::where('name', '=', $paramName)->first();

        //Array to hold titles
        $titleArray = collect([]);

        //Array to hold data
        $dataArray = collect([]);

        Carbon::setLocale(Lang::getLocale());
        $reportDate = Carbon::now()->toDayDateTimeString();

        //Set report title
        $titleArray->push('');

        $headerArray = [];
        if  (LaravelLocalization::getCurrentLocale() == "en") {
            $headerArray = collect(['Name', 'Display Name', 'Description', 'Permission']);
        } else {
            $headerArray = collect(['Name', 'Display Name', 'Description', 'Permission']);
        }

        //Record
        if(!is_null($role)){
            $dataArray = collect([
                $role->name,
                $role->display_name,
                $role->description
            ]);
        }

        //Array to hold overall data for report
        $report = collect([
            'titles' => $titleArray,
            'headers' => $headerArray,
            'data' => $dataArray,
            'user' => $currentUser,
            'date' => $reportDate,
            'parameters' => collect([])
        ]);

        if($showParameter){
            $report['parameters']->push([
                'label' => 'name', 'value' => $paramName
            ]);
        }

        Excel::create("Role Report - $role", function ($excel) use ($report){
            $excel->sheet('Sheet 1', function ($sheet) use ($report) {
                $sheet->loadView('report_template.role_report', compact('report'));
                $sheet->setPageMargin(0.30);
                $sheet->setAutoSize(true);
            });
        })->download('xlsx');

        return redirect(route('db.report.admin'));
    }

    public function generateStoreReport(Request $request)
    {
        Log::info('ReportAdminController@generateStoreReport');

        $showParameter = true;

        $paramName = $request->input('inputStore_Name');
        $paramTaxId = $request->input('inputStore_TaxId');

        $currentUser = Auth::user()->name;

        $store = Store::where('name', '=', $paramName)->first();

        //Array to hold titles
        $titleArray = collect([]);

        //Array to hold data
        $dataArray = collect([]);

        Carbon::setLocale(Lang::getLocale());
        $reportDate = Carbon::now()->toDayDateTimeString();

        //Set report title
        $titleArray->push('');

        $headerArray = [];
        if  (LaravelLocalization::getCurrentLocale() == "en") {
            $headerArray = collect(['Name', 'Address', 'Phone Number', 'Fax Number', 'Tax ID', 'Status', 'Default', 'Remarks']);
        } else {
            $headerArray = collect(['Name', 'Address', 'Phone Number', 'Fax Number', 'Tax ID', 'Status', 'Default', 'Remarks']);
        }

        //Record
        if(!is_null($store)){
            $dataArray = collect([
                $store->name,
                $store->address,
                $store->phone_num,
                $store->fax_num,
                $store->tax_id,
                $store->status,
                $store->is_default,
                $store->remarks,
            ]);
        }

        //Array to hold overall data for report
        $report = collect([
            'titles' => $titleArray,
            'headers' => $headerArray,
            'data' => $dataArray,
            'user' => $currentUser,
            'date' => $reportDate,
            'parameters' => collect([])
        ]);

        if($showParameter){
            $report['parameters']->push([
                'label' => 'name', 'value' => $paramName
            ]);
        }

        Excel::create("Store Report - $store", function ($excel) use ($report){
            $excel->sheet('Sheet 1', function ($sheet) use ($report) {
                $sheet->loadView('report_template.store_report', compact('report'));
                $sheet->setPageMargin(0.30);
                $sheet->setAutoSize(true);
            });
        })->download('xlsx');

        return redirect(route('db.report.admin'));
    }

    public function generateUnitReport(Request $request)
    {
        Log::info('ReportAdminController@generateUnitReport');

        $showParameter = true;

        $paramName = $request->input('inputUnit_Name');
        $paramSymbol = $request->input('inputUnit_Symbol');

        $currentUser = Auth::user()->name;

        $unit = Unit::where('name', '=', $paramName)->first();

        //Array to hold titles
        $titleArray = collect([]);

        //Array to hold data
        $dataArray = collect([]);

        Carbon::setLocale(Lang::getLocale());
        $reportDate = Carbon::now()->toDayDateTimeString();

        //Set report title
        $titleArray->push('');

        $headerArray = [];
        if  (LaravelLocalization::getCurrentLocale() == "en") {
            $headerArray = collect(['Name', 'Symbol', 'Status', 'Remarks']);
        } else {
            $headerArray = collect(['Name', 'Symbol', 'Status', 'Remarks']);
        }

        //Record
        if(!is_null($unit)){
            $dataArray = collect([
                $unit->name,
                $unit->symbol,
                $unit->status,
                $unit->remarks,
            ]);
        }

        //Array to hold overall data for report
        $report = collect([
            'titles' => $titleArray,
            'headers' => $headerArray,
            'data' => $dataArray,
            'user' => $currentUser,
            'date' => $reportDate,
            'parameters' => collect([])
        ]);

        if($showParameter){
            $report['parameters']->push([
                'label' => 'name', 'value' => $paramName
            ]);
        }

        Excel::create("Unit Report - $unit", function ($excel) use ($report){
            $excel->sheet('Sheet 1', function ($sheet) use ($report) {
                $sheet->loadView('report_template.unit_report', compact('report'));
                $sheet->setPageMargin(0.30);
                $sheet->setAutoSize(true);
            });
        })->download('xlsx');

        return redirect(route('db.report.admin'));
    }

    public function generatePhoneProviderReport(Request $request)
    {
        Log::info('ReportAdminController@generatePhoneProviderReport');

        $showParameter = true;

        $paramName = $request->input('inputUnit_Name');
        $paramShortName = $request->input('inputUnit_ShortName');

        $currentUser = Auth::user()->name;

        $ph = PhoneProvider::where('name', '=', $paramName)->first();

        //Array to hold titles
        $titleArray = collect([]);

        //Array to hold data
        $dataArray = collect([]);

        Carbon::setLocale(Lang::getLocale());
        $reportDate = Carbon::now()->toDayDateTimeString();

        //Set report title
        $titleArray->push('');

        $headerArray = [];
        if  (LaravelLocalization::getCurrentLocale() == "en") {
            $headerArray = collect(['Name', 'Short Name', 'Prefix', 'Status', 'Remarks']);
        } else {
            $headerArray = collect(['Name', 'Short Name', 'Prefix', 'Status', 'Remarks']);
        }

        //Record
        if(!is_null($ph)){
            $dataArray = collect([
                $ph->name,
                $ph->short_name,
                $ph->prefix,
                $ph->status,
                $ph->remarks,
            ]);
        }

        //Array to hold overall data for report
        $report = collect([
            'titles' => $titleArray,
            'headers' => $headerArray,
            'data' => $dataArray,
            'user' => $currentUser,
            'date' => $reportDate,
            'parameters' => collect([])
        ]);

        if($showParameter){
            $report['parameters']->push([
                'label' => 'name', 'value' => $paramName
            ]);
        }

        Excel::create("Phone Provider Report - $ph", function ($excel) use ($report){
            $excel->sheet('Sheet 1', function ($sheet) use ($report) {
                $sheet->loadView('report_template.phone_provider_report', compact('report'));
                $sheet->setPageMargin(0.30);
                $sheet->setAutoSize(true);
            });
        })->download('xlsx');

        return redirect(route('db.report.admin'));
    }

    public function generateSettingsReport(Request $request)
    {
        Log::info('ReportAdminController@generateSettingsReport');

        $showParameter = true;

        $paramUser = $request->input('inputSettings_User');

        $currentUser = Auth::user()->name;

        $settings = Settings::where('user_id', '=', $paramUser)->first();

        //Array to hold titles
        $titleArray = collect([]);

        //Array to hold data
        $dataArray = collect([]);

        Carbon::setLocale(Lang::getLocale());
        $reportDate = Carbon::now()->toDayDateTimeString();

        //Set report title
        $titleArray->push('');

        $headerArray = [];
        if  (LaravelLocalization::getCurrentLocale() == "en") {
            $headerArray = collect(['Key', 'Value']);
        } else {
            $headerArray = collect(['Key', 'Value']);
        }

        //Record
        if(!is_null($settings)){
            $dataArray = collect([
                $settings->key,
                $settings->value,
            ]);
        }

        //Array to hold overall data for report
        $report = collect([
            'titles' => $titleArray,
            'headers' => $headerArray,
            'data' => $dataArray,
            'user' => $currentUser,
            'date' => $reportDate,
            'parameters' => collect([])
        ]);

        if($showParameter){
            $report['parameters']->push([
                'label' => 'user', 'value' => $paramUser
            ]);
        }

        Excel::create("Settings Report - $settings", function ($excel) use ($report){
            $excel->sheet('Sheet 1', function ($sheet) use ($report) {
                $sheet->loadView('report_template.settings_report', compact('report'));
                $sheet->setPageMargin(0.30);
                $sheet->setAutoSize(true);
            });
        })->download('xlsx');

        return redirect(route('db.report.admin'));
    }
}