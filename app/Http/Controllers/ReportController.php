<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

use App\Model\Bank;
use App\Model\Product;
use App\Model\ProductType;
use App\Model\TruckMaintenance;
use App\Model\VendorTrucking;
use App\Model\Warehouse;
use App\Model\Role;
use App\Model\Truck;
use App\Model\Lookup;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function report_trx()
    {
        return view('report.transaction');
    }

    public function report_mon()
    {
        return view('report.monitoring');
    }

    public function report_tax()
    {
        return view('report.tax');
    }

    public function report_master()
    {
        $trucklist = Truck::get()->pluck('plate_number', 'id');

        return view('report.master', compact('trucklist'));
    }

    public function report_admin()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $rolesDDL = Role::get()->pluck('display_name', 'name');

        return view('report.admin', compact('statusDDL', 'rolesDDL'));
    }

    public function generateProductTypeReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateProductTypeReport');

        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = Lookup::whereCategory('STATUS')->pluck('description', 'code');
        $productTypeName = $request->input('name');
        $shortCode = $request->input('short_code');
        $currentUser = Auth::user()->name;

        if (isset($productTypeName) || isset($shortCode)) {
            $productTypes = ProductType::with('store')->where('name', 'like', "%$productTypeName%")
                ->orWhere('short_code', 'like', "$shortCode")->get();
        } else {
            $productTypes = ProductType::with('store')->all();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Product_Type_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.product_type_report',
            compact('productTypeName', 'shortCode', 'productTypes', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($productTypeName, $shortCode, $productTypes, $statusDDL, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($productTypeName, $shortCode, $productTypes, $statusDDL, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.product_type_report',
                    compact('productTypeName', 'shortCode', 'productTypes', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateBankReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateBankReport');

        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = Lookup::whereCategory('STATUS')->pluck('description', 'code');
        $bankName = $request->input('name');
        $shortName = $request->input('short_name');
        $branch = $request->input('branch');
        $branchCode = $request->input('branch_code');
        $currentUser = Auth::user()->name;

        if (!empty($bankName) || !empty($shortName) || !empty($branch) || !empty($branchCode)) {
            $banks = Bank::where('name', 'like', "%$bankName%")
                ->orWhere('short_name', 'like', "%$shortName%")
                ->orWhere('branch', 'like', "%$branch%")
                ->orWhere('branch_code', 'like', "%$branchCode%")->get();
        } else {
            $banks = Bank::all();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Bank_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.bank_report',
            compact('bankName', 'shortName', 'branch', 'branchCode', 'banks', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($bankName, $shortName, $branch, $branchCode, $banks, $statusDDL, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($bankName, $shortName, $branch, $branchCode, $banks, $statusDDL, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.bank_report',
                    compact('bankName', 'shortName', 'branch', 'branchCode', 'banks', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateWarehouseReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateWarehouseReport');

        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = Lookup::whereCategory('STATUS')->pluck('description', 'code');
        $warehouseName = $request->input('name');
        $currentUser = Auth::user()->name;

        if (isset($warehouseName)) {
            $warehouses = Warehouse::with('store')->where('name', 'like', "%$warehouseName%")->get();
        } else {
            $warehouses = Warehouse::with('store')->all();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Warehouse_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.warehouse_report',
            compact('warehouseName', 'warehouses', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($warehouseName, $warehouses, $statusDDL, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($warehouseName, $warehouses, $statusDDL, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.warehouse_report',
                    compact('warehouseName', 'warehouses', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateTruckReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateTruckReport');

        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = Lookup::whereCategory('STATUS')->pluck('description', 'code');
        $truckTypeDDL = Lookup::whereCategory('TRUCKTYPE')->pluck('description', 'code');
        $plateNumber = $request->input('plate_number');
        $currentUser = Auth::user()->name;

        if (isset($plateNumber)) {
            $trucks = Truck::with('store')->where('plate_number', 'like', "%$plateNumber%")->get();
        } else {
            $trucks = Truck::with('store')->all();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Truck_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.truck_report',
            compact('plateNumber', 'trucks', 'statusDDL', 'truckTypeDDL', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($plateNumber, $trucks, $statusDDL, $truckTypeDDL, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($plateNumber, $trucks, $statusDDL, $truckTypeDDL, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.truck_report',
                    compact('plateNumber', 'trucks', 'statusDDL', 'truckTypeDDL', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateTruckMaintenanceReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateTruckMaintenanceReport');

        $reportDate = Carbon::now();
        $showParameter = true;
        $truckMaintenanceTypeDDL = Lookup::whereCategory('TRUCKMTCTYPE')->pluck('description', 'code');
        $plateNumber = $request->input('plate_number');
        $currentUser = Auth::user()->name;

        $type = gettype($plateNumber);
        Log::info("Truck ID Type : $type");

        if (!empty($plateNumber)) {
            $truckMaintenances = TruckMaintenance::with('store', 'truck')
                ->where('truck_id', '=', $plateNumber)->get();
        } else {
            $truckMaintenances = TruckMaintenance::with('store', 'truck')->get();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Truck_Maintenance_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.truck_maintenance_report',
            compact('plateNumber', 'truckMaintenances', 'truckMaintenanceTypeDDL', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($plateNumber, $truckMaintenances, $truckMaintenanceTypeDDL, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($plateNumber, $truckMaintenances, $truckMaintenanceTypeDDL, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.truck_maintenance_report',
                    compact('plateNumber', 'truckMaintenances', 'truckMaintenanceTypeDDL', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateVendorTruckingReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateVendorTruckingReport');

        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = Lookup::whereCategory('STATUS')->pluck('description', 'code');
        $vendorTruckingName = $request->input('name');
        $currentUser = Auth::user()->name;

        if (isset($vendorTruckingName)) {
            $vendorTruckings = VendorTrucking::with('store')->where('name', 'like', "%$vendorTruckingName%")->get();
        } else {
            $vendorTruckings = VendorTrucking::with('store')->all();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Vendor_Trucking_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.vendor_trucking_report',
            compact('vendorTruckingName', 'vendorTruckings', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($vendorTruckingName, $vendorTruckings, $statusDDL, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($vendorTruckingName, $vendorTruckings, $statusDDL, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.vendor_trucking_report',
                    compact('vendorTruckingName', 'vendorTruckings', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function view($fileName)
    {
        return view('report.viewer', compact('fileName'));
    }
}