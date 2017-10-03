<?php

namespace App\Http\Controllers;

use App\Model\Bank;
use App\Model\Truck;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Supplier;
use App\Model\Warehouse;
use App\Model\ProductType;
use App\Model\VendorTrucking;
use App\Model\TruckMaintenance;

use App\Repos\LookupRepo;


use Validator;
use Carbon\Carbon;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Maatwebsite\Excel\Facades\Excel;

class ReportMasterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generateCustomerReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateCustomerReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        //Parameters
        $customerName = $request->input('name');
        $profileName = $request->input('profile_name');
        $bankAccount = $request->input('bank_account');

        $customers = Customer::with('store', 'priceLevel', 'profiles.phoneNumbers.provider', 'bankAccounts.bank')
            ->when(!empty($customerName), function ($query) use ($customerName) {
                return $query->orWhere('name', 'like', "%$customerName%");
            })
            ->when(!empty($profileName), function ($query) use ($profileName) {
                return $query->orWhereHas('profiles', function ($q) use ($profileName){
                    $q->orWhere('first_name', 'like', "%$profileName%")
                        ->orWhere('last_name', 'like', "%$profileName%");
                });
            })
            ->when(!empty($bankAccount), function ($query) use ($bankAccount) {
                return $query->orWhereHas('bankAccounts', function ($q) use ($bankAccount){
                    $q->where('account_number', 'like', "%$bankAccount%");
                });
            })
            ->get();

        if (count($customers) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Customer_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.customer_report',
            compact('customerName', 'profileName', 'bankAccount', 'customers', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($customerName, $profileName, $bankAccount, $customers, $statusDDL, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($customerName, $profileName, $bankAccount, $customers, $statusDDL, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.customer_report',
                    compact('customerName', 'profileName', 'bankAccount', 'customers', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateSupplierReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateSupplierReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        //Parameters
        $supplierName = $request->input('name');
        $profileName = $request->input('profile_name');
        $bankAccount = $request->input('bank_account');

        $suppliers = Supplier::with('profiles.phoneNumbers.provider', 'bankAccounts.bank')
            ->when(!empty($supplierName), function ($query) use ($supplierName) {
                return $query->orWhere('name', 'like', "%$supplierName%");
            })
            ->when(!empty($profileName), function ($query) use ($profileName) {
                return $query->orWhereHas('profiles', function ($q) use ($profileName){
                    $q->orWhere('first_name', 'like', "%$profileName%")
                        ->orWhere('last_name', 'like', "%$profileName%");
                });
            })
            ->when(!empty($bankAccount), function ($query) use ($bankAccount) {
                return $query->orWhereHas('bankAccounts', function ($q) use ($bankAccount){
                    $q->where('account_number', 'like', "%$bankAccount%");
                });
            })
            ->get();

        if (count($suppliers) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Supplier_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.supplier_report',
            compact('supplierName', 'profileName', 'bankAccount', 'suppliers', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($supplierName, $profileName, $bankAccount, $suppliers, $statusDDL, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($supplierName, $profileName, $bankAccount, $suppliers, $statusDDL, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.supplier_report',
                    compact('supplierName', 'profileName', 'bankAccount', 'suppliers', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateProductReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateProductReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        //Parameters
        $productName = $request->input('name');
        $shortCode = $request->input('short_code');

        $products = Product::with('productUnits', 'type')
            ->when(!empty($productName), function ($query) use ($productName){
                return $query->orWhere('name', 'like', "%$productName%");
            })
            ->when(!empty($shortCode), function ($query) use ($shortCode){
                return $query->orWhere('short_code', 'like', "%$shortCode%");
            })
            ->get();

        if (count($products) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
        }

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Product_Report_" . $reportDate->format('Ymd');

        //Save pdf report
        $pdf->loadView('report_template.pdf.product_report',
            compact('productName', 'shortCode', 'products', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'))
            ->setPaper('a4', 'landscape')
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($productName, $shortCode, $products, $statusDDL, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($productName, $shortCode, $products, $statusDDL, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.product_report',
                    compact('productName', 'shortCode', 'products', 'statusDDL', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateProductTypeReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateProductTypeReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        //Parameters
        $productTypeName = $request->input('name');
        $shortCode = $request->input('short_code');

        $productTypes = ProductType::with('store')
            ->when(!empty($productTypeName), function ($query) use ($productTypeName){
                return $query->orWhere('name', 'like', "%$productTypeName%");
            })
            ->when(!empty($shortCode), function ($query) use ($shortCode){
                return $query->orWhere('short_code', 'like', "%$shortCode%");
            })
            ->get();

        if (count($productTypes) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
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

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        //Parameters
        $bankName = $request->input('name');
        $shortName = $request->input('short_name');
        $branch = $request->input('branch');
        $branchCode = $request->input('branch_code');

        $banks = Bank::when(!empty($bankName), function ($query) use ($bankName){
            return $query->where('name', 'like', "%$bankName%");
        })
            ->when(!empty($shortName), function ($query) use ($shortName){
                return $query->where('short_name', 'like', "%$shortName%");
            })
            ->when(!empty($branch), function ($query) use ($branch){
                return $query->where('branch', 'like', "%$branch%");
            })
            ->when(!empty($branchCode), function ($query) use ($branchCode){
                return $query->where('branch_code', 'like', "%$branchCode%");
            })
            ->get();

        if (count($banks) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
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

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        //Parameters
        $warehouseName = $request->input('name');

        $warehouses = Warehouse::with('store')
            ->when(!empty($warehouseName), function ($query) use ($warehouseName){
                return $query->where('name', 'like', "%$warehouseName%");
            })->get();

        if (count($warehouses) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
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

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $truckTypeDDL = LookupRepo::findByCategory('TRUCKTYPE')->pluck('description', 'code');

        //Parameters
        $plateNumber = $request->input('plate_number');

        $trucks = Truck::with('store')
            ->when(!empty($plateNumber), function ($query) use ($plateNumber){
                return $query->where('plate_number', 'like', "%$plateNumber%");
            })->get();

        if (count($trucks) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
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

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $truckMaintenanceTypeDDL = LookupRepo::findByCategory('TRUCKMTCTYPE')->pluck('description', 'code');

        //Parameters
        $truckId = $request->input('truck_id');

        $truckMaintenances = TruckMaintenance::with('store', 'truck')
            ->when(!empty($truckId), function ($query) use ($truckId){
                return $query->where('truck_id', '=', $truckId);
            })->get();

        $plateNumber = '';

        $truck = Truck::find($truckId);
        if($truck){
            $plateNumber = $truck->plate_number;
        }

        if (count($truck) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
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

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        //Parameters
        $vendorTruckingName = $request->input('name');

        $vendorTruckings = VendorTrucking::with('store')
            ->when(!empty($vendorTruckingName), function ($query) use ($vendorTruckingName) {
                return $query->where('name', 'like', "%$vendorTruckingName%");
            })->get();

        if (count($vendorTruckings) == 0) {
            $rules = ['notFound' => 'required'];
            $messages = ['notFound.required' => Lang::get('labels.DATA_NOT_FOUND')];
            Validator::make($request->all(), $rules, $messages)->validate();
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
}
