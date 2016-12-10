<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

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

    public function generateWarehouseReport(Request $request, PDF $pdf)
    {
        Log::info('ReportController@generateWarehouseReport');

        $statusDDL = Lookup::whereCategory('STATUS')->pluck('description', 'code');
        $showParameter = true;
        $warehouseName = $request->input('name');
        $currentUser = Auth::user()->name;

        $warehouse = Warehouse::where('name', '=', $request->input('name'))->with('store')
            ->first();

        //Array to hold titles
        $titleArray = collect([]);
        //Array to hold parameters sent
        $parameterArray = collect([]);
        //Array to hold data
        $dataArray = collect([]);

        $reportDate = Carbon::now();

        if(isset($warehouseName)){
            //Set report title
            $titleArray->push($warehouseName);
        }

        if($showParameter && !empty($request->input('name'))){
            $parameterArray->push(['label' => 'name', 'value' => $request->input('name')]);
        }

        //Column Header
        $headerArray = collect([
            ['label' => 'Store', 'width' => '15%'],
            ['label' => 'Name', 'width' => '20%'],
            ['label' => 'Address', 'width' => '20%'],
            ['label' => 'Phone Number', 'width' => '15%'],
            ['label' => 'Status', 'width' => '10%'],
            ['label' => 'Remarks', 'width' => '20%']
        ]);

        //Record
        if(!is_null($warehouse)){
            $dataArray = collect([
                $warehouse->store->name,
                $warehouse->name,
                $warehouse->address,
                $warehouse->phone_num,
                $statusDDL[$warehouse->status],
                $warehouse->remarks
            ]);
        }

        //Array to hold overall data for report
        $report = collect([
            'titles' => $titleArray,
            'headers' => $headerArray,
            'data' => $dataArray,
            'user' => $currentUser,
            'date' => $reportDate->toDayDateTimeString(),
            'parameters' => $parameterArray
        ]);

        $fileName = "Warehouse_Report_" . $warehouseName . "_" . $reportDate->format('Ymdhis');

        if(!File::exists(storage_path('app/public/reports')))
        {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        //Save pdf report
        $pdf->loadView('report_template.pdf.warehouse_report', compact('report'))->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel) use ($report){
            $excel->sheet('Sheet 1', function ($sheet) use ($report) {
                $sheet->loadView('report_template.excel.warehouse_report', compact('report'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        return redirect(route('db.report.view', $fileName));
    }

    public function generateVendorTruckingReport(Request $request, PDF $pdf)
    {
        $statusDDL = Lookup::whereCategory('STATUS')->pluck('description', 'code');
        $showParameter = true;
        $vendorTruckingName = $request->input('name');
        $currentUser = Auth::user()->name;

        $vendorTrucking = VendorTrucking::where('name', '=', $request->input('name'))->with('store')
            ->first();

        //Array to hold titles
        $titleArray = collect([]);
        //Array to hold parameters sent
        $parameterArray = collect([]);
        //Array to hold data
        $dataArray = collect([]);

        $reportDate = Carbon::now();

        if(isset($vendorTruckingName)){
            //Set report title
            $titleArray->push($vendorTruckingName);
        }

        if($showParameter && !empty($vendorTruckingName)){
            $parameterArray->push(['label' => 'name', 'value' => $vendorTruckingName]);
        }

        //Column Header
        $headerArray = collect([
            ['label' => 'Store', 'width' => '15%'],
            ['label' => 'Name', 'width' => '20%'],
            ['label' => 'Address', 'width' => '20%'],
            ['label' => 'Tax Id', 'width' => '20%'],
            ['label' => 'Status', 'width' => '5%'],
            ['label' => 'Remarks', 'width' => '20%']
        ]);

        //Record
        if(!is_null($vendorTrucking)){
            $dataArray = collect([
                $vendorTrucking->store->name,
                $vendorTrucking->name,
                $vendorTrucking->address,
                $vendorTrucking->tax_id,
                $statusDDL[$vendorTrucking->status],
                $vendorTrucking->remarks
            ]);
        }

        //Array to hold overall data for report
        $report = collect([
            'titles' => $titleArray,
            'headers' => $headerArray,
            'data' => $dataArray,
            'user' => $currentUser,
            'date' => $reportDate->toDayDateTimeString(),
            'parameters' => $parameterArray
        ]);

        $fileName = "Vendor_Trucking_Report_" . $vendorTruckingName . "_" . $reportDate->format('Ymdhis');

        if(!File::exists(storage_path('app/public/reports')))
        {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        //Save pdf report
        $pdf->loadView('report_template.pdf.vendor_trucking_report', compact('report'))->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel) use ($report){
            $excel->sheet('Sheet 1', function ($sheet) use ($report) {
                $sheet->loadView('report_template.excel.vendor_trucking_report', compact('report'));
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