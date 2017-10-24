<?php

namespace App\Http\Controllers;

use App\Model\TaxOutput;
use App\Repos\LookupRepo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;
use Maatwebsite\Excel\Writers\LaravelExcelWriter;

class TaxGenerateController extends Controller
{
    /**
     * Show view excel that going to be generated.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes_output = TaxOutput::with('transactions')
            ->orderBy('invoice_date', 'asc')
            ->get();

        $gstTranTypeDDL = LookupRepo::findByCategory('GSTTRANSACTIONTYPEOUTPUT');
        $tranDocDDL = LookupRepo::findByCategory('TRANSACTIONDOCOUTPUT');
        $tranDetailDDL = LookupRepo::findByCategory('TRANSACTIONDETAILOUTPUT');

        return response()->view('tax.generate', compact('taxes_output', 'gstTranTypeDDL', 'tranDocDDL', 'tranDetailDDL'));
    }

    /**
     * Download Import Product Excel
     *
     * @param string $format
     * @return \Illuminate\Http\Response
     */
    public function indexImportProductsExcel($format = 'xlsx')
    {
        $taxes_output = TaxOutput::with('transactions')
            ->orderBy('invoice_date', 'asc')
            ->get();

        return Excel::create('ImporBarang', function (LaravelExcelWriter $excel) use($taxes_output) {
            $excel->setTitle('ImporBarang');
            $excel->sheet('Sheet 1', function (LaravelExcelWorksheet $sheet) use($taxes_output) {
                $sheet->loadView('tax.generate_components.import_products.excel', [
                    'taxes_output' => $taxes_output
                ]);
            });
        })->download($format);
    }

    /**
     * Download Import Opponent Excel
     *
     * @param string $format
     * @return \Illuminate\Http\Response
     */
    public function indexImportOpponentsExcel($format = 'xlsx')
    {
        $taxes_output = TaxOutput::with('transactions')
            ->orderBy('invoice_date', 'asc')
            ->get();

        return Excel::create('ImporLawan', function (LaravelExcelWriter $excel) use($taxes_output) {
            $excel->setTitle('ImporLawan');
            $excel->sheet('Sheet 1', function (LaravelExcelWorksheet $sheet) use($taxes_output) {
                $sheet->loadView('tax.generate_components.import_opponents.excel', [
                    'taxes_output' => $taxes_output
                ]);
            });
        })->download($format);
    }
}
