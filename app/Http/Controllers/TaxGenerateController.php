<?php

namespace App\Http\Controllers;

use App\Model\Product;
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
        $productsDDL = Product::all();

        return response()->view('tax.generate', compact('taxes_output', 'gstTranTypeDDL', 'tranDocDDL', 'tranDetailDDL', 'productsDDL'));
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

    /**
     * Download Import PK
     *
     * @param string $format
     * @return \Illuminate\Http\Response
     */
    public function indexImportPkExcel($format = 'xlsx')
    {
        $taxes_output = TaxOutput::with('transactions')
            ->orderBy('invoice_date', 'asc')
            ->get();

        return Excel::create('ImporPK', function (LaravelExcelWriter $excel) use($taxes_output) {
            $excel->setTitle('ImporPK');
            $excel->sheet('Sheet 1', function (LaravelExcelWorksheet $sheet) use($taxes_output) {
                $sheet->loadView('tax.generate_components.import_pk.excel', [
                    'taxes_output' => $taxes_output
                ]);
            });
        })->download($format);
    }

    /**
     * Download Import PM
     *
     * @param string $format
     * @return \Illuminate\Http\Response
     */
    public function indexImportPmExcel($format = 'xlsx')
    {
        $taxes_output = TaxOutput::with('transactions')
            ->orderBy('invoice_date', 'asc')
            ->get();

        return Excel::create('ImporPM', function (LaravelExcelWriter $excel) use($taxes_output) {
            $excel->setTitle('ImporPM');
            $excel->sheet('Sheet 1', function (LaravelExcelWorksheet $sheet) use($taxes_output) {
                $sheet->loadView('tax.generate_components.import_pm.excel', [
                    'taxes_output' => $taxes_output
                ]);
            });
        })->download($format);
    }
}
