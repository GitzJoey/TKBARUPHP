<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

use Excel;
use App\Model\Role;
use App\Model\Truck;
use App\Model\TaxInput;
use App\Model\TaxOutput;

use App\Repos\LookupRepo;
use Carbon\Carbon;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Writers\CellWriter;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;

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

    public function reportTaxExcel($year, $month, $format)
    {
        $this->validateWith(validator([
            'year' => $year,
            'month' => $month
        ], [
            'year' => 'numeric|nullable',
            'month' => 'numeric|nullable'
        ]), request());

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
        $taxes_input_array = [];
        foreach ($taxes_input as $key => $tax_input) {
            array_push($taxes_input_array, [
                __('report.tax.input.table.header.invoice_date') => $tax_input->invoice_date,
                __('report.tax.input.table.header.invoice_no') => $tax_input->invoice_no,
                __('report.tax.input.table.header.detail') => $tax_input->detail,
                __('report.tax.input.table.header.unit') => $tax_input->unit,
                __('report.tax.input.table.header.unit_price') => $tax_input->unit_price,
                __('report.tax.input.table.header.tax_base') => $tax_input->tax_base,
                __('report.tax.input.table.header.gst') => $tax_input->gst,
                __('report.tax.input.table.header.grand_total') => $tax_input->tax_base + $tax_input->gst + $tax_input->luxury_tax,
            ]);
        }
        array_push($taxes_input_array, [
            __('report.tax.input.table.header.invoice_date') => null,
            __('report.tax.input.table.header.invoice_no') => null,
            __('report.tax.input.table.header.detail') => null,
            __('report.tax.input.table.header.unit') => null,
            __('report.tax.input.table.header.unit_price') => null,
            __('report.tax.input.table.header.tax_base') => 'Total',
            __('report.tax.input.table.header.gst') => $taxes_input->sum('gst'),
            __('report.tax.input.table.header.grand_total') => $taxes_input->map(function ($tax_input) {
                return $tax_input->tax_base + $tax_input->gst + $tax_input->luxury_tax;
            })->sum(),
        ]);

        $taxes_output = null;
        $taxes_output_array = [];

        return Excel::create($month.'-'.$year.' Rincian Pembelian Penjualan', function (LaravelExcelWriter $excel) use($year, $month, $months, $taxes_input, $taxes_output) {
                    // Set the title
                    $excel->setTitle($month.'-'.$year.' Rincian Pembelian Penjualan');
                    $excel->sheet('Pembelian', function(LaravelExcelWorksheet $sheet) use($year, $month, $months, $taxes_input, $taxes_output) {
                        $sheet->loadView('report.tax.excel')->with([
                            'year' => $year, 'month' => $month, 'months' => $months,
                            'taxes_input' => $taxes_input,
                            'taxes_output' => $taxes_output
                        ]);
                    });
                    $excel->sheet('Penjualan', function(LaravelExcelWorksheet $sheet) use($year, $month, $months, $taxes_input, $taxes_output) {
                        
                    });
                })->download($format);
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
