<?php

namespace App\Http\Controllers;

use App\Model\TaxOutput;
use App\Repos\LookupRepo;
use Illuminate\Http\Request;

class TaxGenerateController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $taxes_output = TaxOutput::with('transactions')
            ->orderBy('invoice_date', 'asc')
            ->get();

        $gstTranTypeDDL = LookupRepo::findByCategory('GSTTRANSACTIONTYPEOUTPUT');
        $tranDocDDL = LookupRepo::findByCategory('TRANSACTIONDOCOUTPUT');
        $tranDetailDDL = LookupRepo::findByCategory('TRANSACTIONDETAILOUTPUT');

        return response()->view('tax.generate', compact('taxes_output', 'gstTranTypeDDL', 'tranDocDDL', 'tranDetailDDL'));
    }
}
