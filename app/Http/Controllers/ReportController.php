<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

use App\Model\Warehouse;
use App\User;
use App\Model\Role;
use App\Model\Truck;
use App\Model\Lookup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $warehouseName = $request->input('name');
        $currentUsername = Auth::user()->name;
        $currentTime = Carbon::now()->toDayDateTimeString();

        $warehouse = Warehouse::where('name', '=', $request->input('name'))->with('store')
            ->first();

        //Array to hold data for each row
        $dataArray = [];
        //Array for header
        $headerArray = [];

        //Set report header
        $headerArray[] = "Warehouse Report";
        $headerArray[] = $warehouseName;
        $headerArray[] = "Printed by $currentUsername on $currentTime";
        //Column Header
        $dataArray[] = ['Store', 'Name', 'Address', 'Phone Number', 'Status', 'Remarks'];
        //Record
        if(!is_null($warehouse))
            $dataArray[] = [$warehouse->store->name, $warehouse->name, $warehouse->address, $warehouse->phone_num, $warehouse->status, $warehouse->remarks];

        Excel::create("Warehouse Report - $warehouseName", function ($excel) use ($headerArray, $dataArray){
            $excel->sheet('Sheet 1', function ($sheet) use ($headerArray, $dataArray) {
                foreach ($headerArray as $key => $item){
                    $sheet->cell('A' . ($key + 1), function ($cell) use ($item){
                        $cell->setAlignment('center');
                        $cell->setValue($item);
                    });

                    $endColumn = 'A';
                    for($index = 1; $index < count($dataArray[0]); $endColumn++, $index++){}

                    $sheet->mergeCells('A' . ($key + 1) . ':' . $endColumn . ($key + 1));

                    $sheet->cell('A' . ($key + 1), function ($cell) use ($item){
                        $cell->setAlignment('center');
                    });
                }

                $sheet->fromArray($dataArray, null, 'A' . (count($headerArray) + 2), false, false);

                $sheet->setPageMargin(array(0.25, 0.30, 0.25, 0.30));

                $sheet->cells('A5:F5', function ($cell) use ($item){
                    $cell->setAlignment('center');
                });

                $sheet->setBorder('A5:F6','thin');
            });
        })->download('xlsx');

        return redirect(route('db.report.master'));
    }
}