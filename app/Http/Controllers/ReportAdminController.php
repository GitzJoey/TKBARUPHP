<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/8/2016
 * Time: 11:49 AM
 */

namespace App\Http\Controllers;

use App\User;
use App\Model\Role;
use App\Model\Unit;
use App\Model\Store;
use App\Model\PhoneProvider;

use App\Repos\LookupRepo;

use Validator;
use Carbon\Carbon;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use App\Services\ReportService;

class ReportAdminController extends Controller
{
    private $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
        $this->middleware('auth');
    }

    public function generateUserReport(Request $request, PDF $pdf)
    {
        $this->reportService->doReportHousekeeping();

        Log::info('ReportAdminController@generateUserReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;

        //Parameters
        $userName = $request->input('name');
        $email = $request->input('email');
        $roleId = $request->input('role_id');
        $profileName = $request->input('profile_name');

        $users = User::when(!empty($userName), function ($query) use ($userName) {
                return $query->orWhere('name', 'like', "%$userName%");
            })
            ->when(!empty($email), function ($query) use ($email) {
                return $query->orWhere('email', 'like', "%$email%");
            })
            ->when(!empty($roleId), function ($query) use ($roleId) {
                return $query->orWhereHas('roles', function ($q) use ($roleId) {
                    $q->where('id', '=', $roleId);
                });
            })
            ->when($profileName, function ($query) use ($profileName) {
                return $query->orWhereHas('profile', function ($q) use ($profileName){
                    $q->orWhere('first_name', 'like', "%$profileName%")
                      ->orWhere('last_name', 'like', "%$profileName%");
                });
            })
            ->get();

        if (count($users) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
        }

        $roleName = '';

        $role = Role::find($roleId);
        if($role){
            $roleName = $role->name;
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "User_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.user_report',
            compact('userName', 'email', 'profileName', 'roleName', 'users', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($userName, $email, $profileName, $roleName, $users, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($userName, $email, $profileName, $roleName, $users, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.user_report',
                    compact('userName', 'email', 'profileName', 'roleName', 'users', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateRoleReport(Request $request, PDF $pdf)
    {
        Log::info('ReportAdminController@generateRoleReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;

        //Parameters
        $roleName = $request->input('name');
        $permission = $request->input('permission');

        $roles = Role::when(!empty($roleName), function ($query) use ($roleName) {
                return $query->orWhere('name', 'like', "%$roleName%")
                             ->orWhere('display_name', 'like', "%$roleName%");
            })
            ->when(!empty($permission), function ($query) use ($permission) {
                return $query->orWhereHas('permissions', function ($q) use ($permission){
                    $q->orWhere('name', 'like', "%$permission%")
                      ->orWhere('display_name', 'like', "%$permission%");
                });
            })
            ->get();

        if (count($roles) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Role_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.role_report',
            compact('roleName', 'permission', 'roles', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($roleName, $permission, $roles, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($roleName, $permission, $roles, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.role_report',
                    compact('roleName', 'permission', 'roles', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateStoreReport(Request $request, PDF $pdf)
    {
        Log::info('ReportAdminController@generateStoreReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        //Parameters
        $storeName = $request->input('name');
        $taxId = $request->input('tax_id');

        $stores = Store::when(!empty($storeName), function ($query) use ($storeName) {
                return $query->orWhere('name', 'like', "%$storeName%");
            })
            ->when(!empty($taxId), function ($query) use ($taxId) {
                return $query->orWhere('tax_id', 'like', "%$taxId%");
            })
            ->get();

        if (count($stores) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Store_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.store_report',
            compact('storeName', 'taxId', 'statusDDL', 'stores', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($storeName, $taxId, $statusDDL, $stores, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($storeName, $taxId, $statusDDL, $stores, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.store_report',
                    compact('storeName', 'taxId', 'statusDDL', 'stores', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateUnitReport(Request $request, PDF $pdf)
    {
        Log::info('ReportAdminController@generateUnitReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        //Parameters
        $unitName = $request->input('name');
        $symbol = $request->input('symbol');

        $units = Unit::when(!empty($unitName), function ($query) use ($unitName) {
                return $query->orWhere('name', 'like', "%$unitName%");
            })
            ->when(!empty($symbol), function ($query) use ($symbol) {
                return $query->orWhere('symbol', 'like', "%$symbol%");
            })
            ->get();

        if (count($units) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Unit_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.unit_report',
            compact('unitName', 'symbol', 'statusDDL', 'units', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($unitName, $symbol, $statusDDL, $units, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($unitName, $symbol, $statusDDL, $units, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.unit_report',
                    compact('unitName', 'symbol', 'statusDDL', 'units', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generatePhoneProviderReport(Request $request, PDF $pdf)
    {
        Log::info('ReportAdminController@generatePhoneProviderReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        //Parameters
        $phoneProviderName = $request->input('name');
        $shortName = $request->input('short_name');

        $phoneProviders = PhoneProvider::when(!empty($phoneProviderName), function ($query) use ($phoneProviderName) {
                return $query->orWhere('name', 'like', "%$phoneProviderName%");
            })
            ->when(!empty($shortName), function ($query) use ($shortName) {
                return $query->orWhere('short_name', 'like', "%$shortName%");
            })
            ->get();

        if (count($phoneProviders) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Phone_Provider_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.phone_provider_report',
            compact('phoneProviderName', 'shortCode', 'statusDDL', 'phoneProviders', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($phoneProviderName, $shortName, $statusDDL, $phoneProviders, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($phoneProviderName, $shortName, $statusDDL, $phoneProviders, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.phone_provider_report',
                    compact('phoneProviderName', 'shortCode', 'statusDDL', 'phoneProviders', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateSettingsReport(Request $request, PDF $pdf)
    {
        return "Under Constructions";
    }
}
