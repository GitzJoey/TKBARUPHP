<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repos\LookupRepo;

class TaxInvoiceOutputController extends Controller
{
    public function index()
    {
        return view('tax.invoice.output.index');
    }

    public function create()
    {
        $vatTranTypeDDL = LookupRepo::findByCategory('VATTRANSACTIONTYPEOUTPUT');
        $tranDocDDL = LookupRepo::findByCategory('TRANSACTIONDOCOUTPUT');
        $tranDetailDDL = LookupRepo::findByCategory('TRANSACTIONDETAILOUTPUT');
        return view('tax.invoice.output.create', compact('vatTranTypeDDL', 'tranDocDDL', 'tranDetailDDL'));
    }
}
