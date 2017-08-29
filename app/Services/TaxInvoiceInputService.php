<?php

namespace App\Services;
use Doctrine\Common\Collections\Collection;
use Illuminate\Http\Request;

interface TaxInvoiceInputService
{
    public function createInvoice(Request $request);

    public function getTaxByID($id);

    public function editInvoice(Request $request, $invoiceId);
}