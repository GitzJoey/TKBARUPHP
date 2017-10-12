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

use App\Repos\LookupRepo;
use Carbon\Carbon;

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
        $taxes_output = null;

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
