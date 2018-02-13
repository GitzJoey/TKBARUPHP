<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

use App\Model\Role;
use App\Model\Truck;
use App\Model\TaxInput;
use App\Model\TaxOutput;

use App\Repos\LookupRepo;

use App\Services\StockService;
use App\Services\ReportService;

use Log;
use Auth;
use File;
use Exception;
use Carbon\Carbon;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    private $reportService;
    private $stockService;

    public function __construct(ReportService $reportService, StockService $stockService)
    {
        $this->middleware('auth');
        $this->reportService = $reportService;
        $this->stockService = $stockService;
    }

    public function report_trx()
    {
        return view('report.transaction');
    }

    public function report_mon()
    {
        return view('report.monitoring');
    }

    public function downloadStock(Request $request, PDF $pdf)
    {
        Log::info("[ReportController@downloadStock]");

        $this->reportService->doReportHousekeeping();

        $currentUser = Auth::user()->name;
        $reportDate = Carbon::now();
        $showParameter = true;

        $reportType = strtoupper($request->query('f'));

        $stockList = $this->reportService->getStockList($this->stockService->getCurrentStocks());

        if (!File::exists(storage_path('app/public/reports'))) {
            File::makeDirectory(storage_path('app/public/reports'));
        }

        $fileName = "Stock_List_" . $reportDate->format('Ymd');

        $pdf->loadView('report_template.pdf.stock_list_report',
            compact('stockList', 'currentUser', 'reportDate', 'showParameter'))
            ->save(storage_path("app/public/reports/$fileName.pdf"));

        //Save excel report
        Excel::create($fileName, function ($excel)
        use ($stockList, $currentUser, $reportDate, $showParameter) {
            $excel->sheet('Sheet 1', function ($sheet)
            use ($stockList, $currentUser, $reportDate, $showParameter) {
                $sheet->loadView('report_template.excel.stock_list_report',
                    compact('stockList', 'currentUser', 'reportDate', 'showParameter'));
                $sheet->setPageMargin(0.30);
            });
        })->store('xlsx', storage_path("app/public/reports"));

        if ($reportType == 'PDF') {
            return response()->download(storage_path("app/public/reports/") . $fileName . '.pdf', $fileName . '.pdf', ['Content-Type' => 'application/pdf']);
        } else if ($reportType == 'XLS') {
            return response()->download(storage_path('app/public/reports/') . $fileName . '.xlsx', $fileName . '.xlsx', ['Content-Type' => 'application/octet-stream']);
        } else {
            return redirect()->action('ReportController@view', ['fileName' => $fileName]);
        }
    }

    public function report_tax($year = null, $month = null)
    {
        $this->validateWith(validator([
            'year' => $year,
            'month' => $month,
        ], [
            'year' => 'numeric|nullable',
            'month' => 'numeric|nullable'
        ]), request());

        if (is_null($year) || is_null($month)) {
            $year = !is_null($year) ? $year : Carbon::now()->year;
            $month = !is_null($month) ? $month : Carbon::now()->month;
            return response()->redirectTo(route('db.report.tax', [ $year, $month ]));
        }

        $months = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        $taxes_input = TaxInput::where('month', $month)
            ->where('year', $year)
            ->orderBy('invoice_date', 'asc')
            ->get();
        $taxes_output = TaxOutput::with('transactions')
            ->where('month', $month)
            ->where('year', $year)
            ->orderBy('invoice_date', 'asc')
            ->get();

        return view('report.tax')->with([
            'year' => $year, 'month' => $month, 'months' => $months,
            'taxes_input' => $taxes_input,
            'taxes_output' => $taxes_output
        ]);
    }

    public function report_master()
    {
        $trucklist = Truck::get()->pluck('plate_number', 'id');

        return view('report.master', compact('trucklist'));
    }

    public function report_admin()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $rolesDDL = Role::get()->pluck('display_name', 'name');

        return view('report.admin', compact('statusDDL', 'rolesDDL'));
    }

    public function view($fileName)
    {
        return view('report.viewer', compact('fileName'));
    }
}
