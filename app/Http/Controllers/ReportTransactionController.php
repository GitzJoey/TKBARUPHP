<?php

namespace App\Http\Controllers;

use App\Model\Lookup;
use App\Model\PurchaseOrder;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ReportTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generatePurchaseOrderReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generatePurchaseOrderReport');

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;
        $statusDDL = Lookup::whereCategory('STATUS')->pluck('description', 'code');

        //Parameters
        $vendorTruckingName = $request->input('name');

        $vendorTruckings = PurchaseOrder::with('store')
            ->when(!empty($vendorTruckingName), function ($query) use ($vendorTruckingName) {
                return $query->where('name', 'like', "%$vendorTruckingName%");
            })->get();

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
