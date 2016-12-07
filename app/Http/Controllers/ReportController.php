<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

use App\Model\Warehouse;
use App\Model\Role;
use App\Model\Truck;
use App\Model\Lookup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
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

    public function generateWarehouseReport(Request $request)
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
        //Array to hold data
        $dataArray = collect([]);
        Carbon::setLocale(Lang::getLocale());
        $reportDate = Carbon::now()->toDayDateTimeString();

        //Set report title
        $titleArray->push($warehouseName);
        //Column Header
        $headerArray = collect(['Store', 'Name', 'Address', 'Phone Number', 'Status', 'Remarks']);
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
            'date' => $reportDate,
            'parameters' => collect([])
        ]);

        if($showParameter){
            $report['parameters']->push(['label' => 'name', 'value' => $request->input('name')]);
        }

        Excel::create("Warehouse Report - $warehouseName", function ($excel) use ($report){
            $excel->sheet('Sheet 1', function ($sheet) use ($report) {
                $sheet->loadView('report_template.warehouse_report', compact('report'));
                $sheet->setPageMargin(0.30);
                $sheet->setAutoSize(true);
            });
        })->download('xlsx');

        return redirect(route('db.report.master'));
    }
}